<?php
require(__DIR__."/../../partials/nav.php");
?>
<h1>My Teams</h1>
<?php
if (is_logged_in(true)) {
    error_log("Session data: " . print_r($_SESSION, true));
} else {
    flash("You are not logged in!");
}?>
<table class = "table">
    <thead>
        <th>Name</th>
        <th>Description</th>
        <th>Total Members</th>
        <th>Active</th>
        <th>View</th>
    </thead>
    <tbody>
        <?php
        $user_teams = find_user_teams();
        if ($user_teams != NULL) :
        foreach ($user_teams as $team) : ?>
            <tr>
                <td><?php se($team["name"]); ?></td>
                <td><?php se($team["about"]); ?></td>
                <td><?php se($team["total_members"]); ?></td>
                <td><?php se($team["is_active"] ? "Yes" : "No"); ?></td>
                <td>
                    <form method="POST" action="<?php se(pass_team_url($team["id"],"team_dashboard.php")); ?>">
                        <input type="hidden" name="team_id" value="<?php $team["id"] ?>" />
                        <input class="btn btn-primary" type="submit" value="View" />
                    </form>
            </tr>
        <?php endforeach ?>
        <?php else : ?>
           <?php flash("You are not a member of any teams"); ?>
        <?php endif?>
    </tbody>
</table>


<?php require_once(__DIR__ . "/../../partials/flash.php"); ?>