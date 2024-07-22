<?php
/**
 * The header for the theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package cb-hydronix
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

$ip = $_SERVER['REMOTE_ADDR'];
$countryData = json_decode(file_get_contents("http://ip-api.com/json/{$ip}"));
// if ($countryData->countryCode === 'CN') {
if (isset($countryData) && property_exists($countryData, 'countryCode') && $countryData->countryCode === 'CN') {
    header('Location: https://www.hydronix.cn/');
    exit;
}

$curr_lang = apply_filters('wpml_current_language', null);

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta
        charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <!-- <link rel="preload" href="<?php echo get_stylesheet_directory_uri(); ?>/fonts/poppins-v15-latin-300.woff2"
    as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload"
        href="<?php echo get_stylesheet_directory_uri(); ?>/fonts/poppins-v15-latin-300.ttf"
        as="font" type="font/ttf" crossorigin="anonymous">
    <link rel="preload"
        href="<?php echo get_stylesheet_directory_uri(); ?>/fonts/poppins-v15-latin-600.woff2"
        as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload"
        href="<?php echo get_stylesheet_directory_uri(); ?>/fonts/poppins-v15-latin-600.ttf"
        as="font" type="font/ttf" crossorigin="anonymous"> -->
    <?php
    if (get_field('ga_property', 'options')) {
        ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async
        src="https://www.googletagmanager.com/gtag/js?id=<?=get_field('ga_property', 'options')?>">
    </script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config',
            '<?=get_field('ga_property', 'options')?>'
        );
    </script>
    <?php
    }
    if (get_field('gtm_property', 'options')) {
        ?>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer',
            '<?=get_field('gtm_property', 'options')?>'
        );
    </script>
    <!-- End Google Tag Manager -->
    <!-- Google Tag Manager LEGACY -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer',
            'GTM-59WCRW4'
        );
    </script>
    <!-- End Google Tag Manager -->
    <?php
    }
    if (get_field('google_site_verification', 'options')) {
        echo '<meta name="google-site-verification" content="' . get_field('google_site_verification', 'options') . '" />';
    }
    if (get_field('bing_site_verification', 'options')) {
        echo '<meta name="msvalidate.01" content="' . get_field('bing_site_verification', 'options') . '" />';
    }
?>
    <?php
    
wp_head();

$socials = array();
$social = get_field('social', 'options');
if ($social['facebook_url'] ?? null) {
    $socials[] = '"' . $social['facebook_url'] . '"';
}
if ($social['linkedin_url'] ?? null) {
    $socials[] = '"' . $social['linkedin_url'] . '"';
}
if ($social['twitter_url'] ?? null) {
    $socials[] = '"' . $social['twitter_url'] . '"';
}
if ($social['youtube_url'] ?? null) {
    $socials[] = '"' . $social['youtube_url'] . '"';
}
$s = implode(',', $socials);

?>

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Organization",
            "name": "Hydronix",
            "alternateName": "Hydronix",
            "url": "https://www.hydronix.com/",
            "description": "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
            "sameAs": [
                <?=$s?>
            ]
        }
    </script>

</head>

<body <?php body_class(); ?>
    <?php understrap_body_attributes(); ?>>
<?php
    if (get_field('gtm_property', 'options')) {
    ?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe
        src="https://www.googletagmanager.com/ns.html?id=<?=get_field('gtm_property', 'options')?>"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<!-- Google Tag Manager (noscript LEGACY) -->
<noscript><iframe
        src="https://www.googletagmanager.com/ns.html?id=GTM-59WCRW4"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php
}
    <?php
do_action('wp_body_open');
$home_url = apply_filters('wpml_home_url', get_option('home'));

$l = $curr_lang == 'en' ? '/' : '/' . $curr_lang . '/';
?>
    <div class="site" id="page">
        <div id="wrapper-navbar" class="fixed-top">

            <a class="skip-link sr-only sr-only-focusable"
                href="#content"><?php esc_html_e('Skip to content', 'understrap'); ?></a>

            <nav id="nav" class="navbar navbar-expand-lg navbar-light d-block p-0" aria-labelledby="nav-label">
                <div id="top-nav">
                    <div class="container-xl d-flex align-items-center justify-content-between">
                        <!-- <div class="w-100 d-flex flex-column flex-lg-row justify-content-between align-items-center"> -->
                        <a href="<?=$home_url?>"
                            class="navbar-brand logo-link logo" rel="home"></a>
                        <div class="d-none d-lg-flex navbar-nav justify-content-end my-2 w-100 align-content-end">
                            <div class="contacts">
                                <div class="mb-2 text-center text-lg-end">
                                    <div id="searchBox" class="d-none">
                                        <form id="search" class="d-flex w-100 justify-content-center" action="<?=$l?>"
                                            method="get" accept-charset="utf-8">
                                            <input type="text" name="s" id="search-s" value=""
                                                class="align-self-center search-input form-control" autofocus />
                                            <input type="hidden" name="post_type" value="products, events" />
                                        </form>
                                    </div>
                                    <div id="searchTrigger" class="d-block d-lg-inline me-4"><i
                                            class="fa fa-search"></i></div>
                                    <div class="d-block d-lg-inline me-4"><?php
                                    wp_nav_menu(array(
                                        'theme_location'  => 'lang_nav',
                                        'container_class' => 'd-inline-block',
                                        'menu_class' => 'navbar-nav',
                                        'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
                                    ))
?></div>
                                    <?php
$en_contact = get_page_by_path('/about-hydronix/contact-us/');
$en_contact_id = $en_contact->ID;
$lang_contact = apply_filters('wpml_object_id', $en_contact_id, 'page', true, $curr_lang);
$lang_contact_url = get_permalink($lang_contact);

$en_download = get_page_by_path('/resources/downloads/');
$en_download_id = $en_download->ID;
$lang_download = apply_filters('wpml_object_id', $en_download_id, 'page', true, $curr_lang);
$lang_download_url = get_permalink($lang_download);
?>
                                    <div class="d-block d-lg-inline me-4"><a
                                            href="<?=$lang_contact_url?>"><?=__('Contact', 'cb-hydronix')?></a>
                                    </div>
                                    <div class="d-block d-lg-inline me-4"><a
                                            href="<?=$lang_download_url?>"><?=__('Downloads', 'cb-hydronix')?></a>
                                    </div>
                                    <?php
/*
<div class="d-block d-lg-inline me-4"><a href="#">Partners</a></div>
*/
?>
                                </div>
                            </div>
                        </div>
                        <div class="d-inline d-lg-none me-2 align-self-end mb-3 mobile-lang-nav"><?php
                        wp_nav_menu(array(
                            'theme_location'  => 'lang_nav',
                            'container_class' => 'd-inline-block',
                            'menu_class' => 'navbar-nav',
                            'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
                        ))
