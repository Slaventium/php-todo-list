<?php
include(__DIR__ . '/../bootstrap.php');

$urlMap = [
    '/login' => 'login.php',
    '/logout' => 'logout.php',
    '/tasks' => 'tasks.php',
    '/create-task' => 'create-task.php',
    '/list-tasks' => 'list-tasks.php',
    '/' => 'homepage.php',
    '/edit-task' => 'edit-task.php',
    '/mark-as-done' => 'mark-as-done.php',
    '/delete-task' => 'delete-task.php'
];
$pathInfo = $_SERVER['PATH_INFO'] ?? '/';
if (isset($urlMap[$pathInfo])) {
// Load a specific page script
    include(__DIR__ . '/../pages/' . $urlMap[$pathInfo]);
} else {
// Produce a 404 response
    header($_SERVER['SERVER_PROTOCOL'] . ': 404 Not Found');
    include(__DIR__ . '/../pages/404.php');
}

?>

<?php include(__DIR__ . '/../_footer.php'); ?>