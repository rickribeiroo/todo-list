class Controller {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function listTasks() {
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $tasks = $this->model->getTasks($search);
        require __DIR__ . '/../views/tasks/view.php';
    }
}
