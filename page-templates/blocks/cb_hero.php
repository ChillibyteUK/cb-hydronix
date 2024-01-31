<?php
$c = count(get_field('slides')) - 1;
?>    
<!-- hero -->
<section class="hero carousel slide carousel-fade d-flex" id="heroCarousel" data-bs-interval="6000" data-bs-ride="carousel">
    <?php
    if ($c > 0) {
        ?>
    <ol class="carousel-indicators">
        <?php
        $aa = 'active';
        for ($i = 0; $i <= $c; $i++) {
            ?>
        <li data-bs-target="#heroCarousel" data-bs-slide-to="<?=$i?>" class="<?=$aa?>"></li>
            <?php
            $aa = '';
        }
        ?>
    </ol>
        <?php
    }
    ?>
    <div class="carousel-inner">
    <?php
    $active = 'active';
    while (have_rows('slides')) {
        the_row();
        $bg = wp_get_attachment_image_url( get_sub_field('image'), 'full' );
        ?>
        <div class="carousel-item py-5 <?=$active?>" style="background-image:url(<?=$bg?>)">
            <div class="container my-auto mt-md-0">
                <div class="hero__content text-center">
                    <h1><?=get_sub_field('title')?></h1>
                    <div class="hero__content mb-4"><?=get_sub_field('content')?></div>
                    <?php
                    if (get_sub_field('cta')) {
                        $cta = get_sub_field('cta');
                        ?>
                    <a class="btn btn-primary" href="<?=$cta['url']?>" target="<?=$cta['target']?>"><?=$cta['title']?></a>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
        $active = '';
    }
    ?>
    </div>
</section>