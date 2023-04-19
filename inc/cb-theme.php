<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

define('CB_THEME_DIR', WP_CONTENT_DIR . '/themes/cb-hydronix');

require_once CB_THEME_DIR . '/inc/cb-posttypes.php';
require_once CB_THEME_DIR . '/inc/cb-taxonomies.php';
require_once CB_THEME_DIR . '/inc/cb-utility.php';
require_once CB_THEME_DIR . '/inc/cb-blocks.php';
require_once CB_THEME_DIR . '/inc/cb-news.php';


define('ICL_DONT_LOAD_NAVIGATION_CSS', true);
define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);
define('ICL_DONT_LOAD_LANGUAGES_JS', true);


// Remove unwanted SVG filter injection WP
remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );


// Remove comment-reply.min.js from footer
function remove_comment_reply_header_hook(){
	wp_deregister_script( 'comment-reply' );
}
add_action('init','remove_comment_reply_header_hook');

add_action('admin_menu', 'remove_comments_menu');
function remove_comments_menu()
{
    remove_menu_page('edit-comments.php');
}

add_filter('theme_page_templates', 'child_theme_remove_page_template');
function child_theme_remove_page_template($page_templates)
{
    // unset($page_templates['page-templates/blank.php'],$page_templates['page-templates/empty.php'], $page_templates['page-templates/fullwidthpage.php'], $page_templates['page-templates/left-sidebarpage.php'], $page_templates['page-templates/right-sidebarpage.php'], $page_templates['page-templates/both-sidebarspage.php']);
    unset($page_templates['page-templates/blank.php'],$page_templates['page-templates/empty.php'], $page_templates['page-templates/left-sidebarpage.php'], $page_templates['page-templates/right-sidebarpage.php'], $page_templates['page-templates/both-sidebarspage.php']);
    return $page_templates;
}
add_action('after_setup_theme', 'remove_understrap_post_formats', 11);
function remove_understrap_post_formats()
{
    remove_theme_support('post-formats', array( 'aside', 'image', 'video' , 'quote' , 'link' ));
}

if (function_exists('acf_add_options_page')) {
    acf_add_options_page(
        array(
            'page_title' 	=> 'Site-Wide Settings',
            'menu_title'	=> 'Site-Wide Settings',
            'menu_slug' 	=> 'theme-general-settings',
            'capability'	=> 'edit_posts',
        )
    );
}

function widgets_init()
{

    register_sidebar(
        array(
            'name'          => __('Footer Col 1', 'cb-hydronix'),
            'id'            => 'footer-1',
            'description'   => __('Footer Col 1', 'cb-hydronix'),
            'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
            'after_widget'  => '</div>',
        )
    );

    register_nav_menus(array(
        'lang_nav' => __('Language Nav', 'cb-hydronix'),
    ));

    register_nav_menus(array(
        'primary_nav' => __('Primary Nav', 'cb-hydronix'),
    ));

    register_nav_menus(array(
        'footer_menu1' => __('Footer Menu 1', 'cb-hydronix'),
    ));
    register_nav_menus(array(
        'footer_menu2' => __('Footer Menu 2', 'cb-hydronix'),
    ));
    register_nav_menus(array(
        'footer_menu3' => __('Footer Menu 3', 'cb-hydronix'),
    ));

    unregister_sidebar('hero');
    unregister_sidebar('herocanvas');
    unregister_sidebar('statichero');
    unregister_sidebar('left-sidebar');
    unregister_sidebar('right-sidebar');
    unregister_sidebar('footerfull');
    unregister_nav_menu('primary');

}
add_action('widgets_init', 'widgets_init', 11);


remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );


// add china to language switcher

