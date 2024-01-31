<?php
$allApps = get_terms( array(
    'taxonomy' => 'applications',
    'hide_empty' => false
));
$appIDs = wp_list_pluck($allApps,'term_id');

$background = get_field('background');
$bg = !empty($background) && $background[0] === 'light' ? '' : 'bg--blue-100';

$classes = $block['className'] ?? null;
?>
<!-- application_icons -->
<section class="<?=$bg?> <?=$classes?> py-4">
<div class="container py-4">
    <h2 class="fs-4 text-center mb-4"><?=__('Typical Applications','cb-hydronix')?></h2>
    <div class="applications row g-4">
        <?php
        global $sitepress;

        $thisApps = get_field('applications');
        
        foreach ($allApps as $a) {

            // inactive defaults - grey on desktop blue on mobile
            $icon = '--grey'; // TODO - colour icons
            $icon2 = '--blue'; // TODO - colour icons
            $active = '';
            
            // echo $a->slug;

            $en_id = apply_filters( 'wpml_object_id', $a->term_id, 'applications', TRUE, 'en');

            $current_lang = apply_filters( 'wpml_current_language', NULL );
            $sitepress->switch_lang( 'en' );
            $en_term = get_term( $en_id, 'applications' );
            $sitepress->switch_lang($current_lang);

            $imgslug = $en_term->slug;

            // var_dump($en_id);
            
            foreach ($thisApps as $i) {
                if ($i == $a->term_id) {
                    // active - blue on desktop colour on mobile
                    $icon = '--blue'; // 
                    $icon2 = '--colour'; // 
                    $active = 'active'; 
                }
            }
            ?>
        <div class="col-sm-4 col-lg-2 applications__card <?=$active?>">
            <a href="<?=__('/measure/','cb-hydronix')?><?=$a->slug?>/">
                <img src="<?=get_stylesheet_directory_uri()?>/img/icons/icon__<?=$imgslug?><?=$icon?>.svg" alt="X <?=$icon?>">
                <div class="applications__title"><?=$a->name?></div>
            </a>
        </div>
            <?php
        }
        ?>
    </div>
</div>
</section>