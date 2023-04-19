<?php
$class = $block['className'];
?>
<!-- accordion -->
<section class="faq py-5">
    <div class="container">
        <?php
            echo '<div id="accordion" class="' . $class . '">';
            $counter = 0;
            $show = 'show';
            $collapsed = '';
            while (have_rows('faq')) {
                the_row();
                $border = $counter == 0 ? 'border-top' : '';
                echo '<div class="py-4 border-bottom ' . $border . '">';
                echo '  <div class="h4 question ' . $collapsed . '" data-bs-toggle="collapse" id="heading_' . $counter . '" data-bs-target="#collapse_' . $counter . '" aria-expanded="true" aria-controls="collapse_' . $counter . '">' . get_sub_field('question') . '</div>';
                echo '  <div class="answer collapse ' . $show . '" id="collapse_' . $counter . '" aria-labelledby="heading_' . $counter . '" data-bs-parent="#accordion"><div class="pt-2" itemprop="text">' . apply_filters('the_content',get_sub_field('answer')) . '</div></div>';
                echo '</div>';
                $counter++;
                $show = '';
                $collapsed = 'collapsed';
            }
            echo '</div>';
        ?>
    </div>
</section>