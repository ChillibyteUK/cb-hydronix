<?php

function cb_register_taxes() {

    $args = [
        "label" => __( "Industries", "cb-hydronix" ),
        "labels" => [
            "name" => __( "Industries", "cb-hydronix" ),
            "singular_name" => __( "Industry", "cb-hydronix" ),
        ],
        "public" => true,
        "publicly_queryable" => false,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => false,
        "show_admin_column" => true,
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "rest_base" => "industries",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "show_in_quick_edit" => true,
        "show_in_graphql" => false,
    ];
    register_taxonomy( "industries", [ "page", "products", "attachment" ], $args );

    $args = [
        "label" => __( "Applications", "cb-hydronix" ),
        "labels" => [
            "name" => __( "Applications", "cb-hydronix" ),
            "singular_name" => __( "Application", "cb-hydronix" ),
        ],
        "public" => true,
        "publicly_queryable" => false,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => false,
        "show_admin_column" => true,
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "rest_base" => "applications",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "show_in_quick_edit" => true,
        "show_in_graphql" => false,
    ];
    register_taxonomy( "applications", [ "products" ], $args );

    $args = [
        "label" => __( "Product Types", "cb-hydronix" ),
        "labels" => [
            "name" => __( "Products Types", "cb-hydronix" ),
            "singular_name" => __( "Product Type", "cb-hydronix" ),
        ],
        "public" => true,
        "publicly_queryable" => false,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => false,
        "show_admin_column" => true,
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "rest_base" => "ptype",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "show_in_quick_edit" => true,
        "show_in_graphql" => false,
    ];
    register_taxonomy( "ptype", [ "products" ], $args );

    $args = [
        "label" => __( "Process", "cb-hydronix" ),
        "labels" => [
            "name" => __( "Process", "cb-hydronix" ),
            "singular_name" => __( "Process", "cb-hydronix" ),
        ],
        "public" => true,
        "publicly_queryable" => false,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => false,
        "show_admin_column" => true,
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "rest_base" => "process",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "show_in_quick_edit" => true,
        "show_in_graphql" => false,
    ];
    register_taxonomy( "process", [ "page", "products" ], $args );

    $args = [
        "label" => __( "Accessory Type", "cb-hydronix" ),
        "labels" => [
            "name" => __( "Type", "cb-hydronix" ),
            "singular_name" => __( "Types", "cb-hydronix" ),
        ],
        "public" => true,
        "publicly_queryable" => false,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => false,
        "show_admin_column" => true,
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "rest_base" => "atype",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "show_in_quick_edit" => true,
        "show_in_graphql" => false,
    ];
    register_taxonomy( "atype", [ "accessories" ], $args );

    $args = [
        "label" => __( "Temp Range", "cb-hydronix" ),
        "labels" => [
            "name" => __( "Temp Range", "cb-hydronix" ),
            "singular_name" => __( "Range", "cb-hydronix" ),
        ],
        "public" => true,
        "publicly_queryable" => false,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => false,
        "show_admin_column" => true,
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "rest_base" => "temp",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "show_in_quick_edit" => true,
        "show_in_graphql" => false,
    ];
    register_taxonomy( "temp", [ "products" ], $args );

    $args = [
        "label" => __( "Doc Type", "cb-hydronix" ),
        "labels" => [
            "name" => __( "Doc Types", "cb-hydronix" ),
            "singular_name" => __( "Doc Type", "cb-hydronix" ),
        ],
        "public" => true,
        "publicly_queryable" => false,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => true,
        "show_admin_column" => true,
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "rest_base" => "doctype",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "show_in_quick_edit" => true,
        "show_in_graphql" => false,
    ];
    // register_taxonomy( "doctype", [ "attachment" ], $args );

    $args = [
        "label" => __( "Doc Lang", "cb-hydronix" ),
        "labels" => [
            "name" => __( "Doc Langs", "cb-hydronix" ),
            "singular_name" => __( "Doc Lang", "cb-hydronix" ),
        ],
        "public" => true,
        "publicly_queryable" => false,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => false,
        "show_admin_column" => true,
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "rest_base" => "doclang",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "show_in_quick_edit" => true,
        "show_in_graphql" => false,
    ];
    register_taxonomy( "doclang", [ "attachment" ], $args );

    $args = [
        "label" => __( "Doc Product", "cb-hydronix" ),
        "labels" => [
            "name" => __( "Doc Products", "cb-hydronix" ),
            "singular_name" => __( "Doc Product", "cb-hydronix" ),
        ],
        "public" => true,
        "publicly_queryable" => false,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => false,
        "show_admin_column" => true,
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "rest_base" => "docprod",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "show_in_quick_edit" => true,
        "show_in_graphql" => false,
    ];
    register_taxonomy( "docprod", [ "attachment" ], $args );

    
    $args = [
        "label" => __( "Installation Points", "cb-hydronix" ),
        "labels" => [
            "name" => __( "Installation Points", "cb-hydronix" ),
            "singular_name" => __( "Installation Point", "cb-hydronix" ),
        ],
        "public" => true,
        "publicly_queryable" => false,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => false,
        "show_admin_column" => true,
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "rest_base" => "installation",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "show_in_quick_edit" => true,
        "show_in_graphql" => false,
    ];
    register_taxonomy( "installation", [ "products" ], $args );

}
add_action( 'init', 'cb_register_taxes' );
