<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$args = array(
  'posts_per_page' => 8,
  'paged' => $paged,
  'category_name' => 'Events',
);

$q = new WP_Query($args);

?>
<main id="main">
    <div class="container py-5">
        <h1 class="mb-4">Hydronix News &amp; Blogs</h1>
        <div class="row g-5">
            <?php
            while ($q->have_posts()) {
                $q->the_post();
                $img = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                // if (!$img) {
                    // $img = catch_that_image($post);
                // }
                // $cats = get_the_category();
                // $category = $cats[0]->name;
                ?>
            <div class="col-md-6">
                <a href="<?=get_the_permalink()?>" class="news__item">
                    <div class="news__image" style="background-image:url(<?=$img?>)"></div>
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
        <?php /*numeric_posts_nav() */?>
    </div>
</main>
<?php

get_footer();