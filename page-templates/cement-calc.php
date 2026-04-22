<?php
/**
 * Template Name: Cement Calculator
 *
 * @package cb-hydronix
 */

defined( 'ABSPATH' ) || exit;

get_header();

?>
<main id="main">
    <style>
        input:read-only:not([type="range"]),
        .cLabel {
            background-color: transparent !important;
            color: #3c3c3c !important;
            border: none !important;
            cursor: not-allowed;
            font-weight: 700;
            font-size: 1.1rem;
        }
    </style>

    <div class="container py-5">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="recipe-tab" data-bs-toggle="tab" data-bs-target="#recipe" type="button" role="tab" aria-controls="recipe" aria-selected="true"><?php echo esc_html__( 'Recipe', 'cb-hydronix' ); ?></button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="production-data-tab" data-bs-toggle="tab" data-bs-target="#production-data" type="button" role="tab" aria-controls="production-data" aria-selected="false"><?php echo esc_html__( 'Production Data', 'cb-hydronix' ); ?></button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="material-moisture-tab" data-bs-toggle="tab" data-bs-target="#material-moisture" type="button" role="tab" aria-controls="material-moisture" aria-selected="false"><?php echo esc_html__( 'Material Moisture', 'cb-hydronix' ); ?></button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="wc-report-tab" data-bs-toggle="tab" data-bs-target="#wc-report" type="button" role="tab" aria-controls="wc-report" aria-selected="false"><?php echo esc_html__( 'Water/Cement Report', 'cb-hydronix' ); ?></button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="recipe" role="tabpanel" aria-labelledby="recipe-tab">
                <div class="mt-3">
                    <h2 class="mb-4"><?php echo esc_html__( 'Mix Design for 1m', 'cb-hydronix' ); ?><sup>3</sup><?php echo esc_html__( ' of Concrete', 'cb-hydronix' ); ?></h2>
                    <?php
                    if ( get_field( 'recipe_intro' ) ) {
                        echo '<div class="alert alert-info" role="alert">';
                        echo wp_kses_post( get_field( 'recipe_intro' ) );
                        echo '</div>';
                    }
                    ?>
                    <div class="row g-5">
                        <div class="col-lg-6">
                            <h4><?php echo esc_html__( 'Aggregates', 'cb-hydronix' ); ?></h4>

                            <div class="mb-3 row border-bottom">
                                <label for="sand1" class="col-sm-6 col-xl-8 col-form-label"><?php echo esc_html__( 'Fine Sand (0-2 mm)', 'cb-hydronix' ); ?></label>
                                <div class="col-sm-6 col-xl-4">
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control text-end" id="sand1" value="1000" oninput="updateSlider(this); calculateAggregateTotal(); calculateBinderTotal(); calculateTotalDryWeight(); calculateRatios();">
                                        <span class="input-group-text">kg/m<sup>3</sup></span>
                                    </div>
                                    <input type="range" class="form-range" id="sand1-slider" min="0" max="2000" value="1000" step="1" oninput="updateNumberInput(this); calculateAggregateTotal(); calculateBinderTotal(); calculateTotalDryWeight(); calculateRatios();">
                                </div>
                            </div>

                            <div class="mb-3 row border-bottom">
                                <label for="sand2" class="col-sm-6 col-xl-8 col-form-label"><?php echo esc_html__( 'Coarse Sand (0-4 mm)', 'cb-hydronix' ); ?></label>
                                <div class="col-sm-6 col-xl-4">
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control text-end" id="sand2" value="1000" oninput="updateSlider(this); calculateAggregateTotal(); calculateBinderTotal(); calculateTotalDryWeight(); calculateRatios();">
                                        <span class="input-group-text">kg/m<sup>3</sup></span>
                                    </div>
                                    <input type="range" class="form-range" id="sand2-slider" min="0" max="2000" value="1000" step="1" oninput="updateNumberInput(this); calculateAggregateTotal(); calculateBinderTotal(); calculateTotalDryWeight(); calculateRatios();">
                                </div>
                            </div>

                            <div class="mb-3 row border-bottom">
                                <label for="aggregate" class="col-sm-6 col-xl-8 col-form-label"><?php echo esc_html__( 'Gravel (8-16 mm)', 'cb-hydronix' ); ?></label>
                                <div class="col-sm-6 col-xl-4">
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control text-end" id="aggregate" value="650" oninput="updateSlider(this); calculateAggregateTotal(); calculateBinderTotal(); calculateTotalDryWeight(); calculateRatios();">
                                        <span class="input-group-text">kg/m<sup>3</sup></span>
                                    </div>
                                    <input type="range" class="form-range" id="aggregate-slider" min="0" max="2000" value="1000" step="1" oninput="updateNumberInput(this); calculateAggregateTotal(); calculateBinderTotal(); calculateTotalDryWeight(); calculateRatios();">
                                </div>
                            </div>

                            <div class="mb-3 row border-bottom">
                                <label for="otherAggregates" class="col-sm-6 col-xl-8 col-form-label"><?php echo esc_html__( 'Other Aggregates', 'cb-hydronix' ); ?></label>
                                <div class="col-sm-6 col-xl-4">
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control text-end" id="otherAggregates" value="0" oninput="calculateAggregateTotal(); calculateBinderTotal(); calculateTotalDryWeight(); calculateRatios();">
                                        <span class="input-group-text">kg/m<sup>3</sup></span>
                                    </div>
                                    <input type="range" class="form-range" id="otherAggregates-slider" min="0" max="2000" value="0" step="1" oninput="updateNumberInput(this); calculateAggregateTotal(); calculateBinderTotal(); calculateTotalDryWeight(); calculateRatios();">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-6 col-xl-8 col-form-label cLabel fw-bold"><?php echo esc_html__( 'Total Dry Weight of Aggregates:', 'cb-hydronix' ); ?></label>
                                <div class="col-sm-6 col-xl-4 d-flex align-items-center">
                                    <input type="text" class="form-control text-end" id="totalWeight" readonly>
                                    <span class="cLabel">kg/m<sup>3</sup></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <!-- Cementitious Materials Section -->
                            <h4><?php echo esc_html__( 'Cementitious Materials (Binder)', 'cb-hydronix' ); ?></h4>
                            <div class="mb-3 row border-bottom">
                                <label for="opc" class="col-sm-6 col-xl-8 col-form-label" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo esc_attr__( 'Ordinary Portland Cement', 'cb-hydronix' ); ?>"><?php echo esc_html__( 'OPC', 'cb-hydronix' ); ?></label>
                                <div class="col-sm-6 col-xl-4">
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control text-end" id="opc" value="300" oninput="calculateAggregateTotal(); calculateBinderTotal(); calculateTotalDryWeight(); calculateRatios();">
                                        <span class="input-group-text">kg/m<sup>3</sup></span>
                                    </div>
                                    <input type="range" class="form-range" id="opc-slider" min="0" max="1000" value="300" step="1" oninput="updateNumberInput(this); calculateAggregateTotal(); calculateBinderTotal(); calculateTotalDryWeight(); calculateRatios();">
                                </div>
                            </div>

                            <div class="mb-3 row border-bottom">
                                <label for="pfa" class="col-sm-6 col-xl-8 col-form-label" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo esc_attr__( 'Pulverized Fuel Ash', 'cb-hydronix' ); ?>"><?php echo esc_html__( 'PFA', 'cb-hydronix' ); ?></label>
                                <div class="col-sm-6 col-xl-4">
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control text-end" id="pfa" value="0" oninput="calculateAggregateTotal(); calculateBinderTotal(); calculateTotalDryWeight(); calculateRatios();">
                                        <span class="input-group-text">kg/m<sup>3</sup></span>
                                    </div>
                                    <input type="range" class="form-range" id="pfa-slider" min="0" max="1000" value="0" step="1" oninput="updateNumberInput(this); calculateAggregateTotal(); calculateBinderTotal(); calculateTotalDryWeight(); calculateRatios();">
                                </div>
                            </div>

                            <div class="mb-3 row border-bottom">
                                <label for="ggbs" class="col-sm-6 col-xl-8 col-form-label" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo esc_attr__( 'Ground Granulated Blast-Furnace Slag', 'cb-hydronix' ); ?>"><?php echo esc_html__( 'GGBS', 'cb-hydronix' ); ?></label>
                                <div class="col-sm-6 col-xl-4">
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control text-end" id="ggbs" value="50" oninput="calculateAggregateTotal(); calculateBinderTotal(); calculateTotalDryWeight(); calculateRatios();">
                                        <span class="input-group-text">kg/m<sup>3</sup></span>
                                    </div>
                                    <input type="range" class="form-range" id="ggbs-slider" min="0" max="1000" value="50" step="1" oninput="updateNumberInput(this); calculateAggregateTotal(); calculateBinderTotal(); calculateTotalDryWeight(); calculateRatios();">
                                </div>
                            </div>

                            <div class="mb-3 row border-bottom">
                                <label for="otherCement" class="col-sm-6 col-xl-8 col-form-label"><?php echo esc_html__( 'Other Cement Replacements', 'cb-hydronix' ); ?></label>
                                <div class="col-sm-6 col-xl-4">
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control text-end" id="otherCement" value="0" oninput="calculateAggregateTotal(); calculateBinderTotal(); calculateTotalDryWeight(); calculateRatios();">
                                        <span class="input-group-text">kg/m<sup>3</sup></span>
                                    </div>
                                    <input type="range" class="form-range" id="otherCement-slider" min="0" max="1000" value="0" step="1" oninput="updateNumberInput(this); calculateAggregateTotal(); calculateBinderTotal(); calculateTotalDryWeight(); calculateRatios();">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-6 col-xl-8 col-form-label cLabel fw-bold"><?php echo esc_html__( 'Total Cementitious Materials (Binder):', 'cb-hydronix' ); ?></label>
                                <div class="col-sm-6 col-xl-4 d-flex align-items-center">
                                    <input type="text" class="form-control text-end" id="totalBinderWeight" readonly>
                                    <span class="cLabel">kg/m<sup>3</sup></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!-- Total Dry Weight and Water Section -->
                    <div class="mb-3 pb-3 border-bottom d-flex align-items-center justify-content-center">
                        <label class="col-form-label cLabel fw-bold"><?php echo esc_html__( 'Total Dry Weight for Recipe:', 'cb-hydronix' ); ?></label>
                        <input type="text" class="form-control text-end" style="width:min-content" id="totalDryWeight" readonly>
                        <span class="cLabel">kg/m<sup>3</sup></span>
                    </div>

                    <div class="mb-3 row border-bottom justify-content-center">
                        <label for="water" class="col-md-3 col-form-label"><?php echo esc_html__( 'Water', 'cb-hydronix' ); ?></label>
                        <div class="col-md-3">
                            <div class="input-group mb-2">
                                <input type="number" class="form-control text-end" id="water" value="150" oninput="calculateAggregateTotal(); calculateBinderTotal(); calculateTotalDryWeight(); calculateRatios();">
                                <span class="input-group-text">litres</span>
                            </div>
                            <input type="range" class="form-range" id="water-slider" min="0" max="1000" value="150" step="1" oninput="updateNumberInput(this); calculateAggregateTotal(); calculateBinderTotal(); calculateTotalDryWeight(); calculateRatios();">
                        </div>
                    </div>

                    <div class="mb-3 pb-3 row border-bottom justify-content-center">
                        <label class="col-md-3 col-form-label fw-bold"><?php echo esc_html__( 'Water / Binder Ratio', 'cb-hydronix' ); ?></label>
                        <div class="col-md-3 d-flex align-items-center">
                            <input type="text" class="form-control text-end" style="max-width:100px" id="waterBinderRatio" readonly>
                            <span class="cLabel"> : 1</span>
                        </div>
                    </div>

                    <div class="mb-3 pb-3 row border-bottom justify-content-center">
                        <label class="col-md-3 col-form-label fw-bold"><?php echo esc_html__( 'Aggregate / Binder Ratio', 'cb-hydronix' ); ?></label>
                        <div class="col-md-3 d-flex align-items-center">
                            <input type="text" class="form-control text-end" style="max-width:100px" id="aggregateBinderRatio" readonly>
                            <span class="cLabel"> : 1</span>
                        </div>
                    </div>
                </div>
				<div class="d-flex justify-content-end">
					<button class="btn btn-primary mt-3 me-0" onclick="document.getElementById('production-data-tab').click();"><?php echo esc_html__( 'Next', 'cb-hydronix' ); ?></button>
				</div>
            </div>
            <!-- Production Data Tab -->
            <div class="tab-pane fade" id="production-data" role="tabpanel" aria-labelledby="production-data-tab">
                <div class="mt-3">
                    <h2><?php echo esc_html__( 'Production Data', 'cb-hydronix' ); ?></h2>
                    <?php
                    if ( get_field( 'production_data_intro' ) ) {
                        echo '<div class="alert alert-info" role="alert">';
                        echo wp_kses_post( get_field( 'production_data_intro' ) );
                        echo '</div>';
                    }
                    ?>
                    <div class="mb-3 row border-bottom">
                        <label for="volumePerDay" class="col-sm-6 col-xl-8 col-form-label"><?php echo esc_html__( 'Volume of concrete per day', 'cb-hydronix' ); ?></label>
                        <div class="col-sm-6 col-xl-4">
                            <div class="input-group mb-2">
                                <input type="number" class="form-control" id="volumePerDay" value="100">
                                <span class="input-group-text"> m<sup>3</sup></span>
                            </div>
                            <input type="range" class="form-range" id="volumePerDay-slider" min="0" max="1000" value="100" step="1" oninput="updateNumberInput(this);">
                        </div>
                    </div>
                    <div class="mb-3 row border-bottom">
                        <label for="daysPerYear" class="col-sm-6 col-xl-8 col-form-label"><?php echo esc_html__( 'Days worked per year', 'cb-hydronix' ); ?></label>
                        <div class="col-sm-6 col-xl-4">
                            <div class="input-group mb-2">
                                <input type="number" class="form-control" id="daysPerYear" value="250">
                                <span class="input-group-text"><?php echo esc_html__( 'Days', 'cb-hydronix' ); ?></span>
                            </div>
                            <input type="range" class="form-range" id="daysPerYear-slider" min="0" max="365" value="250" step="1" oninput="updateNumberInput(this);">
                        </div>
                    </div>
                    <div class="mb-3 row border-bottom">
                        <label for="cementCost" class="col-sm-6 col-xl-8 col-form-label"><?php echo esc_html__( 'Cement cost/tonne', 'cb-hydronix' ); ?></label>
                        <div class="col-sm-6 col-xl-4">
                            <div class="input-group mb-2">
                                <span class="input-group-text">£/$/€</span>
                                <input type="number" class="form-control" id="cementCost" value="80">
                            </div>
                            <input type="range" class="form-range" id="cementCost-slider" min="0" max="365" value="250" step="1" oninput="updateNumberInput(this);">
                        </div>
                    </div>
                    <div class="mb-3 row border-bottom">
                        <label for="cementCO2" class="col-sm-6 col-xl-8 col-form-label"><?php echo esc_html__( 'Cement CO', 'cb-hydronix' ); ?><sub>2</sub><?php echo esc_html__( ' Equivalent', 'cb-hydronix' ); ?></label>
                        <div class="col-sm-6 col-xl-4">
                            <div class="input-group mb-2">
                                <input type="number" class="form-control" id="cementCO2" value="928">
                                <span class="input-group-text">kgCO<sub>2</sub>e/t</span>
                            </div>
                            <input type="range" class="form-range" id="cementCO2-slider" min="0" max="1000" value="928" step="1" oninput="updateNumberInput(this);">
                        </div>
                    </div>
                    <div class="mb-3 row border-bottom">
                        <label for="productionCost" class="col-sm-6 col-xl-8 col-form-label"><?php echo esc_html__( 'Final Concrete Production Cost', 'cb-hydronix' ); ?></label>
                        <div class="col-sm-6 col-xl-4">
                            <div class="input-group mb-2">
                                <input type="number" class="form-control" id="productionCost" value="100">
                                <span class="input-group-text">£/m<sup>3</sup></span>
                            </div>
                            <input type="range" class="form-range" id="productionCost-slider" min="0" max="1000" value="100" step="1" oninput="updateNumberInput(this);">
                        </div>
                    </div>
                    <div class="mb-3 row border-bottom">
                        <label for="salePrice" class="col-sm-6 col-xl-8 col-form-label"><?php echo esc_html__( 'Final Concrete Sale Price', 'cb-hydronix' ); ?></label>
                        <div class="col-sm-6 col-xl-4">
                            <div class="input-group mb-2">
                                <input type="number" class="form-control" id="salePrice" value="150">
                                <span class="input-group-text">£/m<sup>3</sup></span>
                            </div>
                            <input type="range" class="form-range" id="salePrice-slider" min="0" max="1000" value="150" step="1" oninput="updateNumberInput(this);">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <button class="btn btn-secondary mt-3" onclick="document.getElementById('recipe-tab').click();"><?php echo esc_html__( 'Back', 'cb-hydronix' ); ?></button>
                    <button class="btn btn-primary mt-3 me-0" onclick="document.getElementById('material-moisture-tab').click();"><?php echo esc_html__( 'Next', 'cb-hydronix' ); ?></button>
                </div>
            </div>
            <!-- Material Moisture Tab -->
            <div class="tab-pane fade" id="material-moisture" role="tabpanel" aria-labelledby="material-moisture-tab">
                <div class="mt-3">
                    <h2><?php echo esc_html__( 'Material Moisture', 'cb-hydronix' ); ?></h2>
                    <?php
                    if ( get_field( 'moisture_intro' ) ) {
                        echo '<div class="alert alert-info" role="alert">';
                        echo wp_kses_post( get_field( 'moisture_intro' ) );
                        echo '</div>';
                    }
                    ?>
                    <div class="mb-3 row">
                        <label for="moistureMethod" class="col-sm-8 col-form-label"><?php echo esc_html__( 'How is the moisture currently measured?', 'cb-hydronix' ); ?></label>
                        <div class="col-sm-4">
                            <select class="form-select" id="moistureMethod" onchange="toggleMoistureFields();">
                                <option value="automatic"><?php echo esc_html__( 'Automatic', 'cb-hydronix' ); ?></option>
                                <option value="manual"><?php echo esc_html__( 'Manual', 'cb-hydronix' ); ?></option>
                            </select>
                        </div>
                    </div>

                    <!-- Nominal Moisture, Manual, and Automatic Inputs -->
                    <div id="moistureFields">
                        <h4><?php echo esc_html__( 'Moisture Content', 'cb-hydronix' ); ?></h4>
                        <div class="mb-3 pb-3 row border-bottom">
                            <label for="sand1Nominal" class="col-sm-4 col-form-label"><?php echo esc_html__( 'Fine Sand (0-2 mm)', 'cb-hydronix' ); ?></label>
                            <div class="col-sm-8">
                                <div class="input-group mb-2">
                                    <span class="input-group-text"><?php echo esc_html__( 'Average Moisture', 'cb-hydronix' ); ?></span>
                                    <input type="number" class="form-control" id="sand1Nominal" value="6.5" oninput="calculatePotentialManual(); calculatePotentialAutomatic();">
                                    <span class="input-group-text">%</span>
                                </div>
                                <div class="input-group mb-2 manual-field">
                                    <span class="input-group-text"><?php echo esc_html__( 'Min', 'cb-hydronix' ); ?></span>
                                    <input type="number" class="form-control" id="sand1Min" value="2.5" oninput="calculatePotentialManual();">
                                    <span class="input-group-text">%</span>
                                    <span class="input-group-text"><?php echo esc_html__( 'Max', 'cb-hydronix' ); ?></span>
                                    <input type="number" class="form-control" id="sand1Max" value="10.0" oninput="calculatePotentialManual();">
                                    <span class="input-group-text">%</span>
                                </div>
                                <div class="input-group mb-2 automatic-field" style="display: none;">
                                    <span class="input-group-text"><?php echo esc_html__( 'Accuracy', 'cb-hydronix' ); ?></span>
                                    <input type="number" class="form-control" id="sand1Accuracy" value="1" oninput="calculatePotentialAutomatic();">
                                    <span class="input-group-text"><?php echo esc_html__( '+/- %', 'cb-hydronix' ); ?></span>
                                </div>
                                <span class="cLabel"><?php echo esc_html__( 'Potential Maximum Unknown Moisture', 'cb-hydronix' ); ?></span>
                                <input type="text" style="width:4rem;text-align:end;" id="sand1Potential" readonly>
                                <span class="cLabel">%</span>
                            </div>
                        </div>
                        <!-- Similar setup for other moisture materials -->
                        <div class="mb-3 pb-3 row border-bottom">
                            <label for="sand2Nominal" class="col-sm-4 col-form-label"><?php echo esc_html__( 'Coarse Sand (0-4 mm)', 'cb-hydronix' ); ?></label>
                            <div class="col-sm-8">
                                <div class="input-group mb-2">
                                    <span class="input-group-text"><?php echo esc_html__( 'Average Moisture', 'cb-hydronix' ); ?></span>
                                    <input type="number" class="form-control" id="sand2Nominal" value="5.5" oninput="calculatePotentialManual(); calculatePotentialAutomatic();">
                                    <span class="input-group-text">%</span>
                                </div>
                                <div class="input-group mb-2 manual-field">
                                    <span class="input-group-text"><?php echo esc_html__( 'Min', 'cb-hydronix' ); ?></span>
                                    <input type="number" class="form-control" id="sand2Min" value="4.0" oninput="calculatePotentialManual();">
                                    <span class="input-group-text">%</span>
                                    <span class="input-group-text"><?php echo esc_html__( 'Max', 'cb-hydronix' ); ?></span>
                                    <input type="number" class="form-control" id="sand2Max" value="7.0" oninput="calculatePotentialManual();">
                                    <span class="input-group-text">%</span>
                                </div>
                                <div class="input-group mb-2 automatic-field" style="display: none;">
                                    <span class="input-group-text"><?php echo esc_html__( 'Accuracy', 'cb-hydronix' ); ?></span>
                                    <input type="number" class="form-control" id="sand2Accuracy" value="1" oninput="calculatePotentialAutomatic();">
                                    <span class="input-group-text"><?php echo esc_html__( '+/- %', 'cb-hydronix' ); ?></span>
                                </div>
                                <span class="cLabel"><?php echo esc_html__( 'Potential Maximum Unknown Moisture', 'cb-hydronix' ); ?></span>
                                <input type="text" style="width:4rem;text-align:end;" id="sand2Potential" readonly>
                                <span class="cLabel">%</span>
                            </div>
                        </div>
                        <!-- Aggregate Moisture Content -->
                        <div class="mb-3 pb-3 row border-bottom">
                            <label for="aggregateNominal" class="col-sm-4 col-form-label"><?php echo esc_html__( 'Gravel (8-16 mm)', 'cb-hydronix' ); ?></label>
                            <div class="col-sm-8">
                                <div class="input-group mb-2">
                                    <span class="input-group-text"><?php echo esc_html__( 'Average Moisture', 'cb-hydronix' ); ?></span>
                                    <input type="number" class="form-control" id="aggregateNominal" value="2.5" oninput="calculatePotentialManual(); calculatePotentialAutomatic();">
                                    <span class="input-group-text">%</span>
                                </div>
                                <div class="input-group mb-2 manual-field">
                                    <span class="input-group-text"><?php echo esc_html__( 'Min', 'cb-hydronix' ); ?></span>
                                    <input type="number" class="form-control" id="aggregateMin" value="2.0" oninput="calculatePotentialManual();">
                                    <span class="input-group-text">%</span>
                                    <span class="input-group-text"><?php echo esc_html__( 'Max', 'cb-hydronix' ); ?></span>
                                    <input type="number" class="form-control" id="aggregateMax" value="4.0" oninput="calculatePotentialManual();">
                                    <span class="input-group-text">%</span>
                                </div>
                                <div class="input-group mb-2 automatic-field" style="display: none;">
                                    <span class="input-group-text"><?php echo esc_html__( 'Accuracy', 'cb-hydronix' ); ?></span>
                                    <input type="number" class="form-control" id="aggregateAccuracy" value="1" oninput="calculatePotentialAutomatic();">
                                    <span class="input-group-text"><?php echo esc_html__( '+/- %', 'cb-hydronix' ); ?></span>
                                </div>
                                <span class="cLabel"><?php echo esc_html__( 'Potential Maximum Unknown Moisture', 'cb-hydronix' ); ?></span>
                                <input type="text" style="width:4rem;text-align:end;" id="aggregatePotential" readonly>
                                <span class="cLabel">%</span>
                            </div>
                        </div>
                        <!-- Other Aggregates Moisture Content -->
                        <div class="mb-3 pb-3 row border-bottom">
                            <label for="otherAggregatesNominal" class="col-sm-4 col-form-label"><?php echo esc_html__( 'Other Aggregates', 'cb-hydronix' ); ?></label>
                            <div class="col-sm-8">
                                <div class="input-group mb-2">
                                    <span class="input-group-text"><?php echo esc_html__( 'Average Moisture', 'cb-hydronix' ); ?></span>
                                    <input type="number" class="form-control" id="otherAggregatesNominal" value="0.0" oninput="calculatePotentialManual(); calculatePotentialAutomatic();">
                                    <span class="input-group-text">%</span>
                                </div>
                                <div class="input-group mb-2 manual-field">
                                    <span class="input-group-text"><?php echo esc_html__( 'Min', 'cb-hydronix' ); ?></span>
                                    <input type="number" class="form-control" id="otherAggregatesMin" value="0.0" oninput="calculatePotentialManual();">
                                    <span class="input-group-text">%</span>
                                    <span class="input-group-text"><?php echo esc_html__( 'Max', 'cb-hydronix' ); ?></span>
                                    <input type="number" class="form-control" id="otherAggregatesMax" value="0.0" oninput="calculatePotentialManual();">
                                    <span class="input-group-text">%</span>
                                </div>
                                <div class="input-group mb-2 automatic-field" style="display: none;">
                                    <span class="input-group-text"><?php echo esc_html__( 'Accuracy', 'cb-hydronix' ); ?></span>
                                    <input type="number" class="form-control" id="otherAggregatesAccuracy" value="1" oninput="calculatePotentialAutomatic();">
                                    <span class="input-group-text"><?php echo esc_html__( '+/- %', 'cb-hydronix' ); ?></span>
                                </div>
                                <span class="cLabel"><?php echo esc_html__( 'Potential Maximum Unknown Moisture', 'cb-hydronix' ); ?></span>
                                <input type="text" style="width:4rem;text-align:end;" id="otherAggregatesPotential" readonly>
                                <span class="cLabel">%</span>
                            </div>
                        </div>
						<div class="mb-3 pb-3 row border-bottom">
							<div class="col alert alert-info">
								<div class="fw-bold"><?php echo esc_html__( 'Typical accuracies:', 'cb-hydronix' ); ?></div>
								<ul class="mb-0">
									<li><?php echo esc_html__( 'Analogue/Microwave - +/-0.5%', 'cb-hydronix' ); ?></li>
									<li><?php echo esc_html__( 'Capacitance - +/-1%', 'cb-hydronix' ); ?></li>
								</ul>
							</div>
						</div>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <button class="btn btn-secondary mt-3" onclick="document.getElementById('production-data-tab').click();"><?php echo esc_html__( 'Back', 'cb-hydronix' ); ?></button>
                    <button class="btn btn-primary mt-3 me-0" onclick="document.getElementById('wc-report-tab').click();"><?php echo esc_html__( 'Next', 'cb-hydronix' ); ?></button>
                </div>
            </div>
            <div class="tab-pane fade" id="wc-report" role="tabpanel" aria-labelledby="wc-report-tab">
                <div class="mt-3">
					<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
						<h2><?php echo esc_html__( 'Return on Investment Report', 'cb-hydronix' ); ?></h2>
						<button class="btn btn-primary me-0" data-bs-toggle="modal" data-bs-target="#saveResultsModal"><?php echo esc_html__( 'Get Report', 'cb-hydronix' ); ?></button>
					</div>
                    <?php
                    if ( get_field( 'report_intro' ) ) {
                        echo '<div class="alert alert-info" role="alert">';
                        echo wp_kses_post( get_field( 'report_intro' ) );
                        echo '</div>';
                    }
                    ?>
                    <div class="table-responsive alert alert-success h5">
                        <table class="table table-sm table-bordered" id="wcReportTable">

                            <tr>
                                <th><?php echo esc_html__( 'Potential cement cost by not using Hydronix moisture measurement', 'cb-hydronix' ); ?></th>
                                <td id=""><span id="potentialCementCost">0</span> kg/m<sup>3</sup></td>
                            </tr>
                            <tr>
                                <th><?php echo esc_html__( 'Extra Cement required to maintain w/c ratio per year', 'cb-hydronix' ); ?></th>
                                <td id=""><span id="extraCementPerYear">0</span> Tonnes</td>
                            </tr>

                            <tr>
                                <td colspan="2"></td>
                            </tr>

                            <tr>
                                <th><?php echo esc_html__( 'Cost of not using Hydronix per m', 'cb-hydronix' ); ?><sup>3</sup></th>
                                <td id="">£/$/€ <span id="costNotHydronixM"></span></td>
                            </tr>
                            <tr>
                                <th><?php echo esc_html__( 'Cost of not using Hydronix per year', 'cb-hydronix' ); ?></th>
                                <td id="">£/$/€ <span id="costNotHydronixY"></span></td>
                            </tr>
                            <tr>
                                <th><?php echo esc_html__( 'Environmental Cost of not using Hydronix per year', 'cb-hydronix' ); ?></th>
                                <td id=""><span id="envNotHydronixY"></span> kgCO<sub>2</sub>e/t</td>
                            </tr>
                        </table>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-sm table-bordered" id="wcReportTable">
                            <thead>
                                <tr>
                                    <th colspan="2">&nbsp;</th>
                                    <th colspan="2"><?php echo esc_html__( 'Potential (worst case) uncompensated water', 'cb-hydronix' ); ?></th>
                                </tr>
                                <tr>
                                    <th><?php echo esc_html__( 'Material', 'cb-hydronix' ); ?></th>
                                    <th><?php echo esc_html__( 'Your Recipe (Dry Weights)', 'cb-hydronix' ); ?></th>
                                    <th id="toleranceColumnTitle"><?php echo esc_html__( 'Using existing measurement tolerance', 'cb-hydronix' ); ?></th>
                                    <th><?php echo esc_html__( 'With Hydronix', 'cb-hydronix' ); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo esc_html__( 'Fine Sand 0 - 2mm', 'cb-hydronix' ); ?></td>
                                    <td id="sand1Recipe" class="text-end">1000</td>
                                    <td id="sand1Tolerance" class="text-end">0</td>
                                    <td id="sand1Hydronix" class="text-end">0</td>
                                </tr>
                                <tr>
                                    <td><?php echo esc_html__( 'Coarse Sand 0 - 4mm', 'cb-hydronix' ); ?></td>
                                    <td id="sand2Recipe" class="text-end">1000</td>
                                    <td id="sand2Tolerance" class="text-end">0</td>
                                    <td id="sand2Hydronix" class="text-end">0</td>
                                </tr>
                                <tr>
                                    <td><?php echo esc_html__( 'Gravel 8 - 16mm', 'cb-hydronix' ); ?></td>
                                    <td id="aggregateRecipe" class="text-end">650</td>
                                    <td id="aggregateTolerance" class="text-end">0</td>
                                    <td id="aggregateHydronix" class="text-end">0</td>
                                </tr>
                                <tr>
                                    <td><?php echo esc_html__( 'Other Aggregates', 'cb-hydronix' ); ?></td>
                                    <td id="otherAggregatesRecipe" class="text-end">0</td>
                                    <td id="otherAggregatesTolerance" class="text-end">0</td>
                                    <td id="otherAggregatesHydronix" class="text-end">0</td>
                                </tr>
                                <tr>
                                    <td><?php echo esc_html__( 'Weight of uncompensated moisture', 'cb-hydronix' ); ?></td>
                                    <td id="uncompensatedMoistureRecipe" class="text-end">0</td>
                                    <td id="uncompensatedMoistureTolerance" class="text-end">0</td>
                                    <td id="uncompensatedMoistureHydronix" class="text-end">0</td>
                                </tr>
                                <tr>
                                    <th><?php echo esc_html__( 'Total Weight', 'cb-hydronix' ); ?></th>
                                    <th id="totalWeightRecipe" class="text-end">0</th>
                                    <th id="totalWeightTolerance" class="text-end">0</th>
                                    <th id="totalWeightHydronix" class="text-end">0</th>
                                </tr>

                                <tr>
                                    <td colspan="4"></td>
                                </tr>

                                <tr>
                                    <td><?php echo esc_html__( 'OPC', 'cb-hydronix' ); ?></td>
                                    <td id="opcRecipe" class="text-end">0</td>
                                    <td id="opcTolerance" class="text-end">0</td>
                                    <td id="opcHydronix" class="text-end">0</td>
                                </tr>
                                <tr>
                                    <td><?php echo esc_html__( 'PFA', 'cb-hydronix' ); ?></td>
                                    <td id="pfaRecipe" class="text-end">0</td>
                                    <td id="pfaTolerance" class="text-end">0</td>
                                    <td id="pfaHydronix" class="text-end">0</td>
                                </tr>
                                <tr>
                                    <td><?php echo esc_html__( 'GGBS', 'cb-hydronix' ); ?></td>
                                    <td id="ggbsRecipe" class="text-end">0</td>
                                    <td id="ggbsTolerance" class="text-end">0</td>
                                    <td id="ggbsHydronix" class="text-end">0</td>
                                </tr>
                                <tr>
                                    <td><?php echo esc_html__( 'Other Cement Replacements', 'cb-hydronix' ); ?></td>
                                    <td id="otherCementRecipe" class="text-end">0</td>
                                    <td id="otherCementTolerance" class="text-end">0</td>
                                    <td id="otherCementHydronix" class="text-end">0</td>
                                </tr>
                                <tr>
                                    <th><?php echo esc_html__( 'Total Cementitious Materials (Binder)', 'cb-hydronix' ); ?></th>
                                    <th id="totalCementitiousMaterialsRecipe" class="text-end">0</th>
                                    <th id="totalCementitiousMaterialsTolerance" class="text-end">0</th>
                                    <th id="totalCementitiousMaterialsHydronix" class="text-end">0</th>
                                </tr>

                                <tr>
                                    <td colspan="4"></td>
                                </tr>

                                <tr>
                                    <td><?php echo esc_html__( 'Mix design water (litres)', 'cb-hydronix' ); ?></td>
                                    <td id="mixDesignWaterRecipe" class="text-end">0</td>
                                    <td id="mixDesignWaterTolerance" class="text-end">0</td>
                                    <td id="mixDesignWaterHydronix" class="text-end">0</td>
                                </tr>
                                <tr>
                                    <td><?php echo esc_html__( 'Uncompensated Water in Aggregates (litres)', 'cb-hydronix' ); ?></td>
                                    <td id="uncompensatedWaterRecipe" class="text-end">0</td>
                                    <td id="uncompensatedWaterTolerance" class="text-end">0</td>
                                    <td id="uncompensatedWaterHydronix" class="text-end">0</td>
                                </tr>
                                <tr>
                                    <th><?php echo esc_html__( 'Total Water in mix (litres)', 'cb-hydronix' ); ?></th>
                                    <th id="totalWaterRecipe" class="text-end">0</th>
                                    <th id="totalWaterTolerance" class="text-end">0</th>
                                    <th id="totalWaterHydronix" class="text-end">0</th>
                                </tr>

                                <tr>
                                    <td colspan="4"></td>
                                </tr>

                                <tr>
                                    <td><?php echo esc_html__( 'Designed W/C ratio', 'cb-hydronix' ); ?></td>
                                    <td id="designedWCRatioRecipe" class="text-end">0</td>
                                    <td id="designedWCRatioTolerance" class="text-end">0</td>
                                    <td id="designedWCRatioHydronix" class="text-end">0</td>
                                </tr>
                                <tr>
                                    <td><?php echo esc_html__( 'Produced W/C ratio', 'cb-hydronix' ); ?></td>
                                    <td id="producedWCRatioRecipe">&nbsp;</td>
                                    <td id="producedWCRatioTolerance" class="text-end">0</td>
                                    <td id="producedWCRatioHydronix" class="text-end">0</td>
                                </tr>

                                <tr>
                                    <td colspan="4"></td>
                                </tr>

                                <tr>
                                    <td><?php echo esc_html__( 'Total Cement Needed to maintain SD target', 'cb-hydronix' ); ?></td>
                                    <td id="totalCementNeededRecipe">&nbsp;</td>
                                    <td id="totalCementNeededTolerance" class="text-end">0</td>
                                    <td id="totalCementNeededHydronix" class="text-end">0</td>
                                </tr>
                                <tr>
                                    <th><?php echo esc_html__( 'Extra cement needed to maintain SD target', 'cb-hydronix' ); ?></th>
                                    <th id="extraCementNeededRecipe">&nbsp;</th>
                                    <th id="extraCementNeededTolerance" class="text-end">0</th>
                                    <th id="extraCementNeededHydronix" class="text-end">0</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
					<div class="d-flex justify-content-between">
						<button class="btn btn-secondary mt-3" onclick="document.getElementById('material-moisture-tab').click();"><?php echo esc_html__( 'Back', 'cb-hydronix' ); ?></button>
						<button class="btn btn-primary mt-3 me-0" data-bs-toggle="modal" data-bs-target="#saveResultsModal"><?php echo esc_html__( 'Get Report', 'cb-hydronix' ); ?></button>
					</div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <?php
        if ( get_field( 'disclaimer' ) ) {
            echo '<div class="alert alert-light" role="alert">';
            echo wp_kses_post( get_field( 'disclaimer' ) );
            echo '</div>';
        }
        ?>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/10.6.4/math.min.js"></script>
    <script>
        // WordPress AJAX variables for cement calculator
        const ajaxUrl = '<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>';
        const cementCalcNonce = '<?php echo esc_js( wp_create_nonce( 'cement_calc_nonce' ) ); ?>';
    </script>
    <script src="<?= esc_url( get_stylesheet_directory_uri() . '/js/cementCalc.js' ); ?>"></script>
    <style>
        .modal-dialog {
            width: min(90vw, 800px);
            max-width: 800px;
        }
    </style>
