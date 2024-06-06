<?php
session_start();
?>

<!DOCTYPE html>
<html lang="RU">

<head>
  <meta charset="UTF-8">
  <title>Вход в админ-панель</title>
  <link rel="stylesheet" href="./assets/styles/main.css">
</head>

<body>
  <?php include './components/navbar.php'; ?>

  <section class="admin wrapper">

    <h2 class="admin__title">Вход в админ-панель</h2>

    <form action="./admin/admin.php" method="POST" class="admin__form">
      <label for="username">Логин</label>
      <input type="text" id="username" name="username" placeholder="Введите логин">
      <label for="password">Пароль</label>
      <input type="password" name="password" placeholder="Введите пароль">
      <button class="admin__form__btn" type="submit">Войти</button>

      <?php
      if (isset($_SESSION['msgError'])) {
        echo '<p class="admin__form__error">' . $_SESSION['msgError'] . ' </p>';
      }
      unset($_SESSION['msgError']);
      ?>
    </form>
  </section>
</body>

</html>