let cart = {}; // корзина
let goods = {}; // данные о товарах
let user = {}; // данные о пользователе

$(document).ready(async function() {
  await loadGoods(); // Загружаем данные о товарах при загрузке страницы
  loadCart(); // Загружаем корзину при загрузке страницы
  getUserInfo(); // Получаем данные о пользователе при загрузке страницы
  $(document).on('click', '.add-to-cart', addToCart);
  $('.send__password').on('click', sendPassword);
});

async function loadGoods() {
  // Загрузка данных о товарах из базы данных
  return new Promise((resolve, reject) => {
    $.getJSON('./vendor/getProducts.php', function(data) {
      goods = data.reduce((acc, item) => {
        acc[item.id] = item;
        return acc;
      }, {});
      resolve();
    }).fail(function() {
      reject('Ошибка загрузки данных о товарах');
    });
  });
}

function addToCart() {
  // добавляем товар в корзину
  let id = $(this).data('id');
  if (goods[id]) {
    if (cart[id] == undefined) {
      cart[id] = 1; // если в корзине нет товара - делаем равным 1
    } else if (cart[id] < goods[id].productCount) {
      cart[id]++; // если такой товар есть - увеличиваю на 1
    } else {
      alert('Невозможно добавить больше товаров. Достигнут лимит.');
      return; // Прекращаем выполнение функции, чтобы не вызывать showCart и saveCart
    }
  } else {
    alert('Товар не найден.');
    return; // Прекращаем выполнение функции, если товар не найден
  }

  showCart();
  saveCart();
}

function saveCart() {
  // сохранение корзины в localStorage
  localStorage.setItem('cart', JSON.stringify(cart)); // корзину в строку
}

//=== Страница Корзина ===\\

function loadCart() {
  // Загрузка корзины из localStorage
  if (localStorage.getItem('cart')) {
    cart = JSON.parse(localStorage.getItem('cart')); // Преобразуем строку обратно в объект
    showCart();
  } else {
    $('.cart').html('Корзина пуста!');
    $('.create__order').hide(); // Скрываем форму, если корзина пуста
    $('.total__price').hide(); // Скрываем блок с общей стоимостью, если корзина пуста
  }
}

function showCart() {
  if (isEmpty(cart)) {
    $('.cart').html('Корзина пуста!');
    $('.total__price').html('0 Рублей'); // Обнуляем общую стоимость, если корзина пуста
    $('.create__order').hide(); // Скрываем форму, если корзина пуста
    $('.total__price').hide(); // Скрываем блок с общей стоимостью, если корзина пуста
  } else {
    let out = '';
    let totalPrice = 0; // Переменная для хранения общей стоимости
    for (let id in cart) {
      out += '<div class="cart-item">';
      out += `<img src="./assets/images/${goods[id].imageSrc}" alt="Изображение товара" class="cart-item__image">`;
      out += '<div class="cart-item__details">';
      out += `<h3 class="cart-item__title">${goods[id].name}</h3>`;
      out += `<p class="cart-item__price"><span>${goods[id].price}</span> Рублей</p>`;
      out += '</div>';
      out += '<div class="cart-item__controls">';
      out += '<div class="cart-item__quantity">';
      out += `<button class="cart-item__button cart-item__button--increment" data-id="${id}">+</button>`;
      out += `<span class="cart-item__quantity-value">${cart[id]}</span>`;
      out += `<button class="cart-item__button cart-item__button--decrement" data-id="${id}">-</button>`;
      out += '</div>';
      out += `<button class="cart-item__button cart-item__button--remove" data-id="${id}">Удалить</button>`;
      out += '</div>';
      out += `<p class="cart-item__total"><span>${goods[id].price * cart[id]}</span> Рублей</p>`;
      out += '</div>';

      totalPrice += goods[id].price * cart[id];
    }
    $('.cart').html(out);
    $('.total__price').html(`Общая стоимость заказа: ${totalPrice} Рублей`); // Выводим общую стоимость
    $('.create__order').show(); // Показываем форму, если корзина не пуста
    $('.total__price').show(); // Показываем блок с общей стоимостью, если корзина не пуста
    $('.cart-item__button--remove').on('click', deletGoods);
    $('.cart-item__button--increment').on('click', incrementQuantity);
    $('.cart-item__button--decrement').on('click', decrementQuantity);
  }
}

function deletGoods() {
  let id = $(this).attr('data-id');
  delete cart[id];
  saveCart();
  showCart();
}

function incrementQuantity() {
  let id = $(this).attr('data-id');
  if (cart[id] < goods[id].productCount) {
    cart[id]++;
  } else {
    alert('Невозможно добавить больше товаров. Достигнут лимит.');
  }
  saveCart();
  showCart();
}

function decrementQuantity() {
  let id = $(this).attr('data-id');
  if (cart[id] > 1) {
    cart[id]--;
  } else {
    delete cart[id];
  }
  saveCart();
  showCart();
}

function isEmpty(object) {
  // проверка корзины на пустоту
  for (let key in object)
    if(object.hasOwnProperty(key)) return false;
  return true;
}

function getUserInfo() {
  // Получение данных о пользователе с сервера
  $.ajax({
    url: './getUserInfo.php',
    type: 'GET',
    dataType: 'json',
    success: function(response) {
      if (response.status) {
        user = response.user;
      } else {
        alert(response.message);
      }
    }
  });
}

function sendPassword(event) {
  event.preventDefault();
  let password = $('#password').val();

  if (password != '') {
    if (!isEmpty(cart)) {
      $.ajax({
        url: './vendor/order.php',
        type: 'POST',
        dataType: 'json',
        data: {
          password: password,
          user: JSON.stringify(user),
          cart: JSON.stringify(cart)
        },
        success (data) {
          if (data.status) {
            alert('Заказ успешно сформирован!');
            console.log(data.product_ids);
            clearCart(); // Очищаем корзину после успешного оформления заказа
          } else {
            alert(data.message);
          }
        }
      })
    }
    else {
      alert('Корзина пуста!')
    }
  }
  else {
    alert('Поле пустое!')
  }
}

function clearCart() {
  // Очищаем корзину и localStorage
  cart = {};
  localStorage.removeItem('cart');
  showCart();
}