<?php
  // Ponto de entrada - redireciona para o controller
  require_once __DIR__ . '/../app/Controllers/TaskController.php';

  $controller = new TaskController();
  $action = $_GET['action'] ?? '';
  $id = $_GET['id'] ?? null;

  if ($action === 'concluir' && $id !== null) {
      $controller->concluir($id);
  } elseif ($action === 'delete' && $id !== null) {
      $controller->delete($id);
  } elseif ($action === 'update' && $id !== null) {
      $controller->update($id);
  } elseif ($action === 'add') {
      $controller->add();
  } else {
      $controller->index();
  }
  ?>