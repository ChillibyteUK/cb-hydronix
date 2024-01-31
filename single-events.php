<?php
/**
 * The template for displaying all single posts
 *
 * @package cb-carousel
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
?>
<main id="main">
    <?php
if ( get_the_post_thumbnail_url( get_the_ID() ) ) {
    ?>
<!-- hero -->
<section class="hero hero--short d-flex" style="background-image:url(<?=get_the_post_thumbnail_url( get_the_ID(), 'full' )?>)">
    <div class="overlay overlay--dark"></div>
    <div class="container my-auto">
        <div class="row">
            <div class="col-lg-8 py-5 d-flex align-items-center z-index-0">
                <div>
                    <h1 class="hero__title text-white"><?=get_the_title()?></h1>
                    <div class="event__loca text-white fw-bold"><?=get_field('event_location')?></div>        
                    <div class="hero__meta text-white"><?php
                if (get_field('event_end')) {
                    echo '<div class="event__dates">' . date("F jS, Y",strtotime(get_field('event_date',get_the_ID()))) . ' - ' . date("F jS, Y",strtotime(get_field('event_end',get_the_ID()))) . '</div>';
                }
                else {
                    echo '<div class="event__dates">' . date("F jS, Y",strtotime(get_field('event_date',get_the_ID()))). '</div>';
                }
            ?></div>
                </div>
            </div>
        </div>
    </div>
</section>
    <?php
}
?>
<!--section class="sub_page_title pb-4">
    <div class="d-none d-lg-block bread__container">
        <div class="container bread">
            <?php
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
            }
            ?>
        </div>
    </div>
</section-->
<div class="container pt-4 pb-5">
    <div class="content">
        <?php
        if ( ! get_the_post_thumbnail( get_the_ID() ) ) {
            ?>
        <h1><?=get_the_title()?></h1>
        <div class="mb-4">
            <div class="event__loca fw-bold"><?=get_field('event_location')?></div>
            <?php
                if (get_field('event_end')) {
                    echo '<div class="event__dates">' . date("F jS, Y",strtotime(get_field('event_date',get_the_ID()))) . ' - ' . date("F jS, Y",strtotime(get_field('event_end',get_the_ID()))) . '</div>';
                }
                else {
                    echo '<div class="event__dates">' . date("F jS, Y",strtotime(get_field('event_date',get_the_ID()))). '</div>';
                }
            ?>
        </div>
            <?php
        }
        ?>
        <div class="mb-4"><?=apply_filters('the_content',get_field('event_detail'))?></div>
        <div class="mb-4">
            <?php
            if (get_field('event_booking_link')) {
                $link = get_field('event_booking_link');
                $link_title = $link['title'] ? $link['title'] : 'Book Now';
                $link_target = $link['target'] ? $link['target'] : '_self';
                echo '<a href="' . esc_url($link['url']) . '" class="btn btn-primary" target="' . $link_target . '">' . $link_title . '</a>';
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="share-icons">Share: 
                <?php
                    $url = get_permalink();
                ?>
                <a target="_blank" href="mailto:?subject=I%27d%20like%20to%20share%20a%20link%20with%20you&body=<?=$url?>"><i class="fa fa-envelope"></i></a>
                <a target="_blank" href="https://twitter.com/share?url=<?=$url?>"><i class="fa fa-twitter"></i></a>
                <a target="_blank" href="http://www.facebook.com/sharer.php?u=<?=$url?>"><i class="fa fa-facebook-f"></i></a>
                <a target="_blank" href="http://www.linkedin.com/shareArticle?url=<?=$url?>"><i class="fa fa-linkedin-in"></i></a>
            </div>
        </div>
    </div>
</div>
</main>
<?php
get_footer();
