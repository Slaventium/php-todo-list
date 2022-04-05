<?php
include(__DIR__ . '/../bootstrap.php');
include(__DIR__ . '/functions/task-crud.php');
if (!isset($_SESSION['authenticated_user'])) {
    header('Location: /../login');
    exit;
}
if (!isset($_GET['id'])) {
    header('Location: /list-tasks');
    exit;
}
$taskId = (int)$_GET['id'];
$originalData = load_task_data($taskId);
$normalizedData = $originalData;
$formErrors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $normalizedData = array_merge(
        $originalData,
        normalize_submitted_data($_POST)
    );
    $formErrors = validate_normalized_data($normalizedData);
    if (count($formErrors) === 0) {
        save_task_data($normalizedData);
        $normalizedData['id'] = $taskId;
        $_SESSION['message'] = 'The task was updated successfully';
        header('Location: /list-tasks');
        exit;
    }
}
?>
<?php include(__DIR__ . '/../_header.php'); ?>
    <p><a href="/list-tasks">Go back to the list</a></p>
    <h1>Edit task <?php echo $taskId; ?></h1>
<?php
include(__DIR__ . '/snippets/_form-tasks.php');
include(__DIR__ . '/../_footer.php');
?>