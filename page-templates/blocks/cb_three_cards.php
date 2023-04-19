<!-- three_cards -->
<section class="three_cards mb-4 py-5 bg--blue-100">
    <div class="container-xl">
        <div class="row g-4">
            <div class="col-md-3">
                <h2 class="fs-3"><?=__('Typical Materials')?></h2>
                <div class="card">
                <?php
                    $arr = explode( '<br />', get_field('card_1') );
                    echo '<ul class="mb-0">';
                    foreach ($arr as $a) {
                        echo '<li>' . trim($a) . '</li>';
                    }
                    echo '</ul>';
                ?>
                </div>
            </div>
            <div class="col-md-9">
                <h2 class="fs-3"><?=__('Process Control')?></h2>
                <div class="card">
                    <div class="row">
                <?php
                    $steps = get_field('process_steps');
                    // cbdump($steps);
                    foreach ($steps as $step) {
                        $s = $step['value'];
                        ?>
                    <div class="col-sm-4 col-lg-3 applications__card active">
                        <a href="/process-control/<?=$s?>/">
                            <img src="<?=get_stylesheet_directory_uri()?>/img/icons/icon__<?=$s?>--blue.svg" alt="X <?=$icon?>">
                            <div class="applications__title"><?=$step['label']?></div>
                        </a>
                    </div>
                        <?php
                    }
                ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>