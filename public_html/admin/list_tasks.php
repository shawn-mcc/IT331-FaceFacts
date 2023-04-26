<?php
require(__DIR__ . "/../../../partials/nav.php");

if (!has_role("Admin")) {
    flash("You don't have permission to view this page", "warning");
    die(header("Location: " . get_url("dashboard.php")));
}
//handle the toggle first so select pulls fresh data
if (isset($_POST["task_id"])) {
    $task_id = se($_POST, "task_id", "", false);
    if (!empty($task_id)) {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM MasterTasks WHERE id = :tid");
        try {
            $stmt->execute([":tid" => $task_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($results) {
                $task = $results[0];
                echo "<script type='text/javascript'>document.location.href='" . $BASE_PATH . "/admin/edit_task.php?id=" . $task["id"] . "';</script>";
            }else{
                flash("No matches found", "warning");
            }
        } catch (PDOException $e) {
            flash("An unexpected error occurred, please try again later. If the issue persists, please contact the administrator", "danger");
            error_log(var_export($e->errorInfo, true));
        }
    }
}
$query = "SELECT id, name, task_type, assign_type, assign_to, assigned_by,status FROM MasterTasks";
$params = null;
if (isset($_POST["task"])) {
    $search = se($_POST, "task", "", false);
    $query .= " WHERE name LIKE :task";
    $params =  [":task" => "%$search%"];
}
$query .= " ORDER BY modified desc LIMIT 10";
$db = getDB();
$stmt = $db->prepare($query);
$tasks = [];
try {
    $stmt->execute($params);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($results) {
        $tasks = $results;
        error_log(var_export($tasks, true));
    } else {
        flash("No matches found", "warning");
    }
} catch (PDOException $e) {
    flash("An unexpected error occurred, please try again later. If the issue persists, please contact the administrator", "danger");
    error_log("<pre>" . var_export($e, true) . "</pre>");
}

?>
<div class="container-fluid">
    <h1>List Tasks</h1>
    <form method="POST" class="row row-cols-lg-auto g-3 align-items-center">
        <div class="input-group mb-3">
            <input class="form-control" type="search" name="task" placeholder="Task Filter" />
            <input class="btn btn-primary" type="submit" value="Search" />
        </div>
    </form>
    <table class="table">
        <thead>
            <th>Name</th>
            <th>Task Type</th>
            <th>Assigned To</th>
            <th>Assigned By</th>
            <th>Status</th>
            <th>Edit</th>
        </thead>
        <tbody>
            <?php if (empty($tasks)) : ?>
                <tr>
                    <td colspan="100%">No tasks found</td>
                </tr>
            <?php else : ?>
                <?php foreach ($tasks as $task) : ?>
                    <tr>
                        <td><?php se($task, "name"); ?></td>
                        <td><?php se($task, "task_type"); ?></td>
                        <td><?php echo get_assigned_str($task["id"]); ?></td>
                        <td><?php echo get_assigner($task["id"]); ?></td>
                        <td><?php se($task, "status"); ?></td>
                        
                        
                        
                        <td>
                            <form method="POST">
                                <input type="hidden" name="task_id" value="<?php se($task, 'id'); ?>" />
                                <?php if (isset($search) && !empty($search)) : ?>
                                    <?php /* if this is part of a search, lets persist the search criteria so it reloads correctly*/ ?>
                                    <input type="hidden" name="task" value="<?php se($search, null); ?>" />
                                <?php endif; ?>
                                <input class="btn btn-primary" type="submit" value="Edit" />
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