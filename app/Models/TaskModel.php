<?php
class TaskModel {
    private $tasksFile = __DIR__ . '/../../storage/tasks.json';
    private $statusFile = __DIR__ . '/../../storage/status.json';

    public function getTasks($search = '') {
        $tasks = json_decode(file_get_contents($this->tasksFile), true) ?: [];
        if ($search) {
            $search = strtolower($search);
            $tasks = array_filter($tasks, function($task) use ($search) {
                return stripos(strtolower($task['titulo'] ?? ''), $search) !== false;
            });
        }
        return $tasks;
    }

    public function toggleTaskStatus($id) {
        $tasks = $this->getTasks();
        foreach ($tasks as &$task) {
            if ($task['id'] === (int)$id) {
                $task['status'] = ($task['status'] === 'Concluído') ? 'Pendente' : 'Concluído';
                break;
            }
        }
        file_put_contents($this->tasksFile, json_encode($tasks, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    public function deleteTask($id) {
        $tasks = $this->getTasks();
        $tasks = array_filter($tasks, function ($task) use ($id) {
            return $task['id'] != (int)$id;
        });
        file_put_contents($this->tasksFile, json_encode(array_values($tasks), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    public function addTask($titulo) {
        $tasks = $this->getTasks();
        $novo_id = empty($tasks) ? 1 : max(array_column($tasks, 'id')) + 1;
        $nova_tarefa = [
            'id' => $novo_id,
            'titulo' => $titulo,
            'status' => 'Pendente'
        ];
        $tasks[] = $nova_tarefa;
        file_put_contents($this->tasksFile, json_encode($tasks, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    public function updateTask($id, $newTitle) {
    $tasks = $this->getTasks();
    foreach ($tasks as &$task) {
        if ($task['id'] == $id) {
            $task['titulo'] = $newTitle;
            break;
        }
    }
    file_put_contents($this->tasksFile, json_encode($tasks, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}


    public function getTaskById($id) {
        $tasks = $this->getTasks();
        foreach ($tasks as $task) {
            if ($task['id'] == $id) return $task;
        }
        return null;
    }

    public function getStatuses() {
        $statuses = json_decode(file_get_contents($this->statusFile), true)['status'] ?? [];
        return $statuses;
    }
}
?>