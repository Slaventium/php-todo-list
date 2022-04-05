<?php
function normalize_submitted_data(array $submittedData): array
{
    return [
            'task' =>
                isset($_POST['task'])
                    ? (string)$_POST['task']
                    : '',

    ];
}

function validate_normalized_data(array $normalizedData): array
{
    $formErrors = [];
    if ($normalizedData['task'] === '') {
        $formErrors['task'] = 'You need to type something!';
    }
    return $formErrors;
}

function load_all_tasks_data(): array
{
    $toursJsonFile = __DIR__ . '/../../data/tasks.json';
    if (!file_exists($toursJsonFile)) {
        return [];
    } $jsonData = file_get_contents($toursJsonFile);
    return json_decode($jsonData, true);
}

function save_all_tasks_data(array $tasksData): void
{
    $tasksJsonFile = __DIR__ . '/../../data/tasks.json';
    $jsonData = json_encode($tasksData, JSON_PRETTY_PRINT);
    file_put_contents($tasksJsonFile, $jsonData);
}

function load_task_data(int $id): array
{
    $tasksData = load_all_tasks_data();
    foreach ($tasksData as $taskData) {
        if ($taskData['id'] === $id) {
            return $taskData;
        }
    }
    throw new RuntimeException('Could not find task with ID ' . $id);
}

function save_task_data(array $modifiedTaskData): void
{
    $tasksData = load_all_tasks_data();
    foreach ($tasksData as $key => $taskData) {
        if ($taskData['id'] === $modifiedTaskData['id']) {
            $tasksData[$key] = $modifiedTaskData;
        }
    }
    save_all_tasks_data($tasksData);
}

function mark_as_done(int $id): void
{
    $tasksData = load_all_tasks_data();
    foreach ($tasksData as $key => $taskData) {
        if ($taskData['id'] === $id) {
            $tasksData[$key]['isDone'] = true;
        }
    }
    save_all_tasks_data($tasksData);
}

