<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Tarefa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <div class="título">
      <h1 id="todo">TODO</h1>
      <h1 id="list">.list</h1>
    </div>

    <div class="botoes">
        <p id="tarefas">Nova Tarefa</p>
        <form class="form-adicionar" action="/public/index.php?action=add" method="POST">
            <input type="text" name="titulo" placeholder="Digite o título da tarefa..." required>
            <div class="botoes-form">
                <button type="button" onclick="window.location.href='/public/index.php'" class="btn-cancelar">Cancelar</button>
                <button type="submit" class="btn-adicionar-form">Adicionar Tarefa</button>
            </div>
        </form>
    </div>
</body>
</html>