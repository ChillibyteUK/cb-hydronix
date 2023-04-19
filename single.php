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
<!-- hero -->
<section class="hero hero--short d-flex" style="background-image:url(<?=get_the_post_thumbnail_url( get_the_ID(), 'full' )?>)">
    <div class="overlay overlay--dark"></div>
    <div class="container my-auto">
        <div class="row">
            <div class="col-lg-8 py-5 d-flex align-items-center z-index-0">
                <div>
                    <div class="hero__meta text-white"><?=get_the_date('j F Y')?></div>
                    <h1 class="hero__title text-white"><?=get_the_title()?></h1>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container py-5">
    <div class="content pb-5">
        <?=apply_filters('the_content',get_the_content())?>
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
<section class="author py-5">
    <div class="container-xl">
        <?php
$authName = get_the_author_meta('display_name');
$authBio = get_the_author_meta('description');
$authID = get_the_author_meta('ID');
$authImage = wp_get_attachment_image_url(get_field('profile_image','user_'.$authID),'thumbnail');

        ?>
        <div class="row">
            <div class="col-sm-2 text-center">
                <img src="<?=$authImage?>" alt="<?=$authName?>" class="rounded-circle">
            </div>
            <div class="col-sm-6">
                <h3><?=$authName?></h3>
                <?=$authBio?>
            </div>
        </div>
    </div>
</section>
</main>
<?php
get_footer();
