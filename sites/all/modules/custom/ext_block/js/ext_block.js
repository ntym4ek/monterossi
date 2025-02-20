(function ($) {
  Drupal.behaviors.ext_block = {
    attach: function (context, settings) {

      // аккордеон в блоке Качество
      $(".accordion .a-text").hide().prev().click(function() {
        $(this).parents(".accordion").find(".a-text").not(this).slideUp(200).prev().removeClass("active");
        $(this).next().not(":visible").slideDown(200).prev().addClass("active");
      });

    }
  };
})(jQuery);