add_filter('wp_nav_menu_items', 'new_nav_menu_items', 10, 2);
function new_nav_menu_items($items, $args) {
    if( $args->theme_location != 'lang_nav' ) {
        return $items;
    }
    // get languages
    $languages = apply_filters( 'wpml_active_languages', NULL, 'skip_missing=0' );
  
    // add $args->theme_location == 'primary-menu' in the conditional if we want to specify the menu location.
    $dropdown_items = '';
    if ( $languages) {
  
        foreach($languages as $language){
            if(!$language['active']){
                 
                $dropdown_items .= '<li class="menu-item wpml-ls-item wpml-ls-menu-item nav-item"><a class="dropdown-item" href="' . $language['url'] . '"><img src="' . $language['country_flag_url'] . '" height="12" alt="' . $language['language_code'] . '" width="18" /> <span class="wpml-ls-native" lang="' . $language['language_code'] . '"> ' . $language['native_name'] . '</span></a></li>';
            }
            else {
                $active_language = '<li class="menu-item dropdown wpml-ls-item wpml-ls-current-language wpml-ls-menu-item wpml-ls-first-item menu-item-type-wpml_ls_menu_item menu-item-object-wpml_ls_menu_item menu-item-has-children">
                <a title="' . $language['native_name'] . '" href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><img class="wpml-ls-flag" src="' . $language['country_flag_url'] . '" alt=""></a>';
                     
            }
        }
         
        $custom_flag_url = "/wp-content/plugins/sitepress-multilingual-cms/res/flags/cn.png";
        $custom_language_link = "#";
         
        $dropdown_items .='<li class="menu-item wpml-ls-item wpml-ls-menu-item">
        <a class="dropdown-item" href="' . $custom_language_link . '"><img src="' . $custom_flag_url . '" height="12" alt="" width="18" /> <span class="wpml-ls-native"> ' . __('Chinese','cb-hydronix') . '</span></a></li>';
        /* End - Custom Link */
         
        $final_switcher = $active_language. '<ul class="dropdown-menu">'.$dropdown_items.'</ul></li>';
    }
  
    return $items.$final_switcher;
}


add_filter('wpseo_breadcrumb_links', function( $links ) {
    global $post;
    if ( is_singular( 'products' ) ) {
        $t = get_the_terms($post->ID,'ptype');

        if ($t[0]->slug == 'measure') {

            $breadcrumb[] = array(
                'url' => site_url( $t[0]->slug ),
                'text' => $t[0]->name,
            );

            $ref = wp_get_referer();
            if (preg_match('/measure/',$ref)) {
                $refID = url_to_postid(wp_get_referer());
                $refName = get_the_title($refID);
                $breadcrumb[] = array(
                    'url' => $ref,
                    'text' => $refName,
                );
            }

            array_splice( $links, 1, -1, $breadcrumb );
        }
        else {
            $breadcrumb[] = array(
                'url' => site_url( $t[0]->slug ),
                'text' => $t[0]->name,
            );
            array_splice( $links, 1, -1, $breadcrumb );
        }
    }
    return $links;
}
);

//Custom Dashboard Widget
add_action( 'wp_dashboard_setup', 'register_cb_dashboard_widget' );
function register_cb_dashboard_widget() {
	wp_add_dashboard_widget(
		'cb_dashboard_widget',
		'Chillibyte',
		'cb_dashboard_widget_display'
	);

}

function cb_dashboard_widget_display() {
   ?>
    <div style="display: flex; align-items: center; justify-content: space-around;">
        <img style="width: 50%;" src="<?= get_stylesheet_directory_uri().'/img/cb-full.jpg'; ?>">
        <a class="button button-primary" target="_blank" rel="noopener nofollow noreferrer" href="mailto:hello@www.chillibyte.co.uk/">Contact</a>
    </div>
    <div>
        <p><strong>Thanks for choosing Chillibyte!</strong></p>
        <hr>
        <p>Got a problem with your site, or want to make some changes & need us to take a look for you?</p>
        <p>Use the link above to get in touch and we'll get back to you ASAP.</p>
    </div>
   <?php
}

