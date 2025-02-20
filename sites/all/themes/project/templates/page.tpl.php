<div class="page-wrapper">

  <div class="nav-mobile">
    <div class="branding">
      <div class="logo">
        <img src="/sites/all/themes/project/images/logo/logo.png" alt="MONTEROSSI" />
      </div>
      <div class="brand"><?php print $site_name; ?></div>
    </div>
    <div class="menu-mobile-wr">
      <div>
        <?php if ($primary_nav): print $primary_nav; endif; ?>
        <div class="global menu-mobile-link">
          <div><a href="https://kccc.group" target="_blank" title="KCCC GROUP">KCCC GROUP</a></div>
        </div>
      </div>
      <div>
        <?php if (!empty($language_link_mobile)): ?>
          <div class="language-switch menu-mobile-link"><?php print $language_link_mobile; ?></div>
        <?php endif; ?>
        <?php if ($secondary_nav): print $secondary_nav; endif; ?>
      </div>
    </div>
  </div>

  <div class="<?php print $classes; ?>">
    <?php if ($is_header_on): ?>
    <header class="page-header">
      <div class="r1">
        <div class="container">
          <div class="r1-inner">
            <div class="row middle-xs">
              <div class="col fill">
                <div class="branding">
                  <div class="local">
                    <a href="<?php print $front_page ?>">
                      <img src="/sites/all/themes/project/images/logo/logo.png" alt="MONTEROSSI" />
                    </a>
                  </div>
                  <div class="global">
                    <a href="https://kccc.group" target="_blank" title="KCCC GROUP">
                      <img src="/sites/all/themes/project/images/logo/ring_kccc_black.png" alt="KCCC GROUP" />
                    </a>
                  </div>
                </div>
              </div>

              <div class="col hide-xs show-md">
                <div class="menu-wr">
                  <?php if ($secondary_nav): print $secondary_nav; endif; ?>
                </div>
              </div>
              <?php if (!empty($cart_link)): ?>
              <div class="col">
                <?php print $cart_link; ?>
              </div>
              <?php endif; ?>
              <?php if (!empty($language_link)): ?>
              <div class="col hide-xs show-md">
                <div class="language-switch">
                  <?php print $language_link; ?>
                </div>
              </div>
              <?php endif; ?>

            </div>
          </div>
        </div>
      </div>

      <div class="r2">
        <div class="container">
          <div class="row middle-xs">

            <div class="col-xs-12 show-xs hide-lg">
              <div class="nav-mobile-label"><div class="label"><div class="icon"></div></div></div>
            </div>

            <div class="col-xs-9 hide-xs show-lg">
              <div class="menu-wr">
                <?php if ($primary_nav): print $primary_nav; endif; ?>
              </div>
            </div>
            <?php if (isset($search_form)): ?>
            <div class="col-xs-3 hide-xs show-lg">
              <div class="search hide show-lg">
                <?php print drupal_render($search_form); ?>
              </div>
            </div>
            <?php endif; ?>

          </div>
        </div>
      </div>
    </header>
    <?php endif; ?>

    <div class="page-content">
      <div class="container">

        <?php if ($page['highlighted'] || $is_banner_on): ?>
          <div class="page-highlighted">

            <?php if ($page['highlighted']): ?>
              <?php print render($page['highlighted']); ?>
            <?php endif; ?>

            <?php if ($is_banner_on): ?>
              <div class="page-banner">
                <div class="screen-width">
                  <div class="image">
                    <picture>
                      <?php if (!empty($banner_mobile_url)): ?><source srcset="<?php print $banner_mobile_url; ?>" media="(max-width: <?php print $banner_break; ?>px)"><?php endif; ?>
                      <img src="<?php print $banner_url; ?>" alt="<?php print $banner_title ?? t('Banner'); ?>">
                    </picture>
                  </div>
                  <div class="container full-height">
                    <div class="banner-title-wrapper">
                      <?php if (!empty($banner_title_prefix)): ?><div class="banner-prefix"><?php print $banner_title_prefix; ?></div><?php endif; ?>
                      <?php if ($banner_title): ?><div class="banner-title"><?php print $banner_title; ?></div><?php endif; ?>
                      <?php if (!empty($banner_title_suffix)): ?><div class="banner-suffix"><?php print $banner_title_suffix; ?></div><?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
            <?php endif; ?>
          </div>
        <?php endif; ?>

        <?php print $breadcrumb; ?>

        <?php if ($is_title_on && $title): ?>
          <div class="page-title">
            <?php print render($title_prefix); ?>
            <?php if ($title): ?><h1 class="title direction-clr" id="page-title"><?php print $title; ?></h1><?php endif; ?>
            <?php print render($title_suffix); ?>
          </div>
        <?php endif; ?>

        <?php
        $ls = !empty($page['sidebar_first']);
        $rs = !empty($page['sidebar_second']);
        ?>
        <?php if ($ls || $rs): ?>
        <div class="row">
          <?php endif; ?>

          <?php if ($ls): ?>
            <div class="col-xs-12 col-lg-3">
              <div class="page-left">
                <?php print render($page['sidebar_first']); ?>
              </div>
            </div>
          <?php endif; ?>

          <?php if ($ls || $rs): ?>
          <div class="col-xs-12 col-lg-9">
            <?php endif; ?>

            <div class="page-main">
              <?php if (isset($tabs)): ?><?php print render($tabs); ?><?php endif; ?>
              <?php print $messages; ?>
              <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>

              <?php print render($page['content']); ?>
            </div>

            <?php if ($ls || $rs): ?>
          </div>
        <?php endif; ?>

          <?php if ($rs): ?>
            <div class="col-xs-12 col-lg-3">
              <div class="page-right">
                <?php print render($page['sidebar_second']); ?>
              </div>
            </div>
          <?php endif; ?>

          <?php if ($ls || $rs): ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($page['downlighted'])): ?>
        <div class="page-downlighted">
          <?php print render($page['downlighted']); ?>
        </div>
      <?php endif; ?>
      </div>
    </div>

    <div class="page-footer">
      <div class="container">
        <div class="row">
          <div class="col-xs-6 col-md-1">
            <div class="branding">
              <div class="image"><a href="/"><img src="/sites/all/themes/project/images/logo/logo.png" alt="MONTEROSSI" /></a></div>
            </div>
          </div>
          <div class="col-xs-6 col-md-4">
            <ul class="menu company">
              <li><?php print l(t('About us'), 'node/11'); ?></li>
              <li><?php print l(t('For distributors'), 'novosti'); ?></li>
              <li><?php print l(t('Technical advice'), 'node/12'); ?></li>
              <li><a href="https://kccc.group" target="_blank">KCCC GROUP</a></li>
            </ul>
          </div>

          <div class="col-xs-12 col-md-4">
            <ul class="menu directions">
              <li><?php print l(t('Motor oils for passenger cars'), 'taxonomy/term/8'); ?></li>
              <li><?php print l(t('Motor oils for trucksy'), 'taxonomy/term/10'); ?></li>
              <li><?php print l(t('Transmission oils'), 'taxonomy/term/9', ['html' => true]); ?></li>
              <li><?php print l(t('Car cosmetics'), 'taxonomy/term/9', ['html' => true]); ?></li>
            </ul>
          </div>

          <div class="col-xs-6 col-md-3">
            <ul class="menu actions">
              <li><?php print l(t('Contacts'), 'node/12'); ?></li>
              <li><?php print l(t('ООО «КССС лубрикантс»'), '<front>'); ?></li>
              <li><a href="tel:88005502426" class="contacts c0py">8 (800) 550-24-26</a></li>
              <li><a href="mailto:info@monterossi.ru" class="contacts c0py">info@monterossi.ru</a></li>
            </ul>
          </div>

        </div>
      </div>
    </div>

    <div id="back-to-top"><i class="icon icon-17 direction-clr"></i></div>
  </div>
</div>


