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

$query = "SELECT o.id, o.status, o.date, op.product_name, op.product_count 
          FROM orders o 
          JOIN order_products op ON o.id = op.order_id 
          WHERE o.user_id = ? 
          ORDER BY o.date DESC";

$stmt = $connect->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

$orders = [];

while ($row = $result->fetch_assoc()) {
    $orderId = $row['id'];
    if (!isset($orders[$orderId])) {
        $orders[$orderId] = [
            "id" => $orderId,
            "status" => $row['status'],
            "date" => $row['date'],
            "products" => []
        ];
    }
    $orders[$orderId]['products'][] = [
        "name" => $row['product_name'],
        "count" => $row['product_count']
    ];
}

$response = [
    "status" => true,
    "orders" => array_values($orders)
];

header('Content-Type: application/json');
echo json_encode($response);
?>