<?php
define('WP_USE_THEMES', false); // Don't load theme support functionality
require_once("../../../wp-load.php");

header('Content-Type: application/json; charset=utf-8');

$industry = $_REQUEST['ind'];

$lang = $_REQUEST['lang'];
global $sitepress;
$sitepress->switch_lang( $lang );
$curr_lang = apply_filters('wpml_current_language', null);

if ($industry != '%') {
    $ind_tax = array(
        'taxonomy' => 'industries',
        'field' => 'slug',
        'terms' => $industry,
    );
}

$process = $_REQUEST['process'];

if ($process != '%') {
    $proc_tax = array(
        'taxonomy' => 'process',
        'field' => 'slug',
        'terms' => $process,
    );
}

$temp = $_REQUEST['temp'];

if ($temp != '%') {
    $temp_tax = array(
        'taxonomy' => 'temp',
        'field' => 'slug',
        'terms' => $temp,
    );
}

$q = new WP_Query(array(
    'post_type' => 'products',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'tax_query' => array(
        $ind_tax,
        $proc_tax,
        $temp_tax
    )
));

$products = array();

while ($q->have_posts()) {
    $q->the_post();

    $fs = $ex = $ht = 0;

    foreach ( get_the_terms(get_the_ID(),'applications') as $t ) {
        if ($t->slug == __('explosive-atmosphere','cb-hydronix') ) {
            $ex = 1;
        }
        if ($t->slug == __('food-safe','cb-hydronix') ) {
            $fs = 1;
        }
        if ($t->slug == __('high-temperature','cb-hydronix') ) {
            $ht = 1;
        }
    }

    $products[get_the_ID()] = array(
        get_the_title(),
        get_the_permalink(),
        get_the_post_thumbnail_url(get_the_ID(),'medium'),
        get_field('hero_subtitle',get_the_ID()),
        $fs,
        $ex,
        $ht
    );
}

echo json_encode($products);


die();