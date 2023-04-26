<?php
require(__DIR__ . "/../../../partials/nav.php");

if (!has_role("Admin")) {
    flash("You don't have permission to view this page", "warning");
    die(header("Location: " . get_url("dashboard.php")));
}
//handle the toggle first so select pulls fresh data
if (isset($_POST["team_id"])) {
    $team_id = se($_POST, "team_id", "", false);
    if (!empty($team_id)) {
        $db = getDB();
        $stmt = $db->prepare("UPDATE Teams SET is_active = !is_active WHERE id = :tid");
        try {
            $stmt->execute([":tid" => $team_id]);
            flash("Updated Team", "success");
        } catch (PDOException $e) {
            flash("An unexpected error occurred, please try again later. If the issue persists, please contact the administrator", "danger");
            error_log(var_export($e->errorInfo, true), "danger");
        }
    }
}
$query = "SELECT id, name, about, is_active, total_members from Teams";
$params = null;
if (isset($_POST["team"])) {
    $search = se($_POST, "team", "", false);
    $query .= " WHERE name LIKE :team";
    $params =  [":team" => "%$search%"];
}
$query .= " ORDER BY modified desc LIMIT 10";
$db = getDB();
$stmt = $db->prepare($query);
$teams = [];
try {
    $stmt->execute($params);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($results) {
        $teams = $results;
    } else {
        flash("No matches found", "warning");
    }
} catch (PDOException $e) {
    flash("An unexpected error occurred, please try again later. If the issue persists, please contact the administrator", "danger");
    error_log("<pre>" . var_export($e, true) . "</pre>");
}

?>
<div class="container-fluid">
    <h1>List Teams</h1>
    <form method="POST" class="row row-cols-lg-auto g-3 align-items-center">
        <div class="input-group mb-3">
            <input class="form-control" type="search" name="team" placeholder="Team Filter" />
            <input class="btn btn-primary" type="submit" value="Search" />
        </div>
    </form>
    <table class="table">
        <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Active</th>
            <th>Total Members</th>
            <th>Officers</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php if (empty($teams)) : ?>
                <tr>
                    <td colspan="100%">No teams</td>
                </tr>
            <?php else : ?>
                <?php foreach ($teams as $team) : ?>
                    <tr>
                        <td><?php se($team, "id"); ?></td>
                        <td><?php se($team, "name"); ?></td>
                        <td><?php se($team, "about"); ?></td>
                        <td><?php echo (se($team, "is_active", 0, false) ? "active" : "disabled"); ?></td>
                        <td><?php se($team, "total_members"); ?></td>
                        <td><?php echo find_officers(se($team, "id"), true); ?></td>
                        
                        
                        <td>
                            <form method="POST">
                                <input type="hidden" name="team_id" value="<?php se($team, 'id'); ?>" />
                                <?php if (isset($search) && !empty($search)) : ?>
                                    <?php /* if this is part of a search, lets persist the search criteria so it reloads correctly*/ ?>
                                    <input type="hidden" name="team" value="<?php se($search, null); ?>" />
                                <?php endif; ?>
                                <input class="btn btn-primary" type="submit" value="Toggle Active" />
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
<?php
require_once(__DIR__ . "/../../../partials/flash.php");
?>