<!-- products_by_process -->
<section class="prod_by_app products pb-5">
    <div class="container-xl">
        <h2><?=__('Related Products','cb-hydronix')?></h2>
        <div class="row g-3">

<?php
$app = get_field('process');

$q = new WP_Query(array(
    'post_type' => 'products',
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'process',
            'field' => 'term_id',
            'terms' => $app
        )
    )
));

while ($q->have_posts()) {
    $q->the_post();
    $p = get_the_ID();
    ?>
    <div class="col-sm-6 col-lg-3">
        <a class="product__card" href="<?=get_the_permalink()?>">
        <img src="<?=get_the_post_thumbnail_url($p,'medium')?>">
            <div class="mb-2 fw-bold"><?=get_the_title($p)?></div>
            <div class="mb-2 product__subtitle"><?=get_field('hero_subtitle',$p)?></div>
            <div class="badges">
                <?php
                $curr_lang = apply_filters( 'wpml_current_language', null );
                
                $ht_term = get_term_by('slug', 'high-temperature', 'applications');
                $ht_termid_tx = apply_filters('wpml_object_id', $ht_term->term_id, 'applications', true, $curr_lang);
                $ht_term_tx = get_term($ht_termid_tx, 'applications');
                $high_temp = $ht_term_tx->slug;

                $ex_term = get_term_by('slug', 'explosive-atmosphere', 'applications');
                $ex_termid_tx = apply_filters('wpml_object_id', $ex_term->term_id, 'applications', true, $curr_lang);
                $ex_term_tx = get_term($ex_termid_tx, 'applications');
                $explosive = $ex_term_tx->slug;

                $fs_term = get_term_by('slug', 'food-safe', 'applications');
                $fs_termid_tx = apply_filters('wpml_object_id', $fs_term->term_id, 'applications', true, $curr_lang);
                $fs_term_tx = get_term($fs_termid_tx, 'applications');
                $food_safe = $fs_term_tx->slug;

                foreach ( get_the_terms($p,'applications') as $t ) {
                    if ($t->slug == $explosive) {
                        ?>
                        <div class="badge badge--atex"></div>
                        <div class="badge badge--etl"></div>
                        <?php
                    }
                    if ($t->slug == $food_safe) {
                        ?>
                        <div class="badge badge--food-safe"></div>
                        <?php
                    }
                    if ($t->slug == $high_temp) {
                        ?>
                        <div class="badge badge--high-temp"></div>
                        <?php
                    }
                }
                ?>
            </div>        </a>
    </div>
    <?php
}

?>
        </div>
    </div>
</section>