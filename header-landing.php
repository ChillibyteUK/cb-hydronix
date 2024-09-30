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
    <link rel="preload"
        href="<?php echo get_stylesheet_directory_uri(); ?>/fonts/frutiger-45-light-webfont.woff2"
        as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload"
        href="<?php echo get_stylesheet_directory_uri(); ?>/fonts/frutiger-55-roman-webfont.woff2"
        as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload"
        href="<?php echo get_stylesheet_directory_uri(); ?>/fonts/frutiger-65-bold-webfont.woff2"
        as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload"
        href="<?php echo get_stylesheet_directory_uri(); ?>/fonts/frutiger-75-black-webfont.woff2"
        as="font" type="font/woff2" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
<?php
}
?>
    <?php
do_action('wp_body_open');
$home_url = apply_filters('wpml_home_url', get_option('home'));

$l = $curr_lang == 'en' ? '/' : '/' . $curr_lang . '/';
?>
<header>
    <div class="container-xl py-2 text-center bg--light">
        <img src="<?=get_stylesheet_directory_uri()?>/img/hydronix-logo.svg" alt="Hydronix" width="105" height="73">
    </div>
</header>
    <div class="site" id="page">
