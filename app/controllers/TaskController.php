<?php
class TaskController
{
    public function update()
    {
        $id = (int) $_POST['id'];
        $newStatus = $_POST['status'];
        $newDescription = $_POST['descricao'];

        $tasksPath = __DIR__ . '/../../storage/tasks.json';

        // Carrega as tasks
        $tasks = json_decode(file_get_contents($tasksPath), true);

        // Atualiza a task correspondente
        foreach ($tasks as &$task) {
            if ($task['id'] == $id) {
                $task['status'] = $newStatus;
                $task['descricao'] = $newDescription;
                break;
            }
        }

        // Salva de volta no JSON
        file_put_contents($tasksPath, json_encode($tasks, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        // Redireciona de volta para a lista principal
        header("Location: /");
        exit;
    }
}
