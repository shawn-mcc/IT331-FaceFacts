<?php
require_once(__DIR__ . "/../../../lib/functions.php"); // AJAX enpoints require functions.php explicitly, since nav would break the POST
error_log("Checking officer");
error_log(var_export($_POST, true));
if (isset($_POST["user"]) && isset($_POST["team"])) {
    $uid = $_POST["user"];
    $tid = $_POST["team"];
    error_log("uid: " . $uid . " tid: " . $tid);
    if (user_on_team($tid, $uid)) {
        echo json_encode(array(
            "success" => true,
            "message" => "on_team"
        ));
        return;
    } else {
        echo json_encode(array(
            "success" => false,
            "message" => "not_on_team"
        ));
        return;
    }
} else {
    echo json_encode(array(
        "success" => false,
        "message" => "Invalid request"
    ));
    return;
}
