<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/style.css">
  <title>Admin</title>
</head>
<body>
  <h1>Ты админ!</h1>

  <div class="goods__out"></div>

  <main>
    <h2>Товар</h2>
    <form id="productForm">
        <div class="form-group">
            <label for="nameProduct">Имя товара:</label>
            <input type="text" id="nameProduct" placeholder="Имя товара">
        </div>
        <div class="form-group">
            <label for="priceProduct">Цена товара:</label>
            <input type="text" id="priceProduct" placeholder="Цена товара">
        </div>
        <div class="form-group">
            <label for="countProduct">Количество товара:</label>
            <input type="text" id="countProduct" placeholder="Количество товара">
        </div>
        <div class="form-group">
            <label for="yearProduct">Год выпуска товара:</label>
            <input type="text" id="yearProduct" placeholder="Год выпуска товара">
        </div>
        <div class="form-group">
            <label for="categoryProduct">Категория товара:</label>
            <input type="text" id="categoryProduct" placeholder="Категория товара">
        </div>
        <div class="form-group">
            <label for="imageProduct">Фото товара:</label>
            <input type="text" id="imageProduct" placeholder="Фото товара">
        </div>
        <div class="form-group">
            <label for="inStockProduct">В наличии товар:</label>
            <input type="text" id="inStockProduct" placeholder="Наличие товара 1 или 0">
        </div>
        <input type="hidden" id="id">
        <button type="button" class="addToDB">Обновить</button>
    </form>
    
    <br>

    <h2>Просмотр всех заказов!</h2>
    <div class="filters">
      <button onclick="viewOrders('Новый')">Новые</button>
      <button onclick="viewOrders('Подтвержденный')">Подтвержденные</button>
      <button onclick="viewOrders('Отмененный')">Отмененные</button>
      <button onclick="viewOrders('')">Все</button>
    </div>
    <div class="view__orders"></div>
</main>

<script src="./js/jquery-3.6.0.min.js"></script>
<script src="./js/admin.js"></script>
</body>
</html>