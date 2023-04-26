<?php
require(__DIR__ . "/../../../partials/nav.php");

if (!has_role("Admin")) {
    flash("You don't have permission to view this page", "warning");
    die(header("Location: $BASE_PATH" . "/dashboard.php"));
}


//get active teams
$active_teams = [];
$db = getDB();
$stmt = $db->prepare("SELECT id, name, total_members, about FROM Teams WHERE is_active = 1 LIMIT 10");
try {
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($results) {
        $active_teams = $results;
    }
} catch (PDOException $e) {
    error_log(var_export($e->errorInfo, true));
    flash("An unexpected error occurred, please try again later. If the issue persists, please contact the administrator", "danger");
}

//search for user by username
$users = [];
if (isset($_POST["username"])) {
    $username = se($_POST, "username", "", false);
    if (!empty($username)) {
        $db = getDB();
        $stmt = $db->prepare("SELECT Users.id, username, (SELECT GROUP_CONCAT(name, ' (' , IF(ur.is_active = 1,'active','inactive') , ')') from 
        UserTeams ur JOIN Teams on ur.team_id = Teams.id WHERE ur.user_id = Users.id) as teams
        from Users WHERE username like :username");
        try {
            $stmt->execute([":username" => "%$username%"]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($results) {
                $users = $results;
            } else{
                flash("No users found", "warning");
            }
        } catch (PDOException $e) {
            error_log(var_export($e->errorInfo, true));
            flash("An unexpected error occurred, please try again later. If the issue persists, please contact the administrator", "danger");
        }
    } else {
        flash("Username must not be empty", "warning");
    }
}


?>
<script src="../helpers.js"></script>
<div class="container-fluid">
    <h1>Assign Officer Positions</h1>
    <form method="POST" class="row row-cols-lg-auto g-3 align-items-center">
        <div class="input-group mb-3">
            <input class="form-control" type="search" name="username" placeholder="Username search" />
            <input class="btn btn-primary" type="submit" value="Search" />
        </div>
    </form>
    <form method="POST" id = "List" onsubmit = "return false">
        <?php if (isset($username) && !empty($username)) : ?>
            <input type="hidden" name="username" value="<?php se($username, false); ?>" />
        <?php endif; ?>
        <table class="table">
            <thead>
                <th>Users</th>
                <th>Team to Assign</th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <table>
                            <?php foreach ($users as $user) : ?>
                                <tr>
                                    <td>
                                        <label for="user_<?php se($user, 'id'); ?>"><?php se($user, "username"); ?></label>
                                        <input id="user_<?php se($user, 'id'); ?>" type="checkbox" name="users_<?php se($user, 'id'); ?>" />
                                    </td>
                                    <td><?php se($user); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </td>
                    <td>
                        <?php foreach ($active_teams as $teams) : ?>
                            <div>
                                <label for="role_<?php  se($teams, 'id'); ?>"><?php se($teams, "name"); ?></label>
                                <input id="role_<?php se($teams, 'id'); ?>" type="checkbox" name="team_<?php se($teams, 'id'); ?>" />

                            </div>
                        <?php endforeach; ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <button class="btn btn-primary" onclick="return handleClick()">Make Officer</button>
        
    </form>
</div>
<?php
//note we need to go up 1 more directory
require_once(__DIR__ . "/../../../partials/flash.php");
?>

<script type = "text/javascript">

   async function checkOfficers(user_id, team_id){ // Check if user is on team
        const uid = user_id;
        const tid = team_id;
        const data = {
            "user": uid,
            "team": tid
        };
        let jsonResponse = await fetch("/Project/api/check_officer.php", {
        method:"POST",
        headers: {"Content-Type":"application/x-www-form-urlencoded",
                  "X-Requested-With": "XMLHttpRequest"},
        body: Object.keys(data).map(function(key){
            return "" + key + "=" + data[key];
        }).join("&")
    }).then(resp=>resp.json());
        return jsonResponse;

    }

    async function doPromote(user_id, team_id){ // Promote user to officer
        const uid = user_id;
        const tid = team_id;
        const data = {
            "user": uid,
            "team": tid
        };
        let jsonResponse = await fetch("/Project/api/promote.php", {
        method:"POST",
        headers: {"Content-Type":"application/x-www-form-urlencoded",
                  "X-Requested-With": "XMLHttpRequest"},
        body: Object.keys(data).map(function(key){
            return "" + key + "=" + data[key];
        }).join("&")
    }).then(resp=> resp.json());
    return jsonResponse;
    
}
    async function addOfficer(user_id, team_id){ // Add user to team as an officer
        const uid = user_id;
        const tid = team_id;
        const data = {
            "user": uid,
            "team": tid
        };
        let jsonResponse = await fetch("/Project/api/add_officer.php", {
        method:"POST",
        headers: {"Content-Type":"application/x-www-form-urlencoded",
                   "X-Requested-With": "XMLHttpRequest"},
        body: Object.keys(data).map(function(key){
            return "" + key + "=" + data[key];
        }).join("&")
    }).then(resp=>resp.json());
    return jsonResponse;
    
    

}

   async function handleClick(){
        const form = document.getElementById('List');
        const formData = Object.fromEntries(new FormData(form).entries());
        const team_ids = [];
        const user_ids = [];
        for (let key of Object.keys(formData)){
            if (key.startsWith("users_")){
                let user_id = key.split("_")[1];
                user_ids.push(user_id);
            }
        }
        for (let key of Object.keys(formData)) {
      if (key.startsWith("team_")) {
        var team_id = key.split("_")[1];

      for (let user_id of user_ids) {
        console.log (user_id, team_id);
        await checkOfficers(user_id, team_id)
        .then(resp=>{
            console.log(resp);
            console.log("AFTER CHECK");
            console.log(user_id, team_id);
            if (resp.message == "on_team"){
                console.log("on team");
                doPromote(user_id, team_id);
                alert("User promoted to officer");
            } else {
                if (resp.message == "not_on_team"){
                    if (confirm("This user is not currently on this team, are you sure you want to add them as an officer?")){
                        addOfficer(user_id, team_id);
                        alert("User added to team as an officer");
                    } else {
                        alert("User not added");
                    }
                } 
            
            }
        }).catch(err=>{
            console.log(err);
            alert("An unexpected error occurred, please try again later. If the issue persists, please contact the administrator");

        });
          
      }
    }
  }
}    
</script>
    