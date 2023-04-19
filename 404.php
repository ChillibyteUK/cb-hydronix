<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
// $mt = is_front_page() ? '' : 'margin-top';
?>
<main id="main" class="padding-top">
<section class="hero carousel slide carousel-fade d-flex">
    <div class="carousel-inner">
        <div class="carousel-item py-5 active d-flex align-items-center" style="background-image:url(/wp-content/uploads/2022/08/home-hero.jpg)">
            <div class="container my-auto">
                <div class="row">
                    <div class="col-lg-5 hero__content offset-lg-7">
                        <h1>404 - <?=__('Page Not Found','cb-hydronix')?></h1>
                        <div class="hero__content mb-4"><?=__("We can't seem to find the page you're looking for",'cb-hydronix')?></div>
                        <a class="btn btn-primary" href="/"><?=__('Return to Homepage','cb-hydronix')?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</main>
<?php
get_footer();