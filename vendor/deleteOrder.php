<?php
session_start();
require_once 'connect.php';

$response = [];

if (!isset($_SESSION['user'])) {
  $response = [
    "status" => false,
    "message" => "Пользователь не авторизован"
  ];
  echo json_encode($response);
  exit();
}

$userId = $_SESSION['user']['id'];
$orderId = $_POST['order_id'];

// Проверяем, что заказ принадлежит текущему пользователю и его статус "Новый"
$query = "SELECT id FROM orders WHERE id = ? AND user_id = ? AND status = 'Новый'";
$stmt = $connect->prepare($query);
$stmt->bind_param("ii", $orderId, $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  // Начинаем транзакцию
  $connect->begin_transaction();

  try {
    // Удаляем связанные записи из order_products
    $deleteOrderProductsQuery = "DELETE FROM order_products WHERE order_id = ?";
    $stmt1 = $connect->prepare($deleteOrderProductsQuery);
    $stmt1->bind_param("i", $orderId);
    $stmt1->execute();

    // Удаляем сам заказ из orders
    $deleteOrderQuery = "DELETE FROM orders WHERE id = ?";
    $stmt2 = $connect->prepare($deleteOrderQuery);
    $stmt2->bind_param("i", $orderId);
    $stmt2->execute();

    // Подтверждаем транзакцию
    $connect->commit();

    $response = [
      "status" => true,
      "message" => "Заказ успешно удален"
    ];
  } catch (Exception $e) {
    // Откатываем транзакцию в случае ошибки
    $connect->rollback();
    $response = [
      "status" => false,
      "message" => "Ошибка при удалении заказа: " . $e->getMessage()
    ];
  }
} else {
  $response = [
    "status" => false,
    "message" => "Заказ не найден или его нельзя удалить"
  ];
}

header('Content-Type: application/json');
echo json_encode($response);
?>