(function ($) {
  Drupal.behaviors.ext_block = {
    attach: function (context, settings) {

      // аккордеон в блокfах
      $(".accordion .a-text").hide().prev().click(function() {
        $(this).parents(".accordion").find(".a-text").not(this).slideUp(200).prev().removeClass("active");
        $(this).next().not(":visible").slideDown(200).prev().addClass("active");
      });

      // карта на странице контактов
      $('.block-contacts-map').once('map', () => {
        var contacts = settings.contacts;
        ymaps.ready(() => {
          var myMap = new ymaps.Map('map', {
                                    center: [50.443705, 30.530946],
                                    zoom: 5,
                                    controls: []
                                  }),
            placemark;

          let keys = Object.keys(contacts);
          keys.forEach((key) => {
            let contact = contacts[key];
            placemark = new ymaps.Placemark(contact.coords, {
                balloonContentBody:
                  '<div class="balloon">' +
                  '<div class="title">' + contact.title + '</div>' +
                  '<div class="address">' + contact.name + '</div>' +
                  '<div class="phones">' + contact.phone + '</div>' +
                  '<div class="email"><a href="mailto:' + contact.email + '">' + contact.email + '</a></div>' +
                  '</div>'
              },
              {
                iconLayout: 'default#image',
                iconImageHref: '/sites/default/files/images/etc/pm_r.png',
                iconImageSize: [43, 55],
                iconImageOffset: [-21, -52],
                balloonPanelMaxMapArea: 'Infinity',
              });
            myMap.geoObjects.add(placemark);

          });

          myMap.setBounds(myMap.geoObjects.getBounds());
        });
      });

    }
  };
})(jQuery);
