<?php
include(__DIR__ . '/../bootstrap.php');


?>
<?php include(__DIR__ . '/../_header.php'); ?>

    <h1>Manage tasks</h1>
    <p>New Task</p>
    <form method="post">
        <div>
            <label for="task">
                Task:
            </label>
            <input type="text" name="task" id="task">
        </div>
        <div>
            <button type="submit">Create</button>
        </div>
    </form>
<?php if(empty($_POST['task'])) {
    $_SESSION['message'] = 'You need to type something!';
    include __DIR__ . '/../_flash_message.php';
    }
?>
<?php
    $username = $_SESSION['authenticated_user'];
    if(!empty($_POST['task'])) {
        if (isset($_POST['task'])) {
            $_SESSION['tasks'][$username][] = $_POST['task'];
        }
    }
        $allTasks = isset($_SESSION['tasks'][$username]) ? $_SESSION['tasks'][$username] : [];
    ?>
<h2>Tasks</h2>
<ul class="tasks">
    <?php
    foreach ($allTasks as $task) {
        ?>
        <li><?php echo htmlspecialchars($task, ENT_QUOTES); ?></li>
        <?php
    }
    ?>
</ul>
<?php include(__DIR__ . '/../_footer.php'); ?>