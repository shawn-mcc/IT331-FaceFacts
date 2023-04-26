<?php
function get_task_by_id($task_id) // Returns all data associated with a task
{
    $task_id = (int)$task_id;
    $db = getDB();
    $stmt = $db->prepare("SELECT * FROM MasterTasks WHERE id = :task_id");
    try {
        $stmt->execute([":task_id" => $task_id]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($results) {
            return $results;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        error_log("<pre>" . var_export($e, true) . "</pre>");
        return false;
    }
}

function assign_task($task_id)
{
    $task_id = (int)$task_id;
    $db = getDB();
    $stmt = $db->prepare("SELECT assign_type,assign_to FROM MasterTasks WHERE id = :taskID");
    try {
        $stmt->execute([":taskID" => $task_id]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        error_log("<pre>" . var_export($results, true) . "</pre>");
        if ($results) {
            switch ($results[0]["assign_type"]) {
                case "Team":
                    $team_id = $results[0]["assign_to"];
                    $stmt = $db->prepare("INSERT INTO TaskAssignment (master_id, user_or_team, assigned_id) VALUES (:taskID, 'Team', :teamID)");
                    try {
                        $stmt->execute([":taskID" => $task_id, ":teamID" => $team_id]);
                        return true;
                    } catch (PDOException $e) {
                        error_log("<pre>" . var_export($e, true) . "</pre>");
                        return false;
                    }
                    break;
                case "Individual":
                    $user_id = $results[0]["assign_to"];
                    $stmt = $db->prepare("INSERT INTO TaskAssignment (master_id, user_or_team, assigned_id) VALUES (:taskID, 'User', :userID)");
                    try {
                        $stmt->execute([":taskID" => $task_id, ":userID" => $user_id]);
                        return true;
                    } catch (PDOException $e) {
                        error_log("<pre>" . var_export($e, true) . "</pre>");
                        return false;
                    }
                    break;
                case "Batch":
                    $team_id = $results[0]["assign_to"];
                    $stmt = $db->prepare("SELECT * FROM UserTeams WHERE team_id = :teamID");
                    try {
                        $stmt->execute([":teamID" => $team_id]);
                        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($results as $result) {
                            error_log("Attempting to assign task " . $task_id . " to user " . $result["user_id"]);
                            $stmt = $db->prepare("INSERT INTO TaskAssignment (master_id, user_or_team, assigned_id, batch_team) VALUES (:taskID, 'User (via Batch)', :userID, :teamID)");
                            try {
                                $stmt->execute([":taskID" => $task_id, ":userID" => $result["user_id"] , ":teamID" => $team_id]);
                            } catch (PDOException $e) {
                                error_log("<pre>" . var_export($e, true) . "</pre>");
                            }
                        }
                    } catch (PDOException $e) {
                        error_log("<pre>" . var_export($e, true) . "</pre>");
                        return false;
                        die; //Otherwise finally block will still return true
                    } finally {
                        return true;
                    }


                    break;
            }
        } else {
            return false;
        }
    } catch (PDOException $e) {
        error_log("<pre>" . var_export($e, true) . "</pre>");
        return false;
    }
}

function delete_task($task_id) //Done in 3 parts since task exists in multiple DB's
{
    $task_id = (int)$task_id;
    error_log("Request to delete task " . $task_id);
    $db = getDB();
    $stmt = $db->prepare("SELECT * FROM MasterTasks WHERE id = :taskID");
    try {
        $stmt->execute([":taskID" => $task_id]);
        $masterID = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $taskType = $masterID[0]["task_type"];
        //Part 1 Delete task data from respective DB
        switch ($taskType) {
            case "DocRequest":
                $stmt = $db->prepare("DELETE FROM DocTasks WHERE master_id = :taskID");
                try {
                    $stmt->execute([":taskID" => $task_id]);
                    error_log("Deleted DocTask data for task " . $task_id);
                } catch (PDOException $e) {
                    error_log("<pre>" . var_export($e, true) . "</pre>");
                    return false;
                }
                break;
            case "Survey":
                $stmt = $db->prepare("DELETE FROM FormTasks WHERE master_id = :taskID");
                try {
                    $stmt->execute([":taskID" => $task_id]);
                    error_log("Deleted FormTasks data for task " . $task_id);
                } catch (PDOException $e) {
                    error_log("<pre>" . var_export($e, true) . "</pre>");
                    return false;
                }
                break;
            case "Payment":
                $stmt = $db->prepare("DELETE FROM PayTasks WHERE master_id = :taskID");
                try {
                    $stmt->execute([":taskID" => $task_id]);
                    error_log("Deleted PayTasks data for task " . $task_id);
                } catch (PDOException $e) {
                    error_log("<pre>" . var_export($e, true) . "</pre>");
                    return false;
                }
                break;
        }
        //Part 2 Delete task from Assignment DB
        $stmt = $db->prepare("DELETE FROM TaskAssignment WHERE master_id = :taskID");
        try {
            $stmt->execute([":taskID" => $task_id]);
            error_log("Deleted TaskAssignment data for task " . $task_id);
        } catch (PDOException $e) {
            error_log("<pre>" . var_export($e, true) . "</pre>");
            return false;
        }
        //Part 3 Delete task from MasterTasks DB
        $stmt = $db->prepare("DELETE FROM MasterTasks WHERE id = :taskID");
        try {
            $stmt->execute([":taskID" => $task_id]);
            error_log("Deleted MasterTasks data for task " . $task_id);
        } catch (PDOException $e) {
            error_log("<pre>" . var_export($e, true) . "</pre>");
            return false;
        }
    } catch (PDOException $e) {
        error_log("<pre>" . var_export($e, true) . "</pre>");
        return false;
    }
}
function get_assigned_str($task_id)
{
    $task_id = (int)$task_id;
    $db = getDB();
    $stmt = $db->prepare("SELECT user_or_team, assigned_id, batch_team FROM TaskAssignment WHERE master_id = :taskID");
    try {
        $stmt->execute([":taskID" => $task_id]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $str = "";
        foreach ($results as $result) {
            switch ($result["user_or_team"]) {
                case "User":
                    $user = find_user_by_id($result["assigned_id"]);
                    $str .= $user["first_name"] . " " . $user["last_name"] . " ";
                    break;
                case "Team":
                    $team = find_team_by_id($result["assigned_id"]);
                    $str .= $team["name"] . " ";
                    break;
                case "User (via Batch)":
                    $team = find_team_by_id($result["batch_team"]);
                    $num = count_team_members($result["batch_team"]);
                    $str = $team["name"] . " via Batch <br />(" . $num . " members)";
                    break;
            }
        }
        return $str;
    } catch (PDOException $e) {
        error_log("<pre>" . var_export($e, true) . "</pre>");
        return false;
    }
}
function get_assigner($task_id)
{
    $task_id = (int)$task_id;
    $db = getDB();
    $stmt = $db->prepare("SELECT assigned_by FROM MasterTasks WHERE id = :taskID");
    try {
        $stmt->execute([":taskID" => $task_id]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($results) {
            $user = find_user_by_id($results[0]["assigned_by"]);
            if ($user["id"] == get_user_id()) {
                return "Me";
            } else {
                return $user["first_name"] . " " . $user["last_name"];
            }
        }
    } catch (PDOException $e) {
        error_log("<pre>" . var_export($e, true) . "</pre>");
        return false;
    }
}
function get_doc_data($task_id){
    $task_id = (int)$task_id;
    $db = getDB();
    $stmt = $db->prepare("SELECT * FROM DocTasks WHERE master_id = :taskID");
    $params = array();
    $doc = "";
    $type = "";
    try {
        $stmt->execute([":taskID" => $task_id]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        for ($i = 0; $i < count($results); $i++) {
            foreach ($results[$i] as $key => $value) {
                if ($key == "doc_name") {
                    $doc = $value;;
                } else if ($key == "allowed_types") {
                    $type = $value;
                }
            }
            if (!empty($doc) && !empty($type)) {
                $params[] = array($doc => $type);
                error_log("key: " . $doc . " value: " . $type);
                $doc = "";
                $type = "";
            }
        }
        error_log("Params: " . var_export($params, true));
        return $params;
        
    } catch (PDOException $e) {
        error_log("<pre>" . var_export($e, true) . "</pre>");
        return false;
    }
}
