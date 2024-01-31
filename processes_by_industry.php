<?php
define('WP_USE_THEMES', false); // Don't load theme support functionality
require_once("../../../wp-load.php");

header('Content-Type: application/json; charset=utf-8');

$industry = $_REQUEST['ind'];

if ($industry != '%') {
    $ind_tax = array(
        'taxonomy' => 'industries',
        'field' => 'slug',
        'terms' => $industry,
    );
}
$q = new WP_Query(array(
    'post_type' => 'products',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'tax_query' => array(
        $ind_tax
    )
));

$industries = array();

while ($q->have_posts()) {
    $q->the_post();
    $terms = get_the_terms( get_the_ID(), 'process' );
    if ($terms) {
        foreach ($terms as $t) {
            $industries[$t->slug] = $t->name;
        }
    }
}

$industries['%'] = 'Other';

echo json_encode($industries);


die();