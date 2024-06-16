<?php
session_start();
?>

<!DOCTYPE html>
<html lang="RU">
<head>
    <meta charset="UTF-8">
    <title>Где нас найти?</title>
    <link rel="stylesheet" href="./assets/styles/main.css">
    <!-- Намеренно некорректный URL для вызова ошибки -->
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&wrongParam=1" type="text/javascript"></script>
</head>
<body>
  <?php include './components/navbar.php'; ?>

  <main class="wrapper">
    <div class="container__findus">
      <section class="contact-info">
        <h1>Где нас найти?</h1>
        <div class="map-container" id="map">
          <noscript>
            <img src="./assets/images/static-map.jpg" alt="Карта" class="static-map-image">
          </noscript>
          <div id="map-fallback" class="map-fallback">
            <img src="./assets/images/static-map.jpg" alt="Карта" class="static-map-image">
          </div>
        </div>
        <div class="contact-details">
          <h2>Контактные данные</h2>
          <p><strong>Адрес:</strong> ул. Примерная, д. 1, г. Москва</p>
          <p><strong>Телефон:</strong> +7 (123) 456-78-90</p>
          <p><strong>Email:</strong> info@example.com</p>
        </div>
      </section>
    </div>
  </main>

  <script src="./assets/libs/jquery-3.6.0.min.js"></script>
  <script>
    ymaps.ready(init);
    function init() {
      try {
        var myMap = new ymaps.Map("map", {
          center: [55.751574, 37.573856], // Координаты центра карты (Москва)
          zoom: 10
        });

        var myPlacemark = new ymaps.Placemark([55.751574, 37.573856], {
          hintContent: 'Мы здесь!',
          balloonContent: 'ул. Примерная, д. 1, г. Москва'
        });

        myMap.geoObjects.add(myPlacemark);
        document.getElementById('map-fallback').style.visibility = 'hidden'; // Скрываем fallback изображение, если карта загрузилась
      } catch (e) {
        console.error('Ошибка загрузки карты:', e);
        document.getElementById('map-fallback').style.visibility = 'visible'; // Показываем fallback изображение, если карта не загрузилась
      }
    }
  </script>
</body>
</html>