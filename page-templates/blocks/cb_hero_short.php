<?php
$bg = get_the_post_thumbnail_url( get_the_ID(), 'full' );
$title = get_field('title') == '' ? get_the_title() : get_field('title');
?>    
<!-- hero_short -->
<section class="short_hero d-flex py-5" style="background-image:url(<?=$bg?>)">
    <div class="overlay"></div>
    <div class="container-xl my-auto">
        <div class="row">
            <div class="col-lg-5 hero__content">
                <h1><?=$title?></h1>
            </div>
        </div>
    </div>
</section>
<!--section class="sub_page_title py-1 mb-4">
    <div class="container-xl">
        <?php
        if ( function_exists('yoast_breadcrumb') ) {
            yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
        }
        ?>
    </div>
</section-->
