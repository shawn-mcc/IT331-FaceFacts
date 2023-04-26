<?php
function users_check_duplicate($errorInfo)
{
    if ($errorInfo[1] === 1062) {
        //https://www.php.net/manual/en/function.preg-match.php
        preg_match("/Users.(\w+)/", $errorInfo[2], $matches);
        if (isset($matches[1])) {
            flash("The chosen " . $matches[1] . " is not available.", "warning");
        } else {
            flash("An error occurred", "danger");
            error_log("<pre>" . var_export($errorInfo, true) . "</pre>");
        }
    } else {
        flash("Errpr from duplicate users", "danger");
        error_log("<pre>" . var_export($errorInfo, true) . "</pre>");
    }
}