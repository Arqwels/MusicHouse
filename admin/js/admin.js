function init() {
  $.post(
    "core.php",
    {
      "action": "init"
    },
    showGoods
  );
}

function showGoods(data) {
  data = JSON.parse(data);
  console.log(data);

  let out = '<select>';
  out += '<option data-id="0">Новый товар</option>'
  for (let id in data) {
    out += `<option data-id="${id}">${data[id].name}</option>`
  }

  out += '</select>';
  $('.goods__out').html(out);
  $('.goods__out select').on('change', selectGoods);
}

function selectGoods() {
  
  let id = $('.goods__out select option:selected').attr('data-id');
  console.log(id);
  $.post(
    "core.php",
    {
      "action": "selectOneGoods",
      "id": id
    },
    function(data) {
      data = JSON.parse(data);
      $('#nameProduct').val(data.name);
      $('#priceProduct').val(data.price);
      $('#countProduct').val(data.productCount);
      $('#yearProduct').val(data.productionYear);
      $('#categoryProduct').val(data.category);
      $('#imageProduct').val(data.urlImg);
      $('#inStockProduct').val(data.inStock);
      $('#id').val(data.id);
      console.log(data);
    }
  )
}

function saveToDB() {
  let id = $('#id').val();
  if (id != '') {
    $.post(
      "core.php",
      {
        "action": "updateGoods",
        "id": id,
        "nameProduct": $('#nameProduct').val(),
        "priceProduct": $('#priceProduct').val(),
        "countProduct": $('#countProduct').val(),
        "yearProduct": $('#yearProduct').val(),
        "categoryProduct": $('#categoryProduct').val(),
        "imageProduct": $('#imageProduct').val(),
        "inStockProduct": $('#inStockProduct').val()
      },
      function (data) {
        if (data == 1) {
          alert(`Данные товара успешно обновленны!`)
          init();
        }
        else {
          console.log(data);
        }
      }
    )
  }
  else {
    console.log("new");
    $.post(
      "core.php",
      {
        "action": "newGoods",
        "id": 0,
        "nameProduct": $('#nameProduct').val(),
        "priceProduct": $('#priceProduct').val(),
        "countProduct": $('#countProduct').val(),
        "yearProduct": $('#yearProduct').val(),
        "categoryProduct": $('#categoryProduct').val(),
        "imageProduct": $('#imageProduct').val(),
        "inStockProduct": $('#inStockProduct').val()
      },
      function (data) {
        if (data == 1) {
          alert(`Данные товара ${$('#nameProduct').val()} успешно обновленны!`)
          init();
        }
        else {
          console.log(data);
        }
      }
    )
  }
}

function viewOrders(status = '') {
  $.get(
    "core.php",
    {
      "action": "viewOrders",
      "status": status
    },
    function (data) {
      try {
        data = JSON.parse(data);
        if (data != "0") {
          let out = '<table>';
          out += '<tr><th>ID заказа</th><th>Имя клиента</th><th>Дата заказа</th><th>Товар</th><th>Количество</th><th>Статус</th></tr>';
          for (let order of data) {
            out += `<tr>
                      <td>${order.order_id}</td>
                      <td>${order.customerName}</td>
                      <td>${order.orderDate}</td>
                      <td>${order.product_name}</td>
                      <td>${order.product_count}</td>
                      <td>${order.status}</td>
                    </tr>`;
          }
          out += '</table>';
          $('.view__orders').html(out);
        } else {
          $('.view__orders').html('<p>Заказы отсутствуют</p>');
        }
      } catch (e) {
        console.error("Ошибка при парсинге JSON:", e);
        console.error("Ответ от сервера:", data);
      }
    }
  );
}

$(document).ready(function () {
  init();
  $('.addToDB').on('click', saveToDB);
  viewOrders(); // Добавляем вызов функции для отображения заказов при загрузке страницы
});