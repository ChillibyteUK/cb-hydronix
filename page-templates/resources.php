<?php
/*
Template name: Resource Hub
*/

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
?>
<main id="main">
    <div class="container py-5">
        <h1 class="mb-4"><?=__('Hydronix Resource Hub','cb-hydronix')?></h1>
        <div class="row g-5">
            <div class="col-lg-6">
                <div class="d-flex justify-content-between align-items-end mb-4">
                    <h2 class="mb-0"><?=__('Latest News & Blogs','cb-hydronix')?></h2>
                    <a href="<?=get_post_type_archive_link('post')?>"><?=__('All News','cb-hydronix')?></a>
                </div>
                <div class="row g-4 mx-1">
                    <?php
                        $latest_news = get_posts("post_type=post&numberposts=3");
                        foreach ($latest_news as $news) {
                            $img = get_the_post_thumbnail_url( $news->ID, 'medium' );
                            ?>
                    <a href="<?=get_the_permalink($news->ID)?>" class="res__item">
                        <div class="col-12">
                            <div class="row res">
                                <div class="col-md-2 m-0 res__image" style="background-image:url(<?=$img?>)"></div>
                                <div class="col-md-10 res__detail py-2">
                                    <div class="res__title"><?=$news->post_title?></div>
                                    <div class="res__date"><?=get_the_date('j F, Y', $news->ID)?></div>
                                </div>
                            </div>
                        </div>
                    </a>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="d-flex justify-content-between align-items-end mb-4">
                    <h2 class="mb-0"><?=__('Upcoming Events','cb-hydronix')?></h2>
                    <a href="<?=get_post_type_archive_link('events')?>"><?=__('All Events','cb-hydronix')?></a>
                </div>
                <div class="row g-4 mx-1">
                    <?php
                    $q = new WP_Query(array(
                        'post_type' => 'events',
                        'meta_query' => array(
                            array(
                                'key' => 'event_date',
                                'value' => date('Ymd'),
                                'type' => 'DATE',
                                'compare' => '>='
                            )
                        ),
                        'order' => 'ASC',
                        'orderby' => 'meta_value',
                        'meta_key' => 'event_date',
                        'meta_type' => 'DATETIME',
                        'posts_per_page' => 4
                    ));
                    
                    while ($q->have_posts()) {
                        $q->the_post();
                        ?>
                    <a href="<?=get_the_permalink(get_the_ID())?>" class="evt__item">
                        <div class="col-12">
                            <div class="row evt">
                                <div class="col-md-3 px-0"><div class="evt__edate"><?=date("j F, Y",strtotime(get_field('event_date',get_the_ID())))?></div></div>
                                <div class="col-md-9 py-2 evt__detail">
                                    <div class="evt__title"><?=get_the_title()?></div>
                                    <div class="evt__loca"><?=get_field('event_location',get_the_ID())?></div>
                                </div>
                            </div>
                        </div>
                    </a>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</main>
<?php

get_footer();