<?php
// Carrega os arquivos JSON
$tasks = json_decode(file_get_contents(__DIR__ . '/../../../storage/tasks.json'), true);

$statuses = json_decode(file_get_contents(__DIR__ . '/../../../storage/status.json'), true)['status'];
// Pega o ID vindo da URL
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;

if ($id === null) {
    die("ID da tarefa não informado!");
}

// Procura a tarefa pelo ID
$task = null;
foreach ($tasks as $t) {
    if ($t['id'] == $id) {
        $task = $t;
        break;
    }
}

if (!$task) {
    die("Tarefa não encontrada!");
}

$currentStatus = $task['status'];
$description = $task['descricao'] ?? 'Sem descrição.';

// Filtra os status disponíveis, removendo o status atual
$availableStatuses = array_filter($statuses, function($s) use ($currentStatus) {
    return $s['nome'] !== $currentStatus;
});
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit_task</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>

<body>
    <div class="task-container">
        <div class="task-card">
            <!-- Alterar action para apontar para a rota correta -->
            <form action="/app/Controllers/updater.php" method="POST">
            <input type="hidden" name="id" value="<?= $task['id'] ?>">
            <input type="hidden" id="statusInput" name="status" value="<?= $currentStatus ?>">
            
            <div class="task-title"><?= $task['titulo'] ?></div>

            <div class="dropdown task-status">
                <button id="taskStatusBtn" class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?= $currentStatus ?>
                </button>
                <ul class="dropdown-menu">
                    <?php foreach ($availableStatuses as $status): ?>
                        <li>
                            <a class="dropdown-item" href="#" data-status="<?= $status['nome'] ?>">
                                <?= $status['nome'] ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="task-description-container">
                <textarea class="task-description" name="descricao"><?= $task['descricao'] ?></textarea>
            </div>

            <div class="task-actions">
                <button type="submit" class="btn btn-save">Salvar</button>
            </div>
        </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

    <script>
    document.querySelectorAll('.task-status .dropdown-item').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const btn = document.getElementById('taskStatusBtn');
            const hiddenInput = document.getElementById('statusInput');
            const oldStatus = btn.textContent;
            const newStatus = this.dataset.status;

            btn.textContent = newStatus;
            hiddenInput.value = newStatus;

            this.textContent = oldStatus;
            this.dataset.status = oldStatus;
        });
    });
    </script>
</body>

  <style>
      *
        {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            padding: 20px;
        }
        
        .task-container {
            width: 120%;
            max-width: 864px;
            position: relative;
        }
        
        .task-card {
            width: 100%;
            height: 512px;
            background: #19191C;
            border-radius: 20px;
            padding: 32px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }
        
        .task-title {
            color: #F9F9F9;
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 32px;
            font-style: normal;
            line-height: normal;
        }
        
        .task-description-container {
            width: 100%;
            height: 288px;
            background: #2F2D37;
            border-radius: 16px;
            color: #2F2D37;
            border: 1.3px #2F2D37 solid;
            padding: 16px;
            margin-bottom: 32px;
            /*overflow-y: auto;*/
        }

        .task-description {
            width: 100%;
            height: 100%;
            border: none;
            outline: none;
            resize: none;              /* impede redimensionamento manual */
            background: transparent;   /* mantém o fundo igual ao container */
            color: #F9F9F9;
            font-size: 20px;
            font-weight: 400;
            line-height: 1.6;
            overflow-y: auto;          /* ativa rolagem se o texto for grande */
        }
        
        .task-status {
            display: inline-block;
            background: #2F2D37;
            border-radius: 8px;
            color: #F9F9F9;
            font-size: 24px;
            font-weight: 500;
            position: absolute;
            top: 36px;
            right: 32px;
            z-index: 1050;
        }

        /* Botão ocupa todo o container */
        .task-status .btn {
            background: transparent;
            border: none;
            color: #F9F9F9;
            font-size: 24px;
            font-weight: 500;
            padding: 5px 24px;      
            width: 100%;
            text-align: left;
            border-radius: 8px; /* mesmo arredondamento */
        }

        /* Dropdown com mesmo tamanho e alinhamento do botão */
        .task-status .dropdown-menu {
            background: #2F2D37;
            border: none;
            border-radius: 8px 8px 8px 8px; /* só arredonda embaixo */
            width: 100%;
            min-width: unset;
            margin-top: 0; /* encosta no botão */
        }

        /* Itens ocupam toda a largura */
        .task-status .dropdown-item {
            color: #F9F9F9;
            font-size: 18px;
            width: 100%;
            text-align: left;
            padding: 10px 20px;
        }

        /* Hover com mesmo estilo */
        .task-status .dropdown-item:hover {
            background: #3C3A47;
        }

        .btn:hover {
            background: #6A47D1;
            color: white;
            /*transform: translateX(-1px);*/
        }
                
        .task-actions {
            display: flex;
            gap: 16px;
            margin-top: 20px;
        }
        
        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            border: none;
            font-size: 18px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-save {
            background: #805CF6;
            color: white;
            margin-left: auto;
        }
        
        
        .task-meta {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            color: #666;
            font-size: 16px;
        }
        
        @media (max-width: 768px) {
            .task-card {
                height: auto;
                padding: 20px;
            }
            
            .task-status {
                position: relative;
                top: 0;
                right: 0;
                margin-bottom: 20px;
            }
            
            .task-title {
                font-size: 28px;
            }
        }
  </style>

</html>