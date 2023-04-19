<section class="process_cards pt-4 pb-5">
    <div class="container-xl">
        <div class="row g-4 justify-content-center">
            <?php
            while (have_rows('cards')) {
                the_row();
                ?>
            <div class="col-lg-6 col-xl-4">
                <div class="process_cards__card">
                    <div class="process_cards__body">
                        <h3 class="process_cards__title"><?=get_sub_field('title')?></h3>
                        <div class="row g-2 px-2">
                            <div class="col-md-7 order-2 order-md-1">
                                <?php
                                $arr = explode( '<br />', get_sub_field('bullets') );
                                echo '<ul>';
                                foreach ($arr as $a) {
                                    echo '<li>' . trim($a) . '</li>';
                                }
                                echo '</ul>'
                                ?>
                            </div>
                            <div class="col-md-5 order-1 order-md-2">
                                <img src="<?=wp_get_attachment_image_url(get_sub_field('image'),'medium')?>">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="process_cards__products">
                            <table class="table table-sm table-striped">
                            <?php
                            $products = get_sub_field('products');
                            if ($products) {
                                foreach ($products as $p) {
                                    // $p['product_link']
                                    ?>
                                    <tr>
                                        <td class="text-center">
                                            <img src="<?=wp_get_attachment_image_url($p['image'],'medium')?>" class="process_cards__product_image">
                                        </td>
                                        <td class="align-middle">
                                            <?=$p['products']?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                            </table>
                        </div>
                        <?php
                        if (get_sub_field('ambient_temp')) {
                            ?>
                        <div class="process_cards__environment">
                            <img src="<?=get_stylesheet_directory_uri()?>/img/temps.svg" class="img--temps">
                            <div class="process_cards__env_detail">
                                Temperature Measurement<br>
                                Ambient: <span class="text-green"><?=get_sub_field('ambient_temp')?>&deg;C</span><br>
                                High: <span class="text-red">Up to <?=get_sub_field('high_temp')?>&deg;C </span>
                            </div>
                            <div class="process_cards__badges">
                                <?php
                                if (get_sub_field('badges')) {
                                    foreach (get_sub_field('badges') as $b) {
                                        ?>
                                <img src="<?=get_stylesheet_directory_uri()?>/img/badge--<?=$b?>.png" alt="">
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>