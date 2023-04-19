<?php
$id = get_field('post');
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
<!-- single post -->
<section class="single_post">
    <div class="container-xl px-0">
        <div class="single_post__card my-4">
            <div class="row">
                <div class="col-md-3">
                    <?=get_the_post_thumbnail($id)?>
                </div>
                <div class="col-md-9 p-3">
                    <h3><?=get_the_title($id)?></h3>
                    <p><?=wp_trim_words(get_the_content(null, false, $id),30)?></p>
                    <a href="<?=get_the_permalink($id)?>" class="btn <?=$btn?> ms-md-auto me-md-4"><?=__('Read more','cb-hydronix')?></a>
                </div>
            </div>
        </div>
    </div>
</section>