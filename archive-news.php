<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
?>
<main id="main">
    <div class="container py-5">
        <h1 class="mb-4">Hydronix News</h1>
        <div class="row g-5">
        <?php
        while (have_posts()) {
            the_post();
            $img = get_the_post_thumbnail_url( get_the_ID(), 'large' );
            // if (!$img) {
                // $img = catch_that_image($post);
            // }
            // $cats = get_the_category();
            // $category = $cats[0]->name;
            ?>
            <div class="col-lg-6">
                <a href="<?=get_the_permalink()?>" class="latest__item">
                    <div class="row">
                        <div class="col-md-4 d-flex"><img src="<?=$img?>" class="m-2"></div>
                        <div class="col-md-8">
                            <div class="latest__inner">
                                <div class="latest__title"><?=get_the_title()?></div>
                                <div class="latest__date"><?=get_the_date('j F, Y')?></div>
                                <div class="latest__intro"><?=wp_trim_words(get_the_content(),15)?></div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php
        }
        ?>
        </div>
        <?php /*numeric_posts_nav() */?>
    </div>
</main>
<?php

get_footer();