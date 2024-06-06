// Акустические гитары
// Классические
// Стальные струны
// 12-струнные
// Электроакустические
// Электрогитары
// Солид-боди
// Полуакустические
// 7-ми, 8-ми струнные
// Бас-гитары
// 4-струнные
// 5-струнные
// 6-струнные


// script.js

document.addEventListener("DOMContentLoaded", function () {
  // Предположим, что у вас есть JSON-данные слайдов
  var slidesData = [{
      price: "8999",
      name: "Гитарка№1",
      imageSrc: "./assets/images/novelty_1.png",
      alt: "123"
    },
    {
      price: "7999",
      name: "Гитарка№2",
      imageSrc: "./assets/images/novelty_2.png",
      alt: "123"
    },
    {
      price: "12999",
      name: "Гитарка№3",
      imageSrc: "./assets/images/novelty_3.png",
      alt: "123"
    },
    {
      price: "13999",
      name: "Гитарка№4",
      imageSrc: "./assets/images/novelty_4.png",
      alt: "123"
    },
    {
      price: "6999",
      name: "Гитарка№5",
      imageSrc: "./assets/images/novelty_5.png",
      alt: "123"
    },
    {
      price: "21999",
      name: "Гитарка№6",
      imageSrc: "./assets/images/novelty_5.png",
      alt: "123"
    },
    {
      price: "26999",
      name: "Гитарка№7",
      imageSrc: "./assets/images/novelty_5.png",
      alt: "123"
    }
  ];

  // Функция для создания HTML-кода карточки слайда на основе данных
  function createSlideCard(slideData) {
    return `
            <div class="novelty-slider__slide swiper-slide">
                <div class="novelty-card-top">
                    <p class="novelty-card-price"><span>${slideData.price}</span> ₽</p>
                    <h3 class="novelty-card-name">${slideData.name}</h3>
                    <img class="novelty-card-img" src="${slideData.imageSrc}" alt="${slideData.alt}"/>
                </div>
                <div class="novelty-card-btn">
                    <a href="productPage.php?id=${slideData.id}">Купить</a>
                </div>
            </div>
        `;
  }

  // Получите контейнер, в который вы хотите вставить карточки слайдов
  var slidesContainer = document.querySelector('.novelty-slider__wrapper');

  // Создайте HTML-код для каждого слайда и вставьте его в контейнер
  slidesData.forEach(function (slideData) {
    var slideCardHTML = createSlideCard(slideData);
    slidesContainer.innerHTML += slideCardHTML;
  });

  // Инициализация Swiper.js
  const swiper = new Swiper('.novelty-slider', {
    slidesPerView: 'auto',
    watchOverflow: true,
    spaceBetween: 50,
    centeredSlides: true,
    loop: true,
    loopedSlides: 3,
    autoplay: {
      delay: 1000,
      stopOnLastSlide: false,
      disableOnInteraction: true
    },
    speed: 800
  });
});