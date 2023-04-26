<?php
require(__DIR__."/../../partials/nav.php");
?>
<?php
// Validation
if (is_logged_in(true)) {
    error_log("Session data: " . print_r($_SESSION, true));
} else {
    flash("You must be logged in to view this page!");
}
$team_id = get_url_params("team_id");
if (!on_team($team_id)) {
    flash("You're not a member of this team!", "warning");
    die(header("Location: $BASE_PATH" . "/my_teams.php"));
}

// Get team data
$team_data = get_team_data($team_id);
$team_name = $team_data["name"];
$team_about = $team_data["about"];
$team_is_active = $team_data["is_active"];
$team_total_members = $team_data["total_members"];
$team_members = $team_data["members"];
error_log("Team data: " . print_r($team_data, true));
?>
<h1><?php se($team_name); ?> 's Dashboard</h1>

<div class="container-fluid">
    <div class="row">
    <?php 
    // Task Completion Table ?>
  <div class="TaskCompletion col-md-3">
    <h2 class = "text-center">Task Completion</h2>
    <?php 
    // TODO put logic here after tasks created, eventully put graphic ?>
    <p class = "text-center">Your team has completed all of its tasks!</p>
</div>
  <?php 
    // Tasks Table ?>
  <div class="Tasks col-md-6">
    <h2 class = "text-center">Tasks</h2>
  <table class = "table">
    <thread>
        <th>Task</th>
        <th>Type</th>
        <th>Assigned By</th>
        <th>Assigned Date</th>
        <th>Due Date</th>
        <th>Description</th>
        <th>View</th>
    </thread>
    
    <tbody>
        <!-- TODO put task info
        <?php /*
        if ($team_members != NULL) :
        foreach ($team_members as $member) : 
        ?>
        
            <tr>
                <td><?php se($member["username"]); ?></td>
                <td><?php se($member["email"]); ?></td>
                <td><?php se($member["roles"],"","Member"); ?></td>
            </tr>
        <?php endforeach ?>
        <?php else : ?>
           <td> This Team has no Members </td>
        <?php endif? >
         
        */ ?>
        -->

            <p class = "text-center">No tasks are assigned to this team</p>
  </table>
  </div>
  <?php 
    // Teammates Table ?>
  <div class="Teammates col-md-3">
    <h2 class = "text-center">Teammates</h2>
  <table class = "table">
    <thread>
        <th>Username</th>
        <th>Email</th>
        <th>Role</th>
    </thread>
    <tbody>
        <?php
        if (empty($team_members)) : ?>
            <tr>
                <td colspan="3">No members in this team! This is most likely an error. Please refresh</td>
            </tr> 
        <?php else : ?>
            <?php foreach ($team_members as $member) : ?>      
            <tr>
                <td><?php se($member["username"]); ?></td>
                <td><?php se($member["email"]); ?></td>
                <td><?php se($member["roles"],"","Member"); ?></td>
            </tr>
        <?php endforeach ?>
        
        <?php endif?>
  </table>
  </div>
    </div>
    
    <div class="row">
    <div class = "Team-Info">
        <div class="col-md-3">
            <h2 class="text-center">Team Info</h2>
            <p class="text-center"> Total Members: <?php se($team_total_members); ?></p>
            <p class="text-center">About: <?php se($team_about); ?></p>
            <p class="text-center">This team is currently <?php se($team_is_active ? "active" : "inactive"); ?></p>
        </div>
            </div>
    </div>
            
 
</div>


<?php require_once(__DIR__ . "/../../partials/flash.php"); ?>