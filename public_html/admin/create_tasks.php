<?php
require(__DIR__ . "/../../../partials/nav.php");


if (!has_role("Admin")) {
    flash("You don't have permission to view this page", "warning");
    die(header("Location: " . get_url("dashboard.php")));
}
if (isset($_POST["name"]) && isset($_POST["description"]) && isset($_POST["taskType"]) && isset($_POST["assignType"]) && isset($_POST["dueDate"]) && isset($_POST["dueTime"])) {
    $assignType = se($_POST, "assignType", "", false);
    switch ($assignType) {
        case "1":
            $assignTypeName = "Individual";
            break;
        case "2":
            $assignTypeName = "Team";
            break;
        case "3":
            $assignTypeName = "Batch";
            break;
    }
    $taskType = se($_POST, "taskType", "", false);
    switch ($taskType) {
        case "1":
            $taskTypeName = "DocRequest";
            break;
        case "2":
            $taskTypeName = "Survey";
            break;
        case "3":
            $taskTypeName = "Payment";
            break;
    }
    $name = se($_POST, "name", "", false);
    $description = se($_POST, "description", "", false);
    $dueDate = se($_POST, "dueDate", "", false);
    $dueTime = se($_POST, "dueTime", "", false);
    $dueDateTime = $dueDate . " " . $dueTime;
    $dueDateTime = strtotime($dueDateTime);
    $dueDateTime = date("Y-m-d H:i:s", $dueDateTime);
    $assigner = get_user_id();
    $raw = json_encode($_POST);
    if ($assignType == "1") {
        $assignTo = $_POST["userSelect"];
    } else {
        $assignTo = $_POST["teamSelect"];
    }


    // Insert task into MasterTask table
    $db = getDB();
    $stmt = $db->prepare("INSERT INTO MasterTasks (name, task_type, assign_type, assign_to, assigned_by, due_date, about_task) VALUES (:taskName, :taskType, :assignType, :assignTo, :assignBy, :dueDate, :description)");
    try {
        $stmt->execute([ //TODO figure out how to make DB like non-strings when not in time crunch
            ":taskName" => $name,
            ":taskType" => $taskTypeName,
            ":assignType" => $assignTypeName,
            ":assignTo" => $assignTo,
            ":assignBy" => $assigner,
            ":dueDate" => $dueDateTime,
            ":description" => $description
        ]);
        error_log("Sucessfully added task into MasterTasks");
    } catch (Exception $e) {
        error_log("Error inserting task into Master Task table: " . $e->getMessage());
    }
    // Get task id from MasterTask table
    $stmt = $db->prepare("SELECT id FROM MasterTasks ORDER BY id DESC LIMIT 1");
    try {
        $stmt->execute();
        $masterID = $stmt->fetch(PDO::FETCH_ASSOC)["id"];
        error_log("Successfully retrieved task id from MasterTasks " . $masterID);
    } catch (Exception $e) {
        error_log("Error retrieving task id from MasterTasks: " . $e->getMessage());
    }

    switch ($taskType) {
        case "1": //DocRequest
            if (isset($_POST["document_1"]) && isset($_POST["type_1"])) { //Since at least one line is required
                error_log($raw);
                $array = json_decode($raw, true);
                $data = array();
                $doc = "";
                $type = "";
                foreach ($array as $key => $value) {
                    if (str_starts_with($key, "document_")) {
                        $doc = $value;
                    }
                    if (str_starts_with($key, "type_")) {
                        $type = $value;
                    }
                    if (!empty($doc) && !empty($type)) {
                        $data[] = array($doc => $type);
                        $doc = "";
                        $type = "";
                    }
                }
                error_log("data: " . json_encode($data));
                $stmt = $db->prepare("INSERT INTO DocTasks (master_id, doc_name, allowed_types, location) VALUES (:masterID, :docName, :docType, :uploadDir)");
                for ($i = 0; $i < count($data); $i++) {
                    try {
                        $stmt->execute([
                            ":masterID" => $masterID,
                            ":docName" => array_keys($data[$i])[0],
                            ":docType" => array_values($data[$i])[0],
                            ":uploadDir" => get_url("uploads/view_upload.php?id=" . $masterID)
                        ]);
                        error_log("Successfully added doc task into DocTasks");
                    } catch (Exception $e) {
                        error_log("Error inserting doc task into DocTasks: " . $e->getMessage());
                    }
                }
                // Verify that the task was added to the DBs
                if (get_task_by_id($masterID) != false) {
                    error_log("Successfully added task to DB");
                } else {
                    error_log("Error adding task to DB");
                    flash("There was an error creating your task. Please try again later.", "error");
                }
                if(assign_task($masterID)) {
                    flash ("Task successfully created!", "success");
                } else {
                    error_log("Error assigning task to users");
                    flash("There was an error assigning your task. Please try again later.", "error");
                }
            }
            break;
        case "2": // Survey/Form Task
            if (isset($_POST["question_1"]) && isset($_POST["type_1"])) {
                error_log($raw);
                $array = json_decode($raw, true);
                $data = array();
                $question = "";
                $type = "";
                foreach ($array as $key => $value) {
                    error_log("Looping through array. Current: " . $key . " Value: " . $value);
                    if (str_starts_with($key, "question_")) {
                        $question = $value;
                    }
                    if (str_starts_with($key, "type_")) {
                        $type = $value;
                    }
                    if (!empty($question) && !empty($type)) {
                        $data[] = array($question => $type);
                        $question = "";
                        $type = "";
                    }
                }
                error_log("data: " . json_encode($data));
                $stmt = $db->prepare("INSERT INTO FormTasks (master_id, question, answer_type, location) VALUES (:masterID, :questionBody, :answerType, :uploadDir)");
                for ($i = 0; $i < count($data); $i++) {
                    try {
                        $stmt->execute([
                            ":masterID" => $masterID,
                            ":questionBody" => array_keys($data[$i])[0],
                            ":answerType" => array_values($data[$i])[0],
                            ":uploadDir" => get_url("uploads/view_form.php?id=" . $masterID)
                        ]);
                        error_log("Successfully added doc task into FormTasks");
                    } catch (Exception $e) {
                        error_log("Error inserting doc task into FormTasks: " . $e->getMessage());
                    }
                }
                // Verify that the task was added to the DBs
                if (get_task_by_id($masterID) != false) {
                    error_log("Successfully added task to DB");
                } else {
                    error_log("Error adding task to DB");
                    flash("There was an error creating your task. Please try again later.", "error");
                }
                if(assign_task($masterID)) {
                    flash ("Task successfully created!", "success");
                } else {
                    error_log("Error assigning task to users");
                    flash("There was an error assigning your task. Please try again later.", "error");
                }
            }
            break;
        case "3": //Payment Task
            if (isset($_POST["line_item_1"]) && isset($_POST["amount_1"])) {
                error_log($raw);
                $array = json_decode($raw, true);
                $data = array();
                $line_itm = "";
                $amount = "";
                foreach ($array as $key => $value) {
                    error_log("Looping through array. Current: " . $key . " Value: " . $value);
                    if (str_starts_with($key, "line_item_")) {
                        $line_itm = $value;
                    }
                    if (str_starts_with($key, "amount_")) {
                        $amount = $value;
                    }
                    if (!empty($line_itm) && !empty($amount)) {
                        $data[] = array($line_itm => $amount);
                        $line_itm = "";
                        $amount = "";
                    }
                }
                error_log("data: " . json_encode($data));
                $stmt = $db->prepare("INSERT INTO PayTasks (master_id, line_name, total_due, location) VALUES (:masterID, :lineItem, :totalAmount, :uploadDir)");
                for ($i = 0; $i < count($data); $i++) {
                    try {
                        $stmt->execute([
                            ":masterID" => $masterID,
                            ":lineItem" => array_keys($data[$i])[0],
                            ":totalAmount" => array_values($data[$i])[0],
                            ":uploadDir" => get_url("uploads/view_invoice.php?id=" . $masterID)
                        ]);
                        error_log("Successfully added doc task into PayTasks");
                    } catch (Exception $e) {
                        error_log("Error inserting doc task into PayTasks: " . $e->getMessage());
                    }
                }
                // Verify that the task was added to the DBs
                if (get_task_by_id($masterID) != false) {
                    error_log("Successfully added task to DB");
                } else {
                    error_log("Error adding task to DB");
                    flash("There was an error creating your task. Please try again later.", "error");
                }
                if(assign_task($masterID)) {
                    flash ("Task successfully created!", "success");
                } else {
                    error_log("Error assigning task to users");
                    flash("There was an error assigning your task. Please try again later.", "error");
                }
            }

            break;
        default:
            flash("An error occured when trying to validate your task. Please check your inputs and try again.", "error");
            break;
    }
}

