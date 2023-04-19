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
        ?>
        <div class="col-md-4 col-xl-3">
            <a class="child_pages__card" href="<?=get_the_permalink()?>">
                <img src="<?=get_stylesheet_directory_uri()?>/img/icons/icon__<?=get_post_field( 'post_name', get_the_ID() );?>--blue.svg" alt="" class="d-flex mx-auto w-50">
                <?=get_the_title()?>
            </a>
        </div>
        <?php
    }
}
wp_reset_postdata();

if (get_field('your_application')) {
    ?>
        <div class="col-md-4 col-xl-3">
            <a class="child_pages__card" href="/your-application/">
                <img src="<?=get_stylesheet_directory_uri()?>/img/icon--your-application.svg" alt="" class="d-flex mx-auto w-50">
                <?=__('Your Application','cb-hydronix')?>
            </a>
        </div>
    <?php
}

?>
    </div>
</section>