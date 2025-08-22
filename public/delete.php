<?php
$id = $_GET['id'] ?? null;

if ($id) {
    $file = __DIR__ . '/../storage/tasks.json';
    $tasks = json_decode(file_get_contents($file), true);

    $tasks = array_filter($tasks, function ($task) use ($id) {
        return $task['id'] != $id;
    });

    file_put_contents($file, json_encode(array_values($tasks), JSON_PRETTY_PRINT));
}

header('Location: index.php');
exit;
