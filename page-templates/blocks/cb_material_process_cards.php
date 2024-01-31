<?php
global $sitepress;
$curr_lang = $sitepress->get_current_language();

$background = get_field('background');
$bg = !empty($background) && $background[0] === 'light' ? '' : 'bg--blue-100';

$classes = $block['className'] ?? null;

?>
<!-- material_process_cards -->
<section class="three_cards py-5 <?=$bg?> <?=$classes?>">
    <div class="container-xl">
        <div class="row g-4">
            <div class="col-md-3">
                <h2 class="fs-3"><?=__('Typical Materials','cb-hydronix')?></h2>
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
                <h2 class="fs-3"><?=__('Process Control','cb-hydronix')?></h2>
                <div class="card">
                    <div class="row">
                <?php
                    $steps = get_field('process_steps');
                    // cbdump($steps);
                    
                    if ($steps) {
                        foreach ($steps as $step) {

                            $en = apply_filters( 'wpml_object_id', $step, 'process', FALSE, 'en' );
                            $cl = apply_filters( 'wpml_object_id', $step, 'process', FALSE, $curr_lang );
                

                            $sitepress->switch_lang('en');
                            $en_term = get_term_by('id', $en, 'process');
                            $sitepress->switch_lang($curr_lang);
                            $icon_slug = $en_term->slug;

                            $cl_term = get_term_by('id', $cl, 'process');
                            $cl_slug = $cl_term->slug;
                            $cl_name = $cl_term->name;

                            ?>
                    <div class="col-sm-4 col-lg-3 applications__card active">
                        <?php
                        $lang = $curr_lang == 'en' ? '' : '/' . $curr_lang ;
                        $link = $lang . '/' . $cl_slug;
                        echo '<a href="' . $lang . '/' . __('processes','cb-hydronix') . '/' . $cl_slug . '/">';
                        ?>
                            <img src="<?=get_stylesheet_directory_uri()?>/img/icons/icon__<?=$icon_slug?>--blue.svg" alt="X <?=$cl_name?>">
                            <div class="applications__title"><?=$cl_name?></div>
                        </a>
                    </div>
                            <?php
                        }
                    }
                ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>