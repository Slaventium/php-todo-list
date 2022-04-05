<?php

require_once '../vendor/autoload.php';

include(__DIR__ . '/../bootstrap.php');

$urlMap = [
    '/login' => 'login.php',
    '/logout' => 'logout.php',
    '/tasks' => 'tasks.php',
    '/create-task' => 'create-task.php',
    '/list-tasks' => 'list-tasks.php',
    '/' => 'tasks.php',
    '/edit-task' => 'edit-task.php',
    '/mark-as-done' => 'mark-as-done.php',
    '/delete-task' => 'delete-task.php'
];
$pathInfo = $_SERVER['PHP_SELF'] ?? '/';

if (array_key_exists($pathInfo, $urlMap)) {
    // Load a specific page script
    include(__DIR__ . '/../pages/' . $urlMap[$pathInfo]);
} else {
// Produce a 404 response
    header($_SERVER['SERVER_PROTOCOL'] . ': 404 Not Found');
    include(__DIR__ . '/../pages/404.php');
}

?>

<?php include(__DIR__ . '/../_footer.php'); ?>