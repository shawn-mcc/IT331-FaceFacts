<?php
require_once(__DIR__ . "/../../../lib/functions.php"); // AJAX enpoints require functions.php explicitly, since nav would break the POST
if (isset($_POST["task_id"])) {
    $task_id = $_POST["task_id"];
    $db = getDB();
    $stmt = $db->prepare("SELECT * FROM DocTasks WHERE id = :task_id");
    try{
        $stmt->execute([":task_id" => $task_id]);
        if ($results = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo json_encode($results);
            }return;
        } catch (PDOException $e) {
            error_log("<pre>" . var_export($e, true) . "</pre>");
            return false;
        }
    }
    
