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
                        target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                    <?php
}
if ($social['twitter_url'] ?? null) {
    ?>
                    <a href="<?=$social['twitter_url']?>"
                        target="_blank"><i class="fa-brands fa-x-twitter"></i></a>
                    <?php
}
if ($social['linkedin_url'] ?? null) {
    ?>
                    <a href="<?=$social['linkedin_url']?>"
                        target="_blank"><i class="fa-brands fa-linkedin"></i></a>
                    <?php
}
if ($social['instagram_url'] ?? null) {
    ?>
                    <a href="<?=$social['instagram_url']?>"
                        target="_blank"><i class="fa-brands fa-instagram"></i></a>
                    <?php
}
if ($social['youtube_url'] ?? null) {
    ?>
                    <a href="<?=$social['youtube_url']?>"
                        target="_blank"><i class="fa-brands fa-youtube"></i></a>
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
<script type="text/javascript">
sc_var_lang = document.URL;
sc_var_regx = /hydronix.com\/.*\//;
sc_var_lang = sc_var_lang.match(sc_var_regx)[0].split('/')[1];
sc_var_lang_array = [
  {"lang": "default", "sc_project": 2314988, "sc_security": "7cab6657"},
  {"lang": "zh-hans", "sc_project": 6852770, "sc_security": "0c519325"},
  {"lang": "fr", "sc_project": 4790275, "sc_security": "1c33b885"},
  {"lang": "de", "sc_project": 4790279, "sc_security": "7f1485bb"},
  {"lang": "it", "sc_project": 4790282, "sc_security": "d11252ab"},
  {"lang": "ru", "sc_project": 4790271, "sc_security": "e8c90801"},
  {"lang": "es", "sc_project": 4790285, "sc_security": "d3ba65ba"},
  {"lang": "tr", "sc_project": 11297195, "sc_security": "83b658e1"},
  {"lang": "uk", "sc_project": 12965237, "sc_security": "af1fe84b"},
  {"lang": "pt-pt", "sc_project": 9839444, "sc_security": "d47c1fb9"},
];
lang_match = sc_var_lang_array.find(sc_var_lang_array => sc_var_lang_array.lang === sc_var_lang);
try {lang_match.length} catch(e) {lang_match = sc_var_lang_array[0];}
var sc_project=lang_match.sc_project;
var sc_invisible=0;
var sc_security=lang_match.sc_security;
var sc_https=1;
</script>
<script type="text/javascript" src="https://www.statcounter.com/counter/counter.js"></script>
<?php wp_footer();
?>
</body>

</html>