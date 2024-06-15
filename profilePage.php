<?php
session_start();

if (!$_SESSION['user']) {
  header('Location: loginPage.php');
};
?>
<!DOCTYPE html>
<html lang="RU">

<head>
  <meta charset="UTF-8">
  <title>Профиль</title>
  <link rel="stylesheet" href="./assets/styles/main.css">
</head>

<body>

  <?php include './components/navbar.php'; ?>
  <main class="wrapper">
    <div class="profile-container">
      <h1>Профиль пользователя: <?= $_SESSION["user"]["surname"] ?> <?= $_SESSION["user"]["name"] ?> <?= $_SESSION["user"]["patronymic"] ?></h1>
      

      <p class="title__order">История заказов</p>

      <div class="history__order"></div>
    </div>
  </main>
  

  <script src="./assets/libs/jquery-3.6.0.min.js"></script>
  <script src="./js/getHistoryOrder.js"></script>
</body>

</html>