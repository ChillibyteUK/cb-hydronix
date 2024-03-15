<?php
ob_start();
$hasContent = 0;

$background = get_field('background');
$bg = !empty($background) && $background[0] === 'dark' ? 'bg--blue-100' : '';

$classes = $block['className'] ?? null;

?>
<section id="docs" class="resources py-5 <?=$bg?> <?=$classes?>">
    <div class="container-xl">
        <h2 class="mb-4">
            <?=__('Resources', 'cb-hydronix')?>
        </h2>
        <?php

    $currLang = apply_filters('wpml_current_language', null);
do_action('wpml_switch_language', 'en');

$related_by = get_field('related_by');


$dind = array();
if ($related_by == 'Industry') {
    foreach (get_the_terms(get_the_ID(), 'industries') as $tx) {
        $dind[] = $tx->slug;
    }
}

// var_dump($dind);

$dind_tax = $dind == '' ? '' : array('taxonomy' => 'industries', 'field' => 'slug', 'terms' => $dind, 'operator' => 'IN');

// var_dump($dind_tax);


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

            .tab-content {
                background-color: white;
                padding: 1rem;
                box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px
            }
        </style>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist"></div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <?php

$types = get_terms(array('taxonomy' =>'attachment_category'));

global $post;
$slug = $post->post_name;
$active = 'show active';
$tstate = 'active';
$tabs = array();

if ($types ?? null) {
    foreach ($types as $doctype) {

    // var_dump($dind_tax);

    $res = new WP_Query(array(
        'post_type' => 'attachment',
        'posts_per_page' => -1,
        'post_status' => 'any',
        'tax_query' => array(
            'compare' => 'AND',
            array(
                'taxonomy' => 'doclang',
                'field' => 'slug',
                'terms' => $currLang
            ),
            array(
                'taxonomy' => 'attachment_category',
                'field' => 'slug',
                'terms' => $doctype->slug
            ),
            $dind_tax,
        )
    ));

    // echo '<pre>';
    // var_dump($res);
    // echo '</pre>';

    if ($res->have_posts()) {
        $hasContent = 1;
        do_action('wpml_switch_language', $currLang);
        $name = __($doctype->name, 'cb-hydronix');
        do_action('wpml_switch_language', 'en');
        $tabs[] = <<<EOT
<button class="nav-link {$tstate}" id="nav-{$doctype->slug}-tab" data-bs-toggle="tab" data-bs-target="#nav-{$doctype->slug}" type="button" role="tab" aria-controls="nav-{$doctype->slug}" aria-selected="true">{$name}</button>
EOT;
        ?>
            <div class="py-4 tab-pane fade <?=$active?>"
                id="nav-<?=$doctype->slug?>" role="tabpanel"
                aria-labelledby="nav-<?=$doctype->slug?>-tab">
                <div class="row g-4">
                    <?php
        global $sitepress;
        $current_lang = apply_filters( 'wpml_current_language', NULL );
        do_action( 'wpml_switch_language', 'en' );
        while ($res->have_posts()) {

            $res->the_post();
            $fdesc = wp_get_attachment_caption(get_the_ID());
            $img = wp_get_attachment_image(get_the_ID(), 'medium', "", ['class'=>'dl_card__image',]) ?: '<img src="/wp-content/themes/cb-hydronix/img/missing-image.png" class="dl_card__image">';
            $type = get_the_terms(get_the_ID(), 'attachment_category');
            do_action('wpml_switch_language', $currLang);
            $typename = __($type[0]->name, 'cb-hydronix');
            do_action('wpml_switch_language', 'en');
    
            $filename = wp_get_attachment_url(get_the_ID());
            ?>
                    <div class="col-md-4 col-lg-3 col-xl-2">
                        <a class="dl_card" href="<?=$filename?>"
                            download>
                            <?=$img?>
                            <div class="dl_card__bottom">
                                <div class="dl_card__type">
                                    <?=$typename?>
                                </div>
                                <div class="dl_card__title">
                                    <?=$fdesc?>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
        }
        // $sitepress->switch_lang($current_lang);
        // do_action('wpml_switch_language', $currLang);
        $active = '';
        $tstate = '';
        ?>
                </div>
            </div>
            <?php
    }
}
}

?>
        </div>
    </div>
</section>

<?php

do_action('wpml_switch_language', $currLang);

if ($hasContent === 1) {
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
    })(jQuery);
</script>
<?php
    }, 9999);
} else {
    ob_end_clean();
}
?>