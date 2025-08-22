<?php
// Caminho do arquivo JSON
$tasksFile = __DIR__ . '/../../storage/tasks.json';

// Carrega as tasks existentes
$tasks = json_decode(file_get_contents($tasksFile), true);

// Dados recebidos do formulário
$id = $_POST['id'] ?? null;
$newStatus = $_POST['status'] ?? null;
$newDescription = $_POST['descricao'] ?? null;

if ($id === null) {
    die("ID da tarefa não informado.");
}

// Atualiza a task correspondente
foreach ($tasks as &$task) {
    if ($task['id'] == $id) {
        if ($newStatus !== null) {
            $task['status'] = $newStatus;
        }
        if ($newDescription !== null) {
            $task['descricao'] = $newDescription;
        }
        break;
    }
}

// Salva de volta no JSON
file_put_contents($tasksFile, json_encode($tasks, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

// Redireciona de volta para a página inicial
header("Location: /public/index.php");
exit;
