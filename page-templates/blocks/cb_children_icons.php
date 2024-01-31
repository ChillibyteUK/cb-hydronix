<!-- children_icons -->
<section class="child_pages py-4">
    <div class="container-xl">
        <?php
        if (get_field('title')) {
            echo '<h2>' . get_field('title') . '</h2>';
        }
        ?>
        <div class="row g-4 justify-content-center">
<?php
$children = new WP_Query( array(
    'post_type'      => 'page',
    'posts_per_page' => -1,
    'post_parent'    => get_the_ID(),
    'order'          => 'ASC',
    'orderby'        => 'menu_order'
));

if ( $children->have_posts() ) {
    while ( $children->have_posts() ) {
        $children->the_post();

        // get post name in base language
        $original_post = apply_filters( 'wpml_object_id', get_the_ID(), 'page', TRUE, 'en' );
        $native = get_post($original_post);
        $native_slug = $native->post_name;
        ?>
        <div class="col-md-4 col-xl-3">
            <a class="child_pages__card" href="<?=get_the_permalink()?>">
                <img src="<?=get_stylesheet_directory_uri()?>/img/icons/icon__<?=$native_slug?>--blue.svg" alt="" class="d-flex mx-auto w-50">
                <?=get_the_title()?>
            </a>
        </div>
        <?php
    }
}
wp_reset_postdata();

if (get_field('your_application')) {
    $appID = get_page_by_path('your-application');
    $appIDLang = apply_filters( 'wpml_object_id', $appID->ID, 'page' );
    $appLink = get_the_permalink($appIDLang);
    ?>
        <div class="col-md-4 col-xl-3">
            <a class="child_pages__card" href="<?=$appLink?>">
                <img src="<?=get_stylesheet_directory_uri()?>/img/icons/icon--your-application.svg" alt="" class="d-flex mx-auto w-50">
                <?=__('Your Application','cb-hydronix')?>
            </a>
        </div>
    <?php
}

?>
    </div>
</section>