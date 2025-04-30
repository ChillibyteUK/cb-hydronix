<?php

function cb_register_post_types() {

    $labels = [
        "name" => __( "Products", "cb-hydronix" ),
        "singular_name" => __( "Product", "cb-hydronix" ),
    ];

    $args = [
        "label" => __( "Products", "cb-hydronix" ),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => [ "slug" => "products", "with_front" => false ],
        "query_var" => true,
        "supports" => [ "title",  "thumbnail" ],
        "show_in_graphql" => false,
    ];

    register_post_type( "products", $args );

    $labels = [
        "name" => __( "Accessories", "cb-hydronix" ),
        "singular_name" => __( "Accessory", "cb-hydronix" ),
    ];

    $args = [
        "label" => __( "Accessories", "cb-hydronix" ),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => true,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => false ,
        "query_var" => true,
        "supports" => [ "title", "thumbnail" ],
        "show_in_graphql" => false,
    ];

    register_post_type( "accessories", $args );

    $labels = [
        "name" => __( "News", "cb-hydronix" ),
        "singular_name" => __( "News", "cb-hydronix" ),
    ];

    $args = [
        "label" => __( "News", "cb-hydronix" ),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => [ "slug" => "resources/news", "with_front" => false ],
        "query_var" => true,
        "supports" => [ "title", "editor", "thumbnail" ],
        "show_in_graphql" => false,
    ];

    if (function_exists('wpml_register_single_string')) {
        do_action('wpml_register_single_string', 'Custom Post Type Slugs', 'events_archive_slug', 'resources/events');
    }

    $translated_slug = function_exists('icl_translate')
    ? icl_translate('Custom Post Type Slugs', 'events_archive_slug', 'resources/events')
    : 'resources/events';

    $labels = [
        "name" => __( "Events", "cb-hydronix" ),
        "singular_name" => __( "Event", "cb-hydronix" ),
    ];

    $args = [
        "label" => __( "Events", "cb-hydronix" ),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => [ "slug" => $translated_slug, "with_front" => false ],
        "query_var" => true,
        "supports" => [ "title", "thumbnail" ],
        "show_in_graphql" => false,
        'taxonomies' => array('post_tag')
    ];

    register_post_type( "events", $args );

    if (!get_option('custom_events_rewrite_flushed')) {
        flush_rewrite_rules();
        update_option('custom_events_rewrite_flushed', true);
    }

}
add_action( 'init', 'cb_register_post_types' );

add_action('after_setup_theme', function () {
    if (function_exists('icl_translate')) {
        $translated_slug = icl_translate('Custom Post Type Slugs', 'events_archive_slug', 'resources/events');

        // Generate the expected archive URL
        $expected_url = home_url(trailingslashit($translated_slug));
        $actual_url = get_post_type_archive_link('events');

        // Compare the rewritten archive URL to the translated one
        if ($expected_url !== $actual_url || !get_option('custom_events_rewrite_flushed')) {
            flush_rewrite_rules();
            update_option('custom_events_rewrite_flushed', true);
            error_log('Rewriting rules flushed to use: ' . $translated_slug);
        }
    }
});

add_action( 'after_switch_theme', 'cb_rewrite_flush' );
function cb_rewrite_flush() {
    cb_register_post_types();
    flush_rewrite_rules();
}


function add_acf_columns ( $columns ) {
    return array_merge ( $columns, array ( 
        'product_code' => __ ( 'SKU' ),
    ) );
}
add_filter ( 'manage_accessories_posts_columns', 'add_acf_columns' );
function accessories_custom_column ( $column, $post_id ) {
    switch ( $column ) {
        case 'product_code':
           echo get_post_meta ( $post_id, 'product_code', true );
            break;
    }
}
add_action ( 'manage_accessories_posts_custom_column', 'accessories_custom_column', 10, 2 );