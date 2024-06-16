<?php

require_once 'connect.php';

$response = [];

function getProductsByIds($productIds) {
  global $connect;
  $ids = implode(',', array_map('intval', $productIds)); // Преобразуем массив идентификаторов в строку
  $query = "SELECT id, name, productionYear, price, urlImg, category, productCount FROM products WHERE id IN ($ids)";
  $result = mysqli_query($connect, $query);

  $items = [];

  if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
      $items[] = [
        'id' => $row['id'],
        'name' => $row['name'],
        'price' => $row['price'],
        'productCount' => $row['productCount'] //можно сделать проверку в будущем
      ];
    }
  } else {
    return null;
  }

  return $items;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $password = $_POST['password'] ?? null;
  $cart_items = json_decode($_POST['cart'], true);
  $user_items = json_decode($_POST['user'], true);

  if ($password && $user_items && $cart_items) {
    $userId = $user_items['id'];

    // Получаем пароль из базы данных для указанного пользователя
    $query = "SELECT password FROM users WHERE id = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $dbPassword = $result->fetch_assoc()['password'];

    // Хешируем введенный пароль
    $hashedPassword = md5($password);

    // Проверяем введенный пароль с паролем из базы данных
    if ($hashedPassword === $dbPassword) {
      // Получаем идентификаторы продуктов из корзины
      $productIds = array_keys($cart_items);

      // Получаем товары по их идентификаторам
      $products = getProductsByIds($productIds);

      if ($products !== null) {
        // Вставляем новый заказ в таблицу orders
        $status = "Новый";
        $date = date('Y-m-d H:i:s');
        $query = "INSERT INTO orders (user_id, name, surname, patronymic, status, date) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("isssss", $userId, $user_items['name'], $user_items['surname'], $user_items['patronymic'], $status, $date);
        $stmt->execute();
        $orderId = $stmt->insert_id;

        // Вставляем данные о продуктах в таблицу order_products
        foreach ($products as $product) {
          $productId = $product['id'];
          $productName = $product['name'];
          $productCount = $cart_items[$productId];
          $query = "INSERT INTO order_products (order_id, product_id, product_name, product_count) VALUES (?, ?, ?, ?)";
          $stmt = $connect->prepare($query);
          $stmt->bind_param("iisi", $orderId, $productId, $productName, $productCount);
          $stmt->execute();
        }

        // Формируем ответ
        $response = [
          "status" => true,
          "message" => "Заказ оформлен!",
          "product_ids" => $productIds
        ];
      } else {
        $response = [
          "status" => false,
          "message" => "Ошибка получения товаров"
        ];
      }
    } else {
      $response = [
        "status" => false,
        "message" => "Неверный пароль"
      ];
    }
  } else {
    $response = [
      "status" => false,
      "message" => "Некорректные данные"
    ];
  }
} else {
  $response = [
    "status" => false,
    "message" => "Некорректный метод запроса"
  ];
}

header('Content-Type: application/json');
echo json_encode($response);
?>