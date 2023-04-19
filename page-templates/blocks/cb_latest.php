<!-- latest -->
<section class="latest">
    <div class="latest__heading py-4">
        <div class="container-xl">
            <h2><?=__('Related News, Blogs &amp; Events','cb-hydronix')?></h2>
        </div>
    </div>
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-7">
                <h2 class="mb-4"><?=__('Latest News & Blogs','cb-hydronix')?></h2>
                <?php
                $latest_news = get_posts("post_type=post&numberposts=2");
                foreach ($latest_news as $news) {
                    ?>
                <a href="<?=get_the_permalink($news->ID)?>" class="latest__item mb-4">
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <div class="latest__title"><?=$news->post_title?></div>
                            <div class="latest__date"><?=get_the_date('j F Y', $news->ID)?></div>
                            <div class="latest__intro"><?=wp_trim_words( apply_filters('the_content', get_post_field('post_content', $news->ID)),15)?></div>
                        </div>
                        <div class="col-md-4 text-center">
                            <img src="<?=get_the_post_thumbnail_url($news->ID,'medium')?> " alt="" class="latest__image">
                        </div>
                    </div>
                </a>
                <?php
                }
                ?>
                <div>
                    <a href="/resources/" class="mx-auto btn btn--orange">Hydronix Resource Hub</a>
                </div>
            </div>
            <div class="col-lg-5">
                <h2 class="mb-4">Upcoming Events</h2>
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
                while($q->have_posts()) {
                    $q->the_post();
                    $type = get_field('event_type', get_the_ID());
                    if ($type == 'Organic') {
                        $type = 'evt__edate--organic';
                    }
                    elseif ($type == 'Concrete') {
                        $type = 'evt__edate--concrete';
                    }
                    else {
                        $type = '';
                    }
                    ?>
                <a href="<?=get_the_permalink(get_the_ID())?>" class="evt__item mb-4">
                    <div class="row evt mx-0">
                        <div class="col-md-4 px-0"><div class="evt__edate <?=$type?>"><?=date("j F, Y",strtotime(get_field('event_date',get_the_ID())))?></div></div>
                        <div class="col-md-8 py-2 evt__detail">
                            <div class="evt__title"><?=get_the_title()?></div>
                            <div class="evt__loca"><?=get_field('event_location',get_the_ID())?></div>
                        </div>
                    </div>
                </a>
                <?php
                }
                wp_reset_postdata();
                ?>
                <div>
                    <a href="/resources/events/" class="mx-auto btn btn--orange">All Events</a>
                </div>
            </div>
        </div>
    </div>
</section>