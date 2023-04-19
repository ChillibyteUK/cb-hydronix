<!-- products -->
<section class="prod_by_app product pb-5">
    <div class="container-xl">
        <h2><?=__('Products','cb-hydronix')?></h2>
        <div class="row g-3">

<?php
$products = get_field('products');
foreach ($products as $p) {
    ?>
    <div class="col-sm-6 col-lg-3">
        <a class="product__card" href="<?=get_the_permalink($p)?>">
            <img src="<?=get_the_post_thumbnail_url($p,'medium')?>">
            <div class="mb-2 fw-bold"><?=get_the_title($p)?></div>
            <div class="mb-2 product__subtitle"><?=get_field('hero_subtitle',$p)?></div>
            <div class="badges">
                <?php
                foreach ( get_the_terms($p,'applications') as $t ) {
                    if ($t->slug == 'explosive-atmosphere') {
                        ?>
                        <div class="badge badge--atex"></div>
                        <div class="badge badge--etl"></div>
                        <?php
                    }
                    if ($t->slug == 'food-safe') {
                        ?>
                        <div class="badge badge--food-safe"></div>
                        <?php
                    }
                    if ($t->slug == 'high-temperature') {
                        ?>
                        <div class="badge badge--high-temp"></div>
                        <?php
                    }
                }
                ?>
            </div>
        </a>
    </div>
    <?php
}
?>
        </div>
    </div>
</section>