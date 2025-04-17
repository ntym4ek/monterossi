<?php
/**
 * @file
 * Customize the display of a complete webform.
 *
 * This file may be renamed "webform-form-[nid].tpl.php" to target a specific
 * webform on your site. Or you can leave it "webform-form.tpl.php" to affect
 * all webforms on your site.
 *
 * Available variables:
 * - $form: The complete form array.
 * - $nid: The node ID of the Webform.
 *
 * The $form array contains two main pieces:
 * - $form['submitted']: The main content of the user-created form.
 * - $form['details']: Internal information stored by Webform.
 *
 * If a preview is enabled, these keys will be available on the preview page:
 * - $form['preview_message']: The preview message renderable.
 * - $form['preview']: A renderable representing the entire submission preview.
 */
?>

<div class="screen-width">
  <div class="container">
    <h2><?php print 'Оставить сообщение'; ?></h2>
    <div class="row">
      <div class="col-sm-12 col-md-6">
        <?php print drupal_render($form['submitted']['name']); ?>
        <?php print drupal_render($form['submitted']['phone']); ?>
        <?php print drupal_render($form['submitted']['email']); ?>
        <?php print drupal_render($form['submitted']['theme']); ?>
      </div>
      <div class="col-sm-12 col-md-6">
        <?php print drupal_render($form['submitted']['message']); ?>
      </div>
      <div class="col-sm-12">
        <?php print drupal_render($form['fz152_agreement']); ?>
        <?php print drupal_render($form['actions']); ?>
        <?php print drupal_render_children($form); ?>
      </div>
    </div>
  </div>
</div>

