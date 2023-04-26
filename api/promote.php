<?php
require_once(__DIR__ . "/../../../lib/functions.php"); // AJAX enpoints require functions.php explicitly, since nav would break the POST

if (isset($_POST["user"]) && isset($_POST["team"])) {
    $uid = $_POST["user"]; //se() doesn't like arrays so we'll just do this
    $tid = $_POST["team"]; //se() doesn't like arrays so we'll just do this        
    $db = getDB();
    $stmt = $db->prepare("UPDATE UserTeams SET is_officer = !is_officer WHERE user_id = :uid AND team_id = :tid");
    try {
        $stmt->execute([":uid" => $uid, ":tid" => $tid]);
        error_log("{$uid} is now an officer");
        echo json_encode(array(
            "success" => true,
            "message" => "Added Officer"
        ));
        return;
    } catch (PDOException $e) {
        flash("An unexpected error occurred, please try again later. If the issue persists, please contact the administrator", "danger");
        error_log(var_export($e->errorInfo, true));
        echo json_encode(array(
            "success" => false,
            "message" => "Error"
        ));
        return;
    }
}
    ?>
