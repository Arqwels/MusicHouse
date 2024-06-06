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

  <h1>ты лошок</h1>
  <h2><?= $_SESSION["user"]["name"] ?></h2>



</body>

</html>