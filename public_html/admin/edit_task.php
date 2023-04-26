<?php
require(__DIR__ . "/../../../partials/nav.php");


if (!has_role("Admin")) {
    flash("You don't have permission to view this page", "warning");
    die(header("Location: " . get_url("dashboard.php")));
}
$task_id = get_url_params("id");
$task_data = get_task_by_id($task_id);
error_log("Task data: " . var_export($task_data, true));
$date = explode(" ", $task_data[0]["due_date"]);
$type = strval($task_data[0]["task_type"]);
$assigned_to = $task_data[0]["assign_to"];
switch($type){
    case "DocRequest":
        $data = get_doc_data($task_data[0]["id"]);
        $data = json_encode($data);
        break;
    case "Individual":
        $assigned_to = $task_data[0]["assigned_by"];
        break;
    default:
        $assigned_to = "";
        break;
    }

// START UPDATE

/* if(isset($_POST)){
    $dueDate = se($_POST, "dueDate", "", false);
    $dueTime = se($_POST, "dueTime", "", false);
    $dueDateTime = $dueDate . " " . $dueTime;
    $dueDateTime = strtotime($dueDateTime);
    $dueDateTime = date("Y-m-d H:i:s", $dueDateTime);
    error_log("POST: " . var_export($_POST, true));
    $db = getDB();
    $stmt = $db->prepare("UPDATE MasterTasks SET about_task = :about, assign_to = :assign_to, assigned_by = :assigned_by, due_date = :due_date WHERE id = :id");
    try{
        $stmt->execute([
            ":about" => se($_POST, "description", "", false),
            ":assign_to" => se($_POST, "teamSelect", "", false),
            ":assigned_by" => get_user_id(),
            ":due_date" => $dueDateTime,
            ":id" => $task_id
        ]);
        
        flash("Task updated successfully", "success");


    }catch(PDOException $e){
        error_log("<pre>" . var_export($e, true) . "</pre>");
        return false;
    }
}
*/ // TODO Doesn't work yet. Too exhausted to fix. Other featrues to add before midnight. 




?>
<div class="container-fluid">
    <h1>Edit Task</h1>
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
                                                <input class="form-control" id="taskName" name="name" disabled value=<?php se($task_data[0]["name"])?>>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="mb-3">
                                                <label class="form-label" for="taskDescription">Task Description</label>
                                                <textarea required class="form-control" name="description" id="taskDescription"  cols="50" rows="3" value=<?php se($task_data[0]["about_task"])?>><?php se($task_data[0]["about_task"])?></textarea>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="col-md-2" hidden>
                                        <td>
                                            <div>
                                                <label class="form-label" for="taskType">Select type of task to create</label>
                                                <select id="taskType" name="taskType" class="form-label" required>
                                                    <option value="<?php se($task_data[0]["task_type"])?>" disabled selected value><?php se($task_data[0]["task_type"])?></option>
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
                                <table class="table" id="taskTable">
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
                                <table class="table" id="assignTable">
                                    <thread>
                                        <tr>
                                            <th id="assignTableHeader">Task Assignment</th>
                                        </tr>
                                    </thread>
                                    <tbody id="assignTableBody">
                                        <tr>
                                            <td>
                                                <div class="mb-3">
                                                    <label class="form-label" for="assignType"></label> <!-- TODO: Allow assign modification when not in time crunch -->
                                                    <select id="assignType" name="assignType" class="form-label" required>
                                                        <option value="<?php se($task_data[0]["assign_type"])?>" disabled selected value><?php se($task_data[0]["assign_type"])?></option>
                                                    </select>
                                            </td>
                                            <td>
                                                <?php if ($task_data[0]["assign_type"] == "Team" || $task_data[0]["assign_type"] == "Batch") : ?>
                                                    <div class="mb-3" id="teamTask">
                                                    <label class="form-label" id="teamSelectLabel" for="teamSelect"></label>
                                                    <select id="teamSelect" name="teamSelect" class="form-label">
                                                        <option value="<?php echo find_team_by_id($task_data[0]["assign_to"])["id"]?>" selected hidden><?php echo find_team_by_id($task_data[0]["assign_to"])["name"]?></option>
                                                        <?php
                                                        $teams = fetch_all_teams();
                                                        foreach ($teams as $team) {
                                                            echo "<option value='" . $team["id"] . "'>" . $team["name"] . "</option>";
                                                        } ?>
                                                    </select>
                                                    <?php else : ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mb-3" id="userTask">
                                                    <label class="form-label" for="userSelect">Choose a user to assign this task to</label>
                                                    <select id="userSelect" name="userSelect" class="form-label" onchange="goToDate()">
                                                        <option value="<?php echo find_user_by_id($task_data[0]["assign_to"])["id"]?>" hidden disabled selected value><?php echo find_user_by_id($task_data[0]["assign_to"])["name"]?></option>
                                                        <?php
                                                        $users = fetch_all_users();
                                                        foreach ($users as $user) {
                                                            echo "<option value='" . $user["id"] . "'>" . $user["username"] . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </tr>
                    </div>
                    <div id="part4">
                        <tr>
                            <td>
                                <div class="mb-3">
                                    <label class="form-label" for="taskDueDate">Task Due Date</label>
                                    <input type="date" class="form-control" id="taskDueDate" name="dueDate" required value=<?php se($date[0])?> />
                                </div>
                            </td>
                            <td>
                                <div class="mb-3">
                                    <label class="form-label" for="taskDueTime">Task Due Time</label>
                                    <input type="time" class="form-control" id="taskDueTime" name="dueTime" value=<?php se($date[1])?> required />
                                </div>
                            </td>
                        </tr>
                    </div>
                    <div id="submitTask">
                        <tr>
                            <button type="submit" class="btn btn-primary align-right">Update Task</button>
                        </tr>
                    </div>
                </table>
            </div>
    </form>
</div>
<script type="text/javascript">
    function get_task_data(task_type) {
        var data = <?php echo $data; ?>;
        var task_type = "<?php echo (string)$task_data[0]["task_type"] ?>";

            switch (task_type) { // Initialize the task list based on the task type selected
                case "DocRequest":
                    document.getElementById("taskTable").hidden = false;
                    fetchDocRequest(data);
                    document.getElementById("add_another").innerHTML = "<input type='button' class='btn btn-warning' id ='another' value='Add another document?' onclick='addAnother()'/>";
                    break;
                case "FormTask":
                    document.getElementById("taskTable").hidden = false;
                    fetchSurveyForm(task_id);
                    document.getElementById("add_another").innerHTML = "<input type='button' class='btn btn-warning' id ='another' value='Add another question?' onclick='addAnother()'/>";
                    break;
                case "PayTask":
                    document.getElementById("taskTable").hidden = false;
                    fetchPaymentTask(task_id);
                    document.getElementById("add_another").innerHTML = "<input type='button' class='btn btn-warning' id ='another' value='Add another line item?' onclick='addAnother()'/>";
                    break;
            }

         
           
        }
        
        
    get_task_data();

    function addAnother() { // Allows creation of another row in the task list
        type = document.getElementById("taskType").value;
        total_rows = document.getElementById("taskTableBody").rows;
        lines = total_rows.length + 1;
        console.log("total_rows: " + lines);
        switch (type) {
            case "DocRequest":
                createDocRequest(lines);
                break;
            case "FornTask":
                createSurveyForm(lines);
                break;
            case "PayTask":
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