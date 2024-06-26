<?php
$order_image = (get_field('order') == 'text_left') ? 'order-1 order-lg-2' : 'order-1 order-lg-1';
$order_text = (get_field('order') == 'text_left') ? 'order-2 order-lg-1' : 'order-2 order-lg-2';

$cols_text = (get_field('split') == '5050' || get_field('split') == '') ? 'col-lg-6' : 'col-lg-8';
$cols_image = (get_field('split') == '5050' || get_field('split') == '') ? 'col-lg-6' : 'col-lg-4';

$theme = get_field('theme');
$text = $theme == 'bg--blue' ? 'text-white' : null;
?>    
<!-- text_image -->
<section class="text_image py-5 <?=$theme?> <?=$text?>">
    <div class="container-xl">
        <div class="row">
            <div class="<?=$cols_text?> text_image__content my-auto <?=$order_text?>">
                <?php
                if (get_field('text_image__title')) {
                    echo '<h2>' . get_field('text_image__title') . '</h2>';
                }
                ?>
                <div class="content"><?=get_field('text_image__content')?></div>
                <?php
                if (get_field('cta')) {
                    $cta = get_field('cta');
                    echo '<a href="' . $cta['url'] . '" target="' . $cta['target'] . '" class="btn btn--orange">' . $cta['title'] . '</a>';
                }
                ?>
            </div>
            <div class="<?=$cols_image?> text_image__image text-center my-auto <?=$order_image?>">
                <img src="<?=wp_get_attachment_image_url(get_field('image'), 'full')?>" class="img-fluid w-50 w-md-75 mb-4">
            </div>
        </div>
    </div>
</section>