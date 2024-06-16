document.addEventListener("DOMContentLoaded", function () {
  // Функция для создания HTML-кода карточки слайда на основе данных
  function createSlideCard(slideData) {
    return `
      <div class="novelty-slider__slide swiper-slide">
        <div class="novelty-card-top">
          <p class="novelty-card-price"><span>${slideData.price}</span> ₽</p>
          <h3 class="novelty-card-name">${slideData.name}</h3>
          <img class="novelty-card-img" src="./assets/images/${slideData.imageSrc}" alt="${slideData.alt}"/>
        </div>
        <div class="novelty-card-btn">
          <a href="productPage.php?id=${slideData.id}">Купить</a>
        </div>
      </div>
    `;
  }

  // Функция для обработки данных о продуктах и создания слайдов
  function goodsOut(data) {
    // Вывод данных на страницу
    console.log(data);
    let out = '';
    data.forEach(item => {
      out += createSlideCard(item);
    });

    // Получите контейнер, в который вы хотите вставить карточки слайдов
    var slidesContainer = document.querySelector('.novelty-slider__wrapper');
    slidesContainer.innerHTML = out;

    // Инициализация Swiper.js
    const swiper = new Swiper('.novelty-slider', {
      slidesPerView: 'auto',
      watchOverflow: true,
      spaceBetween: 100,
      centeredSlides: true,
      loop: true,
      loopedSlides: 3,
      autoplay: {
        delay: 2000,
        stopOnLastSlide: false,
        disableOnInteraction: true
      },
      speed: 800
    });
  }

  // Выполняем AJAX-запрос к PHP-скрипту
  $.getJSON("./vendor/getProducts.php", goodsOut);
});