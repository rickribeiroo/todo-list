<?php
require_once __DIR__ . '/../Models/TaskModel.php';

class TaskController {
    private $model;

    public function __construct() {
        $this->model = new TaskModel();
    }

    public function index() {
        $search = $_GET['search'] ?? '';
        $tasks = $this->model->getTasks($search);
        require __DIR__ . '/../Views/index.php';
    }

    public function concluir($id) {
        $this->model->toggleTaskStatus($id);
        header("Location: /public/index.php");
        exit;
    }

    public function delete($id) {
        $this->model->deleteTask($id);
        header("Location: /public/index.php");
        exit;
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = $_POST['titulo'];
            $this->model->addTask($titulo);
            header('Location: /public/index.php');
            exit;
        }
        require __DIR__ . '/../Views/add_task.php';
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newStatus = $_POST['status'] ?? null;
            $newDescription = $_POST['descricao'] ?? null;
            $this->model->updateTask($id, $newStatus, $newDescription);
            header("Location: /public/index.php");
            exit;
        }
        $task = $this->model->getTaskById($id);
        $statuses = $this->model->getStatuses();
        require __DIR__ . '/../Views/tasks/update_task.php';
    }
}
?>