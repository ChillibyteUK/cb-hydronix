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
                <div class="mb-4"><?=__('To ensure that our customers receive the best possible sales and support assistance, Hydronix has offices located across the world. Our head office is in the UK, and we also have offices in the US, Germany, France and China.','cb-hydronix')?></div>
                <a href="<?=__('/about-hydronix/contact-us/','cb-hydronix')?>" class="btn btn--orange mb-3"><?=__('Get in touch','cb-hydronix')?></a>
                <div class="social-icons mb-2">
                    <?php
                    $social = get_field('social', 'options');
                    if ($social['facebook_url']) {
                        ?>
                    <a href="<?=$social['facebook_url']?>" target="_blank"><i class="fa fa-facebook-f"></i></a>
                        <?php
                    }
                    if ($social['twitter_url']) {
                        ?>
                    <a href="<?=$social['twitter_url']?>" target="_blank"><i class="fa fa-twitter"></i></a>
                        <?php
                    }
                    if ($social['linkedin_url']) {
                        ?>
                    <a href="<?=$social['linkedin_url']?>" target="_blank"><i class="fa fa-linkedin"></i></a>
                        <?php
                    }
                    if ($social['instagram_url']) {
                        ?>
                    <a href="<?=$social['instagram_url']?>" target="_blank"><i class="fa fa-instagram"></i></a>
                        <?php
                    }
                    if ($social['youtube_url']) {
                        ?>
                    <a href="<?=$social['youtube_url']?>" target="_blank"><i class="fa fa-youtube"></i></a>
                        <?php
                    }
                    ?>
                </div>

            </div>
            <div class="col-lg-3">
                <div class="h5"><?=__('Industries','cb-hydronix')?></div>
                <?=wp_nav_menu( array('theme_location' => 'footer_menu1') )?>
            </div>
            <div class="col-lg-3">
                <div class="h5"><?=__('Applications','cb-hydronix')?></div>
                <?=wp_nav_menu( array('theme_location' => 'footer_menu2') )?>
            </div>
            <div class="col-lg-2">
                <div class="h5"><?=__('Popular Links','cb-hydronix')?></div>
                <?=wp_nav_menu( array('theme_location' => 'footer_menu3') )?>
            </div>
        </div>
    </div>
</div>
<div class="colophon">
    <div class="container py-2">
        <div class="d-flex flex-wrap justify-content-between">
            <div class="col-md-6">
                &copy; <?=date('Y')?> Hydronix Ltd. Registered in England No. 01609365
            </div>
            <div class="col-md-6 d-flex align-items-center justify-content-end">
                <div class="link"><a href="<?=__('/privacy-policy/','cb-hydronix')?>"><?=__('Privacy & Cookies','cb-hydronix')?></a></div>
                <div class="link"><a href="<?=__('/contact-us/','cb-hydronix')?>"><?=__('Sales','cb-hydronix')?></a></div>
                <div class="link"><a href="<?=__('/contact-support/','cb-hydronix')?>"><?=__('Support','cb-hydronix')?></a></div>
                <a href="https://www.chillibyte.co.uk/" rel="nofollow noopener" target="_blank" class="cb" title="<?=__('Digital Marketing by','cb-hydronix')?> Chillibyte"></a>
            </div>
        </div>
    </div>
</div>
<?php wp_footer();
if (get_field('gtm_property', 'options')) {
    ?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?=get_field('gtm_property', 'options')?>" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    <?php
}
?>
</body>

</html>