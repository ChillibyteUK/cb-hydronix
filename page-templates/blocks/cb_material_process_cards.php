<?php
$allProcs = get_terms( array(
    'taxonomy' => 'process',
    'hide_empty' => false
));
// $appIDs = wp_list_pluck($allApps,'term_id');
?>
<!-- material_process_cards -->
<section class="material_process_cards mb-4">
    <div class="container-xl">
        <div class="row g-4">
            <div class="col-md-4">
                <h2 class="fs-3"><?=get_field('title_1')?></h2>
                <div class="card p-2">
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
            <div class="col-md-8">
                <h2 class="fs-3"><?=get_field('title_2')?></h2>
                <div class="card">
                    <div class="process">
                        <?php
                        $thisProcs = get_field('processes');
                        
                        foreach ($allProcs as $a) {

                            $icon = ''; // TODO - colour icons
                            $active = '';
                            
                            foreach ($thisProcs as $i) {
                                if ($i == $a->term_id) {
                                    $icon = '--blue'; // TODO - colour icons
                                    $active = 'active'; 
                                }
                            }
                            ?>
                        <div class="process__card <?=$active?>">
                            <img src="<?=get_stylesheet_directory_uri()?>/img/icons/icon__<?=$a->slug?><?=$icon?>.svg">
                            <div class="process__title"><?=$a->name?></div>
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