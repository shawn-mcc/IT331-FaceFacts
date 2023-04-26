<?php
require(__DIR__ . "/../../partials/nav.php");
?>

<?php
if (is_logged_in(true)) {
    $user = find_user_by_id(get_user_id());
    $user_id = $user["id"];
    $user_name = $user["first_name"];
    $stmt = $db->prepare("SELECT * FROM TaskAssignment WHERE assigned_id = :user_id AND user_or_team = 'User' OR user_or_team = 'User (via Batch'");
    try {
        $stmt->execute([":user_id" => $user_id]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        error_log(var_export($results, true));
        $task_ids = [];
        for ($i = 0; $i < count($results); $i++) {
            $task_ids[] += $results[$i]["master_id"];
        }
    } catch (PDOException $e) {
        error_log("<pre>" . var_export($e, true) . "</pre>");
        return false;
    }
} else {
    flash("You are not logged in!");
}
if (isset($_POST["submit"])){
    echo "<script type='text/javascript'>document.location.href='" . $BASE_PATH . "/complete_task.php?id=" . $task["id"] . "';</script>";
}

?>
<div class="container-fluid">
    <h1 id="Dashboard Title"><?php echo $user_name ?>'s Dashboard</h1>
    <form method="POST" class="row row-cols-lg-auto g-3 align-items-center">
        <div class="input-group mb-3">
            <input class="form-control" type="search" name="task" placeholder="Task Filter" />
            <input class="btn btn-primary" type="submit" value="Search" />
        </div>
    </form>
    <h3> My Tasks </h3>
    <table class="table">
        <thead>
            <th>Name</th>
            <th>Task Type</th>
            <th>Assigned To</th>
            <th>Assigned By</th>
            <th>Status</th>
            <th>Complete</th>
        </thead>
        <tbody>

            <?php for ($i = 0; $i < count($task_ids); $i++) :
                $task = get_task_by_id($task_ids[$i]);
                error_log(var_export($task, true));
                if (!$task) : ?>
                    <tr>
                        <td colspan="100%">No tasks found</td>
                    </tr>
                <?php else : ?>

                    <tr>
                        <td><?php se($task[0], "name"); ?></td>
                        <td><?php se($task[0], "task_type"); ?></td>
                        <td><?php echo get_assigned_str($task[0]["id"]); ?></td>
                        <td><?php echo get_assigner($task[0]["id"]); ?></td>
                        <td><?php se($task[0], "status"); ?></td>



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
                <?php endif; ?>
            <?php endfor; ?>
        </tbody>
    </table>
    <?php require_once(__DIR__ . "/../../partials/flash.php"); ?>