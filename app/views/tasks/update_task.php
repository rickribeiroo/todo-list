<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Tarefa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="task-container">
        <div class="task-card">
            <form action="/public/index.php?action=update&id=<?= $task['id'] ?>" method="POST">
                <div class="mb-3">
                    <label for="titulo" class="form-label text-light">Editar Task</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" 
                           value="<?= htmlspecialchars($task['titulo']) ?>" required>
                </div>
                <div class="task-actions">
                    <button type="submit" class="btn btn-save">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</body>

<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        font-family: 'Poppins', sans-serif;
    }
    .task-container {
        width: 100%;
        max-width: 500px;
    }
    .task-card {
        background: #19191C;
        border-radius: 20px;
        padding: 32px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }
    .form-label {
        color: #F9F9F9;
    }
    .form-control {
        background: #2F2D37;
        border: none;
        color: white;
    }
    .form-control:focus {
        border: 2px solid #805CF6;
        outline: none;
    }
    .btn-save {
        background: #805CF6;
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .btn-save:hover {
        background: #6B46E1;
    }
</style>
</html>
