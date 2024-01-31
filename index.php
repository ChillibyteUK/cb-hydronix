<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;



get_header();
?>
<main id="main">
    <div class="container py-5">
        <h1 class="mb-4"><?=__('Hydronix News &amp; Blogs','cb-hydronix')?></h1>
        <?php
        if (get_field('news_archive','options')) {
            echo '<div class="mb-5">' . get_field('news_archive','options') . '</div>';
        }
        ?>
        <div class="row g-5">
            <?php
            while (have_posts()) {
                the_post();
                $img = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                // if (!$img) {
                    // $img = catch_that_image($post);
                // }
                $cats = get_the_category();
                $category = wp_list_pluck($cats, 'name');
                // $category = implode(', ',$category);
                $category = $category[0];

                // get category in english for flash
                $id = $cats[0]->term_id;
                $en_id = apply_filters( 'wpml_object_id', $id, 'category', TRUE, 'en');

                $current_lang = apply_filters( 'wpml_current_language', NULL );
                $sitepress->switch_lang( 'en' );
                $en_term = get_term( $en_id, 'category' );
                $sitepress->switch_lang($current_lang);
    
                $catClass = $en_term->name;

                ?>
            <div class="col-md-6">
                <a href="<?=get_the_permalink()?>" class="news__item">
                    <div class="news__image" style="background-image:url(<?=$img?>)">
                        <div class="news__flash news__flash--<?=$catClass?>"><?=$category?></div>
                    </div>
                    <div class="news__inner">
                        <div class="news__title"><?=get_the_title()?></div>
                        <div class="news__date"><?=get_the_date('j F, Y')?> - <?=the_author_meta('display_name')?></div>
                        <div class="news__intro"><?=wp_trim_words(get_the_content(),30)?></div>
                    </div>
                </a>
            </div>
                <?php
            }
            ?>
        </div>
        <div class="mt-5">
        <?php
        numeric_posts_nav();
        ?>
        </div>
    </div>
</main>
<?php

get_footer();