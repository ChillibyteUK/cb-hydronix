<?php
$bg = wp_get_attachment_image_url(get_field('background'),'full');
?>
<!-- application_hero -->
<section class="application_hero d-flex py-5" style="background-image:url(<?=$bg?>)">
    <div class="overlay"></div>
    <div class="container my-auto">
        <div class="row">
            <div class="col-lg-9 d-flex hero__content"><h1 class="my-auto text-white"><?=get_field('title')?></h1></div>
            <div class="col-lg-3"><img src="<?=get_stylesheet_directory_uri()?>/img/icons/icon__<?=get_field('icon')?>--wo.svg"></div>
        </div>
    </div>
</section>
<!-- section class="sub_page_title py-1 mb-4">
    <div class="container-xl">
        <?php
        if ( function_exists('yoast_breadcrumb') ) {
            yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
        }
        ?>
    </div>
</section -->
