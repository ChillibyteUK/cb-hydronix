<?php
$background = get_field('background');
$bg = !empty($background) && $background[0] === 'dark' ? 'bg--blue-100' : '';

$classes = $block['className'] ?? null;
?>
<!-- benefits -->
<section
    class="benefits py-5 <?=$bg?> <?=$classes?>">
    <div class="container-xl">
        <h2><?=__('Key Benefits', 'cb-hydronix')?>
        </h2>
        <div class="row">
            <div class="col-md-4 px-4">
                <img src="<?=get_field('benefits_image', 'options')?>"
                    class="benefits__image d-block mx-auto mb-4" alt="">
            </div>
            <div class="col-md-8">
                <div class="benefits__content">
                    <?=get_field('benefits_copy', 'options')?>
                </div>
            </div>
        </div>
    </div>
</section>