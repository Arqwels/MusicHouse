<?php

require_once 'function.php';

// Проверка наличия ключа 'action' в POST-запросе
if (isset($_POST['action'])) {
  $action = $_POST['action'];
  switch ($action) {
    case 'init':
      init();
      break;
    case 'selectOneGoods':
      selectOneGoods();
      break;
    case 'updateGoods':
      updateGoods();
      break;
    case 'newGoods':
      newGoods();
      break;
  }
}

// Проверка наличия ключа 'action' в GET-запросе
if (isset($_GET['action'])) {
  $action = $_GET['action'];
  if ($action == 'viewOrders') {
    viewOrders();
  }
}
?>