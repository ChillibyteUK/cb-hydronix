<?php
$order_image = (get_field('order') == 'text_left') ? 'order-1 order-lg-2' : 'order-1 order-lg-1';
$order_text  = (get_field('order') == 'text_left') ? 'order-2 order-lg-1' : 'order-2 order-lg-2';

$split = get_field('split'); // '5050', '6040', or '6040img'

// Set column sizes based on split
switch ($split) {
  case '6040': // text-heavy: text 8, image 4
    $cols_text  = 'col-lg-8';
    $cols_image = 'col-lg-4';
    break;

  case '6040img': // image-heavy: image 8, text 4
    $cols_text  = 'col-lg-4';
    $cols_image = 'col-lg-8';
    break;

  case '5050':
  default: // default to 50/50 if empty/unknown
    $cols_text  = 'col-lg-6';
    $cols_image = 'col-lg-6';
    break;
}

$theme = get_field('theme');
$text  = ($theme == 'bg--blue') ? 'text-white' : null;
?>    
<!-- text_image -->
<section class="text_image py-5 <?=$theme?> <?=$text?>">
  <div class="container-xl">
    <div class="row">
      <div class="<?=$cols_text?> text_image__content my-auto <?=$order_text?>">
        <?php if ($title = get_field('text_image__title')): ?>
          <h2><?= $title ?></h2>
        <?php endif; ?>

        <div class="content"><?= get_field('text_image__content') ?></div>

        <?php if ($cta = get_field('cta')): ?>
          <a href="<?= esc_url($cta['url']) ?>"
             target="<?= esc_attr($cta['target']) ?>"
             class="btn btn--orange"><?= esc_html($cta['title']) ?></a>
        <?php endif; ?>
      </div>

      <div class="<?=$cols_image?> text_image__image text-center my-auto <?=$order_image?>">
        <img src="<?= esc_url(wp_get_attachment_image_url(get_field('image'), 'full')) ?>"
             class="img-fluid w-50 w-md-75 mb-4" alt="">
      </div>
    </div>
  </div>
</section>