</main>
<!-- Modal -->
<div class="modal fade" id="saveResultsModal" tabindex="-1" aria-labelledby="saveResultsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resultsModalLabel"><?php echo esc_html__( 'Send My Report', 'cb-hydronix' ); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?php echo esc_attr__( 'Close', 'cb-hydronix' ); ?>"></button>
            </div>
            <div class="modal-body">
                <?php
                if ( get_field( 'email_intro' ) ) {
                    echo '<div class="alert alert-info" role="alert">';
                    echo wp_kses_post( get_field( 'email_intro' ) );
                    echo '</div>';
                }
                ?>
                <form id="resultsForm">
                    <div class="mb-3">
                        <label for="nameField" class="form-label"><?php echo esc_html__( 'Name', 'cb-hydronix' ); ?></label>
                        <input type="text" class="form-control" id="nameField" placeholder="<?php echo esc_attr__( 'Enter your name', 'cb-hydronix' ); ?>" required>
                        <div class="invalid-feedback">
                            <?php echo esc_html__( 'Please provide your name.', 'cb-hydronix' ); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="companyField" class="form-label"><?php echo esc_html__( 'Company', 'cb-hydronix' ); ?></label>
                        <input type="text" class="form-control" id="companyField" placeholder="<?php echo esc_attr__( 'Enter your company', 'cb-hydronix' ); ?>" required>
                        <div class="invalid-feedback">
                            <?php echo esc_html__( 'Please provide your company name.', 'cb-hydronix' ); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="emailAddress" class="form-label"><?php echo esc_html__( 'Email Address', 'cb-hydronix' ); ?></label>
                        <input type="email" class="form-control" id="emailAddress" placeholder="<?php echo esc_attr__( 'Enter your email', 'cb-hydronix' ); ?>" required>
                        <div class="invalid-feedback">
                            <?php echo esc_html__( 'Please provide a valid email address.', 'cb-hydronix' ); ?>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-secondary" data-bs-dismiss="modal"><?php echo esc_html__( 'Close', 'cb-hydronix' ); ?></button>
                        <button type="button" class="btn btn-primary me-0" id="saveResultsButton" onclick="resultsJson()" disabled><?php echo esc_html__( 'Send My Results', 'cb-hydronix' ); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
