<?php
$bg = wp_get_attachment_image_url(get_field('background'), 'full');
?>
<!-- product_range_nav -->
<section class="product_range_nav"
    style="background-image:url(<?=$bg?>)">
    <!-- <div class="overlay"></div> -->
    <div class="container-xl">
        <h2><?=__('Our Product Range', 'cb-hydronix')?>
        </h2>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <?php
                $pageID = get_page_by_path('/measure/concrete-construction/');
$pageIDLang = apply_filters('wpml_object_id', $pageID->ID, 'page');
$pageLink = get_the_permalink($pageIDLang);
?>
                <a href="<?=$pageLink?>">
                    <div class="product_range_nav__card">
                        <div class="product_range_nav__title">
                            <?=__('Concrete &amp; Construction', 'cb-hydronix')?>
                        </div>
                        <div class="product_range_nav__icon">
                            <img src="<?=get_stylesheet_directory_uri()?>/img/icons/icon__concrete-construction--blue.svg"
                                width=170 height=160
                                alt="<?=__('Concrete & Construction', 'cb-hydronix')?>">
                        </div>
                        <div class="product_range_nav__description">
                            <?=__('Robust and durable sensors for harsh environments.', 'cb-hydronix')?>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-4">
                <?php
$pageID = get_page_by_path('/measure/grain-bulk-solids/');
$pageIDLang = apply_filters('wpml_object_id', $pageID->ID, 'page');
$pageLink = get_the_permalink($pageIDLang);
?>
                <a href="<?=$pageLink?>">
                    <div class="product_range_nav__card">
                        <div class="product_range_nav__title">
                            <?=__('Grain &amp; Bulk Solids', 'cb-hydronix')?>
                        </div>
                        <div class="product_range_nav__icon">
                            <img src="<?=get_stylesheet_directory_uri()?>/img/icons/icon__bulk-solids--blue.svg"
                                width=170 height=160
                                alt="<?=__('Bulk Solids', 'cb-hydronix')?>">
                        </div>
                        <div class="product_range_nav__description">
                            <?=__('Range of sensors for bulk solids installations.', 'cb-hydronix')?>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-4">
                <?php
$pageID = get_page_by_path('/measure/high-temperature/');
$pageIDLang = apply_filters('wpml_object_id', $pageID->ID, 'page');
$pageLink = get_the_permalink($pageIDLang);
?>
                <a href="<?=$pageLink?>">
                    <div class="product_range_nav__card">
                        <div class="product_range_nav__title">
                            <?=__('High Temperature', 'cb-hydronix')?>
                        </div>
                        <div class="product_range_nav__icon">
                            <img src="<?=get_stylesheet_directory_uri()?>/img/icons/icon__high-temperature--blue.svg"
                                width=170 height=160
                                alt="<?=__('High Temperature', 'cb-hydronix')?>">
                        </div>
                        <div class="product_range_nav__description">
                            <?=__('Sensors with operating temperature range of up to 120°C.', 'cb-hydronix')?>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-4">
                <?php
$pageID = get_page_by_path('/measure/liquids/');
$pageIDLang = apply_filters('wpml_object_id', $pageID->ID, 'page');
$pageLink = get_the_permalink($pageIDLang);
?>
                <a href="<?=$pageLink?>">
                    <div class="product_range_nav__card">
                        <div class="product_range_nav__title">
                            <?=__('Liquids', 'cb-hydronix')?>
                        </div>
                        <div class="product_range_nav__icon">
                            <img src="<?=get_stylesheet_directory_uri()?>/img/icons/icon__liquids--blue.svg"
                                width=170 height=160
                                alt="<?=__('Liquids', 'cb-hydronix')?>">
                        </div>
                        <div class="product_range_nav__description">
                            <?=__('Digital sensor for measuring moisture or dissolved liquids', 'cb-hydronix')?>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-4">
                <?php
$pageID = get_page_by_path('/measure/explosive-atmosphere/');
$pageIDLang = apply_filters('wpml_object_id', $pageID->ID, 'page');
$pageLink = get_the_permalink($pageIDLang);
?>
                <a href="<?=$pageLink?>">
                    <div class="product_range_nav__card">
                        <div class="product_range_nav__title">
                            <?=__('Explosive Atmosphere', 'cb-hydronix')?>
                        </div>
                        <div class="product_range_nav__icon">
                            <img src="<?=get_stylesheet_directory_uri()?>/img/icons/icon__explosive-atmosphere--blue.svg"
                                width=170 height=160
                                alt="<?=__('Explosive Atmosphere', 'cb-hydronix')?>">
                        </div>
                        <div class="product_range_nav__description">
                            <?=__('Sensors certified in use for explosive atmosphere (dust) environments.', 'cb-hydronix')?>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-4">
                <?php
$pageID = get_page_by_path('/measure/food-safe/');
$pageIDLang = apply_filters('wpml_object_id', $pageID->ID, 'page');
$pageLink = get_the_permalink($pageIDLang);
?>
                <a href="<?=$pageLink?>">
                    <div class="product_range_nav__card">
                        <div class="product_range_nav__title">
                            <?=__('Food Safe', 'cb-hydronix')?>
                        </div>
                        <div class="product_range_nav__icon">
                            <img src="<?=get_stylesheet_directory_uri()?>/img/icons/icon__food-safe--blue.svg"
                                width=170 height=160
                                alt="<?=__('Food Safe', 'cb-hydronix')?>">
                        </div>
                        <div class="product_range_nav__description">
                            <?=__('Sensor certified in use for Food Safe measure. ', 'cb-hydronix')?>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>