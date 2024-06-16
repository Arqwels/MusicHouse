$(document).ready(function () {
  // Загрузка данных из PHP-скрипта
  $.getJSON("./vendor/getProducts.php", function (data) {
    const items = data.map(item => ({
      id: item.id,
      name: item.name,
      year: item.year,
      price: item.price,
      imageSrc: item.imageSrc,
      category: item.category
    }));

    console.log(items);

    const itemList = $('#itemList');
    renderItems(items);

    $('#sortSelect').change(function () {
      var selectedValue = $(this).val();
      sortItems(selectedValue);
    });

    $('.catalog-categories-func').click(function () {
      var category = $(this).data('category');
      filterItemsByCategory(category);
    });

    function createSlideCard(slideData) {
      return `
        <div class="card">
          <div class="card__top">
            <p class="card__top-price"><span>${slideData.price}</span> ₽</p>
            <h3 class="card__top-name">${slideData.name}</h3>
            <img class="card__top-img" src="./assets/images/${slideData.imageSrc}" alt="${slideData.imageSrc}"/>
          </div>
          <div class="card__btn">
            <a href="productPage.php?id=${slideData.id}">Купить</a>
          </div>
        </div>
      `;
    }

    function renderItems(items) {
      itemList.empty();
      items.forEach(item => {
        const cardHtml = createSlideCard(item);
        itemList.append(cardHtml);
      });
    }

    function sortItems(value) {
      var sortedItems = [...items];
      switch (value) {
        case 'year-new':
          sortedItems.sort((a, b) => b.year - a.year);
          break;
        case 'year-old':
          sortedItems.sort((a, b) => a.year - b.year);
          break;
        case 'name':
          sortedItems.sort((a, b) => a.name.localeCompare(b.name));
          break;
        case 'price-min':
          sortedItems.sort((a, b) => a.price - b.price);
          break;
        case 'price-max':
          sortedItems.sort((a, b) => b.price - a.price);
          break;
        default:
          break;
      }
      renderItems(sortedItems);
    }

    function filterItemsByCategory(category) {
      var filteredItems;
      if (category === 'all') {
        filteredItems = items;
      } else {
        filteredItems = items.filter(item => item.category.includes(category));
      }
      renderItems(filteredItems);
    }
  });
});