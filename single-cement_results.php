<?php
/**
 * Cement Savings Report Template
 *
 * Displays the cement savings report for Hydronix.
 *
 * @package cb-hydronix
 */

defined( 'ABSPATH' ) || exit;

ob_start();
get_header();
$header = ob_get_clean();
$header = preg_replace( '#<title>(.*?)<\/title>#', '<title>Cement Savings Report | Hydronix</title>', $header );
echo $header;

?>

<main id="main-content" role="main">
    <?php
	if ( have_posts() ) {
        while ( have_posts() ) {
            the_post();
            ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php
            // Get all post meta data for this post.
            $meta = get_post_meta( get_the_ID() );

			/*
            ?>
            <div class="custom-fields">
                <h2>Custom Fields</h2>
                <ul>
                    <?php
                    foreach ( $meta as $key => $value ) {
                        echo '<li><strong>' . esc_html( $key ) . ':</strong> ' . esc_html( $value[0] ) . '</li>';
                    }
                    ?>
                </ul>
            </div>
			<?php
			*/
			?>
            <div class="container-xl my-4">
                <h1>Hydronix Cement Savings Report</h1>
            </div>
            <section class="contact mb-4">
                <div class="container-xl bg--blue-200 text-white p-4">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-6 fw-bold">Company Name</div>
                                <div class="col-md-6"><?= isset( $meta['company'] ) ? esc_html( $meta['company'][0] ) : 'N/A'; ?></div>
                                <div class="col-md-6 fw-bold">Contact Name</div>
                                <div class="col-md-6"><?= isset( $meta['name'] ) ? esc_html( $meta['name'][0] ) : 'N/A'; ?></div>
                                <div class="col-md-6 fw-bold">Date</div>
                                <div class="col-md-6"><?= esc_html( get_the_date( 'j F, Y' ) ); ?></div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-12">A link to this report was emailed to <?= isset( $meta['email'] ) ? esc_html( $meta['email'][0] ) : 'N/A'; ?></div>
                                <ul class="fa-ul mt-2 mb-0">
                                    <li><span class="fa-li"><i class="fa-solid fa-map-pin"></i></span> <a href="<?= esc_url( get_the_permalink() ); ?>">Bookmark this link</a> for future reference.</li>
                                    <li><span class="fa-li"><i class="fa-solid fa-envelope"></i></span> <a href="mailto:?subject=Hydronix%20Cement%20Savings%20Report&amp;body=<?= esc_url( get_the_permalink() ); ?>">Share via email</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
			<section>
				<div class="container-xl mb-4">
					<div class="row g-4">
						<div class="col-md-6">
							<div class="card">
								<div class="card-body d-flex flex-column align-items-center gap-4">
									<a href="<?= esc_url( get_stylesheet_directory_uri() . '/img/standard-deviation.png' ); ?>" data-lightbox="gallery" class="d-flex gap-2 text-decoration-none"><img src="<?= esc_url( get_stylesheet_directory_uri() . '/img/standard-deviation.png' ); ?>" style="max-height:400px;width:auto;"></a>
									<div>A batching plant has to design mixes based around historic results. A statistical analysis of the results can then be made and a result called the Standard Deviation (SD) gives the spread of the results around a mean value. British and EU law states that the design strength of the concrete mix must be at a point that is 2x Standard Deviations below the mean value. This means that the probability of batches will be below the design strength is only approximately 2.275%.</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card h-100">
								<div class="card-body d-flex flex-column align-items-center gap-4">
									<a href="<?= esc_url( get_stylesheet_directory_uri() . '/img/water-cement-ratio.png' ); ?>" data-lightbox="gallery" class="d-flex gap-2 text-decoration-none"><img src="<?= esc_url( get_stylesheet_directory_uri() . '/img/water-cement-ratio.png' ); ?>" style="max-height:400px;width:auto;"></a>
									<div>So a 38 N/mm2 with a W/C ratio of 0.605 and a water quantity of 200 l/m3 would need 331kg of cement. A 34N/mm2 mix has a W/C ratio of 0.660 and so will only need 303kg of cement presuming the water demand is constant. This still gives the same design strength of C30 but saves 28kg of cement per m3!</div>
								</div>
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
                                <th id="toleranceColumnTitle"><?= isset( $meta['tolerancecolumntitle'] ) ? esc_html( $meta['tolerancecolumntitle'][0] ) : 'Tolerance'; ?></th>
                                <th>With Hydronix</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Fine Sand 0 - 2mm</td>
                                <td id="sand1Recipe" class="text-end"><?= isset( $meta['sand1recipe'] ) ? esc_html( $meta['sand1recipe'][0] ) : '0'; ?></td>
                                <td id="sand1Tolerance" class="text-end"><?= isset( $meta['sand1tolerance'] ) ? esc_html( $meta['sand1tolerance'][0] ) : '0'; ?></td>
                                <td id="sand1Hydronix" class="text-end"><?= isset( $meta['sand1hydronix'] ) ? esc_html( $meta['sand1hydronix'][0] ) : '0'; ?></td>
                            </tr>
                            <tr>
                                <td>Coarse Sand 0 - 4mm</td>
                                <td id="sand2Recipe" class="text-end"><?= isset( $meta['sand2recipe'] ) ? esc_html( $meta['sand2recipe'][0] ) : '0'; ?></td>
                                <td id="sand2Tolerance" class="text-end"><?= isset( $meta['sand2tolerance'] ) ? esc_html( $meta['sand2tolerance'][0] ) : '0'; ?></td>
                                <td id="sand2Hydronix" class="text-end"><?= isset( $meta['sand2hydronix'] ) ? esc_html( $meta['sand2hydronix'][0] ) : '0'; ?></td>
                            </tr>
                            <tr>
                                <td>Gravel 8 - 16mm</td>
                                <td id="aggregateRecipe" class="text-end"><?= isset( $meta['aggregaterecipe'] ) ? esc_html( $meta['aggregaterecipe'][0] ) : '0'; ?></td>
                                <td id="aggregateTolerance" class="text-end"><?= isset( $meta['aggregatetolerance'] ) ? esc_html( $meta['aggregatetolerance'][0] ) : '0'; ?></td>
                                <td id="aggregateHydronix" class="text-end"><?= isset( $meta['aggregatehydronix'] ) ? esc_html( $meta['aggregatehydronix'][0] ) : '0'; ?></td>
                            </tr>
                            <tr>
                                <td>Other Aggregates</td>
                                <td id="otherAggregatesRecipe" class="text-end"><?= isset( $meta['otheraggregatesrecipe'] ) ? esc_html( $meta['otheraggregatesrecipe'][0] ) : '0'; ?></td>
                                <td id="otherAggregatesTolerance" class="text-end"><?= isset( $meta['otheraggregatestolerance'] ) ? esc_html( $meta['otheraggregatestolerance'][0] ) : '0'; ?></td>
                                <td id="otherAggregatesHydronix" class="text-end"><?= isset( $meta['otheraggregateshydronix'] ) ? esc_html( $meta['otheraggregateshydronix'][0] ) : '0'; ?></td>
                            </tr>
                            <tr>
                                <td>Weight of uncompensated moisture</td>
                                <td id="uncompensatedMoistureRecipe" class="text-end"><?= isset( $meta['uncompensatedmoisturerecipe'] ) ? esc_html( $meta['uncompensatedmoisturerecipe'][0] ) : '0'; ?></td>
                                <td id="uncompensatedMoistureTolerance" class="text-end"><?= isset( $meta['uncompensatedmoisturetolerance'] ) ? esc_html( $meta['uncompensatedmoisturetolerance'][0] ) : '0'; ?></td>
                                <td id="uncompensatedMoistureHydronix" class="text-end"><?= isset( $meta['uncompensatedmoisturehydronix'] ) ? esc_html( $meta['uncompensatedmoisturehydronix'][0] ) : '0'; ?></td>
                            </tr>
                            <tr>
                                <th>Total Weight</th>
                                <th id="totalWeightRecipe" class="text-end"><?= isset( $meta['totalweightrecipe'] ) ? esc_html( $meta['totalweightrecipe'][0] ) : '0'; ?></th>
                                <th id="totalWeightTolerance" class="text-end"><?= isset( $meta['totalweighttolerance'] ) ? esc_html( $meta['totalweighttolerance'][0] ) : '0'; ?></th>
                                <th id="totalWeightHydronix" class="text-end"><?= isset( $meta['totalweighthydronix'] ) ? esc_html( $meta['totalweighthydronix'][0] ) : '0'; ?></th>
                            </tr>
                        
                            <tr>
                                <td colspan="4"></td>
                            </tr>

                            <tr>
                                <td>OPC</td>
                                <td id="opcRecipe" class="text-end"><?= isset( $meta['opcrecipe'] ) ? esc_html( $meta['opcrecipe'][0] ) : '0'; ?></td>
                                <td id="opcTolerance" class="text-end"><?= isset( $meta['opctolerance'] ) ? esc_html( $meta['opctolerance'][0] ) : '0'; ?></td>
                                <td id="opcHydronix" class="text-end"><?= isset( $meta['opchydronix'] ) ? esc_html( $meta['opchydronix'][0] ) : '0'; ?></td>
                            </tr>
                            <tr>
                                <td>PFA</td>
                                <td id="pfaRecipe" class="text-end"><?= isset( $meta['pfarecipe'] ) ? esc_html( $meta['pfarecipe'][0] ) : '0'; ?></td>
                                <td id="pfaTolerance" class="text-end"><?= isset( $meta['pfatolerance'] ) ? esc_html( $meta['pfatolerance'][0] ) : '0'; ?></td>
                                <td id="pfaHydronix" class="text-end"><?= isset( $meta['pfahydronix'] ) ? esc_html( $meta['pfahydronix'][0] ) : '0'; ?></td>
                            </tr>
                            <tr>
                                <td>GGBS</td>
                                <td id="ggbsRecipe" class="text-end"><?= isset( $meta['ggbsrecipe'] ) ? esc_html( $meta['ggbsrecipe'][0] ) : '0'; ?></td>
                                <td id="ggbsTolerance" class="text-end"><?= isset( $meta['ggbstolerance'] ) ? esc_html( $meta['ggbstolerance'][0] ) : '0'; ?></td>
                                <td id="ggbsHydronix" class="text-end"><?= isset( $meta['ggbshydronix'] ) ? esc_html( $meta['ggbshydronix'][0] ) : '0'; ?></td>
                            </tr>
                            <tr>
                                <td>Other Cement Replacements</td>
                                <td id="otherCementRecipe" class="text-end"><?= isset( $meta['othercementrecipe'] ) ? esc_html( $meta['othercementrecipe'][0] ) : '0'; ?></td>
                                <td id="otherCementTolerance" class="text-end"><?= isset( $meta['othercementtolerance'] ) ? esc_html( $meta['othercementtolerance'][0] ) : '0'; ?></td>
                                <td id="otherCementHydronix" class="text-end"><?= isset( $meta['othercementhydronix'] ) ? esc_html( $meta['othercementhydronix'][0] ) : '0'; ?></td>
                            </tr>
                            <tr>
                                <th>Total Cementitious Materials (Binder)</th>
                                <th id="totalCementitiousMaterialsRecipe" class="text-end"><?= isset( $meta['totalcementitiousmaterialsrecipe'] ) ? esc_html( $meta['totalcementitiousmaterialsrecipe'][0] ) : '0'; ?></th>
                                <th id="totalCementitiousMaterialsTolerance" class="text-end"><?= isset( $meta['totalcementitiousmaterialstolerance'] ) ? esc_html( $meta['totalcementitiousmaterialstolerance'][0] ) : '0'; ?></th>
                                <th id="totalCementitiousMaterialsHydronix" class="text-end"><?= isset( $meta['totalcementitiousmaterialshydronix'] ) ? esc_html( $meta['totalcementitiousmaterialshydronix'][0] ) : '0'; ?></th>
                            </tr>

                            <tr>
                                <td colspan="4"></td>
                            </tr>

                            <tr>
                                <td>Mix design water (litres)</td>
                                <td id="mixDesignWaterRecipe" class="text-end"><?= isset( $meta['mixdesignwaterrecipe'] ) ? esc_html( $meta['mixdesignwaterrecipe'][0] ) : '0'; ?></td>
                                <td id="mixDesignWaterTolerance" class="text-end"><?= isset( $meta['mixdesignwatertolerance'] ) ? esc_html( $meta['mixdesignwatertolerance'][0] ) : '0'; ?></td>
                                <td id="mixDesignWaterHydronix" class="text-end"><?= isset( $meta['mixdesignwaterhydronix'] ) ? esc_html( $meta['mixdesignwaterhydronix'][0] ) : '0'; ?></td>
                            </tr>
                            <tr>
                                <td>uncompensated Water in Aggregates (litres)</td>
                                <td id="uncompensatedWaterRecipe" class="text-end"><?= isset( $meta['uncompensatedwaterrecipe'] ) ? esc_html( $meta['uncompensatedwaterrecipe'][0] ) : '0'; ?></td>
                                <td id="uncompensatedWaterTolerance" class="text-end"><?= isset( $meta['uncompensatedwatertolerance'] ) ? esc_html( $meta['uncompensatedwatertolerance'][0] ) : '0'; ?></td>
                                <td id="uncompensatedWaterHydronix" class="text-end"><?= isset( $meta['uncompensatedwaterhydronix'] ) ? esc_html( $meta['uncompensatedwaterhydronix'][0] ) : '0'; ?></td>
                            </tr>
                            <tr>
                                <th>Total Water in mix (litres)</th>
                                <th id="totalWaterRecipe" class="text-end"><?= isset( $meta['totalwaterrecipe'] ) ? esc_html( $meta['totalwaterrecipe'][0] ) : '0'; ?></th>
                                <th id="totalWaterTolerance" class="text-end"><?= isset( $meta['totalwatertolerance'] ) ? esc_html( $meta['totalwatertolerance'][0] ) : '0'; ?></th>
                                <th id="totalWaterHydronix" class="text-end"><?= isset( $meta['totalwaterhydronix'] ) ? esc_html( $meta['totalwaterhydronix'][0] ) : '0'; ?></th>
                            </tr>

                            <tr>
                                <td colspan="4"></td>
                            </tr>

                            <tr>
                                <td>Designed W/C ratio</td>
                                <td id="designedWCRatioRecipe" class="text-end"><?= isset( $meta['designedwcratiorecipe'] ) ? esc_html( $meta['designedwcratiorecipe'][0] ) : '0'; ?></td>
                                <td id="designedWCRatioTolerance" class="text-end"><?= isset( $meta['designedwcratiotolerance'] ) ? esc_html( $meta['designedwcratiotolerance'][0] ) : '0'; ?></td>
                                <td id="designedWCRatioHydronix" class="text-end"><?= isset( $meta['designedwcratiohydronix'] ) ? esc_html( $meta['designedwcratiohydronix'][0] ) : '0'; ?></td>
                            </tr>
                            <tr>
                                <td>Produced W/C ratio</td>
                                <td id="producedWCRatioRecipe" class="text-end"><?= isset( $meta['producedwcratiorecipe'] ) ? esc_html( $meta['producedwcratiorecipe'][0] ) : '0'; ?></td>
                                <td id="producedWCRatioTolerance" class="text-end"><?= isset( $meta['producedwcratiotolerance'] ) ? esc_html( $meta['producedwcratiotolerance'][0] ) : '0'; ?></td>
                                <td id="producedWCRatioHydronix" class="text-end"><?= isset( $meta['producedwcratiohydronix'] ) ? esc_html( $meta['producedwcratiohydronix'][0] ) : '0'; ?></td>
                            </tr>

                            <tr>
                                <td colspan="4"></td>
                            </tr>

                            <tr>
                                <td>Total Cement Needed to maintain SD target</td>
                                <td id="totalCementNeededRecipe" class="text-end"><?= isset( $meta['totalcementneededrecipe'] ) ? esc_html( $meta['totalcementneededrecipe'][0] ) : '0'; ?></td>
                                <td id="totalCementNeededTolerance" class="text-end"><?= isset( $meta['totalcementneededtolerance'] ) ? esc_html( $meta['totalcementneededtolerance'][0] ) : '0'; ?></td>
                                <td id="totalCementNeededHydronix" class="text-end"><?= isset( $meta['totalcementneededhydronix'] ) ? esc_html( $meta['totalcementneededhydronix'][0] ) : '0'; ?></td>
                            </tr>
                            <tr>
                                <th>Extra cement needed to maintain SD target</th>
                                <th id="extraCementNeededRecipe" class="text-end"><?= isset( $meta['extracementneededrecipe'] ) ? esc_html( $meta['extracementneededrecipe'][0] ) : '0'; ?></th>
                                <th id="extraCementNeededTolerance" class="text-end"><?= isset( $meta['extracementneededtolerance'] ) ? esc_html( $meta['extracementneededtolerance'][0] ) : '0'; ?></th>
                                <th id="extraCementNeededHydronix" class="text-end"><?= isset( $meta['extracementneededhydronix'] ) ? esc_html( $meta['extracementneededhydronix'][0] ) : '0'; ?></th>
                            </tr>

                            <tr>
                                <td colspan="4"></td>
                            </tr>

                            <tr>
                                <td>Potential cement cost by not using Hydronix moisture measurement</td>
                                <td id="">&nbsp;</td>
                                <td id="potentialCementCost" class="text-end"><?= isset( $meta['potentialcementcost'] ) ? esc_html( $meta['potentialcementcost'][0] ) : '0'; ?></td>
                                <td id="">kg/m<sup>3</sup></td>
                            </tr>
                            <tr>
                                <th>Extra Cement required to maintain w/c ratio per year</th>
                                <td id="">&nbsp;</td>
                                <td id="extraCementPerYear" class="text-end"><?= isset( $meta['extracementperyear'] ) ? esc_html( $meta['extracementperyear'][0] ) : '0'; ?></td>
                                <td id="">Tonnes</td>
                            </tr>

                            <tr>
                                <td colspan="4"></td>
                            </tr>

                            <tr>
                                <th>Cost of not using Hydronix per m<sup>3</sup></th>
                                <td id="" colspan="3" class="text-end">£/$/€ <span id="costNotHydronixM"><?= isset( $meta['costnothydronixm'] ) ? esc_html( $meta['costnothydronixm'][0] ) : '0'; ?></span></td>
                            </tr>
                            <tr>
                                <th>Cost of not using Hydronix per year</th>
                                <td id="" colspan="3" class="text-end">£/$/€ <span id="costNotHydronixY"><?= isset( $meta['costnothydronixy'] ) ? esc_html( $meta['costnothydronixy'][0] ) : '0'; ?></span></td>
                            </tr>
                            <tr>
                                <th>Environmental Cost of not using Hydronix per year</th>
                                <td id="" colspan="3" class="text-end"><span id="envNotHydronixY"><?= isset( $meta['envnothydronixy'] ) ? esc_html( $meta['envnothydronixy'][0] ) : '0'; ?></span> kgCO<sub>2</sub>e/t</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
			</div>
		</article>
		<!-- products -->
		<section class="prod_by_app product py-5">
			<div class="container-xl">
				<h2><?= __('Related Products','cb-hydronix'); ?></h2>
				<div class="row g-3">
					<?php
					$products = array( 10993, 337, 10240 );
					$p        = new WP_Query(
						array(
							'post_type'      => 'products',
							'posts_per_page' => -1,
							'post__in'       => $products,
							'post_status'    => 'publish',
						)
					);

					while ( $p->have_posts() ) {
 						$p->the_post();
    					?>
					<div class="col-sm-6 col-lg-3">
						<a class="product__card" href="<?= esc_url( get_the_permalink( $p->ID ) ); ?>">
							<img src="<?= esc_url( get_the_post_thumbnail_url( $p->ID,'medium' ) ); ?>">
							<div class="mb-2 fw-bold"><?= esc_html( get_the_title( $p->ID ) ); ?></div>
							<div class="mb-2 product__subtitle"><?= esc_html( get_field( 'hero_subtitle', $p->ID ) ); ?></div>
							<div class="badges">
                		<?php
						$curr_lang = apply_filters( 'wpml_current_language', null );

						$ht_term      = get_term_by( 'slug', 'high-temperature', 'applications' );
						$ht_termid_tx = apply_filters( 'wpml_object_id', $ht_term->term_id, 'applications', true, $curr_lang );
						$ht_term_tx   = get_term( $ht_termid_tx, 'applications' );
						$high_temp    = $ht_term_tx->slug;

						$ex_term      = get_term_by( 'slug', 'explosive-atmosphere', 'applications' );
						$ex_termid_tx = apply_filters( 'wpml_object_id', $ex_term->term_id, 'applications', true, $curr_lang );
						$ex_term_tx   = get_term( $ex_termid_tx, 'applications' );
						$explosive    = $ex_term_tx->slug;

						$fs_term      = get_term_by( 'slug', 'food-safe', 'applications' );
						$fs_termid_tx = apply_filters( 'wpml_object_id', $fs_term->term_id, 'applications', true, $curr_lang );
						$fs_term_tx   = get_term( $fs_termid_tx, 'applications' );
						$food_safe    = $fs_term_tx->slug;

						foreach ( get_the_terms( $p, 'applications' ) as $t ) {
							if ( $t->slug === $explosive ) {
		                        ?>
								<div class="badge badge--atex"></div>
								<div class="badge badge--etl"></div>
                        		<?php
                    		}
                    		if ( $t->slug === $food_safe ) {
                        		?>
								<div class="badge badge--food-safe"></div>
                        		<?php
                    		}
                    		if ( $t->slug === $high_temp ) {
                        		?>
								<div class="badge badge--high-temp"></div>
                        		<?php
                    		}
                		}
                		?>
            				</div>
        				</a>
    				</div>
    					<?php
					}
					?>
				</div>
			</div>
		</section>
		<?php
		$id1 = 1187;
		$id2 = 1186;
		?>
		<style>
			.single_post__card {
				background-color: white;
				box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
				text-decoration: none;
				color: #3c3c3c;
				transition: all 0.3s ease;
			}
		</style>
		<!-- two posts -->
		<section
			class="single_post py-5">
			<div class="container-xl px-0">
				<h2 class="mb-4">Related Articles</h2>
				<div class=" row g-4 mb-4">
					<div class="col-lg-6">
						<div class="single_post__card h-100">
							<div class="row">
								<div class="col-md-3">
									<?= get_the_post_thumbnail( $id1 ); ?>
								</div>
								<div class="col-md-9 p-3">
									<h3><?= get_the_title( $id1 ); ?></h3>
									<p><?= wp_trim_words( get_the_content( null, false, $id1 ), 30 ); ?>
									</p>
									<a href="<?= get_the_permalink( $id1 ); ?>"
										class="btn btn--orange ms-md-auto me-md-4"><?= __( 'Read more', 'cb-hydronix' ); ?></a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="single_post__card h-100">
							<div class="row">
								<div class="col-md-3">
									<?= get_the_post_thumbnail( $id2 ); ?>
								</div>
								<div class="col-md-9 p-3">
									<h3><?= get_the_title( $id2 ); ?></h3>
									<p><?= wp_trim_words( get_the_content( null, false, $id2 ), 30 ); ?>
									</p>
									<a href="<?= get_the_permalink( $id2 ); ?>"
										class="btn btn--orange ms-md-auto me-md-4"><?= __( 'Read more', 'cb-hydronix' ); ?></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		    <?php
        }
    }
    ?>
</main>
<?php
add_action(
	'wp_footer',
	function () {
		?>
            <link rel="stylesheet"
                href="<?= esc_url( get_stylesheet_directory_uri() ); ?>/css/lightbox.min.css">
            <script
                src="<?= esc_url( get_stylesheet_directory_uri() ); ?>/js/lightbox.min.js">
            </script>
		<?php
	}
);

get_footer();
