<!-- products_by_application -->
<section class="prod_by_app product pb-5">
    <div class="container-xl">
        <h2><?=__('Products','cb-hydronix')?></h2>
        <div class="row g-3">

<?php
$app = get_field('product_application');

$q = new WP_Query(array(
    'post_type' => 'products',
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'applications',
            'field' => 'term_id',
            'terms' => $app
        )
    )
));

while ($q->have_posts()) {
    $q->the_post();
    ?>
    <div class="col-sm-6 col-lg-3">
        <a class="product__card" href="<?=get_the_permalink()?>">
            <img src="<?=get_the_post_thumbnail_url(get_the_ID(),'medium')?>">
            <div><?=get_the_title()?></div>            
        </a>
    </div>
    <?php
}

?>
        </div>
    </div>
</section>