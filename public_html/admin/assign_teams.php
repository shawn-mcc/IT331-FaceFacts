<?php
require(__DIR__ . "/../../../partials/nav.php");

if (!has_role("Admin")) {
    flash("You don't have permission to view this page", "warning");
    die(header("Location: $BASE_PATH" . "/dashboard.php"));
}
//attempt to apply
if (isset($_POST["users"]) && isset($_POST["teams"])) {
    $user_ids = $_POST["users"]; //se() doesn't like arrays so we'll just do this
    $team_ids = $_POST["teams"]; //se() doesn't like arrays so we'll just do this
    if (empty($user_ids) || empty($team_ids)) {
        flash("You must select at least one user to assign to at least one team", "warning");
    } else {
        //for sake of simplicity, this will be a tad inefficient
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO UserTeams (user_id, team_id, is_active) VALUES (:uid, :tid, 1) ON DUPLICATE KEY UPDATE is_active = !is_active");
        foreach ($user_ids as $uid) {
            foreach ($team_ids as $tid) {
                try {
                    $stmt->execute([":uid" => $uid, ":tid" => $tid]);
                    flash("Sucessfully added users to team" , "success");
                    update_total_members($tid);
                } catch (PDOException $e) {
                    flash("An unexpected error occurred, please try again later. If the issue persists, please contact the administrator", "danger");
                    error_log(var_export($e->errorInfo, true), "danger");
                }
            }
        }
    }
}

//get active teams
$active_teams = [];
$db = getDB();
$stmt = $db->prepare("SELECT id, name, about FROM Teams WHERE is_active = 1 LIMIT 10");
try {
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($results) {
        $active_teams = $results;
    }else{
        flash("No teams found", "warning");
    }
} catch (PDOException $e) {
    error_log("<pre>" . var_export($e, true) . "</pre>");
    flash("An unexpected error occurred, please try again later. If the issue persists, please contact the administrator", "danger");
}

//search for user by username
$users = [];
if (isset($_POST["username"])) {
    $username = se($_POST, "username", "", false);
    if (!empty($username)) {
        $db = getDB();
        $stmt = $db->prepare("SELECT Users.id, username, (SELECT GROUP_CONCAT(name, ' (' , IF(ut.is_active = 1,'active','inactive') , ')') from 
        UserTeams ut JOIN Teams on ut.team_id = Teams.id WHERE ut.user_id = Users.id) as teams
        from Users WHERE username like :username");
        try {
            $stmt->execute([":username" => "%$username%"]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($results) {
                $users = $results;
            } else {
                flash("No users found", "warning");
            }
        } catch (PDOException $e) {
            error_log("<pre>" . var_export($e, true) . "</pre>");
            flash("An unexpected error occurred, please try again later. If the issue persists, please contact the administrator", "danger");
        }
    } else {
        flash("Username must not be empty", "warning");
    }
}


?>
<div class="container-fluid">
    <h1>Assign Teams</h1>
    <form method="POST" class="row row-cols-lg-auto g-3 align-items-center">
        <div class="input-group mb-3">
            <input class="form-control" type="search" name="username" placeholder="Username search" />
            <input class="btn btn-primary" type="submit" value="Search" />
        </div>
    </form>
    <form method="POST">
        <?php if (isset($username) && !empty($username)) : ?>
            <input type="hidden" name="username" value="<?php se($username, false); ?>" />
        <?php endif; ?>
        <table class="table">
            <thead>
                <th>Users</th>
                <th>Teams to Assign</th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <table>
                            <?php foreach ($users as $user) : ?>
                                <tr>
                                    <td>
                                        <label for="user_<?php se($user, 'id'); ?>"><?php se($user, "username"); ?></label>
                                        <input id="user_<?php se($user, 'id'); ?>" type="checkbox" name="users[]" value="<?php se($user, 'id'); ?>" />
                                    </td>
                                    <td><?php se($user, "teams", "No teams assigned"); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </td>
                    <td>
                        <?php foreach ($active_teams as $team) : ?>
                            <div>
                                <label for="team_<?php se($team, 'id'); ?>"><?php se($team, "name"); ?></label>
                                <input id="team_<?php se($team, 'id'); ?>" type="checkbox" name="teams[]" value="<?php se($team, 'id'); ?>" />
                            </div>
                        <?php endforeach; ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <input type="submit" class="btn btn-primary" value="Assign Teams" />
    </form>
</div>
<?php
//note we need to go up 1 more directory
require_once(__DIR__ . "/../../../partials/flash.php");
?>