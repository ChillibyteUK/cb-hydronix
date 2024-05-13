<?php
/**
 * The template for displaying all single posts
 *
 * @package cb-peoplesafe
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

add_action('wp_head', function () {
    echo '<link rel="stylesheet" href="' . get_stylesheet_directory_uri() . '/css/jquery.fancybox.min.css" />';
    echo '<link rel="stylesheet" href="' . get_stylesheet_directory_uri() . '/css/lightslider.min.css" />';
});


get_header();
the_post();

$bg = wp_get_attachment_image_url(get_field('hero_background'), 'full');
if ($bg == '') {
    $bg = '/wp-content/uploads/2022/09/product-bg-organic-2.jpg';
}
$ptype = array_shift(get_the_terms(get_the_ID(), 'ptype'));
?>
<main id="main">
    <!-- hero -->
    <section class="phero" style="background-image:url(<?=$bg?>)">
        <div class="container my-auto pb-5">
            <div class="row">
                <div class="col-lg-7 d-flex justify-content-center align-items-center px-5">
                    <?php
                    if (get_the_post_thumbnail_url(get_the_ID(), 'full')) {
                        ?>
                    <img src="<?=get_the_post_thumbnail_url(get_the_ID(), 'full')?>"
                        class="phero__image">
                    <?php
                    }
?>
                </div>
                <div class="col-lg-5 phero__content d-flex flex-column my-auto">
                    <h1><?=get_the_title()?></h1>
                    <div class="phero__subtitle mb-4">
                        <?=get_field('hero_subtitle')?>
                    </div>
                    <div class="d-flex justify-content-between flex-wrap">
                        <a class="btn btn--orange mb-2"
                            href="#form"><?=__('Request More Info', 'cb-hydronix')?></a>
                        <a class="btn btn--green mb-2 d-none" id="docBtn"
                            href="#docs"><?=__('Download Resources', 'cb-hydronix')?></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--section class="sub_page_title py-1 mb-4">
    <div class="container-xl">
        <?php
        if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
        }
?>
    </div>
    </section-->
    <?php
    $thisApp = get_the_terms(get_the_ID(), 'applications');
        
$allApps = get_terms(array('taxonomy'=>'applications','hide_empty'=>false)) ?? null;
$thisAppIDs = wp_list_pluck($thisApp, 'term_id') ?? null;

if ($thisApp) {
    $appIDs = wp_list_pluck($allApps, 'term_id');
    ?>
    <div class="container py-4">
        <h2 class="fs-4 text-center mb-4">
            <?=__('Typical Applications', 'cb-hydronix')?>
        </h2>
        <div class="applications row g-4">
            <?php
    global $sitepress;

    foreach ($allApps as $a) {
        // inactive defaults - grey on desktop blue on mobile
        $icon = '--grey'; // TODO - colour icons
        $icon2 = '--blue'; // TODO - colour icons
        $active = '';
            
        $en_id = apply_filters('wpml_object_id', $a->term_id, 'applications', true, 'en');

        $current_lang = apply_filters('wpml_current_language', null);
        $sitepress->switch_lang('en');
        $en_term = get_term($en_id, 'applications');
        $sitepress->switch_lang($current_lang);

        $imgslug = $en_term->slug;


        foreach ($thisAppIDs as $i) {
            if ($i == $a->term_id) {
                // active - blue on desktop colour on mobile
                $icon = '--blue'; //
                $icon2 = '--colour'; //
                $active = 'active';
            }
        }
        ?>
            <div
                class="col-sm-4 col-lg-2 applications__card <?=$active?>">
                <a
                    href="<?=__('/measure/', 'cb-hydronix')?><?=$a->slug?>/">
                    <img class="d-md-none"
                        src="<?=get_stylesheet_directory_uri()?>/img/icons/icon__<?=$imgslug?><?=$icon2?>.svg"
                        alt="X <?=$icon2?>">
                    <img class="d-none d-md-block"
                        src="<?=get_stylesheet_directory_uri()?>/img/icons/icon__<?=$imgslug?><?=$icon?>.svg"
                        alt="X <?=$icon?>">
                    <div class="applications__title"><?=$a->name?>
                    </div>
                </a>
            </div>
            <?php
    }
    ?>
        </div>
    </div>
    <?php
}
$img = '/wp-content/uploads/2022/09/loader-1846346.jpg';
if (get_field('detail_bg') != '') {
    // echo 'DETBG:' . get_field('detail_bg');
    $img = wp_get_attachment_image_url(get_field('detail_bg'), 'full');
}
?>
    <section class="details py-5"
        style="background-image:url(<?=$img?>)">
        <div class="container responsive-tabs">
            <ul id="tabs" class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a id="overview" href="#pane-Overview" class="nav-link active" data-bs-toggle="tab"
                        role="tab"><?=__('Overview', 'cb-hydronix')?></a>
                </li>
                <?php
            if (get_field('installation_points')) {
                ?>
                <li class="nav-item">
                    <a id="installation" href="#pane-Installation" class="nav-link" data-bs-toggle="tab"
                        role="tab"><?=__('Installation', 'cb-hydronix')?></a>
                </li>
                <?php
            }
if (get_field('installation_by_connectivity')) {
    ?>
                <li class="nav-item">
                    <a id="installationConn" href="#pane-InstallationConn" class="nav-link" data-bs-toggle="tab"
                        role="tab"><?=__('Installation by Connectivity', 'cb-hydronix')?></a>
                </li>
                <?php
}
if (get_field('accessories')) {
    ?>
                <li class="nav-item">
                    <a id="accessories" href="#pane-Accessories" class="nav-link" data-bs-toggle="tab"
                        role="tab"><?=__('Accessories', 'cb-hydronix')?></a>
                </li>
                <?php
}
$txterm = icl_object_id('measure', 'ptype', true);
if (has_term($txterm, 'ptype')) {
    // if (has_term('measure','ptype')) {
    ?>
                <li class="nav-item">
                    <a id="features" href="#pane-Features" class="nav-link" data-bs-toggle="tab"
                        role="tab"><?=__('Features', 'cb-hydronix')?></a>
                </li>
                <?php
}
if (get_field('interfaces')) {
    ?>
                <li class="nav-item">
                    <a id="connectivity" href="#pane-Connectivity" class="nav-link" data-bs-toggle="tab"
                        role="tab"><?=__('Connectivity', 'cb-hydronix')?></a>
                </li>
                <?php
}
if (get_field('products')) {
    ?>
                <li class="nav-item">
                    <a id="products" href="#pane-Products" class="nav-link" data-bs-toggle="tab"
                        role="tab"><?=__('Associated Products', 'cb-hydronix')?></a>
                </li>
                <?php
}
?>
            </ul>

            <div id="content" class="tab-content" role="tablist">
                <div id="pane-Overview" class="card tab-pane fade show active" role="tabpanel"
                    aria-labelledby="overview">
                    <div class="card-header" role="tab" id="heading-Overview">
                        <div class="h5 mb-0">
                            <a data-bs-toggle="collapse" href="#collapse-Overview" aria-expanded="true"
                                aria-controls="collaspe-Overview">
                                <?=__('Overview', 'cb-hydronix')?>
                            </a>
                        </div>
                    </div>
                    <div id="collapse-Overview" class="collapse show" data-bs-parent="#content" role="tabpanel"
                        aria-labelledby="heading-Overview">
                        <div class="card-body py-5">
                            <div class="row">
                                <div class="col-lg-8 order-2 order-lg-1 cols-lg-2">
                                    <?php
                    if (get_field('overview')) {
                        ?>
                                    <h3 class="fs-5 mb-3">
                                        <?=__('Measurement', 'cb-hydronix')?>:
                                    </h3>
                                    <ul>
                                        <?=cb_list(get_field('overview'))?>
                                    </ul>
                                    <?php
                    }
if (get_field('typical_materials')) {
    ?>
                                    <h3 class="fs-5 mb-3">
                                        <?=__('Typical Materials', 'cb-hydronix')?>:
                                    </h3>
                                    <ul>
                                        <?=cb_list(get_field('typical_materials'))?>
                                    </ul>
                                    <?php
}
if (get_field('installation')) {
    ?>
                                    <h3 class="fs-5 mb-3">
                                        <?=__('Installation Points', 'cb-hydronix')?>:
                                    </h3>
                                    <ul>
                                        <?=cb_list(get_field('installation'))?>
                                    </ul>
                                    <?php
}
if (get_field('key_features')) {
    ?>
                                    <h3 class="fs-5 mb-3">
                                        <?=__('Unique Key Features', 'cb-hydronix')?>:
                                    </h3>
                                    <ul>
                                        <?=cb_list(get_field('key_features'))?>
                                    </ul>
                                    <?php
}
if (is_array($allApps)) {
    ?>
                                    <div class="badges">
                                        <?php
                                                
        foreach ($allApps as $a) {

            $en_id = apply_filters('wpml_object_id', $a->term_id, 'applications', true, 'en');

            $current_lang = apply_filters('wpml_current_language', null);
            $sitepress->switch_lang('en');
            $en_term = get_term($en_id, 'applications');
            $sitepress->switch_lang($current_lang);
                                    
            $imgslug = $en_term->slug;
            foreach ($thisAppIDs as $i) {
                if ($i == $a->term_id) {
                    if ($imgslug == 'food-safe') {
                        echo '<div class="badge badge--food-safe" title="Food Safe"></div>';
                    }
                    if ($imgslug == 'explosive-atmosphere') {
                        echo '<div class="badge badge--atex" title="ATEX"></div>';
                        echo '<div class="badge badge--etl" title="Intertek ETL"></div>';
                    }
                    if ($imgslug == 'high-temperature') {
                        echo '<div class="badge badge--high-temp" title="High Temperature"></div>';
                    }
                }
            }
        }
    ?>
                                    </div>
                                    <?php
}
?>
                                </div>
                                <div class="col-lg-4 order-1 order-lg-3">
                                    <?php
echo '<!--';
echo var_dump(get_field('views'));
echo '-->';
                                                                            
if (!get_field('views', get_the_ID())) {
    ?>
                                    <img src="<?=get_the_post_thumbnail_url(get_the_ID(), 'full')?>"
                                        class="">
                                    <?php
} else {
    ?>
                                    <div class="tl_slide_photo_container mb-5">
                                        <ul class="image-gallery" id="light-slider">

                                            <?php
    // echo get_the_post_thumbnail($id,'large',['class' => 'viewSlider']);
    foreach (get_field('views', get_the_ID()) as $i) {

        ?>
                                            <li
                                                data-thumb="<?=wp_get_attachment_image_url($i, 'medium')?>">
                                                <a href="<?=wp_get_attachment_image_url($i, 'full')?>"
                                                    data-fancybox="gallery">
                                                    <img
                                                        src="<?=wp_get_attachment_image_url($i, 'large')?>">
                                                </a>
                                            </li>
                                            <?php
        echo wp_get_attachment_image($id, 'large', '', ['class' => 'viewSlider']);
    }
    if (get_field('video_id')) {
        $vid = get_field('video_id');
        $thumb = get_vimeo_data_from_id($vid, 'thumbnail_url') ?: get_stylesheet_directory_uri() . "/img/missing-video.png" ;
        ?>
                                            <li
                                                data-thumb="<?=$thumb?>">
                                                <a href="https://player.vimeo.com/video/<?=get_field('video_id')?>?byline=0&portrait=0"
                                                    data-fancybox="gallery">
                                                    <img
                                                        src="<?=get_stylesheet_directory_uri()?>/img/missing-video.png">
                                                    <!-- <div class="ratio ratio-16x9 mx-auto">
                                                        <iframe src="https://player.vimeo.com/video/<?=get_field('vimeo_id')?>?byline=0&portrait=0"
                                                    allow="autoplay; fullscreen; picture-in-picture"
                                                    webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                    </div> -->
                                    </a>
                                    </li>
                                    <?php
    }
    ?>
                                    </ul>
                                </div>
                                <?php
    add_action('wp_footer', function () {
        ?>
                                <script
                                    src="<?=get_stylesheet_directory_uri()?>/js/lightslider.min.js">
                                </script>
                                <script
                                    src="<?=get_stylesheet_directory_uri()?>/js/jquery.fancybox.min.js">
                                </script>
                                <script>
                                    (function($) {
                                        h_slider = $('#light-slider').lightSlider({
                                            gallery: true,
                                            item: 1,
                                            auto: false,
                                            loop: false,
                                            slideMargin: 0,
                                            thumbItem: 9,
                                            galleryMargin: 10,
                                            thumbMargin: 5,
                                            onSliderLoad: function() {
                                                $("img").addClass("preferredHeight");
                                            },
                                            onMove: function(el, v) {
                                                if (el == $slider1) {
                                                    $slider2.css({
                                                        'transform': 'translate3d(0px, ' + (-
                                                            v) + 'px, 0px)',
                                                        '-webkit-transform': 'translate3d(0px, ' +
                                                            (-v) + 'px, 0px)',
                                                        'transition-duration': $slider1.css(
                                                            'transition-duration')
                                                    });
                                                }
                                            }
                                        });
                                        $selector = '#light-slider li:not(".clone") a';
                                        $().fancybox({
                                            selector: $selector,
                                            backFocus: false,
                                            // smallBtn: "auto",
                                            toolbar: "true",
                                            buttons: [
                                                'slideShow',
                                                //   'share',
                                                //   'zoom',
                                                'fullScreen',
                                                //   'thumbs',
                                                //   'download',
                                                'close'
                                            ]
                                        });
                                    })(jQuery);
                                </script>
                                <?php
    }, 9999);
    /*
    ?>
    <script>
    var slideIndex = 0;
    carousel();

    function carousel() {
      var i;
      var x = document.getElementsByClassName("viewSlider");
      for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
      }
      slideIndex++;
      if (slideIndex > x.length) {slideIndex = 1}
      x[slideIndex-1].style.display = "block";
      setTimeout(carousel, 2000); // Change image every 2 seconds
    }
    </script>
    <?php
    */

}
?>
                            </div>
                        </div>
                    </div>
                    <?php
                        if (get_the_terms(get_the_ID(), 'process')) {
                            ?>
                    <div class="container p-0">
                        <div class="process-steps">
                            <h2 class="fs-4 mb-2">
                                <?=__('Processes', 'cb-hydronix')?>
                            </h2>
                            <div class="d-flex flex-wrap justify-content-between">
                                <?php
                                $psteps = get_the_terms(get_the_ID(), 'process');
                            // cbdump($psteps);
                            foreach ($psteps as $p) {

                                $en_id = apply_filters('wpml_object_id', $p->term_id, 'process', true, 'en');

                                $current_lang = apply_filters('wpml_current_language', null);
                                $sitepress->switch_lang('en');
                                $en_term = get_term($en_id, 'process');
                                $sitepress->switch_lang($current_lang);
                        
                                $imgslug = $en_term->slug;

                                $f = '/img/icons/icon__' . $imgslug . '--wo.svg';
                                // if (!file_exists(get_stylesheet_directory() . $f)) {
                                //     $f = '/img/icons/icon__missing-wo.svg';
                                // }
                                ?>
                                <!-- <div class="col-6 col-md-4 col-lg-2 process-steps__step"> -->
                                <div class="process-steps__step">
                                    <a
                                        href="<?=__('/processes/', 'cb-hydronix')?><?=$p->slug?>/">
                                        <img src="<?=get_stylesheet_directory_uri()?><?=$f?>"
                                            class="mb-2"
                                            alt="<?=$p->slug?>">
                                        <div class="process-steps__name">
                                            <?=$p->name?></div>
                                    </a>
                                </div>
                                <?php
                            }
                            ?>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
?>
                </div>
            </div>
            <?php
                if (get_field('installation_points') ?? null) {
                    ?>
            <div id="pane-Installation" class="card tab-pane fade" role="tabpanel" aria-labelledby="installation">
                <div class="card-header" role="tab" id="heading-Installation">
                    <div class="h5 mb-0">
                        <a class="collapsed" data-bs-toggle="collapse" href="#collapse-Installation"
                            aria-expanded="true" aria-controls="collapse-Installation">
                            <?=__('Installation', 'cb-hydronix')?>
                        </a>
                    </div>
                </div>
                <div id="collapse-Installation" class="collapse" data-bs-parent="#content" role="tabpanel"
                    aria-labelledby="heading-Installation">
                    <div class="card-body py-5">
                        <div class="row g-4 justify-content-center">
                            <?php
                            foreach(get_field('installation_points') as $p) {
                                ?>
                            <div class="col-lg-6 col-xl-4">
                                <div class="install__card">
                                    <h3 class="fs-5 mb-3">
                                        <?=$p->name?></h3>
                                    <div class="row g-2">
                                        <div class="col-md-6 order-1 order-md-2 text-center">
                                            <a href="<?=wp_get_attachment_image_url(get_field('image', $p), 'large')?>"
                                                data-fancybox="gallery">
                                                <img
                                                    src="<?=wp_get_attachment_image_url(get_field('image', $p), 'medium')?>">
                                            </a>
                                            <!-- 20230310 <img src="<?=wp_get_attachment_image_url(get_field('image', $p), 'medium')?>">
                                            -->
                                        </div>
                                        <div class="col-md-6 order-2 order-md-1">
                                            <ul>
                                                <?=cb_list($p->description)?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            }
                    ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                }
if (get_field('installation_by_connectivity')) {
    ?>
            <div id="pane-InstallationConn" class="card tab-pane fade" role="tabpanel"
                aria-labelledby="installationConn">
                <div class="card-header" role="tab" id="heading-InstallationConn">
                    <div class="h5 mb-0">
                        <a class="collapsed" data-bs-toggle="collapse" href="#collapse-InstallationConn"
                            aria-expanded="true" aria-controls="collapse-Installation">
                            <?=__('Installation by Connectivity', 'cb-hydronix')?>
                        </a>
                    </div>
                </div>
                <div id="collapse-InstallationConn" class="collapse" data-bs-parent="#content" role="tabpanel"
                    aria-labelledby="heading-InstallationConn">
                    <div class="card-body py-5">
                        <?=get_field('installation_by_connectivity')?>
                    </div>
                </div>
            </div>
            <?php
}
if (get_field('accessories')) {
    ?>
            <div id="pane-Accessories" class="card tab-pane fade" role="tabpanel" aria-labelledby="accessories">
                <div class="card-header" role="tab" id="heading-Accessories">
                    <div class="h5 mb-0">
                        <a class="collapsed" data-bs-toggle="collapse" href="#collapse-Accessories" aria-expanded="true"
                            aria-controls="collapse-Accessories">
                            <?=__('Accessories', 'cb-hydronix')?>
                        </a>
                    </div>
                </div>
                <div id="collapse-Accessories" class="collapse" data-bs-parent="#content" role="tabpanel"
                    aria-labelledby="heading-Accessories">
                    <div class="card-body py-5">
                        <ul class="cols-lg-3 nopad">
                            <?php
            foreach (get_field('accessories') as $i) {
                // if (has_term('option','atype',$i)) {
                $img = get_the_post_thumbnail_url($i, 'full');
                // echo '<li><a href="' . $img . '" data-lightbox="gallery">' . get_the_title($i) . '</a></li>';
                echo '<li>' . get_the_title($i) . '</li>';
                // }
                // else {
                //     echo '<li><a href="' . get_the_permalink($i) . '">' . get_the_title($i) . '</a></li>';
                // }
            }
    ?>
                        </ul>
                    </div>
                </div>
            </div>
            <?php
                add_action('wp_footer', function () {
                    ?>
            <link rel="stylesheet"
                href="<?=get_stylesheet_directory_uri()?>/css/lightbox.min.css">
            <script
                src="<?=get_stylesheet_directory_uri()?>/js/lightbox.min.js">
            </script>
            <?php
                });

}

$txterm = icl_object_id('measure', 'ptype', true);
if (has_term($txterm, 'ptype')) {
    // if (has_term('measure','ptype')) {
    ?>
            <div id="pane-Features" class="card tab-pane fade" role="tabpanel" aria-labelledby="features">
                <div class="card-header" role="tab" id="heading-Features">
                    <div class="h5 mb-0">
                        <a class="collapsed" data-bs-toggle="collapse" href="#collapse-Features" aria-expanded="true"
                            aria-controls="collapse-Features">
                            <?=__('Features', 'cb-hydronix')?>
                        </a>
                    </div>
                </div>
                <div id="collapse-Features" class="collapse" data-bs-parent="#content" role="tabpanel"
                    aria-labelledby="heading-Features">
                    <div class="card-body py-5 cols-lg-3">
                        <?=get_field('features', 'options')?>
                    </div>
                </div>
            </div>
            <?php
}
if (get_field('interfaces')) {
    ?>
            <div id="pane-Connectivity" class="card tab-pane fade" role="tabpanel" aria-labelledby="connectivity">
                <div class="card-header" role="tab" id="heading-Connectivity">
                    <div class="h5 mb-0">
                        <a class="collapsed" data-bs-toggle="collapse" href="#collapse-Connectivity"
                            aria-expanded="true" aria-controls="collapse-Connectivity">
                            <?=__('Sensor Connectivity', 'cb-hydronix')?>
                        </a>
                    </div>
                </div>
                <div id="collapse-Connectivity" class="collapse" data-bs-parent="#content" role="tabpanel"
                    aria-labelledby="heading-Connectivity">
                    <div class="card-body pt-5">
                        <div class="row g-4">
                            <div class="col-xl-6">
                                <img class="d-flex mx-auto mb-3"
                                    src="<?=get_field('sensor_connectivity_with_io', 'options')?>"
                                    alt="">
                                <div class="text-center fst-italic">
                                    <?=__('Modbus to control system', 'cb-hydronix')?>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <img class="d-flex mx-auto mb-3"
                                    src="<?=get_field('sensor_connectivity', 'options')?>"
                                    alt="">
                                <div class="text-center fst-italic">
                                    <?=__('Input / Output connections', 'cb-hydronix')?>
                                </div>
                                <div class="py-4">
                                    <strong><?=__('Recommended field cabling', 'cb-hydronix')?>:</strong>
                                    <ul>
                                        <li><?=__('Six pairs twisted (12 cores total) screened (shielded) cable with 22 AWG, 0.35mm2 conductors', 'cb-hydronix')?>
                                        </li>
                                        <li><?=__('Screen (shield): Braid with 65% minimum coverage plus aluminium/polyester foil', 'cb-hydronix')?>
                                        </li>
                                        <li><?=__('Recommended cable types: Belden 8306, Alpha 6373', 'cb-hydronix')?>
                                        </li>
                                        <li><?=__('Maximum cable run: 100m, separate to any heavy equipment power cables', 'cb-hydronix')?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="row g-3 products">
                            <?php
            foreach (get_field('interfaces') as $i) {
                if (get_post_status($i) != 'publish') {
                    continue;
                }
                if (has_term('option', 'atype', $i)) {
                    ?>
                            <div class="col-sm-6 col-lg-3">
                                <div class="product__card"
                                    href="<?=get_the_permalink($i)?>">
                                    <img
                                        src="<?=get_the_post_thumbnail_url($i, 'medium')?>">
                                    <div><?=get_the_title($i)?></div>
                                </div>
                            </div>
                            <?php
                } else {
                    ?>
                            <div class="col-sm-6 col-lg-3">
                                <a class="product__card"
                                    href="<?=get_the_permalink($i)?>">
                                    <img
                                        src="<?=get_the_post_thumbnail_url($i, 'medium')?>">
                                    <div><?=get_the_title($i)?></div>
                                </a>
                            </div>
                            <?php
                }
            }
    ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php
}
?>
            </div>
        </div>

    </section>
    <section id="form" class="py-5">
        <div class="container col-lg-8 offset-lg-2">
            <h2 class="h2 text--blue mb-4">
                <?=__('Enquire about', 'cb-hydronix')?>
                <?=get_the_title()?></h2>
            <!--[if lte IE 8]>
            <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2-legacy.js"></script>
            <![endif]-->
            <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
            <?php
            $e = get_field('enquiry_form', 'options');
$sku = get_field('product_code') == '' ? get_the_title() : get_field('product_code');
?>
            <script>
                hbspt.forms.create({
                    region: "<?=$e['region']?>",
                    portalId: "<?=$e['portal_id']?>",
                    formId: "<?=$e['form_id']?>",
                    onFormSubmit: function($form, ctx) {
                        $form.find('input[name="product_enquiry_field"]').val(
                            '<?=$sku?>').change();
                    }
                });
            </script>
        </div>
    </section>
    <?php
    require_once CB_THEME_DIR . '/page-templates/blocks/cb_support_cta.php';


// ob_start();
$hasContent = 0;
?>
    <section id="docs" class="resources py-5">
        <div class="container-xl">
            <h2 class="mb-4">
                <?=__('Resources', 'cb-hydronix')?>
            </h2>
            <?php

$currLang = apply_filters('wpml_current_language', null);

?>
            <style>
                .dl_card {
                    border: 1px solid #2988bf;
                    height: 100%;
                    display: flex;
                    flex-direction: column;
                    text-decoration: none;
                }

                .dl_card__image {
                    height: 150px;
                    display: flex;
                    object-fit: contain;
                    margin: 0.5rem auto;
                }

                .dl_card__bottom {
                    color: white;
                    flex: 1;
                    display: flex;
                    flex-direction: column;
                }

                .dl_card__type {
                    padding: 0.5rem;
                    background-color: #0078a9;
                    font-size: 0.889rem;
                    font-weight: 600;
                }

                .dl_card__title {
                    padding: 0.5rem;
                    background-color: #2988bf;
                    font-size: 0.889rem;
                    flex: 1;
                }
            </style>
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist"></div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <?php

do_action('wpml_switch_language', 'en');
$types = get_terms(array('taxonomy' =>'attachment_category'));
do_action('wpml_switch_language', $current_lang);

    global $post;
    // $slug = $post->post_name;
    $active = 'show active';
    $tstate = 'active';
    $tabs = array();

    // // get latest version of product
    $slug = get_field('latest_slug');

    var_dump($slug);

    // get slugs from docprod matching slug-nn
    // if there are none, use the slug as is.
    // if there is more than one, find the one with 'latest' checked.


    foreach ($types as $t) {
        $current_lang = apply_filters( 'wpml_current_language', NULL );
        do_action( 'wpml_switch_language', 'en' );

    $res = new WP_Query(array(
        'post_type' => 'attachment',
        'posts_per_page' => -1,
        'post_status' => 'any',
        'tax_query' => array(
            'compare' => 'AND',
            array(
                'taxonomy' => 'docprod',
                'field' => 'slug',
                'terms' => $slug
            ),
            array(
                'taxonomy' => 'doclang',
                'field' => 'slug',
                'terms' => $currLang
            ),
            array(
                'taxonomy' => 'attachment_category',
                'field' => 'slug',
                'terms' => $t->slug
            ),
            array(
                'taxonomy' => 'docprod',
                'field' => 'slug',
                'terms' => 'legacy',
                'operator' => 'NOT IN',
            ),
        )
    ));
    $sitepress->switch_lang($current_lang);

    if ($res->have_posts()) {
        $hasContent = 1;

        // $term_name = $t->name
            
        switch($t->name) {
            case 'Application Notes':
                $tabLabel = __('Application Notes', 'cb-hydronix');
                break;
            case 'Articles':
                $tabLabel = __('Articles', 'cb-hydronix');
                break;
            case 'Brochures':
                $tabLabel = __('Brochures', 'cb-hydronix');
                break;
            case 'Case Studies':
                $tabLabel = __('Case Studies', 'cb-hydronix');
                break;
            case 'Engineering Notes':
                $tabLabel = __('Engineering Notes', 'cb-hydronix');
                break;
            case 'Miscellaneous':
                $tabLabel = __('Miscellaneous', 'cb-hydronix');
                break;
            case 'Presentations':
                $tabLabel = __('Presentations', 'cb-hydronix');
                break;
            case 'Software/Firmware':
                $tabLabel = __('Software/Firmware', 'cb-hydronix');
                break;
            case 'User Guides':
                $tabLabel = __('User Guides', 'cb-hydronix');
                break;
            default:
                $tabLabel = $t->name;
        }

            
        $tabs[] = '<button class="nav-link '
            . $tstate
            . '" id="nav-'
            . $t->slug
            . '-tab" data-bs-toggle="tab" data-bs-target="#nav-'
            . $t->slug
            . '" type="button" role="tab" aria-controls="nav-'
            . $t->slug
            . '" aria-selected="true">'
            . $tabLabel
            . '</button>';

        ?>
                <div class="py-4 tab-pane fade <?=$active?>"
                    id="nav-<?=$t->slug?>" role="tabpanel"
                    aria-labelledby="nav-<?=$t->slug?>-tab">
                    <div class="row g-4">
                        <?php
        $current_lang = apply_filters('wpml_current_language', null);
        do_action('wpml_switch_language', 'en');
        while ($res->have_posts()) {
            $res->the_post();
            $fdesc = wp_get_attachment_caption(get_the_ID());
            $img = wp_get_attachment_image(get_the_ID(), 'medium', "", ['class'=>'dl_card__image',]) ?: '<img src="/wp-content/themes/cb-hydronix/img/missing-image.png" class="dl_card__image">';
            $type = get_the_terms(get_the_ID(), 'attachment_category');
            // $typename = $type[0]->name;
            $typename = $tabLabel;
            $filename = wp_get_attachment_url(get_the_ID());
            ?>
                        <div class="col-md-4 col-lg-3 col-xl-2">
                            <a class="dl_card" href="<?=$filename?>"
                                download>
                                <?=$img?>
                                <div class="dl_card__bottom">
                                    <div class="dl_card__type">
                                        <?=$typename?></div>
                                    <div class="dl_card__title">
                                        <?=$fdesc?></div>
                                </div>
                            </a>
                        </div>
                        <?php
        }
        $active = '';
        $tstate = '';
        $sitepress->switch_lang($current_lang);
        ?>
                    </div>
                </div>
                <?php
    }
}

?>
            </div>
        </div>
    </section>
</main>
<?php

if ($hasContent == 1) {
    echo ob_get_clean();
    add_action('wp_footer', function () use ($tabs) {
        $json = json_encode((array)$tabs);
        ?>
<script>
    (function($) {
        var tabs = <?=$json?> ;
        for (i = 0; i < tabs.length; i++) {
            $('#nav-tab').append(tabs[i]);
        }

        $('.collapse').on('shown.bs.collapse', function(e) {
            var $card = $(this).closest('.tab-pane');
            var $open = $($(this).data('parent')).find('.collapse.show');

            var additionalOffset = 100;
            if ($card.prevAll().filter($open.closest('.tab-pane')).length !== 0) {
                additionalOffset = $open.height();
            }
            $('html,body').animate({
                scrollTop: $card.offset().top - additionalOffset
            }, 500);
        });

        $('#docBtn').removeClass('d-none');
    })(jQuery);
</script>
<?php
    }, 9999);
} else {
    ob_end_clean();
    echo '</main>';
}



get_footer();
?>