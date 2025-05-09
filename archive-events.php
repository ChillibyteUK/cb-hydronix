<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

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
    'meta_type' => 'DATETIME'
));

global $sitepress;
$curr_lang = $sitepress->get_current_language();
$lang = $curr_lang == 'en' ? '' : '/' . $curr_lang;

?>
<main id="main">
    <div class="container py-3">
        <h1 class="mb-4">
            <?=__('Hydronix Events', 'cb-hydronix')?>
            <?php /* get_post_type_archive_link('events') */ ?>
        </h1>
        <?php
        if (get_field('news_archive', 'options')) {
            echo '<div class="mb-5">XXX' . get_field('event_archive', 'options') . '</div>';
        }
?>
        <?php
if ($q->have_posts()) {
    $curr_mon = '';
    while ($q->have_posts()) {
        $q->the_post();
        // get the date
        preg_match_all('~^(\w+) (\d+), (\d{4})~', date_i18n("F j, Y", strtotime(get_field('event_date', get_the_ID()))), $date);
        if ($curr_mon != $date[1][0]) {
            $curr_mon = $date[1][0];
            echo '<div class="col-12 mb-4"><div class="h2 border-bottom">' . $curr_mon . ' ' . $date[3][0] . '</div></div>';
        }
        $type = get_field('event_type', get_the_ID());
        if ($type == __('Organic', 'cb-hydronix')) {
            $type = 'evt__edate--organic';
        } elseif ($type == __('Concrete', 'cb-hydronix')) {
            $type = 'evt__edate--concrete';
        } else {
            $type = '';
        }
        ?>
        <div class="event mb-4 pt-2 pb-4">
            <a href="<?=get_the_permalink()?>">
                <div class="row event__inner">
                    <div class="col-md-3 col-lg-2">
                        <div class="event__date <?=$type?>">
                            <?=date_i18n("jS", strtotime(get_field('event_date', get_the_ID())))?>
                            <div class="event__month">
                                <?=date_i18n("F", strtotime(get_field('event_date', get_the_ID())))?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-2 d-flex justify-content-center align-items-center">
                        <img src="<?=get_the_post_thumbnail_url(get_the_ID(), 'medium')?>"
                            class="img-fluid">
                    </div>
                    <div class="col-md-6 col-lg-8">
                        <div class="event__detail">
                            <div class="event__title">
                                <?=get_the_title()?></div>
                            <div class="event__intro fw-bold mb-2">
                                <?=get_field('event_intro')?>
                            </div>
                            <div class="event__loca">
                                <?=get_field('event_location')?>
                            </div>
                            <?php
                            if (get_field('event_end')) {
                                echo '<div class="event__dates">' . date_i18n("F jS, Y", strtotime(get_field('event_date', get_the_ID()))) . ' - ' . date_i18n("F jS, Y", strtotime(get_field('event_end', get_the_ID()))) . '</div>';
                            }
        ?>
                            <div class="event__link">
                                <?=__('Find out more', 'cb-hydronix')?>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <?php
    }
}
?>
        <?php /*numeric_posts_nav() */?>
    </div>
</main>
<?php

get_footer();
