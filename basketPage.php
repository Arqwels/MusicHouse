<?php
session_start();
?>

<!DOCTYPE html>
<html lang="RU">
<head>
    <meta charset="UTF-8">
    <title>Корзина</title>
    <link rel="stylesheet" href="./assets/styles/main.css">
</head>
<body>
  <?php include './components/navbar.php'; ?>

  <main class="wrapper">
    <div class="cart"></div>
    <div class="total__price"></div>

    <!-- Форма для отправки заказа -->
    <form class="create__order">
      <label for="password">Введите пароль для подтверждения:</label>
      <input type="password" id="password" placeholder="Введите свой пароль">
      <button type="submit" class="send__password">Сформировать заказ</button>
    </form>

  </main>

<script src="./assets/libs/jquery-3.6.0.min.js"></script>
<script src="./js/cart.js"></script>
</body>
</html>
