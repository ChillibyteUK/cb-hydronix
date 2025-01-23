<?php

ob_start();
get_header();
$header = ob_get_clean();
$header = preg_replace('#<title>(.*?)<\/title>#', '<title>Cement Savings Report | Hydronix</title>', $header);
echo $header;

?>

<main id="main-content" role="main">
    <?php if (have_posts()) {
        while (have_posts()) {
            the_post();
            ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <!-- <h1><?php the_title(); ?></h1>
            <div class="custom-fields">
                <h2>Custom Fields</h2>
                <ul>
                    <?php
                    $meta = get_post_meta(get_the_ID());
                    foreach ($meta as $key => $value) {
                        echo '<li><strong>' . esc_html($key) . ':</strong> ' . esc_html($value[0]) . '</li>';
                    }
                    ?>
                </ul>
            </div> -->
            <div class="container-xl my-4">
                <h1>Hydronix Cement Savings Report</h1>
            </div>
            <section class="contact mb-4">
                <div class="container-xl bg--blue-200 text-white p-4">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-6 fw-bold">Company Name</div>
                                <div class="col-md-6"><?=$meta['company'][0]?></div>
                                <div class="col-md-6 fw-bold">Contact Name</div>
                                <div class="col-md-6"><?=$meta['name'][0]?></div>
                                <div class="col-md-6 fw-bold">Date</div>
                                <div class="col-md-6"><?=get_the_date('j F, Y')?></div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div">A link to this report was emailed to <?=$meta['email'][0]?></div>
                                <ul class="fa-ul mt-2 mb-0">
                                    <li><span class="fa-li"><i class="fa-solid fa-map-pin"></i></span> <a href="<?=get_the_permalink()?>">Bookmark this link</a> for future reference.</li>
                                    <li><span class="fa-li"><i class="fa-solid fa-envelope"></i></span> <a href="mailto:?subject=Hydronix%20Cement%20Savings%20Report&amp;body=<?=get_the_permalink()?>">Share via email</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="container-xl">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered" id="wcReportTable">
                        <thead>
                            <tr>
                                <th colspan="2">&nbsp;</th>
                                <th colspan="2">Potential (worst case) uncompensated water</th>
                            </tr>
                            <tr>
                                <th>Material</th>
                                <th>Your Recipe (Dry Weights)</th>
                                <th id="toleranceColumnTitle"><?=$meta['toleranceColumnTitle'][0]?></th>
                                <th>With Hydronix</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Sand 0 - 2mm</td>
                                <td id="sand1Recipe"><?=$meta['sand1Recipe'][0]?></td>
                                <td id="sand1Tolerance"><?=$meta['sand1Tolerance'][0]?></td>
                                <td id="sand1Hydronix"><?=$meta['sand1Hydronix'][0]?></td>
                            </tr>
                            <tr>
                                <td>Sand 0 - 4mm</td>
                                <td id="sand2Recipe"><?=$meta['sand2Recipe'][0]?></td>
                                <td id="sand2Tolerance"><?=$meta['sand2Tolerance'][0]?></td>
                                <td id="sand2Hydronix"><?=$meta['sand2Hydronix'][0]?></td>
                            </tr>
                            <tr>
                                <td>Aggregate 8 - 16mm</td>
                                <td id="aggregateRecipe"><?=$meta['aggregateRecipe'][0]?></td></td>
                                <td id="aggregateTolerance"><?=$meta['aggregateTolerance'][0]?></td></td>
                                <td id="aggregateHydronix"><?=$meta['aggregateHydronix'][0]?></td>
                            </tr>
                            <tr>
                                <td>Other Aggregates</td>
                                <td id="otherAggregatesRecipe"><?=$meta['otherAggregatesRecipe'][0]?></td>
                                <td id="otherAggregatesTolerance"><?=$meta['otherAggregatesTolerance'][0]?></td>
                                <td id="otherAggregatesHydronix"><?=$meta['otherAggregatesHydronix'][0]?></td>
                            </tr>
                            <tr>
                                <td>Weight of uncompensated moisture</td>
                                <td id="uncompensatedMoistureRecipe"><?=$meta['uncompensatedMoistureRecipe'][0]?></td>
                                <td id="uncompensatedMoistureTolerance"><?=$meta['uncompensatedMoistureTolerance'][0]?></td>
                                <td id="uncompensatedMoistureHydronix"><?=$meta['uncompensatedMoistureHydronix'][0]?></td>
                            </tr>
                            <tr>
                                <th>Total Weight</th>
                                <th id="totalWeightRecipe"><?=$meta['totalWeightRecipe'][0]?></th>
                                <th id="totalWeightTolerance"><?=$meta['totalWeightTolerance'][0]?></th>
                                <th id="totalWeightHydronix"><?=$meta['totalWeightHydronix'][0]?></th>
                            </tr>
                        
                            <tr>
                                <td colspan="4"></td>
                            </tr>

                            <tr>
                                <td>OPC</td>
                                <td id="opcRecipe"><?=$meta['opcRecipe'][0]?></td>
                                <td id="opcTolerance"><?=$meta['opcTolerance'][0]?></td>
                                <td id="opcHydronix"><?=$meta['opcHydronix'][0]?></td>
                            </tr>
                            <tr>
                                <td>PFA</td>
                                <td id="pfaRecipe"><?=$meta['pfaRecipe'][0]?></td>
                                <td id="pfaTolerance"><?=$meta['pfaTolerance'][0]?></td>
                                <td id="pfaHydronix"><?=$meta['pfaHydronix'][0]?></td>
                            </tr>
                            <tr>
                                <td>GGBS</td>
                                <td id="ggbsRecipe"><?=$meta['ggbsRecipe'][0]?></td>
                                <td id="ggbsTolerance"><?=$meta['ggbsTolerance'][0]?></td>
                                <td id="ggbsHydronix"><?=$meta['ggbsHydronix'][0]?></td>
                            </tr>
                            <tr>
                                <td>Other Cement Replacements</td>
                                <td id="otherCementRecipe"><?=$meta['otherCementTolerance'][0]?></td>
                                <td id="otherCementTolerance"><?=$meta['otherCementTolerance'][0]?></td>
                                <td id="otherCementHydronix"><?=$meta['otherCementHydronix'][0]?></td>
                            </tr>
                            <tr>
                                <th>Total Cementitious Materials (Binder)</th>
                                <th id="totalCementitiousMaterialsRecipe"><?=$meta['totalCementitiousMaterialsRecipe'][0]?></th>
                                <th id="totalCementitiousMaterialsTolerance"><?=$meta['totalCementitiousMaterialsTolerance'][0]?></th>
                                <th id="totalCementitiousMaterialsHydronix"><?=$meta['totalCementitiousMaterialsHydronix'][0]?></th>
                            </tr>

                            <tr>
                                <td colspan="4"></td>
                            </tr>

                            <tr>
                                <td>Mix design water (litres)</td>
                                <td id="mixDesignWaterRecipe"><?=$meta['mixDesignWaterRecipe'][0]?></td>
                                <td id="mixDesignWaterTolerance"><?=$meta['mixDesignWaterTolerance'][0]?></td>
                                <td id="mixDesignWaterHydronix"><?=$meta['mixDesignWaterHydronix'][0]?></td>
                            </tr>
                            <tr>
                                <td>uncompensated Water in Aggregates (litres)</td>
                                <td id="uncompensatedWaterRecipe"><?=$meta['uncompensatedWaterRecipe'][0]?></td>
                                <td id="uncompensatedWaterTolerance"><?=$meta['uncompensatedWaterTolerance'][0]?></td>
                                <td id="uncompensatedWaterHydronix"><?=$meta['uncompensatedWaterHydronix'][0]?></td>
                            </tr>
                            <tr>
                                <th>Total Water in mix (litres)</th>
                                <th id="totalWaterRecipe"><?=$meta['totalWaterRecipe'][0]?></th>
                                <th id="totalWaterTolerance"><?=$meta['totalWaterTolerance'][0]?></th>
                                <th id="totalWaterHydronix"><?=$meta['totalWaterHydronix'][0]?></th>
                            </tr>

                            <tr>
                                <td colspan="4"></td>
                            </tr>

                            <tr>
                                <td>Designed W/C ratio</td>
                                <td id="designedWCRatioRecipe"><?=$meta['designedWCRatioRecipe'][0]?></td>
                                <td id="designedWCRatioTolerance"><?=$meta['designedWCRatioTolerance'][0]?></td>
                                <td id="designedWCRatioHydronix"><?=$meta['designedWCRatioHydronix'][0]?></td>
                            </tr>
                            <tr>
                                <td>Produced W/C ratio</td>
                                <td id="producedWCRatioRecipe"><?=$meta['producedWCRatioRecipe'][0]?></td>
                                <td id="producedWCRatioTolerance"><?=$meta['producedWCRatioTolerance'][0]?></td>
                                <td id="producedWCRatioHydronix"><?=$meta['producedWCRatioHydronix'][0]?></td>
                            </tr>

                            <tr>
                                <td colspan="4"></td>
                            </tr>

                            <tr>
                                <td>Total Cement Needed to maintain SD target</td>
                                <td id="totalCementNeededRecipe"><?=$meta['totalCementNeededRecipe'][0]?></td>
                                <td id="totalCementNeededTolerance"><?=$meta['totalCementNeededTolerance'][0]?></td>
                                <td id="totalCementNeededHydronix"><?=$meta['totalCementNeededHydronix'][0]?></td>
                            </tr>
                            <tr>
                                <th>Extra cement needed to maintain SD target</th>
                                <th id="extraCementNeededRecipe"><?=$meta['extraCementNeededRecipe'][0]?></th>
                                <th id="extraCementNeededTolerance"><?=$meta['extraCementNeededTolerance'][0]?></th>
                                <th id="extraCementNeededHydronix"><?=$meta['extraCementNeededHydronix'][0]?></th>
                            </tr>

                            <tr>
                                <td colspan="4"></td>
                            </tr>

                            <tr>
                                <td>Potential cement cost by not using Hydronix moisture measurement</td>
                                <td id="">kg/m<sup>3</sup></td>
                                <td id="potentialCementCost"><?=$meta['potentialCementCost'][0]?></td>
                                <td id="">&nbsp;</td>
                            </tr>
                            <tr>
                                <th>Extra Cement required to maintain w/c ratio per year</th>
                                <td id="">Tonnes</td>
                                <td id="extraCementPerYear"><?=$meta['extraCementPerYear'][0]?></td>
                                <td id="">&nbsp;</td>
                            </tr>

                            <tr>
                                <td colspan="4"></td>
                            </tr>

                            <tr>
                                <th>Cost of not using Hydronix per m<sup>3</sup></th>
                                <td id="" colspan="3">£/$/€ <span id="costNotHydronixM"><?=$meta['costNotHydronixM'][0]?></span></td>
                            </tr>
                            <tr>
                                <th>Cost of not using Hydronix per year</th>
                                <td id="" colspan="3">£/$/€ <span id="costNotHydronixY"><?=$meta['costNotHydronixY'][0]?></span></td>
                            </tr>
                            <tr>
                                <th>Environmental Cost of not using Hydronix per year</th>
                                <td id="" colspan="3"><span id="envNotHydronixY"><?=$meta['envNotHydronixY'][0]?></span> kgCO<sub>2</sub>e/t</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <div class="py-5">
                    RELATED PRODUCTS?
                </div>
            </div>

        </article>
    <?php
        }
    }
    ?>
</main>

<?php get_footer(); ?>


