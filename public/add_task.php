<?php
// Controller para o envio do formulário.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];

    $caminho_json = __DIR__ . '/../storage/tasks.json';

    // Lê o conteúdo atual do arquivo JSON
    $tasks = json_decode(file_get_contents($caminho_json), true);

    // Gera um novo ID para a tarefa
    // Pega o ID da última tarefa e adiciona 1. Se não houver tarefas, o ID inicial será 1.
    $novo_id = empty($tasks) ? 1 : max(array_column($tasks, 'id')) + 1;

    // Cria a nova tarefa com status 'pendente'
    $nova_tarefa = [
        'id' => $novo_id,
        'titulo' => $titulo,
        'status' => 'pendente'
    ];

    // Adiciona a nova tarefa ao array
    $tasks[] = $nova_tarefa;

    // Salva o array atualizado de volta no arquivo JSON
    file_put_contents($caminho_json, json_encode($tasks, JSON_PRETTY_PRINT));

    // Redireciona de volta para a página inicial
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Tarefa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="título">
      <h1 id="todo">TODO</h1>
      <h1 id="list">.list</h1>
    </div>

    <div class="botoes">
        <p id="tarefas">Nova Tarefa</p>
        <form class="form-adicionar" action="add_task.php" method="POST">
            <input type="text" name="titulo" placeholder="Digite o título da tarefa..." required>
            <div class="botoes-form">
                <button type="button" onclick="window.location.href='index.php'" class="btn-cancelar">Cancelar</button>
                <button type="submit" class="btn-adicionar-form">Adicionar Tarefa</button>
            </div>
        </form>
    </div>
</body>
</html>