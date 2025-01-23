<?php

function register_cement_results_cpt() {
    register_post_type('cement_results', array(
        'labels' => array(
            'name' => 'Cement Calc Results',
            'singular_name' => 'Cement Calc Result',
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array(
            'slug' => 'cement-results', // No front prefix
            'with_front' => false,      // Disable the front prefix
        ),
        'supports' => array('title'),
    ));
}
add_action('init', 'register_cement_results_cpt');

function remove_yoast_meta_box_for_cement_results() {
    // Check if the current post type is 'cement_results'
    if ('cement_results' === get_post_type()) {
        // Remove the Yoast SEO meta box
        remove_meta_box('wpseo_meta', 'cement_results', 'normal');
    }
}
add_action('add_meta_boxes', 'remove_yoast_meta_box_for_cement_results', 99);
