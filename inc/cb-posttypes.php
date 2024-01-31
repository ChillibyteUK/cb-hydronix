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

// register_post_type( "news", $args );

// $labels = [
//     "name" => __( "Downloads", "cb-hydronix" ),
//     "singular_name" => __( "Download", "cb-hydronix" ),
// ];

// $args = [
//     "label" => __( "Downloads", "cb-hydronix" ),
//     "labels" => $labels,
//     "description" => "",
//     "public" => true,
//     "publicly_queryable" => true,
//     "show_ui" => true,
//     "show_in_rest" => true,
//     "rest_base" => "",
//     "rest_controller_class" => "WP_REST_Posts_Controller",
//     "has_archive" => false,
//     "show_in_menu" => true,
//     "show_in_nav_menus" => true,
//     "delete_with_user" => false,
//     "exclude_from_search" => false,
//     "capability_type" => "post",
//     "map_meta_cap" => true,
//     "hierarchical" => false,
//     "rewrite" => [ "slug" => "downloads", "with_front" => false ],
//     "query_var" => true,
//     "supports" => [ "title" ],
//     "show_in_graphql" => false,
// ];

// register_post_type( "downloads", $args );

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
    "rewrite" => [ "slug" => "resources/events", "with_front" => false ],
    "query_var" => true,
    "supports" => [ "title", "thumbnail" ],
    "show_in_graphql" => false,
    'taxonomies' => array('post_tag')
];

register_post_type( "events", $args );

}
add_action( 'init', 'cb_register_post_types' );

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