<?php
$tasks = json_decode(file_get_contents(__DIR__ . '/../storage/tasks.json'), true);

// Filtro de busca
$search = $_GET['search'] ?? '';
if ($search) {
    $tasks = array_filter($tasks, function ($task) use ($search) {
        return stripos($task['titulo'], $search) !== false;
    });
}

// 🔹 Função para concluir (ou alternar status)
if (isset($_GET['action']) && $_GET['action'] === 'concluir' && isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    foreach ($tasks as &$task) {
        if ($task['id'] === $id) {
            // Alterna entre Pendente e Concluído
            $task['status'] = ($task['status'] === 'Concluído') ? 'Pendente' : 'Concluído';
            break;
        }
    }

    // Salva no arquivo JSON
    file_put_contents(__DIR__ . '/../storage/tasks.json', json_encode($tasks, JSON_PRETTY_PRINT));

    // Redireciona para evitar reenvio da ação
    header("Location: index.php");
    exit;
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

        // Função para atualizar o ícone do botão com base no status
        function updateIcon() {
            document.querySelectorAll('.concluir').forEach(button => {
                const taskId = button.getAttribute('data-id');
                const statusSpan = button.closest('li').querySelector('span');
                const status = statusSpan ? statusSpan.textContent.replace('(', '').replace(')', '').trim() : '';

                const icon = button.querySelector('i');
                if (status === 'Concluído') {
                    icon.className = 'bi bi-check-circle';
                } else {
                    icon.className = 'bi bi-circle';
                }
            });
        }

        // Chama a função ao carregar a página
        window.onload = updateIcon;
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
      <p id="tarefas">Tarefas</p>
        <?php foreach ($tasks as $task): ?>
            <li class="<?= $task['status'] === 'Concluído' ? 'done' : 'pending' ?>">
              <div class="info">
                <button class="concluir" data-id="<?= $task['id'] ?>" onclick="window.location.href='?action=concluir&id=<?= $task['id'] ?>'">
                    <i class="bi bi-circle"></i>
                </button>
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