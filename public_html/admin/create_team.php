<?php
require(__DIR__ . "/../../../partials/nav.php");

if (!has_role("Admin")) {
    flash("You don't have permission to view this page", "warning");
    die(header("Location: " . get_url("dashboard.php")));
}

if (isset($_POST["name"]) && isset($_POST["description"])) {
    $name = se($_POST, "name", "", false);
    $desc = se($_POST, "description", "", false);
    if (empty($name)) {
        flash("Name is required", "warning");
    } else {
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO Teams (name, about, is_active) VALUES(:name, :desc, 1)");
        try {
            $stmt->execute([":name" => $name, ":desc" => $desc]);
            flash("Successfully created team $name!", "success");
        } catch (PDOException $e) {
            if ($e->errorInfo[1] === 1062) {
                flash("A team with this name already exists, please try another", "warning");
            } else {
                flash("An unexpected error occurred, please try again later. If the issue persists, please contact the administrator", "danger");
                error_log(var_export($e->errorInfo, true));
            }
        }
    }
}
?>
<div class="container-fluid">
    <h1>Create Team</h1>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label" for="name">Name</label>
            <input class="form-control" id="name" name="name" required />
        </div>
        <div class="mb-3">
            <label class="form-label" for="d">Description</label>
            <textarea class="form-control" name="description" id="d"></textarea>
        </div>
        <input type="submit" class="btn btn-primary" value="Create Team" />
    </form>
</div>
<?php
require_once(__DIR__ . "/../../../partials/flash.php");
?>