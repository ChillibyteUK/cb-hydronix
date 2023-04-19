<?php
$id1 = get_field('post');
$id2 = get_field('post_2');
$btn = get_field('cta_colour');
?>
<style>
.single_post__card {
    background-color: white;
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    text-decoration: none;
    color: #3c3c3c;
    transition: all 0.3s ease;
}
</style>
<!-- two posts -->
<section class="single_post">
    <div class="container-xl px-0">
        <div class="row g-4 mb-4">
            <div class="col-lg-6">
                <div class="single_post__card h-100">
                    <div class="row">
                        <div class="col-md-3">
                            <?=get_the_post_thumbnail($id1)?>
                        </div>
                        <div class="col-md-9 p-3">
                            <h3><?=get_the_title($id1)?></h3>
                            <p><?=wp_trim_words(get_the_content(null, false, $id1),30)?></p>
                            <a href="<?=get_the_permalink($id1)?>" class="btn <?=$btn?> ms-md-auto me-md-4"><?=__('Read more','cb-hydronix')?></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="single_post__card h-100">
                    <div class="row">
                        <div class="col-md-3">
                            <?=get_the_post_thumbnail($id2)?>
                        </div>
                        <div class="col-md-9 p-3">
                            <h3><?=get_the_title($id2)?></h3>
                            <p><?=wp_trim_words(get_the_content(null, false, $id2),30)?></p>
                            <a href="<?=get_the_permalink($id2)?>" class="btn <?=$btn?> ms-md-auto me-md-4"><?=__('Read more','cb-hydronix')?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>