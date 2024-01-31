<section class="steps">
        <?php
        if (get_field('steps__title')) {
            ?>
<div class="bg--blue-200">
    <div class="container-xl">
        <div class="row">
            <div class="col-12 text-white p-4">
                <h2 class="mb-0"><?=get_field('steps__title')?></h2>
            </div>
        </div>
    </div>
</div>
            <?php
        }
        ?>
    <div class="container-xl py-4">
        
        <?php
        $n = 1;
        while (have_rows('steps')) {
            the_row();
            ?>
        <div class="row steps__row">
            <div class="col-md-6 steps__left">
                <div class="steps__number me-4">
                    <div class="steps__val"><?=$n?></div>
                </div>
                <div>
                    <?=get_sub_field('left_content')?>
                </div>
            </div>
            <div class="col-md-6 steps__right">
                <div>
                    <?=get_sub_field('right_content')?>
                </div>
            </div>
        </div>
            <?php
            $n++;
        }
        ?>
    </div>
</section>