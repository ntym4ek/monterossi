<?php
?>
<div class="block-front-banner">
  <div class="screen-width">

    <div id="slider-front-banner" class="slider slider-front-banner">
      <div class="swiper">
        <div class="swiper-wrapper">
          <?php foreach ($slides as $slide): ?>
            <div class="swiper-slide">
              <div class="image" style="background-image: url(<?php print $slide['img']; ?>);"></div>
              <div class="container">
                <div class="row">
                  <div class="col-xs-12 col-md-8 col-lg-6">
                    <?php print $slide['content']; ?>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="swiper-pagination"></div>
    </div>

  </div>
</div>
