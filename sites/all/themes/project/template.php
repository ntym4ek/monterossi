<?php

/**
 * Implements hook_theme().
 */
function project_theme()
{
  return [
    'product_teaser' => [
      'variables' => ['product_info' => null],
    ],
  ];
}

/**
 * Функция темизации карточки продукта
 */
function project_product_teaser($vars)
{
  $product_info = $vars['product_info'];

  $output =   '<a href="' . $product_info['url'] . '">';
  $output .=  '<div class="product product-teaser hover-raise">';
  $output .=    '<div class="p-label">' . $product_info['label'] . '</div>';
  $output .=    '<div class="p-image">';
  $output .=      '<div class="image"><img src="' . $product_info['image'] . '" alt="' . $product_info['label'] . '"></div>';
  $output .=      '<div class="p-stickers">';
  foreach ($product_info['adv'] as $adv) {
    $output .= '<div class="p-sticker"><img src="' . $adv['icon_url'] . '" alt="' . $adv['label'] . '"></div>';
  }
  $output .=      '</div>';
  $output .=    '</div>';
  $output .=    '<div class="p-description">';
  $output .=      $product_info['description'];
  $output .=    '</div>';
  $output .=    '<div class="p-tares">';
  foreach ($product_info['tare'] as $tare) {
    $output .=    '<div class="p-tare' . (empty($tare['selected']) ? '' : ' selected') . '">' . $tare['label'] . '</div>';
  }
  $output .=    '</div>';
  $output .=  '</div>';
  $output .=  '</a>';

  return $output;
}

/**
 * Функция темизации заголовка блока Facet
 */
function project_facetapi_title($vars)
{
  // Сделать заголовки блоков фасетных фильтров мультиязычными
  if (strpos($vars["facet"]["#settings"]->facet, 'field_p_category') !== false) {
    return '<span>Категория</span><i class="icon icon-13"></i>';
  }
  if (strpos($vars["facet"]["#settings"]->facet, 'field_p_viscosity') !== false) {
    return '<span>Вязкость</span><i class="icon icon-13"></i>';
  }
  if (strpos($vars["facet"]["#settings"]->facet, 'field_p_specs') !== false) {
    return '<span>Соответствия</span><i class="icon icon-13"></i>';
  }
}

function project_current_search_link_active($vars)
{
  // Sanitizes the link text if necessary.
  $sanitize = empty($vars['options']['html']);
  $link_text = ($sanitize) ? check_plain($vars['text']) : $vars['text'];

  // Builds link, passes through t() which gives us the ability to change the
  // position of the widget on a per-language basis.
  $replacements = array(
    '!current_search_deactivate_widget' => theme('current_search_deactivate_widget', $vars),
  );
  $vars['text'] = t('!current_search_deactivate_widget', $replacements) . $link_text;
  $vars['options']['html'] = TRUE;
//  $vars['options']['attributes']['class'][] = 'active';
  $vars['options']['attributes']['class'][] = 'btn btn-xs btn-success btn-with-icon-left btn-uppercase';
  $vars['options']['attributes']['title'] = t('Remove this filter');
  return l($vars['text'], $vars['path'], $vars['options']);
}

function project_current_search_deactivate_widget($vars)
{
  return 'x&nbsp;&nbsp;';
}
