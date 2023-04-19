<?php
$i = get_field('installation_point');
?>
<!-- installation_points -->
<section class="installation_points py-4">
    <div class="container-xl">
        <div class="row g-4">
            <div class="col-lg-6">
                <h2 class="fs-3 pb-4"><?=__('Installation Points','cb-hydronix')?></h2>
                <div class="row g-4 justify-content-center installations">
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
            <div class="col-lg-6">
            <h2 class="fs-3 mb-4"><?=__('Typical Applications','cb-hydronix')?></h2>
                <div class="card">
                    <div class="applications row g-4">
                        <?php
                        $allApps = get_terms( array(
                            'taxonomy' => 'applications',
                            'hide_empty' => false
                        ));
                        $appIDs = wp_list_pluck($allApps,'term_id');
                        $thisApps = get_field('applications');
                        
                        foreach ($allApps as $a) {

                            $icon = '--grey'; // TODO - colour icons
                            $active = '';
                            
                            foreach ($thisApps as $i) {
                                if ($i == $a->term_id) {
                                    $icon = '--blue'; // TODO - colour icons
                                    $active = 'active'; 
                                }
                            }
                            ?>
                        <div class="col-sm-4 applications__card <?=$active?>">
                            <?php
                            if ($active) {
                                echo '<a href="/measure/' . $a->slug . '/">';
                            }
                            ?>
                            <img src="<?=get_stylesheet_directory_uri()?>/img/icons/icon__<?=$a->slug?><?=$icon?>.svg" alt="<?=$a->slug?>">
                            <div class="applications__title"><?=$a->name?></div>
                            <?php
                            if ($active) {
                                echo '</a>';
                            }
                            ?>
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