(function ($) {
  Drupal.behaviors.project = {
    attach: function (context, settings) {

      // раскрываемый список в блоке фасетных фильтров на странице Каталог
      $(".page-katalog").once(function() {
        $(".page-left .content").hide().prev().click(function() {
          $(this).parents(".block-facetapi").find(".content").slideToggle(200).prev().toggleClass("active");
        });
      });

    }
  };
})(jQuery);
