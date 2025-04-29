(function($) {

  Drupal.behaviors.fnc_map = {
    attach: function (context, settings) {

      var myMap, listMenu, typeMenu, regionSelect,
          typesList = {};

      // настройки опций
      var regionS, typesS;

      var sellers = settings.sellers,   // полный массив данных
          sellersV = settings.sellers;  // выводимый массив

      ymaps.ready(init);

      function init() {
        // Создание экземпляра карты.
        myMap = new ymaps.Map('map', {
            center: [50.443705, 30.530946],
            zoom: 5,
            controls: []
          });

        update();
      }

      function drawMap() {
        // контейнер для меню
        listMenu = $('<ul class="listMenu"/>');
        typeMenu = $('<ul class="typeMenu"/>');
        regionSelect = $('<select class="region form-select" />').append('<option value="0">Все регионы</option>');

        // сформировать список точек продаж и добавить на карту
        let keys_r = Object.keys(sellersV.regions);
        keys_r.forEach((key_r) => {
          let region = sellersV.regions[key_r];
          if (region.items.length) { createMenuGroup(region); }
          let regionItem = $('<option value="' + key_r + '">' + region.label + '</option>');
          regionItem.appendTo(regionSelect);
        });
        // установить опцию
        if (regionS !== undefined) { regionSelect.val(regionS); }

        // сформировать меню типов
        let keys_t = Object.keys(typesList);
        keys_t.forEach((key_t) => {
          let typeItem = $('<li><a data-type="' + key_t + '" class="btn btn-default btn-wide">' + typesList[key_t] + '</a></li>');
          if (sellersV.types[key_t] !== undefined) { typeItem.find('a').addClass('selected'); }
          typeItem.appendTo(typeMenu);
        });

        // добавляем меню в свои контейнеры.
        $('<div class="form-item" />').append(regionSelect).appendTo($('#list'));
        listMenu.appendTo($('#list'));
        typeMenu.appendTo($('#type'));

        // вешаем обработчики
        $('.typeMenu').click((ev) => {
          $(ev.target).toggleClass('selected');
          update();
        });
        $('.region').change(() => {
          update();
        });

        // выставляем масштаб карты чтобы были видны все группы
        zoomToBounds();
      }

      function zoomToBounds () {
        if (myMap.geoObjects.getLength()) {
          myMap.setBounds(myMap.geoObjects.getBounds());
          let z = myMap.getZoom();
          z = z > 6 ? 6 : z;
          myMap.setZoom(z);
        }
      }

      function createMenuGroup (region) {
        // Пункт меню.
        var listItem = $('<li data-region="' + region.id + '"><a>' + region.label + '</a></li>'),
          // Контейнер для подменю.
          submenu = $('<ul class="submenu"/>');

        // Добавляем подменю.
        listItem
          .append(submenu)
          // Добавляем пункт в меню.
          .appendTo(listMenu);
        for (var j = 0, m = region.items.length; j < m; j++) {
          createSubMenu(region.items[j], submenu);
        }
      }

      function createSubMenu (item, submenu) {
        // Пункт подменю.
        let pmColor = item.type.id === 'dealer' ? 'r' : 'g';
        var submenuItem = $('<li class="' + item.type.id + '"><a href="#">' + item.label + '</a></li>'),
          // Создаем метку.
          placemark = new ymaps.Placemark([item.coords.lat, item.coords.lon], {
              balloonContentBody:
              '<div class="balloon">' +
                '<div class="title">' + item.label + '</div>' +
                '<div class="address">' + item.address + '</div>' +
                (item.phones ? '<div class="phones">' + item.phones + '' + '</div>' : '') +
                (item.email ? '<div class="email"><a href="mailto:' + item.email + '">' + item.email + '</a></div>' : '') +
                (item.web ? '<div class="web"><a href="' + item.web + '" target="_blank" rel="nofollow">' + item.web + '</a></div>' : '') +
              '</div>'
            },
            {
              iconLayout: 'default#image',
              iconImageHref: '/sites/default/files/images/etc/pm_' + pmColor + '.png',
              iconImageSize: [43, 55],
              iconImageOffset: [-21, -52],
              balloonPanelMaxMapArea: 'Infinity',
            });

        // задаём свои параметры для дальнейшей фильтрации
        placemark.properties.set('type', item.type.id);
        placemark.properties.set('region', item.region.id);
        myMap.geoObjects.add(placemark);

        submenu.closest('li').addClass(item.type.id);
        // Добавляем пункт в подменю.
        submenuItem
          .appendTo(submenu)
          // При клике по пункту подменю открываем/закрываем балун у метки.
          .find('a')
          .bind('click', function () {
            $('.listMenu').find('a.selected').removeClass('selected');
            if (!placemark.balloon.isOpen()) {
              placemark.balloon.open();
              $(this).addClass('selected');
              myMap.panTo([placemark.geometry.getCoordinates()], {
                delay: 0,
                flying: true
              }).then(function() {
                myMap.setZoom(10);
              });
            } else {
              placemark.balloon.close();
              $(this).removeClass('selected');
              zoomToBounds();
            }
            return false;
          });
      }

      function update() {
        regionS = 0;
        typesS = [];
        // При первой отрисовке определить дефолтные настройки вывода.
        // В параметрах url можно передать type= ID типа продавцов из поля field_seller_type (dealer, retail).
        // Без параметров будут выведены все точки.
        if ($('.typeMenu').length === 0) {
          let params = new URLSearchParams(document.location.search);
          if (params.has('type')) { typesS.push(params.get('type').toString()); }

          let keys_t = Object.keys(sellers.types);
          keys_t.forEach((key_t) => {
            typesList[key_t] = sellers.types[key_t];
          });
        }
        // иначе определить выбор пользователя
        else {
          regionS = Number($('.region').val());
          $('#type a.selected').each((i, el) => {
            typesS.push($(el).data('type'));
          });
        }

        // если настройки по дефолту или заданы пользователем
        if (typesS.length !== 0) {
          // сформировать новый массив точек
          sellersV = { types : [], regions: {}};
          let keys_r = Object.keys(sellers.regions);
          keys_r.forEach((key_r) => {
            let region = sellers.regions[key_r];
            // массив для регионов формируем в любом случае, для селекта регионов
            if (sellersV.regions[key_r] === undefined) {
              sellersV.regions[key_r] = {};
              sellersV.regions[key_r].id = region.id;
              sellersV.regions[key_r].label = region.label;
              sellersV.regions[key_r].items = [];
            }
            if (regionS === 0 || region.id == regionS) {
              for (var j = 0, m = region.items.length; j < m; j++) {
                let typeId = region.items[j].type.id;
                if (typesS.indexOf(typeId) !== -1) {
                  if (sellersV.types[typeId] === undefined) { sellersV.types[typeId] = region.items[j].type.label; }
                  sellersV.regions[key_r].items.push(region.items[j]);
                }
              }
            }
          });
        }
        // иначе вывести весь массив
        else {
          sellersV = sellers;
        }

        // убрать все точки
        myMap.geoObjects.removeAll();
        $('#list').html('');
        $('#type').html('');

        drawMap();
      }
    }
  };

}(jQuery));
