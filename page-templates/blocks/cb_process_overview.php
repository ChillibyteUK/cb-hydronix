<?php
$i = get_field('installation_point');
?>
<!-- process_overview -->
<section class="process_overview mb-4">
    <div class="container-xl">
        <div class="row g-4">
            <div class="col-md-6">
                <h2 class="fs-3 mb-4"><?=__('Overview','cb-hydronix')?></h2>
                <?=get_field('intro')?>
            </div>
            <div class="col-md-6">
                <h2 class="fs-3 mb-4">Benefits</h2>
                <div class="process_benefits mb-4">
                    <div class="card">
                    <?php
                        $arr = explode( '<br />', get_field('benefits') );
                        echo '<ul class="mb-0">';
                        foreach ($arr as $a) {
                            echo '<li>' . trim($a) . '</li>';
                        }
                        echo '</ul>';
                    ?>
                    </div>
                </div>
                <h2 class="fs-3 mb-4"><?=__('Installation Points','cb-hydronix')?></h2>
                <div class="row g-4 justify-content-center installation_points installations">
                    <div class="col-sm-4 text-center">
                        <?php
                            if (in_array('Input',$i)) {
                                ?>
                        <div class="card">
                            <img src="<?=get_stylesheet_directory_uri()?>/img/icon--input.svg" alt="">
                            <?php
                            }
                            else {
                                ?>
                        <div class="card inactive">
                            <img src="<?=get_stylesheet_directory_uri()?>/img/icon--input-inactive.svg" alt="">
                                <?php
                            }
                            echo __('Input','cb-hydronix');
                            ?>
                        </div>
                    </div>
                    <div class="col-sm-4 text-center">
                        <?php
                            if (in_array('In Process',$i)) {
                                ?>
                        <div class="card">
                            <img src="<?=get_stylesheet_directory_uri()?>/img/icon--in-process.svg" alt="">
                                <?php
                            }
                            else {
                                ?>
                        <div class="card inactive">
                            <img src="<?=get_stylesheet_directory_uri()?>/img/icon--in-process-inactive.svg" alt="">
                                <?php
                            }
                            echo __('In Process','cb-hydronix');
                            ?>
                        </div>
                    </div>
                    <div class="col-sm-4 text-center">
                        <?php
                            if (in_array('Output',$i)) {
                                ?>
                        <div class="card">
                            <img src="<?=get_stylesheet_directory_uri()?>/img/icon--output.svg" alt="">
                                <?php
                            }
                            else {
                                ?>
                        <div class="card inactive">
                            <img src="<?=get_stylesheet_directory_uri()?>/img/icon--output-inactive.svg" alt="">
                                <?php
                            }
                            echo __('Output','cb-hydronix');
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>