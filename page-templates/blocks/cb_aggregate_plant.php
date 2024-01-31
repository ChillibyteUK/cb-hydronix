<section class="aggregate-plant pt-4 pb-5">
    <div class="container-xl">
        <h2><?=__('Installation Points','cb-hydronix')?></h2>
        <div class="row">
            <div class="col-md-8 mb-4">
                <img src="<?=get_stylesheet_directory_uri()?>/img/plant/aggregate-plant--dots.png" alt="aggregate plant" class="sc-map img-fluid" usemap="#imageMap">
            </div>
            <div class="col-md-4">
                <div class="plant" id="plantInfo">
                    <div id="intro" class="plant__card">
                        <?=__('Explore the diagram opposite to see where Hydronix sensors can be installed.','cb-hydronix')?>
                    </div>
                    <div id="hopperContent" class="plant__card" style="display:none">
                        <?php
                        $s = get_field('bin_silo_hopper', 'options');
                        ?>
                        <h3 class="plant__title"><?=$s['title']?></h3>
                        <div class="row g-2">
                            <div class="col-md-4 order-1 order-md-2 text-center">
                                <img src="<?=wp_get_attachment_image_url($s['image'],'medium')?>">
                            </div>
                            <div class="col-md-8 order-2 order-md-1">
                                <ul>
                                <?php
                                $arr = explode( '<br />', $s['bullets'] );
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
                    </div>
                    <div id="conveyorContent" class="plant__card" style="display:none">
                        <?php
                        $s = get_field('belt_conveyor', 'options');
                        ?>
                        <h3 class="plant__title"><?=$s['title']?></h3>
                        <div class="row g-2">
                            <div class="col-md-4 order-1 order-md-2 text-center">
                                <img src="<?=wp_get_attachment_image_url($s['image'],'medium')?>">
                            </div>
                            <div class="col-md-8 order-2 order-md-1">
                                <ul>
                                <?php
                                $arr = explode( '<br />', $s['bullets'] );
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
                    </div>
                    <div id="mixerContent" class="plant__card" style="display:none">
                        <?php
                        $s = get_field('mixer', 'options');
                        ?>
                        <h3 class="plant__title"><?=$s['title']?></h3>
                        <div class="row g-2">
                            <div class="col-md-4 order-1 order-md-2 text-center">
                                <img src="<?=wp_get_attachment_image_url($s['image'],'medium')?>">
                            </div>
                            <div class="col-md-8 order-2 order-md-1">
                                <ul>
                                <?php
                                $arr = explode( '<br />', $s['bullets'] );
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
                    </div>
                    <div id="controlContent" class="plant__card" style="display:none">
                    <?php
                        $s = get_field('control_room', 'options');
                        ?>
                        <h3 class="plant__title"><?=$s['title']?></h2>
                        <div class="row g-2">
                            <div class="col-md-4 order-1 order-md-2 text-center">
                                <img src="<?=wp_get_attachment_image_url($s['image'],'medium')?>">
                            </div>
                            <div class="col-md-8 order-2 order-md-1">
                                <ul>
                                    <?php
                                    $arr = explode( '<br />', $s['bullets'] );
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<map name="imageMap">
    <area data-maphilight='{"fillColor":"ef9829","fillOpacity":0.6}' id="hopper" alt="hopper" title="hopper" href="#" coords="43,388,43,537,279,400,280,317,101,421" shape="poly">
    <area data-maphilight='{"fillColor":"ef9829","fillOpacity":0.6}' id="conveyor" alt="conveyor" title="conveyor" href="#" coords="5,561,299,390,313,394,447,221,479,238,326,437,39,600,5,581" shape="poly">
    <area data-maphilight='{"fillColor":"ef9829","fillOpacity":0.6}' id="mixer" alt="mixer" title="mixer" href="#" coords="455,222,481,237,461,266,486,280,509,283,527,280,550,273,558,258,558,225,553,217,534,231,508,236,493,235,472,228" shape="poly">
    <area data-maphilight='{"fillColor":"ef9829","fillOpacity":0.6}' id="control" alt="control" title="control" href="#" coords="712,257,756,231,796,255,796,319,752,344,713,321" shape="poly">
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
        $('#plantInfo').find('.plant__card').css('display','none');
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
    })
/*

    }
    $("#hopper").on("click", function(e){
        e.preventDefault();
        console.log('hopper clicked');
        hideParts(this.id);
        // var data = $('#hopper').mouseout().data('maphilight') || {};
        // data.alwaysOn = !data.alwaysOn;
        // $('#hopper').data('maphilight',data).trigger('alwaysOn.maphilight');
        $('#hopperContent').show();
    });
    $("#conveyor").on("click", function(e){
        e.preventDefault();
        console.log('conveyor clicked');
        hideParts(this.id);
        // var data = $('#conveyor').mouseout().data('maphilight') || {};
        // data.alwaysOn = !data.alwaysOn;
        // $('#conveyor').data('maphilight',data).trigger('alwaysOn.maphilight');
        $('#conveyorContent').show();
    });
    $("#mixer").on("click", function(e){
        e.preventDefault();
        console.log('mixer clicked');
        hideParts(this.id);
        // var data = $('#mixer').mouseout().data('maphilight') || {};
        // data.alwaysOn = !data.alwaysOn;
        // $('#mixer').data('maphilight',data).trigger('alwaysOn.maphilight');
        $('#mixerContent').show();
    });
    $("#control").on("click", function(e){
        e.preventDefault();
        console.log('control clicked');
        hideParts(this.id);
        // var data = $('#control').mouseout().data('maphilight') || {};
        // data.alwaysOn = !data.alwaysOn;
        // $('#control').data('maphilight',data).trigger('alwaysOn.maphilight');
        $('#controlContent').show();
    });
*/
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