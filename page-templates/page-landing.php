<?php
/* Template Name: Landing Page (no nav) */

// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header('landing');
?>
<main id="main" class="pt-0">
    <?php
    the_post();    
    the_content(); 
    ?>
</main>
<?php
get_footer('landing');