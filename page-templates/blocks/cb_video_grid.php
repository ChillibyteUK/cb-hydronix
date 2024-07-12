<!-- video_grid -->
<section class="video_grid">
    <div class="container-xl">
        <div class="row justify-content-center">
            <?php
            while(have_rows('videos')) {
                the_row();
                ?>
            <div class="col-md-6 col-xl-4">
                <div class="ratio ratio-16x9 mx-auto">
                    <?php
                    $current_language = apply_filters( 'wpml_current_language', NULL );
                    if ($current_language == 'zh-hans') {
                        ?>
                    <iframe src="//player.bilibili.com/player.html?bvid=<?=get_sub_field('vimeo_id')?>&high_quality=1&autoplay=false"></iframe>
                        <?php
                    }
                    else {
                        ?>
                    <iframe src="https://player.vimeo.com/video/<?=get_sub_field('video_id')?>?byline=0&portrait=0" allow="autoplay; fullscreen; picture-in-picture" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                        <?php
                    }
                    ?>
                </div>
                <p><?=get_sub_field('video_caption')?></p>
            </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>