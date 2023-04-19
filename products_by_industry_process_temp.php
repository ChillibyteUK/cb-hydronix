<?php
define('WP_USE_THEMES', false); // Don't load theme support functionality
require_once("../../../wp-load.php");

header('Content-Type: application/json; charset=utf-8');

$industry = $_REQUEST['ind'];
$process = $_REQUEST['process'];
$temp = $_REQUEST['temp'];

$q = new WP_Query(array(
    'post_type' => 'products',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'industries',
            'field' => 'slug',
            'terms' => $industry,
        ),
        array(
            'taxonomy' => 'process',
            'field' => 'slug',
            'terms' => $process,
        ),
        array(
            'taxonomy' => 'temp',
            'field' => 'slug',
            'terms' => $temp,
        )
    )
));

$products = array();

while ($q->have_posts()) {
    $q->the_post();

    $fs = $ex = $ht = 0;

    foreach ( get_the_terms(get_the_ID(),'applications') as $t ) {
        if ($t->slug == 'explosive-atmosphere') {
            $ex = 1;
        }
        if ($t->slug == 'food-safe') {
            $fs = 1;
        }
        if ($t->slug == 'high-temperature') {
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