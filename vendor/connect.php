<?php
$bd_hostname = 'localhost'; // Хостинг
$bd_username = 'root'; // 
$bd_password = '';
$bd_name = 'music-house';

$connect = mysqli_connect($bd_hostname, $bd_username, $bd_password, $bd_name);

if (!$connect) {
  die('Ошибка при подключении к БД!');
}








  // $user_table = 'users';
  // $product_table = 'products';
  // $category_table = 'categories';

  // $check_user_table_query = "SHOW TABLES LIKE '$user_table'";
  // $check_product_table_query = "SHOW TABLES LIKE '$product_table'";
  // $check_category_table_query = "SHOW TABLES LIKE '$category_table'";

  // $result_user = mysqli_query($connect, $check_user_table_query);
  // $result_product = mysqli_query($connect, $check_product_table_query);
  // $result_category = mysqli_query($connect, $check_category_table_query);

  // if (mysqli_num_rows($result_user) == 0) {
  //   // SQL-запрос для создания таблицы пользователей, если она не существует
  //   $create_user_table_query = "
  //     CREATE TABLE $user_table (
  //       id INT(11) AUTO_INCREMENT PRIMARY KEY,
  //       name VARCHAR(255),
  //       surname VARCHAR(255),
  //       patronymic VARCHAR(255),
  //       login VARCHAR(255),
  //       email VARCHAR(255),
  //       password VARCHAR(255),
  //       rules TINYINT(1)
  //     ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
  //   ";

  //   if (mysqli_query($connect, $create_user_table_query)) {
  //     echo "Таблица пользователей успешно создана.";
  //   } else {
  //     echo "Ошибка при создании таблицы пользователей: " . mysqli_error($connect);
  //   }
  // }

  // if (mysqli_num_rows($result_category) == 0) {
  //   // SQL-запрос для создания таблицы категорий, если она не существует
  //   $create_category_table_query = "
  //     CREATE TABLE $category_table (
  //       id INT AUTO_INCREMENT PRIMARY KEY,
  //       name VARCHAR(255) NOT NULL
  //     ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
  //   ";

  //   if (mysqli_query($connect, $create_category_table_query)) {
  //     echo "Таблица категорий успешно создана.";
  //   } else {
  //     echo "Ошибка при создании таблицы категорий: " . mysqli_error($connect);
  //   }
  // }

  // if (mysqli_num_rows($result_product) == 0) {
  //   // SQL-запрос для создания таблицы товаров, если она не существует
  //   $create_product_table_query = "
  //     CREATE TABLE $product_table (
  //       id INT AUTO_INCREMENT PRIMARY KEY,
  //       name VARCHAR(255) NOT NULL,
  //       productionYear INT NOT NULL,
  //       price DECIMAL(10, 2) NOT NULL,
  //       urlImg VARCHAR(255) NOT NULL,
  //       inStock BOOLEAN NOT NULL,
  //       productCount INT NOT NULL,
  //       createData TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  //       category_id INT,
  //       FOREIGN KEY (category_id) REFERENCES categories(id)
  //     ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
  //   ";

  //   if (mysqli_query($connect, $create_product_table_query)) {
  //     echo "Таблица товаров успешно создана.";
  //   } else {
  //     echo "Ошибка при создании таблицы товаров: " . mysqli_error($connect);
  //   }
  // }

  // Создание таблицы product_category для связи между товарами и категориями
  // $create_product_category_table_query = "
  //   CREATE TABLE product_category (
  //       id INT AUTO_INCREMENT PRIMARY KEY,
  //       product_id INT,
  //       category_id INT,
  //       FOREIGN KEY (product_id) REFERENCES products(id),
  //       FOREIGN KEY (category_id) REFERENCES categories(id)
  //   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
  // ";

  // if (mysqli_query($connect, $create_product_category_table_query)) {
  //   echo "Таблица product_category успешно создана.";
  // } else {
  //   echo "Ошибка при создании таблицы product_category: " . mysqli_error($connect);
  // }

  // Добавление данных в таблицу категорий
  // $insert_category_query = "INSERT INTO $category_table (name) VALUES ('струнные'), ('клавишные струны')";

  // if (mysqli_query($connect, $insert_category_query)) {
  //   echo "Данные успешно добавлены в таблицу категорий.";
  // } else {
  //   echo "Ошибка при добавлении данных в таблицу категорий: " . mysqli_error($connect);
  // }

  // Добавление данных в таблицу товаров
//   $jsonData = '[
//     {
//         "id": 0,
//         "name": "Гитара №1",
//         "productionYear": 2007,
//         "price": 8999,
//         "urlImg": "./uploads/novelty_1.png",
//         "inStock": true,
//         "productCount": 12,
//         "category_id": [1, 2]
//     },
//     {
//         "id": 1,
//         "name": "Гитара №2",
//         "productionYear": 2002,
//         "price": 12999,
//         "urlImg": "./uploads/novelty_2.png",
//         "inStock": true,
//         "productCount": 2,
//         "category_id": [1]
//     },
//     {
//         "id": 2,
//         "name": "Гитара №3",
//         "productionYear": 2012,
//         "price": 21399,
//         "urlImg": "./uploads/novelty_3.png",
//         "inStock": true,
//         "productCount": 12,
//         "category_id": [1, 2]
//     }
// ]';

  // $products = json_decode($jsonData, true);

  // // Создание связей между товарами и категориями
  // foreach ($products as $product) {
  //   $id = $product['id'];
  //   $name = mysqli_real_escape_string($connect, $product['name']);
  //   $productionYear = $product['productionYear'];
  //   $price = $product['price'];
  //   $urlImg = mysqli_real_escape_string($connect, $product['urlImg']);
  //   $inStock = $product['inStock'] ? 1 : 0;
  //   $productCount = $product['productCount'];

  //   $insert_product_query = "INSERT INTO $product_table (name, productionYear, price, urlImg, inStock, productCount) 
  //   VALUES ('$name', $productionYear, $price, '$urlImg', $inStock, $productCount)";

  //   if (!mysqli_query($connect, $insert_product_query)) {
  //     echo 'Ошибка вставки данных в таблицу товаров: ' . mysqli_error($connect);
  //     exit;
  //   }

  //   // Получение ID вставленного товара
  //   $product_id = mysqli_insert_id($connect);

  //   // Добавление связей с категориями
  //   foreach ($product['category_id'] as $category_id) {
  //     $insert_category_query = "INSERT INTO product_category (product_id, category_id) 
  //     VALUES ($product_id, $category_id)";
  //     if (!mysqli_query($connect, $insert_category_query)) {
  //       echo 'Ошибка вставки данных в таблицу product_category: ' . mysqli_error($connect);
  //       exit;
  //     }
  //   }
  // }



// utf8mb4_general_ci