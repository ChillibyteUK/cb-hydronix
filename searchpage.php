<?php
/*
Template Name: Search Page
*/

// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header();
?>
<main id="main">
    <div class="container py-5">
        <h1><?=__('Search','cb-hydronix')?></h1>
        <?php get_search_form(); ?>
    </div>
</main>
<?php
get_footer();