?></div>
                        <div class="d-lg-none align-self-end mb-3 ml-auto">
                            <a href="/search/" class="me-2"><i class="fa fa-search"></i></a>
                            <button class="navbar-toggler collapsed align-self-end ml-auto input-button me-2"
                                id="navToggle" data-bs-toggle="collapse" data-bs-target="#primaryNav" type="button"
                                style="border-color: rgba(0,0,0,.5);">
                                <span class="navbar-icon"><i class="fa fa-bars"></i></span>
                                <div class="close-icon py-1"><i class="fa fa-times"></i></div>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="container-xl" id="main-nav">
                    <?php
$menuExists = wp_nav_menu(
    array(
        'theme_location' => 'primary_nav',
        'container'      => 'nav',
        'menu_class'     => 'right no-bullets no-margin',
        'fallback_cb'    => false,
        'echo'           => false,
    )
);
if (!$menuExists) {
    ?>
                    <div class="navbar-nav w-100 justify-content-between align-items-lg-center py-2">&nbsp;</div>
                    <?php
}

?>
                    <?php
    wp_nav_menu(
        array(
                                        'theme_location'  => 'primary_nav',
                                        'container_class' => 'collapse navbar-collapse',
                                        'container_id'    => 'primaryNav',
                                        'menu_class'      => 'navbar-nav w-100 justify-content-between align-items-lg-center',
                                        'fallback_cb'     => '',
                                        'menu_id'         => 'main-menu',
                                        'depth'           => 3,
                                        'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
                                    )
    );
?>
                </div>
            </nav>
        </div>
        <style>
            /* ============ desktop view ============ */
            @media all and (min-width: 992px) {
                .dropdown-menu li {
                    position: relative;
                }

                .nav-item .submenu {
                    display: none;
                    position: absolute;
                    left: 100%;
                    top: -7px;
                }

                .nav-item .submenu-left {
                    right: 100%;
                    left: auto;
                }

                .dropdown-menu>li:hover {
                    background-color: #f1f1f1
                }

                .dropdown-menu>li:hover>.submenu {
                    display: block;
                }
            }

            /* ============ desktop view .end// ============ */

            /* ============ small devices ============ */
            @media (max-width: 991px) {
                .dropdown-menu .dropdown-menu {
                    margin-left: 0.7rem;
                    margin-right: 0.7rem;
                    margin-bottom: .5rem;
                }
            }

            /* ============ small devices .end// ============ */
        </style>
        <?php
add_action('wp_footer', function () {
    ?>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // make it as accordion for smaller screens
                if (window.innerWidth < 992) {

                    // close all inner dropdowns when parent is closed
                    document.querySelectorAll('.navbar .dropdown').forEach(function(everydropdown) {
                        everydropdown.addEventListener('hidden.bs.dropdown', function() {
                            // after dropdown is hidden, then find all submenus
                            this.querySelectorAll('.submenu').forEach(function(everysubmenu) {
                                // hide every submenu as well
                                everysubmenu.style.display = 'none';
                            });
                        })
                    });

                    document.querySelectorAll('.dropdown-menu a').forEach(function(element) {
                        element.addEventListener('click', function(e) {
                            let nextEl = this.nextElementSibling;
                            if (nextEl && nextEl.classList.contains('submenu')) {
                                // prevent opening link if link needs to open dropdown
                                e.preventDefault();
                                if (nextEl.style.display == 'block') {
                                    nextEl.style.display = 'none';
                                } else {
                                    nextEl.style.display = 'block';
                                }

                            }
                        });
                    })
                }
                // end if innerWidth
            });

            (function($) {

                $('#searchTrigger').on('click', function(e) {
                    e.stopPropagation();
                    console.log('clunk');
                    $('#searchBox').toggleClass('d-none');
                });

                $('#searchTriggerM').on('click', function(e) {
                    e.stopPropagation();
                    console.log('click');
                    $('#searchBox').toggleClass('d-none');
                });

                $('#closeTrigger').on('click', function(e) {
                    e.stopPropagation();
                    $('#searchBox').addClass('d-none');
                });

            })(jQuery);
        </script>
        <?php
}, 9999);
?>