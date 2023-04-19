    <section id="docs" class="resources py-5">
        <div class="container-xl">
            <h2 class="mb-4"><?=__('Resources','cb-hydronix')?></h2>
            <?php

    $currLang = apply_filters( 'wpml_current_language', NULL );

    $related_by = get_field('related_by');

    $dind = array();
    if ($related_by == 'Industry') {
        foreach (get_the_terms(get_the_ID(),'industries') as $t ) {
            $dind[] = $t->slug;
        }
    }
    
    $dind_tax = $dind == '' ? '' : array('taxonomy' => 'industries', 'field' => 'slug', 'terms' => $dind, 'operator' => 'IN');

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

    $types = get_terms(array('taxonomy' =>'attachment_category'));

    global $post;
    $slug = $post->post_name;
    $active = 'show active';
    $tstate = 'active';
    $tabs = array();
    foreach ($types as $t) {

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
                    'terms' => $t->slug
                ),
                $dind_tax,
            )
        ));
        if ($res->have_posts()) {
            $tabs[] = <<<EOT
<button class="nav-link {$tstate}" id="nav-{$t->slug}-tab" data-bs-toggle="tab" data-bs-target="#nav-{$t->slug}" type="button" role="tab" aria-controls="nav-{$t->slug}" aria-selected="true">{$t->name}</button>
EOT;
            ?>
        <div class="py-4 tab-pane fade <?=$active?>" id="nav-<?=$t->slug?>" role="tabpanel" aria-labelledby="nav-<?=$t->slug?>-tab">
            <div class="row g-4">
            <?php
            while ($res->have_posts()) {
                $res->the_post();
                $fdesc = wp_get_attachment_caption(get_the_ID());
                $img = wp_get_attachment_image( get_the_ID(), 'medium', "", ['class'=>'dl_card__image',] ) ?: '<img src="/wp-content/themes/cb-hydronix/img/missing-image.png" class="dl_card__image">';
                $type = get_the_terms( get_the_ID(), 'attachment_category' );
                $typename = $type[0]->name;
                ?>
                <div class="col-md-4 col-lg-3 col-xl-2">
                    <a class="dl_card" href="<?=get_the_permalink(get_the_ID())?>" download>
                        <?=$img?>
                        <div class="dl_card__bottom">
                            <div class="dl_card__type"><?=$typename?></div>
                            <div class="dl_card__title"><?=$fdesc?></div>
                        </div>
                    </a>
                </div>
                <?php
            }
            $active = '';
            $tstate = '';
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

<?php
add_action('wp_footer',function() use ($tabs) {
    $json = json_encode((array)$tabs);
    ?>
<script>
(function($){
    var tabs = <?=$json?>;
    for (i=0; i<tabs.length; i++) {
        $('#nav-tab').append(tabs[i]);
    }
})(jQuery);
</script>
    <?php
},9999);