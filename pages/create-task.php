<?php
include(__DIR__ . '/../bootstrap.php');
include(__DIR__ . '/functions/task-crud.php');

$formErrors = [];
$tasksData = load_all_tasks_data();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Step 1: normalize the request data:
        $normalizedData = normalize_submitted_data($_POST);
// Step 2: validate the normalized data
        $formErrors = validate_normalized_data($normalizedData);
// Step 3: save the data if it's valid
        if (count($formErrors) === 0) {
            $normalizedData['id'] = count($tasksData) + 1;
            $tasksData[] = $normalizedData;
            save_all_tasks_data($tasksData);
            $_SESSION['message'] = 'The new task was saved successfully';
            header('Location: /list-tasks');
            exit;
        }
    }
?>
<?php include(__DIR__ . '/../_header.php'); ?>
    <p><a href="/list-tasks">Go back to the list</a></p>
    <h1>Manage tasks</h1>
    <p>New Task</p>
<?php
include(__DIR__ . '/snippets/_form-tasks.php');
include(__DIR__ . '/../_footer.php');
?>
