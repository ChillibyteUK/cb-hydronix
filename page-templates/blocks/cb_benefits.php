<section class="benefits py-4 mb-4">
    <div class="container-xl">
        <h2><?=__('Key Benefits','cb-hydronix')?></h2>
        <div class="row">
            <div class="col-md-4 px-4">
                <img src="<?=get_field('benefits','options')?>" class="benefits__image" alt="">
            </div>
            <div class="col-md-8">
                <div class="benefits__content">
                    <?php
                    echo get_field('benefits_copy','options',false);
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>