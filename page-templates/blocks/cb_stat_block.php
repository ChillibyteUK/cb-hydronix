<!-- stat_block -->
<section class="stat_block py-4">
    <div class="container-xl">
        <div class="row justify-content-center g-4">
            <div class="col-sm-6 col-lg-3">
                <?php
                $stat1 = get_field('stat_1');
                // cbdump($stat1);
                $endval = $stat1['stat_figure'];
                $endval = preg_replace('/,/', '.', $endval);
                $decimals = strlen(substr(strrchr($endval, "."), 1));
                /* 
                <div class="stat_block__stat stat_block__stat--<?=$stat1['colour']?>"> 
                    <div class="stat_block__title text--<?=$stat1['colour']?>"><?=$stat1['stat_title']?></div>
                */
                ?>                
                <div class="stat_block__stat stat_block__stat--blue">
                        <?=$stat1['stat_prefix']?>
                        <?=do_shortcode("[countup start='0' end='{$endval}' decimals='{$decimals}' duration='3' scroll='true']")?>
                        <?=$stat1['stat_suffix']?>
                </div>
                <div class="stat_block__title text--blue"><?=$stat1['stat_title']?></div>
                <div class="stat_block__subtitle"><?=$stat1['stat_subtitle']?></div>
            </div>
            <div class="col-sm-6 col-lg-3">
            <?php
                $stat2 = get_field('stat_2');
                // cbdump($stat2);
                $endval = $stat2['stat_figure'];
                $endval = preg_replace('/,/', '.', $endval);
                $decimals = strlen(substr(strrchr($endval, "."), 1));
                ?>                
                <div class="stat_block__stat stat_block__stat--orange">
                        <?=$stat2['stat_prefix']?>
                        <?=do_shortcode("[countup start='0' end='{$endval}' decimals='{$decimals}' duration='3' scroll='true']")?>
                        <?=$stat2['stat_suffix']?>
                </div>
                <div class="stat_block__title text--orange"><?=$stat2['stat_title']?></div>
                <div class="stat_block__subtitle"><?=$stat2['stat_subtitle']?></div>
            </div>
            <div class="col-sm-6 col-lg-3">
            <?php
                $stat3 = get_field('stat_3');
                // cbdump($stat3);
                $endval = $stat3['stat_figure'];
                $endval = preg_replace('/,/', '.', $endval);
                $decimals = strlen(substr(strrchr($endval, "."), 1));
                ?>                
                <div class="stat_block__stat stat_block__stat--grey">
                        <?=$stat3['stat_prefix']?>
                        <?=do_shortcode("[countup start='0' end='{$endval}' decimals='{$decimals}' duration='3' scroll='true']")?>
                        <?=$stat3['stat_suffix']?>
                </div>
                <div class="stat_block__title text--grey"><?=$stat3['stat_title']?></div>
                <div class="stat_block__subtitle"><?=$stat3['stat_subtitle']?></div>
            </div>
            <div class="col-lg-8 text-center">
                <?=get_field('after_content')?>
            </div>
        </div>
    </div>
</section>