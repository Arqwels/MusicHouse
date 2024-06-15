<?php
session_start();

if (!$_SESSION['user']) {
  header('Location: loginPage.php');
  exit;
}

// Проверяем, есть ли переданный идентификатор товара
if (!isset($_GET['id'])) {
  echo 'Идентификатор товара не указан.';
  exit;
}

// Подключение к базе данных
require_once './vendor/connect.php';

// Пытаемся найти товар по переданному идентификатору
$id = intval($_GET['id']);
$query = "SELECT id, name, productionYear, price, urlImg, productCount, inStock, category FROM products WHERE id = $id";
$result = mysqli_query($connect, $query);

$product = mysqli_fetch_assoc($result);

// Если товар не найден, выводим сообщение об ошибке
if (!$product) {
  echo 'Товар не найден.';
  exit;
}

// Преобразуем строку категорий в массив
$product['category'] = explode(',', $product['category']);

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="ru">

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
      <img src="./assets/images/<?php echo $product['urlImg']; ?>" alt="<?php echo $product['name']; ?>">
      <?php if ($product['productCount'] != 0 && $product['inStock']): ?>
        <p class="product__image__status product__status-success">В наличии</p>
        <button class="product__image__btn add-to-cart" data-id="<?php echo $product['id']; ?>">Добавить в корзину</button>
      <?php else: ?>
        <p class="product__image__status product__status-error">Нет в наличии</p>
        <a class="product__image__btn product__not-in-stock">Нет в наличии</a>
      <?php endif; ?>
    </div>
    <button class="back-button">Назад</button>
  </section>

  <div class="mini-cart"></div>

  <script src="./assets/libs/jquery-3.6.0.min.js"></script>
  <script src="./js/cart.js"></script>
  <script>
    $('.back-button').on('click', goBack)
    function goBack() {
      window.history.back();
    }
  </script>
</body>

</html>