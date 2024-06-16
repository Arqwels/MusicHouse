<?php
require_once './connect.php'; // Подключение к базе данных

$query = "SELECT id, name, productionYear, price, urlImg, category, productCount FROM products";
$result = mysqli_query($connect, $query);

$items = [];

if ($result) {
  while ($row = mysqli_fetch_assoc($result)) {
    $items[] = [
      'id' => $row['id'],
      'name' => $row['name'],
      'year' => $row['productionYear'],
      'price' => $row['price'],
      'imageSrc' => $row['urlImg'],
      'category' => $row['category'],
      'productCount' => $row['productCount'] // Добавляем поле productCount
    ];
  }
} else {
  echo json_encode(["status" => false, "message" => "Ошибка выполнения запроса"]);
  die();
}

header('Content-Type: application/json');
echo json_encode($items);

mysqli_close($connect);
?>