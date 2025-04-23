<?php

/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct URL of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type; for example, "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type; for example, story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode; for example, "full", "teaser".
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined; for example, $node->body becomes $body. When needing to
 * access a field's raw values, developers/themers are strongly encouraged to
 * use these variables. Otherwise they will have to explicitly specify the
 * desired field language; for example, $node->body['en'], thus overriding any
 * language negotiation rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 *
 * @ingroup themeable
 */
?>
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>>

  <div class="node-row">
    <div class="row">
      <div class="col-xs-12 col-lg-4">
        <?php if (count($images)): ?>
        <div class="node-images">
          <div class="images-thumbs">
            <div id="slider-images-thumbs" class="slider-thumbs">
              <div class="swiper">
                <div class="swiper-wrapper">
                  <?php foreach ($images as $image) {
                    print '<div class="swiper-slide"><div class="image"><img src="' . image_style_url('thumbnail', $image["#item"]["uri"]) . '" /></div></div>';
                  } ?>
                </div>
              </div>
            </div>
          </div>
          <div class="images">
            <div id="slider-images" class="slider slider-images">
              <div class="swiper">
                <div class="swiper-wrapper">
                  <?php foreach ($images as $image) {
                    print '<div class="swiper-slide"><div class="image">' . drupal_render($image) . '</div></div>';
                  } ?>
                </div>
              </div>
            </div>
            <?php if (!empty($product_info['adv'])): ?>
              <div class="image-stickers">
                <?php foreach ($product_info['adv'] as $adv): ?>
                  <div class="image-sticker"><img src="<?php print $adv['icon_url']; ?>" alt="<?php print $adv['label']; ?>"></div>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
        <?php endif; ?>
      </div>

      <div class="col-xs-12 col-lg-8">
        <div class="node-header">
          <div class="node-title">
            <h1><?php print $title; ?></h1>
          </div>
        </div>
        <div class="node-text">
          <?php print render($content['body']); ?>
        </div>
        <div class="node-specs">
          <?php print render($content['field_p_specs']); ?>
        </div>
        <div class="node-advantages">
          <?php print render($content['field_p_advantages']); ?>
        </div>

        <?php if ($product_info['tds'] || $product_info['passport'] || $product_info['test']): ?>
        <div class="node-files">
          <?php if ($product_info['tds']): ?>
          <div class="file"><a href="<?php print $product_info['tds']; ?>" class="btn btn-small btn-default btn-with-icon btn-icon-left btn-wide" download><i class="icon icon-31"></i>TDS</a></div>
          <?php endif; ?>
          <?php if ($product_info['passport']): ?>
          <div class="file"><a href="<?php print $product_info['passport']; ?>" class="btn btn-small btn-default btn-with-icon btn-icon-left btn-wide" download><i class="icon icon-32"></i>Паспорт продукта</a></div>
          <?php endif; ?>
          <?php if ($product_info['test']): ?>
          <div class="file"><a href="<?php print $product_info['test']; ?>" class="btn btn-small btn-default btn-with-icon btn-icon-left btn-wide" download><i class="icon icon-33"></i>Протокол испытаний</a></div>
          <?php endif; ?>
        </div>
        <?php endif; ?>

        <div class="node-actions">
          <div class="action"><?php print $product_call_btn; ?></div>
          <div class="action"><?php print $product_where_btn; ?></div>
        </div>
      </div>
    </div>
  </div>

</div>
