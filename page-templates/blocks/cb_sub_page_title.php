<!-- sub_page_title -->
<section class="sub_page_title py-4">
    <div class="container-xl">
        <h1><?=get_the_title()?></h1>
        <?php
        if ( function_exists('yoast_breadcrumb') ) {
            yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
        }
        ?>
    </div>
</section>