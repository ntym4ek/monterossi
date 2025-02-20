<?php
?>
<div class="block-popular">
  <h2>Популярное</h2>

  <div class="row">
    <div class="col-xs-12">

      <div id="carousel-popular" class="carousel carousel-popular outer-pagination outer-navigation no-mobile-frame" data-slidesperview-xs="1.5" data-slidesperview-md="2.8" data-slidesperview-lg="4">
        <div class="swiper">
          <div class="swiper-wrapper">
            <?php foreach ($cards as $card) {
              print '<div class="swiper-slide">'  . $card . '</div>';
            } ?>
          </div>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev hide show-xl"></div>
        <div class="swiper-button-next hide show-xl"></div>
      </div>

    </div>
  </div>

</div>
