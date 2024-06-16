<?php
session_start();
?>

<!DOCTYPE html>
<html lang="RU">

<head>
  <meta charset="UTF-8">
  <title>О нас</title>
  <link rel="stylesheet" href="./assets/styles/main.css">
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
</head>

<body>

  <?php include './components/navbar.php'; ?>

  <section class="about wrapper">
    <h2 class="title-text">О нас</h2>
    <div class="about-body">
      <div class="about-body-text">
        <h3>Звучим в ритме будущего, строим мелодии сегодня!</h3>
        <p>Music House - это ваш идеальный партнер в мире музыки. Мы специализируемся на предоставлении широкого
          ассортимента музыкальных инструментов высокого качества, чтобы помочь вам воплотить ваши музыкальные
          амбиции в реальность.<br>Наша цель - вдохновлять и поддерживать музыкантов всех уровней, предоставляя им
          доступ к лучшему оборудованию и сервису.</p>
      </div>
      <img src="./assets/images/music-house-logo.png" width="274" height="274" alt="Music House Logo" class="about-img">
    </div>
  </section>

  <section class="novelty wrapper">
    <h2 class="title-text">Новинки товаров!</h2>

    <div class="novelty-slider swiper-container">
      <div class="novelty-slider__wrapper swiper-wrapper">
        <!--    Тут выводятся через JS слайды   -->
      </div>
    </div>
  </section>

  <script src="./assets/libs/swiper-bundle.min.js"></script>
  <script src="./assets/libs/jquery-3.6.0.min.js"></script>
  <script src="./js/sliderAbout.js"></script>

</body>

</html>