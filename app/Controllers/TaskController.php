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
        $newTitle = $_POST['titulo'] ?? null;
        if ($newTitle) {
            $this->model->updateTask($id, $newTitle);
        }
        header("Location: /public/index.php");
        exit;
    }

    $task = $this->model->getTaskById($id);
    require __DIR__ . '/../Views/tasks/update_task.php';
}

}
?>