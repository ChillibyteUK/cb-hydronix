<section class="organic-plant">
    <div class="container-xl">
        <h2 class="mb-4"><?=__('Installation Points','cb-hydronix')?></h2>
        <nav id="plantNav">
            <div class="nav nav-tabs" id="diag-tab" role="tablist">
                <button class="nav-link active" id="nav-dryer-tab" data-bs-toggle="tab" data-bs-target="#nav-dryer" type="button" role="tab" aria-controls="nav-dryer" aria-selected="true"><?=__('Dryer','cb-hydronix')?></button>
                <button class="nav-link" id="nav-grinder-tab" data-bs-toggle="tab" data-bs-target="#nav-grinder" type="button" role="tab" aria-controls="nav-grinder" aria-selected="true"><?=__('Mill','cb-hydronix')?></button>
                <button class="nav-link" id="nav-mixer-tab" data-bs-toggle="tab" data-bs-target="#nav-mixer" type="button" role="tab" aria-controls="nav-mixer" aria-selected="true"><?=__('Mixer','cb-hydronix')?></button>
                <button class="nav-link" id="nav-pelletiser-tab" data-bs-toggle="tab" data-bs-target="#nav-pelletiser" type="button" role="tab" aria-controls="nav-pelletiser" aria-selected="true"><?=__('Pelletiser','cb-hydronix')?></button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active pt-4" id="nav-dryer" role="tabpanel" aria-labelledby="nav-dryer-tab" tabindex=0>
        <h3><?=__('Dryer','cb-hydronix')?></h3>
        <div class="row mb-4">
            <div class="col-md-8 mb-4">
                <img src="<?=get_stylesheet_directory_uri()?>/img/plant/organic-plant__dryer--dots.png" alt="organic plant - dryer" class="sc-map img-fluid" usemap="#imageMap1">
            </div>
            <div class="col-md-4">
                <div class="plant" id="plantInfo1">
                    <div id="intro" class="mb-4">
                        <?=__('Explore the diagram opposite to see where Hydronix sensors can be installed.','cb-hydronix')?>
                    </div>
                    <div id="dryerPipeOneContent" class="plant__card" style="display:none">
                        <?php
                        $s = get_field('dryer_pipe_one', 'options') ?? null;
                        if ($s) {
                        ?>
                        <h3 class="plant__title"><?=$s['title']?></h3>
                        <div class="row g-2">
                            <div class="col-md-4 order-1 order-md-2 text-center">
                                <img src="<?=wp_get_attachment_image_url($s['image'],'medium')?>">
                            </div>
                            <div class="col-md-8 order-2 order-md-1">
                                <ul>
                                    <?php
                                    $arr = explode('<br />', $s['bullets']);
                                    foreach ($arr as $a) {
                                        if (trim($a)) {
                                            echo '<li>' . trim($a) . '</li>';
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <ul>
                            <?php
                            foreach ($s['products'] as $o) {
                                echo '<li><a href="' . get_the_permalink($o) . '">' . get_the_title($o) . '</a></li>';
                            } 
                            ?>
                        </ul>
                        <?php
                        }
                        ?>
                    </div>
                    <div id="dryerPipeTwoContent" class="plant__card" style="display:none">
                        <?php
                        $s = get_field('dryer_pipe_two', 'options') ?? null;
                        if ($s) {
                        ?>
                        <h3 class="plant__title"><?=$s['title']?></h3>
                        <div class="row g-2">
                            <div class="col-md-4 order-1 order-md-2 text-center">
                                <img src="<?=wp_get_attachment_image_url($s['image'],'medium')?>">
                            </div>
                            <div class="col-md-8 order-2 order-md-1">
                                <ul>
                                    <?php
                                    $arr = explode('<br />', $s['bullets']);
                                    foreach ($arr as $a) {
                                        if (trim($a)) {
                                            echo '<li>' . trim($a) . '</li>';
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <ul>
                            <?php
                            foreach ($s['products'] as $o) {
                                echo '<li><a href="' . get_the_permalink($o) . '">' . get_the_title($o) . '</a></li>';
                            } 
                            ?>
                        </ul>
                        <?php
                        }
                        ?>
                    </div>
                    <div id="dryerPipeThreeContent" class="plant__card" style="display:none">
                        <?php
                        $s = get_field('dryer_pipe_three', 'options') ?? null;
                        if ($s) {
                        ?>
                        <h3 class="plant__title"><?=$s['title']?></h3>
                        <div class="row g-2">
                            <div class="col-md-4 order-1 order-md-2 text-center">
                                <img src="<?=wp_get_attachment_image_url($s['image'],'medium')?>">
                            </div>
                            <div class="col-md-8 order-2 order-md-1">
                                <ul>
                                    <?php
                                    $arr = explode('<br />', $s['bullets']);
                                    foreach ($arr as $a) {
                                        if (trim($a)) {
                                            echo '<li>' . trim($a) . '</li>';
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <ul>
                            <?php
                            foreach ($s['products'] as $o) {
                                echo '<li><a href="' . get_the_permalink($o) . '">' . get_the_title($o) . '</a></li>';
                            } 
                            ?>
                        </ul>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
            </div>
            <div class="tab-pane fade pt-4" id="nav-grinder" role="tabpanel" aria-labelledby="nav-grinder-tab" tabindex=0>
        <h3><?=__('Mill','cb-hydronix')?></h3>
        <div class="row mb-4">
            <div class="col-md-8 mb-4">
                <img src="<?=get_stylesheet_directory_uri()?>/img/plant/organic-plant__grinder--dots.png" alt="organic plant - Mill" class="sc-map img-fluid" usemap="#imageMap2">
            </div>
            <div class="col-md-4">
                <div class="plant" id="plantInfo2">
                    <div id="intro" class="mb-4">
                        <?=__('Explore the diagram to see where Hydronix sensors can be installed.','cb-hydronix')?>
                    </div>
                    <div id="grinderPipeOneContent" class="plant__card" style="display:none">
                        <?php
                        $s = get_field('grinder_pipe_one', 'options') ?? null;
                        if ($s) {
                        ?>
                        <h3 class="plant__title"><?=$s['title']?></h3>
                        <div class="row g-2">
                            <div class="col-md-4 order-1 order-md-2 text-center">
                                <img src="<?=wp_get_attachment_image_url($s['image'],'medium')?>">
                            </div>
                            <div class="col-md-8 order-2 order-md-1">
                                <ul>
                                    <?php
                                    $arr = explode('<br />', $s['bullets']);
                                    foreach ($arr as $a) {
                                        if (trim($a)) {
                                            echo '<li>' . trim($a) . '</li>';
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <ul>
                            <?php
                            foreach ($s['products'] as $o) {
                                echo '<li><a href="' . get_the_permalink($o) . '">' . get_the_title($o) . '</a></li>';
                            } 
                            ?>
                        </ul>
                        <?php
                        }
                        ?>
                    </div>
                    <div id="grinderPipeTwoContent" class="plant__card" style="display:none">
                        <?php
                        $s = get_field('grinder_pipe_two', 'options') ?? null;
                        if ($s) {
                        ?>
                        <h3 class="plant__title"><?=$s['title']?></h3>
                        <div class="row g-2">
                            <div class="col-md-4 order-1 order-md-2 text-center">
                                <img src="<?=wp_get_attachment_image_url($s['image'],'medium')?>">
                            </div>
                            <div class="col-md-8 order-2 order-md-1">
                                <ul>
                                    <?php
                                    $arr = explode('<br />', $s['bullets']);
                                    foreach ($arr as $a) {
                                        if (trim($a)) {
                                            echo '<li>' . trim($a) . '</li>';
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <ul>
                            <?php
                            foreach ($s['products'] as $o) {
                                echo '<li><a href="' . get_the_permalink($o) . '">' . get_the_title($o) . '</a></li>';
                            } 
                            ?>
                        </ul>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
            </div>
            <div class="tab-pane fade pt-4" id="nav-mixer" role="tabpanel" aria-labelledby="nav-mixer-tab" tabindex=0>
        <h3><?=__('Mixer','cb-hydronix')?></h3>
        <div class="row mb-4">
            <div class="col-md-8 mb-4">
                <img src="<?=get_stylesheet_directory_uri()?>/img/plant/organic-plant__mixer--dots.png" alt="organic plant - mixer" class="sc-map img-fluid" usemap="#imageMap3">
            </div>
            <div class="col-md-4">
                <div class="plant" id="plantInfo2">
                    <div id="intro" class="mb-4">
                        <?=__('Explore the diagram to see where Hydronix sensors can be installed.','cb-hydronix')?>
                    </div>
                    <div id="mixerPipeOneContent" class="plant__card" style="display:none">
                        <?php
                        $s = get_field('mixer_pipe_one', 'options') ?? null;
                        if ($s) {
                        ?>
                        <h3 class="plant__title"><?=$s['title']?></h3>
                        <div class="row g-2">
                            <div class="col-md-4 order-1 order-md-2 text-center">
                                <img src="<?=wp_get_attachment_image_url($s['image'],'medium')?>">
                            </div>
                            <div class="col-md-8 order-2 order-md-1">
                                <ul>
                                    <?php
                                    $arr = explode('<br />', $s['bullets']);
                                    foreach ($arr as $a) {
                                        if (trim($a)) {
                                            echo '<li>' . trim($a) . '</li>';
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <ul>
                            <?php
                            foreach ($s['products'] as $o) {
                                echo '<li><a href="' . get_the_permalink($o) . '">' . get_the_title($o) . '</a></li>';
                            } 
                            ?>
                        </ul>
                        <?php
                        }
                        ?>
                    </div>
                    <div id="mixerPipeTwoContent" class="plant__card" style="display:none">
                        <?php
                        $s = get_field('mixer_pipe_two', 'options') ?? null;
                        if ($s) {
                        ?>
                        <h3 class="plant__title"><?=$s['title']?></h3>
                        <div class="row g-2">
                            <div class="col-md-4 order-1 order-md-2 text-center">
                                <img src="<?=wp_get_attachment_image_url($s['image'],'medium')?>">
                            </div>
                            <div class="col-md-8 order-2 order-md-1">
                                <ul>
                                    <?php
                                    $arr = explode('<br />', $s['bullets']);
                                    foreach ($arr as $a) {
                                        if (trim($a)) {
                                            echo '<li>' . trim($a) . '</li>';
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <ul>
                            <?php
                            foreach ($s['products'] as $o) {
                                echo '<li><a href="' . get_the_permalink($o) . '">' . get_the_title($o) . '</a></li>';
                            } 
                            ?>
                        </ul>
                        <?php
                        }
                        ?>
                    </div>
                    <div id="mixerPipeThreeContent" class="plant__card" style="display:none">
                        <?php
                        $s = get_field('mixer_pipe_three', 'options') ?? null;
                        if ($s) {
                        ?>
                        <h3 class="plant__title"><?=$s['title']?></h3>
                        <div class="row g-2">
                            <div class="col-md-4 order-1 order-md-2 text-center">
                                <img src="<?=wp_get_attachment_image_url($s['image'],'medium')?>">
                            </div>
                            <div class="col-md-8 order-2 order-md-1">
                                <ul>
                                    <?php
                                    $arr = explode('<br />', $s['bullets']);
                                    foreach ($arr as $a) {
                                        if (trim($a)) {
                                            echo '<li>' . trim($a) . '</li>';
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <ul>
                            <?php
                            foreach ($s['products'] as $o) {
                                echo '<li><a href="' . get_the_permalink($o) . '">' . get_the_title($o) . '</a></li>';
                            } 
                            ?>
                        </ul>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
            </div>
            <div class="tab-pane fade pt-4" id="nav-pelletiser" role="tabpanel" aria-labelledby="nav-pelletiser-tab" tabindex=0>
        <h3><?=__('Pelletiser','cb-hydronix')?></h3>
        <div class="row mb-4">
            <div class="col-md-8 mb-4">
                <img src="<?=get_stylesheet_directory_uri()?>/img/plant/organic-plant__pelletiser--dots.png" alt="organic plant - pelletiser" class="sc-map img-fluid" usemap="#imageMap4">
            </div>
            <div class="col-md-4">
                <div class="plant" id="plantInfo2">
                    <div id="intro" class="mb-4">
                        <?=__('Explore the diagram to see where Hydronix sensors can be installed.','cb-hydronix')?>
                    </div>
                    <div id="pelletiserPipeOneContent" class="plant__card" style="display:none">
                        <?php
                        $s = get_field('pelletiser_pipe_one', 'options') ?? null;
                        if ($s) {
                        ?>
                        <h3 class="plant__title"><?=$s['title']?></h3>
                        <div class="row g-2">
                            <div class="col-md-4 order-1 order-md-2 text-center">
                                <img src="<?=wp_get_attachment_image_url($s['image'],'medium')?>">
                            </div>
                            <div class="col-md-8 order-2 order-md-1">
                                <ul>
                                    <?php
                                    $arr = explode('<br />', $s['bullets']);
                                    foreach ($arr as $a) {
                                        if (trim($a)) {
                                            echo '<li>' . trim($a) . '</li>';
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <ul>
                            <?php
                            foreach ($s['products'] as $o) {
                                echo '<li><a href="' . get_the_permalink($o) . '">' . get_the_title($o) . '</a></li>';
                            } 
                            ?>
                        </ul>
                        <?php
                        }
                        ?>
                    </div>
                    <div id="pelletiserPipeTwoContent" class="plant__card" style="display:none">
                        <?php
                        $s = get_field('pelletiser_pipe_two', 'options') ?? null;
                        if ($s) {
                        ?>
                        <h3 class="plant__title"><?=$s['title']?></h3>
                        <div class="row g-2">
                            <div class="col-md-4 order-1 order-md-2 text-center">
                                <img src="<?=wp_get_attachment_image_url($s['image'],'medium')?>">
                            </div>
                            <div class="col-md-8 order-2 order-md-1">
                                <ul>
                                    <?php
                                    $arr = explode('<br />', $s['bullets']);
                                    foreach ($arr as $a) {
                                        if (trim($a)) {
                                            echo '<li>' . trim($a) . '</li>';
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <ul>
                            <?php
                            foreach ($s['products'] as $o) {
                                echo '<li><a href="' . get_the_permalink($o) . '">' . get_the_title($o) . '</a></li>';
                            } 
                            ?>
                        </ul>
                        <?php
                        }
                        ?>
                    </div>
                    <div id="pelletiserPipeThreeContent" class="plant__card" style="display:none">
                        <?php
                        $s = get_field('pelletiser_pipe_three', 'options') ?? null;
                        if ($s) {
                        ?>
                        <h3 class="plant__title"><?=$s['title']?></h3>
                        <div class="row g-2">
                            <div class="col-md-4 order-1 order-md-2 text-center">
                                <img src="<?=wp_get_attachment_image_url($s['image'],'medium')?>">
                            </div>
                            <div class="col-md-8 order-2 order-md-1">
                                <ul>
                                    <?php
                                    $arr = explode('<br />', $s['bullets']);
                                    foreach ($arr as $a) {
                                        if (trim($a)) {
                                            echo '<li>' . trim($a) . '</li>';
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <ul>
                            <?php
                            foreach ($s['products'] as $o) {
                                echo '<li><a href="' . get_the_permalink($o) . '">' . get_the_title($o) . '</a></li>';
                            } 
                            ?>
                        </ul>
                        <?php
                        }
                        ?>
                    </div>
                    <div id="pelletiserPipeFourContent" class="plant__card" style="display:none">
                        <?php
                        $s = get_field('pelletiser_pipe_four', 'options') ?? null;
                        if ($s) {
                        ?>
                        <h3 class="plant__title"><?=$s['title']?></h3>
                        <div class="row g-2">
                            <div class="col-md-4 order-1 order-md-2 text-center">
                                <img src="<?=wp_get_attachment_image_url($s['image'],'medium')?>">
                            </div>
                            <div class="col-md-8 order-2 order-md-1">
                                <ul>
                                    <?php
                                    $arr = explode('<br />', $s['bullets']);
                                    foreach ($arr as $a) {
                                        if (trim($a)) {
                                            echo '<li>' . trim($a) . '</li>';
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <ul>
                            <?php
                            foreach ($s['products'] as $o) {
                                echo '<li><a href="' . get_the_permalink($o) . '">' . get_the_title($o) . '</a></li>';
                            } 
                            ?>
                        </ul>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
            </div>
        </div>
    </div>
</section>

<style>
    @media (max-width:992px) {
        #plantNav { display: none; }
        .tab-content>.tab-pane {
            display: block !important;
            opacity: 1 !important;
        }
    }
</style>

<map name="imageMap1"><!-- dryer -->
    <area data-maphilight='{"fillColor":"ef9829","fillOpacity":0.6}' id="dryerPipeOne" alt="Dryer - Pipe One" title="Dryer - Pipe One" href="#" coords="335,53,336,63,431,48,430,55,440,54,437,40" shape="poly">
    <area data-maphilight='{"fillColor":"ef9829","fillOpacity":0.6}' id="dryerPipeTwo" alt="Dryer - Pipe Two" title="Dryer - Pipe Two" href="#" coords="555,100,676,267,677,282,684,280,682,264,562,98" shape="poly">
    <area data-maphilight='{"fillColor":"ef9829","fillOpacity":0.6}' id="dryerPipeThree" alt="Dryer - Pipe Three" title="Dryer - Pipe Three" href="#" coords="446,326,497,358,497,405,397,346,398,308,427,328,445,316" shape="poly">
</map>

<map name="imageMap2"><!-- grinder -->
    <area data-maphilight='{"fillColor":"ef9829","fillOpacity":0.6}' id="grinderPipeOne" alt="<?=__('Mill','cb-hydronix')?> -  Pipe One" title="<?=__('Mill','cb-hydronix')?> -  Pipe One" href="#" coords="229,290,202,305,203,336,470,493,471,464,495,450" shape="poly">
    <area data-maphilight='{"fillColor":"ef9829","fillOpacity":0.6}' id="grinderPipeTwo" alt="<?=__('Mill','cb-hydronix')?> -  Pipe Two" title="<?=__('Mill','cb-hydronix')?> -  Pipe Two" href="#" coords="653,411,631,438,659,469,695,487,739,465,732,431,702,414" shape="poly">
</map>

<map name="imageMap3">
    <area data-maphilight='{"fillColor":"ef9829","fillOpacity":0.6}' id="mixerPipeOne" alt="Mixer - Pipe One" title="Mixer - Pipe One" href="#" coords="669,115,671,124,665,141,663,156,669,173,747,216,755,216,775,204,788,180,794,151,788,132,788,125,780,114,737,137,687,110,679,116" shape="poly">
    <area data-maphilight='{"fillColor":"ef9829","fillOpacity":0.6}' id="mixerPipeTwo" alt="Mixer - Pipe Two" title="Mixer - Pipe Two" href="#" coords="527,287,546,298,548,313,710,219,708,202,688,189" shape="poly">
    <area data-maphilight='{"fillColor":"ef9829","fillOpacity":0.6}' id="mixerPipeThree" alt="Mixer - Pipe Three" title="Mixer - Pipe Three" href="#" coords="175,476,246,434,324,478,327,495,311,503,270,555,249,562,225,553,182,500,172,492" shape="poly">
</map>

<map name="imageMap4">
    <area data-maphilight='{"fillColor":"ef9829","fillOpacity":0.6}' id="pelletiserPipeOne" alt="Pelletiser - Pipe One" title="Pelletiser - Pipe One" href="#" coords="611,226,638,240,638,269,800,173,799,144,773,128" shape="poly">
    <area data-maphilight='{"fillColor":"ef9829","fillOpacity":0.6}' id="pelletiserPipeTwo" alt="Pelletiser - Pipe Two" title="Pelletiser - Pipe Two" href="#" coords="380,237,422,210,475,240,457,274,429,291,396,274" shape="poly">
    <area data-maphilight='{"fillColor":"ef9829","fillOpacity":0.6}' id="pelletiserPipeThree" alt="Pelletiser - Pipe Three" title="Pelletiser - Pipe Three" href="#" coords="335,400,335,436,418,388,386,367" shape="poly">
    <area data-maphilight='{"fillColor":"ef9829","fillOpacity":0.6}' id="pelletiserPipeFour" alt="Pelletiser - Pipe Four" title="Pelletiser - Pipe Four" href="#" coords="260,103,259,113,132,288,131,307,140,306,141,290,268,113,269,102" shape="poly">
</map>

<style>
    .highlight {
        background-color: yellow;
    }
</style>
<?php
add_action('wp_footer',function() {
    ?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/maphilight/1.4.0/jquery.maphilight.min.js"></script>
<script type="text/javascript" src="/wp-content/themes/cb-hydronix/js/imageMapResizer.min.js"></script>
<script>
(function($){
    // $('#plantInfo').find('.plant__card').css('display','none');
    // $('#plantInfo').find('#intro').css('display','block');

    $('map area').click(function(e) {
        e.preventDefault();
        var clicked = $(this);
        $('.plant').find('.plant__card').css('display','none');
        $('map area').each(function() {
            hData = $(this).data('maphilight') || {};
            hData.alwaysOn = $(this).is(clicked);
            $(this).data('maphilight',hData).trigger('alwaysOn.maphilight');
            if ( $(this).is(clicked) == true) {
                var currCard = '#' + this.id + 'Content';
                console.log(currCard);
                $(currCard).css('display','block');
                // $(currCard).show();
            }
        })
    });
    $('.sc-map').maphilight({
            fillColor: 'ef9829',
            strokeColor: 'ef9829',
            strokeOpacity: '0.2',
    });
    $('map').imageMapResize();
    
})(jQuery);
</script>
    <?php
},9999);