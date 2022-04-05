<?php
include(__DIR__ . '/functions/task-crud.php');
include(__DIR__ . '/../bootstrap.php');
if (!isset($_GET['id'])) {
    header('Location: /list-tasks');
    exit;
}
$taskId = (int)$_GET['id'];
mark_as_done($taskId);
$_SESSION['message'] = 'Successfully done task ' . $taskId;
header('Location: /list-tasks');
exit;
