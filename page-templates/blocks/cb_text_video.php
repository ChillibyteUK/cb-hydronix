<?php
$order_left = (get_field('order') == 'text_left') ? 'order-2 order-lg-2' : 'order-2 order-lg-1';
$order_right = (get_field('order') == 'text_left') ? 'order-1 order-lg-1' : 'order-1 order-lg-2';
$modal = random_str(8);
$bg = (get_field('background')) ? 'text_video--bg' : '';
?>
<!-- text_video -->
<section class="text_video <?=$bg?> py-5">
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-5 text_video__content <?=$order_right?> mb-4 mb-lg-0 pt-5 py-md-5">
                <?php
                if (get_field('text_video__title')) {
                    echo '<h2>' . get_field('text_video__title') . '</h2>';
                }
                if (get_field('subtitle')) {
                    echo '<div class="fs-4 mb-4">' . get_field('subtitle') . '</div>';
                }
                ?>
                <div class="content mb-4"><?=get_field('text_video__content')?></div>
                <?php
                if (get_field('cta')) {
                    $cta = get_field('cta');
                    echo '<a href="' . $cta['url'] . '" target="' . $cta['target'] . '" class="btn btn--orange">' . $cta['title'] . '</a>';
                }
                ?>
            </div>
            <div class="col-lg-7 mb-4 mb-lg-0 d-flex <?=$order_left?>">
                <div class="video__container w-100 my-auto" style="background-color:#1a1a1a">
                    <?php
                    $bg = get_vimeo_data_from_id(get_field('vimeo_id'), 'thumbnail_url');
                    ?>
                    <div class="ratio ratio-16x9 mx-auto">
                        <?php
                        $current_language = apply_filters( 'wpml_current_language', NULL );
                        echo $current_language;
                        if ($current_language == 'zh') {
                            echo 'BiliBili';
                        }
                        else {
                            ?>
                        <iframe src="https://player.vimeo.com/video/<?=get_field('vimeo_id')?>?byline=0&portrait=0" allow="autoplay; fullscreen; picture-in-picture" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                            <?php
                        }
                        ?>
                    </div>
                    <!-- <lite-vimeo videoid="<?=get_field('vimeo_id')?>" style="background-image:url('<?=$bg?>');"></lite-vimeo> -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- <script type=module src="https://cdn.jsdelivr.net/npm/@slightlyoff/lite-vimeo@0.1.1/lite-vimeo.js"></script> -->