<?php
/**
 * The template for displaying search results pages
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

?>
<main id="main">
    <div class="container py-5">
        <?php
        if ( have_posts() ) {
            ?>
            <h1><?php
                printf(
                    esc_html__( 'Search Results for: %s', 'cb-hydronix' ),
                    '<span>' . get_search_query() . '</span>'
                );
            ?></h1>
            <hr>
            <?php
            while ( have_posts() ) {
                the_post();
                ?>
                <div class="search mb-4">
                    <div class="search__inner pb-4">
                        <div class="search__title"><?=get_the_title()?></div>
                        <div class="search__date"><?=get_the_date('j M, Y')?></div>
                        <div class="search__intro mb-3"><?=wp_trim_words(get_the_content(get_the_ID()),30)?></div>
                        <div class="search__link text-right"><a href="<?=get_the_permalink()?>">Read more</a></div>
                    </div>
                </div>
                <?php
            }
        }
        else {
            get_template_part( 'loop-templates/content', 'none' );
            ?>
            <h2 class="pt-5"><?=__('Contact Us','cb-hydronix')?></h2>
            <div class="row">
                <div id="form" class="col-lg-6">
                    <!--[if lte IE 8]>
                    <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2-legacy.js"></script>
                    <![endif]-->
                    <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
                    <?php
                    $e = get_field('contact_form','options');
                    ?>
                    <script>
                    hbspt.forms.create({
                                    region: "<?=$e['region']?>",
                                    portalId: "<?=$e['portal_id']?>",
                                    formId: "<?=$e['form_id']?>"
                    });
                    </script>
                </div>
            </div>
            <?php
        }
        ?>
        <?php understrap_pagination(); ?>
    </div>
</main>
<?php
add_action( 'wp_footer', function(){
    ?>
<script src="<?=get_stylesheet_directory_uri()?>/js/jquery.backstretch.min.js"></script>
<script>
(function($){

    $.backstretch("<?=get_the_post_thumbnail_url(get_option('page_for_posts'),'full')?>");
    $('#menu-item-2191').addClass('active');

})( jQuery );
</script>
    <?php
});


get_footer();
