<?php
define('WP_USE_THEMES', false); // Don't load theme support functionality
require_once("../../../wp-load.php");

header('Content-Type: application/json; charset=utf-8');

$industry = $_REQUEST['ind'];
$process = $_REQUEST['process'];

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
        )
    )
));

$industries = array();

while ($q->have_posts()) {
    $q->the_post();
    $terms = get_the_terms( get_the_ID(), 'temp' );
    if ($terms) {
        foreach ($terms as $t) {
            $industries[$t->slug] = $t->name;
        }
    }
}

asort($industries);

echo json_encode($industries);


die();