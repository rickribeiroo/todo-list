<?php
$tasks = json_decode(file_get_contents(__DIR__ . '/../storage/tasks.json'), true);

// Filtro de busca
$search = $_GET['search'] ?? '';
if ($search) {
    $tasks = array_filter($tasks, function ($task) use ($search) {
        return stripos($task['titulo'], $search) !== false;
    });
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>TODO.list</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <script>
        function confirmDelete(id) {
            if (confirm('Tem certeza que deseja excluir esta tarefa?')) {
                window.location.href = 'delete.php?id=' + id;
            }
        }
    </script>
</head>
<body>
    <div class="título">
      <h1 id="todo">TODO</h1>
      <h1 id="list">.list</h1>
    </div>

    <!-- Barra de pesquisa -->
    <div class="search-container">
        <form method="GET" action="">
            <input type="text" name="search" placeholder="Buscar tarefa..." value="<?= htmlspecialchars($search) ?>">
            <button type="submit"><i class="bi bi-search"></i></button>
        </form>
    </div>

    <ul class="botoes">
      <div class="cabecalho-tarefas">
        <p id="tarefas">Tarefas</p>
        <button class="btn-adicionar" onclick="window.location.href='/app/Views/tasks/add_task.php'">
          <i class="bi bi-plus-lg"></i> Adicionar Tarefa
        </button>
      </div>
        <?php foreach ($tasks as $task): ?>
            <li class="<?= $task['status'] === 'feito' ? 'done' : 'pending' ?>">
              <div class="info">
                <button class="concluir"><i class="bi bi-circle"></i></button>
                <?= htmlspecialchars($task['titulo']) ?>
                <span>(<?= $task['status'] ?>)</span>
              </div>
              <div class="botoes-li">
                <button class="editar" onclick="window.location.href='/app/Views/tasks/update_task.php?id=<?= $task['id'] ?>'">
                    <i class="bi bi-pencil-square"></i>
                </button>
                <button class="deletar" onclick="confirmDelete(<?= $task['id'] ?>)">
                    <i class="bi bi-x-lg"></i>
                </button>
              </div>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>