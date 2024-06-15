$(document).ready(function() {
  loadOrderHistory();
});

function loadOrderHistory() {
  $.ajax({
    url: './vendor/getHistoryOrder.php',
    type: 'GET',
    dataType: 'json',
    success: function(response) {
      if (response.status) {
        displayOrderHistory(response.orders);
      } else {
        alert(response.message);
      }
    },
    error: function() {
      alert('Ошибка при получении истории заказов');
    }
  });
}

function displayOrderHistory(orders) {
  let out = '';
  if (orders.length > 0) {
    orders.forEach(order => {
      out += `<div class="order" data-id="${order.id}">`;
      out += `<h3>Заказ №${order.id}</h3>`;
      out += `<p>Статус: ${order.status}</p>`;
      out += `<p>Дата: ${order.date}</p>`;
      out += '<h4>Товары:</h4>';
      out += '<ul>';
      order.products.forEach(product => {
        out += `<li>${product.name} - ${product.count} шт.</li>`;
      });
      out += '</ul>';
      if (order.status === 'Новый') {
        out += `<button class="delete-order" data-id="${order.id}">Удалить заказ</button>`;
      }
      out += '</div>';
    });
  } else {
    out = '<p>История заказов пуста</p>';
  }
  $('.history__order').html(out);
  $('.delete-order').on('click', deleteOrder);
}

function deleteOrder() {
  const orderId = $(this).data('id');
  $.ajax({
    url: './vendor/deleteOrder.php',
    type: 'POST',
    dataType: 'json',
    data: { order_id: orderId },
    success: function(response) {
      if (response.status) {
        alert('Заказ успешно удален');
        loadOrderHistory(); // Обновляем историю заказов
      } else {
        alert(response.message);
      }
    },
    error: function() {
      alert('Ошибка при удалении заказа');
    }
  });
}