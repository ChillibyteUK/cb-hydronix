<?php
global $sitepress;
$curr_lang = $sitepress->get_current_language();
?>
<!-- mechanical_installation_cards -->
<section class="process_cards pt-4 pb-5">
    <div class="container-xl">
        <?php
        if (get_field('show_title') != 'Yes') {
            echo '<h2 class="fs-3">' . __('Mechanical Installations','cb-hydronix') . '</h2>';
        }
        ?>
        <div class="row g-4 justify-content-center">
            <?php
            $steps = get_field('cards');
            foreach (get_field('installation') as $point) {
            // foreach ($steps as $step) {
            //     $f = get_field('cards' . '_' . $curr_lang, 'options');
            //     $s = $f[$step];

                ?>
            <div class="col-lg-6 col-xl-4">
                <div class="process_cards__card">
                    <?php
                    if (get_field('show_text')[0] != 'Yes') {
                        ?>
                    <div class="process_cards__body">
                        <h3 class="process_cards__title"><?=$point->name?></h3>
                        <div class="d-flex justify-content-center align-items-center">
                            <img src="<?=wp_get_attachment_image_url(get_field('image', $point),'medium')?>">
                        </div>
                    </div>
                    <div class="process_cards__badges mb-2">
                        <?php
                        foreach(get_field('badges',$point) as $b) {
                            // cbdump($b);
                            ?>
                        <img src="<?=get_stylesheet_directory_uri()?>/img/badge--<?=$b?>.png" alt="">
                            <?php
                        }
                        ?>
                    </div>
                        <?php
                    }
                    else {
                        ?>
                    <div class="process_cards__body">
                        <h3 class="process_cards__title"><?=$point->name?></h3>
                        <div class="row g-2 px-2">
                            <div class="col-md-7 order-2 order-md-1">
                                <?php
                                echo '<ul>';
                                cb_list($point->description);
                                echo '</ul>'
                                ?>
                            </div>
                            <div class="col-md-5 order-1 order-md-2">
                                <img src="<?=wp_get_attachment_image_url(get_field('image', $point),'medium')?>">
                            </div>
                        </div>
                    </div>
                    <div class="process_cards__badges mb-2">
                        <?php
                        foreach(get_field('badges',$point) as $b) {
                            // cbdump($b);
                            ?>
                        <img src="<?=get_stylesheet_directory_uri()?>/img/badge--<?=$b?>.png" alt="">
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>