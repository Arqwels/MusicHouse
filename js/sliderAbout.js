function init() {
  // Выполняем AJAX-запрос к PHP-скрипту
  $.getJSON("./vendor/getProducts.php", goodsOut);
}

function goodsOut(data) {
  // Вывод данных на страницу
  console.log(data);
  let out = '';
  data.forEach(item => {
    out += '<div class="card">';
    out += '<div class="card__top">';
    out += `<p class="card__top-price"><span>${item.price}</span> ₽</p>`;
    out += `<h3 class="card__top-name">${item.name}</h3>`;
    out += `<img class="card__top-img" src="assets/images/${item.imageSrc}" alt="${item.name}"/>`;
    out += '</div>';
    out += '<div class="card__btn">';
    out += `<a href="productPage.php?id=${item.id}">Купить</a>`;
    out += '</div>';
    out += '</div>';
  });
  $('.goods-out').html(out);
}

$(document).ready(function () {
  init();
});