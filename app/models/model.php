class Model {
    private $tasksFile = __DIR__ . '/../../storage/tasks.json';

    public function getTasks($search = '') {
        $tasks = json_decode(file_get_contents($this->tasksFile), true);
        
        if ($search !== '') {
            $search = strtolower($search);
            $tasks = array_filter($tasks, function($task) use ($search) {
                return strpos(strtolower($task['title']), $search) !== false;
            });
        }

        return $tasks;
    }
}
