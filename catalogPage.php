<?php
session_start();
?>

<!doctype html>
<html lang="RU">

<head>
  <meta charset="UTF-8">
  <title>Каталог</title>
  <link rel="stylesheet" href="./assets/styles/main.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

  <?php include './components/navbar.php'; ?>

  <section class="wrapper">

    <h2 class="title-text">Каталог</h2>

    <div class="catalog">
      <div class="catalog-categories">
        <h3>Категории</h3>
        <div class="catalog-categories-func" data-category="all">Все категории</div>
        <div class="catalog-categories-func" data-category="струнные">Струнные</div>
        <div class="catalog-categories-func" data-category="клавишные-смычковые">Клавишные смычковые</div>
        <div class="catalog-categories-func" data-category="4-стунные">4-стунные</div>
      </div>

      <div class="cards">
        <section class="sort">
          <label for="sortSelect">Сортировать по:</label>
          <select id="sortSelect">
            <option value="year-new">Новинки</option>
            <option value="year-old">Давно добавленные</option>
            <option value="name">Наименование</option>
            <option value="price-min">Сначала недорогие</option>
            <option value="price-max">Сначала дорогие</option>
          </select>
        </section>

        <div id="itemList" class="items-container">
          <!-- Карточки товаров будут отрисованы здесь -->
        </div>
      </div>
    </div>

  </section>

  <script src="./assets/libs/jquery-3.6.0.min.js"></script>
  <script src="./sort.js"></script>
</body>

</html>