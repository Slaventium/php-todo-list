<?php
include(__DIR__ . '/../bootstrap.php');
include(__DIR__ . '/functions/task-crud.php');
$tasksJsonFile = __DIR__ . '/../data/tasks.json';
if (file_exists($tasksJsonFile)) {
    $jsonData = file_get_contents($tasksJsonFile);
    $taskData = json_decode($jsonData, true);
} else {
    $taskData = [];
}
$tasksData = array_filter(
    load_all_tasks_data(),
    function (array $taskData) {
        return !isset($taskData['isDone']) ||
            !$taskData['isDone'];
    }
);
include(__DIR__ . '/../_header.php');
?>
<p>
    <a href="/create-task" class="btn btn-primary">Add a task</a>
</p>
<?php
if (count($taskData) === 0) {
    ?>
    <p>There are no tasks (yet).</p>
    <?php
}
else {
    ?>
    <table class="table">
        <thead>
        <tr>
            <th>Tasks</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($tasksData as $taskData) {
            if (isset($taskData['isDone']) && $taskData['isDone']) {
                continue;
            }
            ?>
            <tr>
                <td>
                    <?php echo htmlspecialchars(
                        $taskData['task'],
                        ENT_QUOTES
                    ); ?>
                </td>
                <td>
                    <a href="/edit-task?id=<?php
                    echo htmlspecialchars($taskData['id'], ENT_QUOTES);
                    ?>" class="btn btn-primary">Edit</a>
                    <form action="/mark-as-done">
                        <input type="hidden" name="id" value="<?php
                        echo htmlspecialchars($taskData['id'], ENT_QUOTES);
                        ?>">
                        <button type="submit" class="btn btn-danger">Done</button>
                    </form>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <?php
}
?>
<?php

include(__DIR__ . '/../_footer.php');
?>;