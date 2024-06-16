<?php

$bd_hostname = 'localhost';
$bd_username = 'root';
$bd_password = '';
$bd_name = 'music-house';

function connect() {

  $connect = mysqli_connect('localhost', 'root', '', 'music-house');

  if (!$connect) {
    die('Ошибка при подключении к БД!');
  }

  return $connect;
}

function init() {
  //вывожу список товаров
  $connect = connect();
  $sql = "SELECT id, name FROM products";
  $result = mysqli_query($connect, $sql);

  if (mysqli_num_rows($result) > 0) {
    $out = array();
    while($row = mysqli_fetch_assoc($result)) {
      $out[$row["id"]] = $row;
    }
    echo json_encode($out);
  }
  else {
    echo "0";
  }

  mysqli_close($connect);
}

function selectOneGoods() {
  $connect = connect();
  $id = $_POST['id'];
  $sql = "SELECT * FROM products WHERE id = '$id'";
  $result = mysqli_query($connect, $sql);

  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo json_encode($row);
  }
  else {
    echo "0";
  }

  mysqli_close($connect);
}

function updateGoods() {
  $connect = connect();

  $id = $_POST['id'];
  $nameProduct = $_POST['nameProduct'];
  $priceProduct = $_POST['priceProduct'];
  $countProduct = $_POST['countProduct'];
  $yearProduct = $_POST['yearProduct'];
  $categoryProduct = $_POST['categoryProduct'];
  $imageProduct = $_POST['imageProduct'];
  $inStockProduct = $_POST['inStockProduct'];

  $sql = "UPDATE products SET name = '$nameProduct', productionYear = '$yearProduct', price = '$priceProduct', urlImg = '$imageProduct', inStock = '$inStockProduct', productCount = '$countProduct', category = '$categoryProduct' WHERE id = '$id'";

  if (mysqli_query($connect, $sql)) {
    echo "1";
  }
  else {
    echo "0";
  }

  mysqli_close($connect);
}

function newGoods() {
  // Подключение к базе данных
  $connect = connect();

  // Получение данных из POST-запроса
  $nameProduct = $_POST['nameProduct'];
  $priceProduct = $_POST['priceProduct'];
  $countProduct = $_POST['countProduct'];
  $yearProduct = $_POST['yearProduct'];
  $categoryProduct = $_POST['categoryProduct'];
  $imageProduct = $_POST['imageProduct'];
  $inStockProduct = $_POST['inStockProduct'];

  // SQL-запрос с использованием функции NOW() для текущей даты и времени
  $sql = "INSERT INTO products (name, productionYear, price, urlImg, inStock, productCount, createData, category) 
          VALUES ('$nameProduct', '$yearProduct', '$priceProduct', '$imageProduct', '$inStockProduct', '$countProduct', NOW(), '$categoryProduct')";

  // Выполнение SQL-запроса и проверка результата
  if (mysqli_query($connect, $sql)) {
    echo "1";
  } else {
    echo "0";
  }

  // Закрытие соединения с базой данных
  mysqli_close($connect);
}

function viewOrders() {
  $connect = connect();

  // Проверяем, передан ли параметр status в GET-запросе
  $status = isset($_GET['status']) ? mysqli_real_escape_string($connect, $_GET['status']) : '';

  // Формируем условие для фильтрации по статусу
  $statusCondition = $status ? "WHERE orders.status = '$status'" : "";

  $sql = "SELECT orders.id as order_id, CONCAT(orders.name, ' ', orders.surname, ' ', orders.patronymic) as customerName, orders.date as orderDate, 
                 products.name as product_name, order_products.product_count, orders.status
          FROM orders
          JOIN order_products ON orders.id = order_products.order_id
          JOIN products ON order_products.product_id = products.id
          $statusCondition";
  $result = mysqli_query($connect, $sql);

  if (mysqli_num_rows($result) > 0) {
    $orders = array();
    while ($row = mysqli_fetch_assoc($result)) {
      $orders[] = $row;
    }
    echo json_encode($orders);
  } else {
    echo "0";
  }

  mysqli_close($connect);
}