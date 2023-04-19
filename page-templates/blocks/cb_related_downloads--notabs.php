<?php

$dlang = apply_filters( 'wpml_current_language', null );
$related_by = get_field('related_by');

if ($related_by == 'Industry') {
    $dind = array();
    foreach (get_the_terms(get_the_ID(),'industries') as $t ) {
        $dind[] = $t->slug;
    }
}

// $dsub_tax  = $dsub  == '' ? '' : array('taxonomy' => 'docprod',  'field' => 'slug', 'terms' => $dsub);
// $dtype_tax = $dtype == '' ? '' : array('taxonomy' => 'attachment_category', 'field' => 'slug', 'terms' => $dtype, 'operator' => 'IN');
$dlang_tax = $dlang == '' ? '' : array('taxonomy' => 'doclang', 'field' => 'slug', 'terms' => $dlang);
$dind_tax = $dind == '' ? '' : array('taxonomy' => 'industries', 'field' => 'slug', 'terms' => $dind, 'operator' => 'IN');

$q = new WP_Query(array(
    'post_type' => 'attachment',
    'post_status' => 'any',
    'posts_per_page' => -1,
    'tax_query' => array(
        array('relation' => 'AND'),
        // $dsub_tax,
        // $dtype_tax,
        $dind_tax,
        $dlang_tax
    ),
));

if ($q->have_posts()) {
    $bg = get_field('background')[0] == 'Yes' ? 'py-5 bg--blue-100' : 'pb-5';
?>
<!-- related_downloads -->
<section class="related_downloads <?=$bg?>">
    <div class="container-xl">
        <h2 class="mb-4"><?=__('Related Downloads','cb-hydronix')?></h2>
        <div class="row g-3 download">
<?php
while ($q->have_posts()) {
    $q->the_post();
    $type = get_the_terms( get_the_ID(), 'attachment_category' );
    $file = basename( get_attached_file(get_the_ID()) );
    $size = filesize( get_attached_file(get_the_ID()) );
    $ftype = get_post_mime_type(get_the_ID());
    $ftype = preg_replace('/application\//','',$ftype);
    $fsize = formatBytes($size);
    $fdesc = wp_get_attachment_caption(get_the_ID());
    $image = wp_get_attachment_image_url( get_the_ID(), 'medium' ) ?: '/wp-content/themes/cb-hydronix/img/missing-image.png';
    ?>
    <div class="col-xl-6">
        <a class="download__card d-flex mb-2" href="<?=get_the_permalink()?>">
            <img src="<?=$image?>">
            <div class="download__info">
                <div class="download__type"><?=$type[0]->name?></div>
                <!-- <div class="download__title"><?=get_the_title()?></div> -->
                <div class="download__desc"><?=$fdesc?></div>
                <div class="download__meta"><?=$ftype?> - <?=$fsize?></div>
            </div>
        </a>
    </div>
    <?php
}
?>
        </div>
    </div>
</section>
<?php
}