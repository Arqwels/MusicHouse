<?php
// Проверяем, есть ли переданный идентификатор товара
if (!isset($_GET['id'])) {
  echo 'Идентификатор товара не указан.';
  exit;
}

// Загружаем содержимое файла productMOCK.json
$jsonData = file_get_contents('productMOCK.json');

// Преобразуем JSON строку в массив PHP
$products = json_decode($jsonData, true);

// Находим товар по переданному идентификатору
$product = null;
foreach ($products as $p) {
  if ($p['id'] == $_GET['id']) {
    $product = $p;
    break;
  }
}

// Если товар не найден, выводим сообщение об ошибке
if (!$product) {
  echo 'Товар не найден.';
  exit;
}
?>

<!DOCTYPE html>
<html lang="RU">

<head>
  <meta charset="UTF-8">
  <title><?php echo $product['name']; ?></title>
  <link rel="stylesheet" href="./assets/styles/main.css">
</head>

<body>
  <?php include './components/navbar.php'; ?>

  <section class="wrapper product">
    <div class="product__text">
      <h1 class="product__text__title"><?php echo $product['name']; ?></h1>
      <p>Год выпуска: <?php echo $product['productionYear']; ?></p>
      <p>Цена: <?php echo $product['price']; ?> ₽</p>
      <p>В наличии: <?php echo $product['productCount']; ?> шт.</p>
      <p>Категории: <?php echo implode(', ', $product['category']); ?></p>
    </div>
    <div class="product__image">
      <img src="<?php echo $product['urlImg']; ?>" alt="<?php echo $product['name']; ?>">
      <?php
      if ($product['productCount'] != 0 && $product['inStock'] == true) {
        echo '
          <p class="product__image__status product__status-success">В наличии</p>
          <a class="product__image__btn" href="#">Добавить в корзину</a>
        ';
      } else {
        echo '
          <p class="product__image__status product__status-error">Отсутствует</p>
          <a class="product__image__btn product__not-in-stock">Нет в наличии</a>
        ';
      }
      ?>

    </div>
    <button onclick="goBack()" class="back-button">Назад</button>
  </section>


  <script>
    function goBack() {
      window.history.back();
    }
  </script>
</body>

</html>