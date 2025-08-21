<?php
$tasks = json_decode(file_get_contents(__DIR__ . '/../storage/tasks.json'), true);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>TODO.list</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="título">
      <h1 id="todo">TODO</h1>
      <h1 id="list">.list</h1>
    </div>
    <ul class="botoes">
      <p id= "tarefas" >Tarefas<p>
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
                <button class="deletar"><i class="bi bi-x-lg"></i></button>
              </div>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
