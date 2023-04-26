<?php
function count_team_members($team_id){
    $db = getDB();
    $count = "SELECT COUNT(*) FROM UserTeams WHERE team_id = :team_id";
    $stmt = $db->prepare($count);
    try {
        $stmt->execute([":team_id" => $team_id]);
        $count = $stmt->fetchColumn();
        return $count;
    } catch (PDOException $e) {
        error_log(var_export($e, true));
        flash("Error counting total members", "danger");
    }
}
function update_total_members($team_id)
{
    $count = count_team_members($team_id);
    $db = getDB();
    $update = "UPDATE Teams SET total_members = :count WHERE id = :team_id";
    $stmt = $db->prepare($update);
    try {
        $stmt->execute([":count" => $count, ":team_id" => $team_id]);
        error_log("count is " . $count . " and team_id is " . $team_id);
    } catch (PDOException $e) {
        error_log(var_export($e, true));
        flash("Error updating total members", "danger");
    }
}
function find_team_by_id($team_id)
{
    $db = getDB();
    $stmt = $db->prepare("SELECT * FROM Teams WHERE id = :team_id");
    try {
        $stmt->execute([":team_id" => $team_id]);
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($results) {
            return $results;
        }
    } catch (PDOException $e) {
        error_log(var_export($e->errorInfo, true), "danger");
        flash("An unexpected error occurred, please try again later. If the issue persists, please contact the administrator", "danger");
    }
}
function find_user_teams()
{
    if (is_logged_in()) { //we need to check for login first because "user" key may not exist
        $user_id = get_user_id();
        $user_teams = [];
        $db = getDB();
        $stmt = $db->prepare("SELECT Teams.id, Teams.name, Teams.total_members , Teams.about , Teams.is_active, UserTeams.user_id, UserTeams.team_id FROM Teams
        JOIN UserTeams on Teams.id = UserTeams.team_id
        WHERE UserTeams.user_id = :user_id");
        try {
            $r = $stmt->execute([":user_id" => $user_id]);
            if ($r) {
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if ($results) {
                    foreach ($results as $result) {
                        $user_teams[] = $result;
                    }
                    error_log(var_export($user_teams, true));
                    return $user_teams;
                }
            } else {
                flash("User is not on a team", "warning");
                return false;
            }
        } catch (Exception $e) {
            flash("Error finding user teams", "danger");
            error_log(var_export($e->errorInfo, true), "danger");
        }
    }
}
function find_team_members($team_id)
{
    $db = getDB();
    $stmt = $db->prepare("SELECT Users.id, username, email,(SELECT GROUP_CONCAT(name, ' (' , IF(ur.is_active = 1,'active','inactive') , ')') from 
    UserRoles ur JOIN Roles on ur.role_id = Roles.id WHERE ur.user_id = Users.id) as roles
    from Users JOIN UserTeams on Users.id = UserTeams.user_id WHERE UserTeams.team_id = :team_id");
    try {
        $stmt->execute([":team_id" => $team_id]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($results) {
            return $results;
        } else {
            flash("No users found", "warning");
        }
    } catch (PDOException $e) {
        error_log(var_export($e->errorInfo, true), "danger");
        flash("An unexpected error occurred, please try again later. If the issue persists, please contact the administrator", "danger");
    }
}
function on_team($team_id)
{
    $user_teams = find_user_teams(); // find_user_teams already checks for login
    if ($user_teams) {
        foreach ($user_teams as $team) {
            if ($team['id'] == $team_id) {
                return true;
            }
        }
    }
    return false;
}
function get_team_data($team_id)
{
    $teaminfo = find_team_by_id($team_id);
    $teammembers = array(
        "members" => find_team_members($team_id),
    );
    $team_data = array_merge($teaminfo, $teammembers);
    return $team_data;
}
function is_officer($team_id, $user_id)
{
    $db = getDB();
    $stmt = $db->prepare("SELECT * FROM UserTeams WHERE user_id = :user_id AND team_id = :team_id AND is_officer = 1");
    try {
        $stmt->execute([":user_id" => $user_id, ":team_id" => $team_id]);
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($results) {
            return true;
        }
    } catch (PDOException $e) {
        error_log(var_export($e->errorInfo, true), "danger");
        flash("An unexpected error occurred, please try again later. If the issue persists, please contact the administrator", "danger");
    }
    return false;
}
function user_on_team($team_id, $user_id)
{
    $db = getDB();
    $stmt = $db->prepare("SELECT * FROM UserTeams WHERE user_id = :user_id AND team_id = :team_id");
    try {
        $stmt->execute([":user_id" => $user_id, ":team_id" => $team_id]);
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($results) {
            return true;
        }
    } catch (PDOException $e) {
        error_log(var_export($e->errorInfo, true), "danger");
        flash("An unexpected error occurred, please try again later. If the issue persists, please contact the administrator", "danger");
    }
    return false;
}
function find_officers($team_id, $only_names = false)
{
    error_log("finding officers for team " . $team_id);
    $db = getDB();
    $stmt = $db->prepare("SELECT * FROM UserTeams WHERE team_id = :team_id AND is_officer = 1");
    try {
        $stmt->execute([":team_id" => $team_id]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($results) {
            error_log(var_export($results, true));
            if (!$only_names) {
                return $results;
            } else {
                $officers = [];
                foreach ($results as $result) {
                    $officers[] = $result['username'];
                }
                return $officers;
            }
        }
    } catch (PDOException $e) {
        error_log(var_export($e->errorInfo, true), "danger");
        flash("An unexpected error occurred, please try again later. If the issue persists, please contact the administrator", "danger");
    }
    return false;
}
function fetch_all_teams()
{
    $db = getDB();
    $stmt = $db->prepare("SELECT * FROM Teams");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    try {
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($results) {
            return $results;
        }
    } catch (PDOException $e) {
        error_log(var_export($e->errorInfo, true), "danger");
        flash("An unexpected error occurred, please try again later. If the issue persists, please contact the administrator", "danger");
    }
}
