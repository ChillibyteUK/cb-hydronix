<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;
?>
<div id="footer-top"></div>
<div class="footer pt-4 pb-2">
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-4">
                <div class="h5">Hydronix</div>
                <div class="mb-4">
                    <?=__('To ensure that our customers receive the best possible sales and support assistance, Hydronix has offices located across the world. Our head office is in the UK, and we also have offices in the US, Germany, France and China.', 'cb-hydronix')?>
                </div>
                <a href="<?=__('/about-hydronix/contact-us/', 'cb-hydronix')?>"
                    class="btn btn--orange mb-3"><?=__('Get in touch', 'cb-hydronix')?></a>
                <div class="social-icons mb-2">
                    <?php
                    $social = get_field('social', 'options');
if ($social['facebook_url'] ?? null) {
    ?>
                    <a href="<?=$social['facebook_url']?>"
                        target="_blank"><i class="fa fa-facebook-f"></i></a>
                    <?php
}
if ($social['twitter_url'] ?? null) {
    ?>
                    <a href="<?=$social['twitter_url']?>"
                        target="_blank"><i class="fa fa-twitter"></i></a>
                    <?php
}
if ($social['linkedin_url'] ?? null) {
    ?>
                    <a href="<?=$social['linkedin_url']?>"
                        target="_blank"><i class="fa fa-linkedin"></i></a>
                    <?php
}
if ($social['instagram_url'] ?? null) {
    ?>
                    <a href="<?=$social['instagram_url']?>"
                        target="_blank"><i class="fa fa-instagram"></i></a>
                    <?php
}
if ($social['youtube_url'] ?? null) {
    ?>
                    <a href="<?=$social['youtube_url']?>"
                        target="_blank"><i class="fa fa-youtube"></i></a>
                    <?php
}
?>
                </div>

            </div>
            <div class="col-lg-3">
                <?php
                $menuExists = wp_nav_menu(
                    array(
                    'theme_location' => 'footer_menu1',
                    'container'      => 'nav',
                    'menu_class'     => 'right no-bullets no-margin',
                    'fallback_cb'    => false,
                    'echo'           => false,
                    )
                );
if ($menuExists) {
    ?>
                <div class="h5">
                    <?=__('Industries', 'cb-hydronix')?>
                </div>
                <?=wp_nav_menu(array('theme_location' => 'footer_menu1'))?>
                <?php
}
?>
            </div>
            <div class="col-lg-3">
                <?php
$menuExists = wp_nav_menu(
    array(
        'theme_location' => 'footer_menu2',
        'container'      => 'nav',
        'menu_class'     => 'right no-bullets no-margin',
        'fallback_cb'    => false,
        'echo'           => false,
    )
);
if ($menuExists) {
    ?>
                <div class="h5">
                    <?=__('Applications', 'cb-hydronix')?>
                </div>
                <?=wp_nav_menu(array('theme_location' => 'footer_menu2'))?>
                <?php
}
?>
            </div>
            <div class="col-lg-2">
                <?php
$menuExists = wp_nav_menu(
    array(
        'theme_location' => 'footer_menu3',
        'container'      => 'nav',
        'menu_class'     => 'right no-bullets no-margin',
        'fallback_cb'    => false,
        'echo'           => false,
    )
);
if ($menuExists) {
    ?>
                <div class="h5">
                    <?=__('Popular Links', 'cb-hydronix')?>
                </div>
                <?=wp_nav_menu(array('theme_location' => 'footer_menu3'))?>
                <?php
}
?>
            </div>
        </div>
    </div>
</div>
<div class="colophon">
    <div class="container py-2">
        <div class="d-flex flex-wrap justify-content-between">
            <div class="col-md-6">
                &copy; <?=date('Y')?> Hydronix
                Ltd. Registered in England No. 01609365
            </div>
            <div class="col-md-6 d-flex align-items-center justify-content-end">
                <?php
global $sitepress;
$current_lang = apply_filters('wpml_current_language', null);
// cbdump($current_lang);
$policies = get_field('policy_docs', 'options');
// cbdump($policies);
foreach ($policies as $p) {
    if ($p['language_code'] != $current_lang) {
        continue;
    }
    if ($p['type'] == 'Cookies') {
        $cookies = $p['file'];
    }
    if ($p['type'] == 'Privacy') {
        $privacy = $p['file'];
    }
}
?>
                <div class="link"><a href="<?=$privacy?>"
                        target="_blank"><?=__('Privacy', 'cb-hydronix')?></a>
                </div>
                <div class="link"><a href="<?=$cookies?>"
                        target="_blank"><?=__('Cookies', 'cb-hydronix')?></a>
                </div>
                <div class="link"><a
                        href="<?=__('/about-hydronix/contact-us/', 'cb-hydronix')?>"><?=__('Sales', 'cb-hydronix')?></a>
                </div>
                <div class="link"><a
                        href="<?=__('/contact-support/', 'cb-hydronix')?>"><?=__('Support', 'cb-hydronix')?></a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php wp_footer();
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
</body>

</html>