?>
<div class="container-fluid">
    <h1>Create New Task</h1>
    <form method="POST" id="entireForm">
        <div id="master_div">
            <div id="master_table">
                <table>
                    <div id="part1">
                        <tr>
                            <td>
                                <table id="part1_table">
                                    <tr>
                                        <td>
                                            <div class="mb-3">
                                                <label class="form-label" for="taskName">Task Name</label>
                                                <input class="form-control" id="taskName" name="name" required />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="mb-3">
                                                <label class="form-label" for="taskDescription">Task Description</label>
                                                <textarea required class="form-control" name="description" id="taskDescription" placeholder="Please enter an overall description of the task" cols="50" rows="3"></textarea>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="col-md-2">
                                        <td>
                                            <div>
                                                <label class="form-label" for="taskType">Select type of task to create</label>
                                                <select id="taskType" name="taskType" class="form-label" required onfocus="this.oldValue = this.value" onchange="startTaskGenerate(this.value,this.oldValue);this.oldValue = this.value">
                                                    <option value="" hidden disabled selected value>Select Task Type</option>
                                                    <option value="1">Document Upload</option>
                                                    <option value="2">Survey or Form</option>
                                                    <option value="3">Payment</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </div>
                    <div id="part2">
                        <tr>
                            <div class="mb-3" id="taskList">
                                <table class="table" id="taskTable" hidden>
                                    <thread>
                                        <tr>
                                            <th id="taskTableHeader"></th>
                                        </tr>
                                    </thread>
                                    <tbody id="taskTableBody">
                                        <!-- CONTENT HERE GENERATED DYNAMICALLY BASED ON TASK TYPE -->
                                    </tbody>
                                </table>
                            </div>
                            <div id="add_another" class="d-flex">
                                <?php //seperated button to make sure its at the bottom after new lines are made. 
                                ?>
                            </div>
                        </tr>
                    </div>
                    <br />
                    <div id="part3">
                        <tr>
                            <div id="assign_table" class="mb-3">
                                <table class="table" id="assignTable" hidden>
                                    <thread>
                                        <tr>
                                            <th id="assignTableHeader"></th>
                                        </tr>
                                    </thread>
                                    <tbody id="assignTableBody">
                                        <tr>
                                            <td>
                                                <div class="mb-3">
                                                    <label class="form-label" for="assignType">Who would you like to assign this task to?</label>
                                                    <select id="assignType" name="assignType" class="form-label" required onfocus="this.oldValue = this.value" onchange="assignFollowUp(this.value,this.oldValue);this.oldValue = this.value">
                                                        <option value="" hidden disabled selected value>Select Assignment Type</option>
                                                        <option value="1">An Individual member</option>
                                                        <option value="2">A Team</option>
                                                        <option value="3">All members of a team individually (batch assign)</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mb-3" id="teamTask" hidden>
                                                    <label class="form-label" id="teamSelectLabel" for="teamSelect"></label>
                                                    <select id="teamSelect" name="teamSelect" onchange="goToDate()" class="form-label">
                                                        <option value="" hidden disabled selected value>Select Team</option>
                                                        <?php
                                                        $teams = fetch_all_teams();
                                                        foreach ($teams as $team) {
                                                            echo "<option value='" . $team["id"] . "'>" . $team["name"] . "</option>";
                                                        } ?>
                                                    </select>
                                                    <br id="noteGap" hidden />
                                                    <label class="form-label" id="BatchSelectNote" for="teamSelect"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mb-3" id="userTask" hidden>
                                                    <label class="form-label" for="userSelect">Choose a user to assign this task to</label>
                                                    <select id="userSelect" name="userSelect" class="form-label" onchange="goToDate()">
                                                        <option value="" hidden disabled selected value>Select User</option>
                                                        <?php
                                                        $users = fetch_all_users();
                                                        foreach ($users as $user) {
                                                            echo "<option value='" . $user["id"] . "'>" . $user["username"] . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </tr>
                    </div>
                    <div id="part4" hidden>
                        <tr>
                            <td>
                                <div class="mb-3">
                                    <label class="form-label" for="taskDueDate">Task Due Date</label>
                                    <input type="date" onchange="allowSubmit()" class="form-control" id="taskDueDate" name="dueDate" required />
                                </div>
                            </td>
                            <td>
                                <div class="mb-3">
                                    <label class="form-label" for="taskDueTime">Task Due Time</label>
                                    <input type="time" class="form-control" id="taskDueTime" name="dueTime" value="23:59" required />
                                </div>
                            </td>
                        </tr>
                    </div>
                    <div id="submitTask" hidden>
                        <tr>
                            <button type="submit" class="btn btn-primary align-right">Create Task</button>
                        </tr>
                    </div>
                </table>
            </div>
    </form>
</div>
<script type="text/javascript">
    function startTaskGenerate(type, oldType) {
        if (oldType == "") {
            console.log("startTaskGenerate called with type: " + type);
            switch (type) { // Initialize the task list based on the task type selected
                case "1":
                    document.getElementById("taskTableHeader").innerHTML = "New Document Upload Task";
                    document.getElementById("taskTable").hidden = false;
                    createDocRequest(1);
                    document.getElementById("add_another").innerHTML = "<input type='button' class='btn btn-warning' id ='another' value='Add another document?' onclick='addAnother()'/>";
                    goToAssign();
                    break;
                case "2":
                    document.getElementById("taskTableHeader").innerHTML = "Survey or Form Task";
                    document.getElementById("taskTable").hidden = false;
                    createSurveyForm(1);
                    document.getElementById("add_another").innerHTML = "<input type='button' class='btn btn-warning' id ='another' value='Add another question?' onclick='addAnother()'/>";
                    goToAssign();
                    break;
                case "3":
                    document.getElementById("taskTableHeader").innerHTML = "Payment Task";
                    document.getElementById("taskTable").hidden = false;
                    createPaymentTask(1);
                    document.getElementById("add_another").innerHTML = "<input type='button' class='btn btn-warning' id ='another' value='Add another line item?' onclick='addAnother()'/>";
                    goToAssign();
                    break;
            }

        } else {
            if (confirm("Switching task types will delete all current information. Are you sure you want to continue?")) {
                location.reload();
            }else{
                document.getElementById("taskType").value = oldType;
            }
        }

    }

    function addAnother() { // Allows creation of another row in the task list
        type = document.getElementById("taskType").value;
        total_rows = document.getElementById("taskTableBody").rows;
        lines = total_rows.length + 1;
        console.log("total_rows: " + lines);
        switch (type) {
            case "1":
                createDocRequest(lines);
                break;
            case "2":
                createSurveyForm(lines);
                break;
            case "3":
                createPaymentTask(lines);
                break;
        }
    }

    function goToAssign() { // Moves to the assign section of the form
        document.getElementById("assignTableHeader").innerHTML = "Assign Task";
        document.getElementById("assignTable").hidden = false;
    }

    function assignFollowUp(type, oldType) {
        if (oldType == "") {
            switch (type) {
                case "1":
                    document.getElementById("userTask").hidden = false;
                    document.getElementById("userTask").required = true;
                    break;
                case "2":
                    document.getElementById("teamTask").hidden = false;
                    document.getElementById("teamSelectLabel").innerHTML = "Chose a team to assign this task to:";
                    document.getElementById("teamTask").required = true;

                    break;
                case "3":
                    document.getElementById("teamTask").hidden = false;
                    document.getElementById("teamSelectLabel").innerHTML = "Select which team to bulk assign this task to:";
                    document.getElementById("noteGap").hidden = false;
                    document.getElementById("BatchSelectNote").innerHTML = "Note: This will assign the task to all members of the team";
                    document.getElementById("teamTask").required = true;
                    break;
            }
        } else { // TODO make it only reload the assignment info if the task type changes. This is good enough for now.
            if (confirm("Switching assignment info will erase all current information. Are you sure you want to continue?")) {
                location.reload();
            }else{
                document.getElementById("taskType").value = oldType;
            }
        }


    }

    function goToDate() {
        document.getElementById("part4").hidden = false;
    }

    function allowSubmit() {
        document.getElementById("submitTask").hidden = false;
    }

    
</script>

<?php
require_once(__DIR__ . "/../../../partials/flash.php");
?>