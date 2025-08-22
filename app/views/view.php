<form method="GET" action="">
    <input type="text" name="search" placeholder="Buscar tarefa" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
    <button type="submit">Pesquisar</button>
</form>

<ul>
<?php foreach ($tasks as $task): ?>
    <li><?= htmlspecialchars($task['title']) ?></li>
<?php endforeach; ?>
</ul>
