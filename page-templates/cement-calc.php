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
                <button class="nav-link active" id="recipe-tab" data-bs-toggle="tab" data-bs-target="#recipe" type="button" role="tab" aria-controls="recipe" aria-selected="true">Recipe</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="production-data-tab" data-bs-toggle="tab" data-bs-target="#production-data" type="button" role="tab" aria-controls="production-data" aria-selected="false">Production Data</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="material-moisture-tab" data-bs-toggle="tab" data-bs-target="#material-moisture" type="button" role="tab" aria-controls="material-moisture" aria-selected="false">Material Moisture</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="wc-report-tab" data-bs-toggle="tab" data-bs-target="#wc-report" type="button" role="tab" aria-controls="wc-report" aria-selected="false">Water/Cement Report</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="recipe" role="tabpanel" aria-labelledby="recipe-tab">
                <div class="mt-3">
                    <h2 class="mb-4">Mix Design for 1m<sup>3</sup> of Concrete</h2>
                    <div class="row g-5">
                        <div class="col-lg-6">
                            <h4>Aggregates</h4>

                            <div class="mb-3 row border-bottom">
                                <label for="sand1" class="col-sm-6 col-xl-8 col-form-label">Sand (0-2 mm)</label>
                                <div class="col-sm-6 col-xl-4">
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control text-end" id="sand1" value="1000" oninput="updateSlider(this); calculateAggregateTotal(); calculateBinderTotal(); calculateTotalDryWeight(); calculateRatios();">
                                        <span class="input-group-text">kg/m<sup>3</sup></span>
                                    </div>
                                    <input type="range" class="form-range" id="sand1-slider" min="0" max="2000" value="1000" step="1" oninput="updateNumberInput(this); calculateAggregateTotal(); calculateBinderTotal(); calculateTotalDryWeight(); calculateRatios();">
                                </div>
                            </div>

                            <div class="mb-3 row border-bottom">
                                <label for="sand2" class="col-sm-6 col-xl-8 col-form-label">Sand (0-4 mm)</label>
                                <div class="col-sm-6 col-xl-4">
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control text-end" id="sand2" value="1000" oninput="updateSlider(this); calculateAggregateTotal(); calculateBinderTotal(); calculateTotalDryWeight(); calculateRatios();">
                                        <span class="input-group-text">kg/m<sup>3</sup></span>
                                    </div>
                                    <input type="range" class="form-range" id="sand2-slider" min="0" max="2000" value="1000" step="1" oninput="updateNumberInput(this); calculateAggregateTotal(); calculateBinderTotal(); calculateTotalDryWeight(); calculateRatios();">
                                </div>
                            </div>

                            <div class="mb-3 row border-bottom">
                                <label for="aggregate" class="col-sm-6 col-xl-8 col-form-label">Aggregate (8-16 mm)</label>
                                <div class="col-sm-6 col-xl-4">
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control text-end" id="aggregate" value="650" oninput="updateSlider(this); calculateAggregateTotal(); calculateBinderTotal(); calculateTotalDryWeight(); calculateRatios();">
                                        <span class="input-group-text">kg/m<sup>3</sup></span>
                                    </div>
                                    <input type="range" class="form-range" id="aggregate-slider" min="0" max="2000" value="1000" step="1" oninput="updateNumberInput(this); calculateAggregateTotal(); calculateBinderTotal(); calculateTotalDryWeight(); calculateRatios();">
                                </div>
                            </div>

                            <div class="mb-3 row border-bottom">
                                <label for="otherAggregates" class="col-sm-6 col-xl-8 col-form-label">Other Aggregates</label>
                                <div class="col-sm-6 col-xl-4">
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control text-end" id="otherAggregates" value="0" oninput="calculateAggregateTotal(); calculateBinderTotal(); calculateTotalDryWeight(); calculateRatios();">
                                        <span class="input-group-text">kg/m<sup>3</sup></span>
                                    </div>
                                    <input type="range" class="form-range" id="otherAggregates-slider" min="0" max="2000" value="0" step="1" oninput="updateNumberInput(this); calculateAggregateTotal(); calculateBinderTotal(); calculateTotalDryWeight(); calculateRatios();">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-6 col-xl-8 col-form-label cLabel fw-bold">Total Dry Weight of Aggregates:</label>
                                <div class="col-sm-6 col-xl-4 d-flex align-items-center">
                                    <input type="text" class="form-control text-end" id="totalWeight" readonly>
                                    <span class="cLabel">kg/m<sup>3</sup></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <!-- Cementitious Materials Section -->
                            <h4>Cementitious Materials (Binder)</h4>
                            <div class="mb-3 row border-bottom">
                                <label for="opc" class="col-sm-6 col-xl-8 col-form-label" data-bs-toggle="tooltip" data-bs-placement="top" title="Ordinary Portland Cement">OPC</label>
                                <div class="col-sm-6 col-xl-4">
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control text-end" id="opc" value="300" oninput="calculateAggregateTotal(); calculateBinderTotal(); calculateTotalDryWeight(); calculateRatios();">
                                        <span class="input-group-text">kg/m<sup>3</sup></span>
                                    </div>
                                    <input type="range" class="form-range" id="opc-slider" min="0" max="1000" value="300" step="1" oninput="updateNumberInput(this); calculateAggregateTotal(); calculateBinderTotal(); calculateTotalDryWeight(); calculateRatios();">
                                </div>
                            </div>

                            <div class="mb-3 row border-bottom">
                                <label for="pfa" class="col-sm-6 col-xl-8 col-form-label" data-bs-toggle="tooltip" data-bs-placement="top" title="Pulverized Fuel Ash">PFA</label>
                                <div class="col-sm-6 col-xl-4">
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control text-end" id="pfa" value="0" oninput="calculateAggregateTotal(); calculateBinderTotal(); calculateTotalDryWeight(); calculateRatios();">
                                        <span class="input-group-text">kg/m<sup>3</sup></span>
                                    </div>
                                    <input type="range" class="form-range" id="pfa-slider" min="0" max="1000" value="0" step="1" oninput="updateNumberInput(this); calculateAggregateTotal(); calculateBinderTotal(); calculateTotalDryWeight(); calculateRatios();">
                                </div>
                            </div>

                            <div class="mb-3 row border-bottom">
                                <label for="ggbs" class="col-sm-6 col-xl-8 col-form-label" data-bs-toggle="tooltip" data-bs-placement="top" title="Ground Granulated Blast-Furnace Slag">GGBS</label>
                                <div class="col-sm-6 col-xl-4">
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control text-end" id="ggbs" value="50" oninput="calculateAggregateTotal(); calculateBinderTotal(); calculateTotalDryWeight(); calculateRatios();">
                                        <span class="input-group-text">kg/m<sup>3</sup></span>
                                    </div>
                                    <input type="range" class="form-range" id="ggbs-slider" min="0" max="1000" value="50" step="1" oninput="updateNumberInput(this); calculateAggregateTotal(); calculateBinderTotal(); calculateTotalDryWeight(); calculateRatios();">
                                </div>
                            </div>

                            <div class="mb-3 row border-bottom">
                                <label for="otherCement" class="col-sm-6 col-xl-8 col-form-label">Other Cement Replacements</label>
                                <div class="col-sm-6 col-xl-4">
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control text-end" id="otherCement" value="0" oninput="calculateAggregateTotal(); calculateBinderTotal(); calculateTotalDryWeight(); calculateRatios();">
                                        <span class="input-group-text">kg/m<sup>3</sup></span>
                                    </div>
                                    <input type="range" class="form-range" id="otherCement-slider" min="0" max="1000" value="0" step="1" oninput="updateNumberInput(this); calculateAggregateTotal(); calculateBinderTotal(); calculateTotalDryWeight(); calculateRatios();">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-6 col-xl-8 col-form-label cLabel fw-bold">Total Cementitious Materials (Binder):</label>
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
                        <label class="col-form-label cLabel fw-bold">Total Dry Weight for Recipe:</label>
                        <input type="text" class="form-control text-end" style="width:min-content" id="totalDryWeight" readonly>
                        <span class="cLabel">kg/m<sup>3</sup></span>
                    </div>

                    <div class="mb-3 row border-bottom justify-content-center">
                        <label for="water" class="col-md-3 col-form-label">Water</label>
                        <div class="col-md-3">
                            <div class="input-group mb-2">
                                <input type="number" class="form-control text-end" id="water" value="150" oninput="calculateAggregateTotal(); calculateBinderTotal(); calculateTotalDryWeight(); calculateRatios();">
                                <span class="input-group-text">litres</span>
                            </div>
                            <input type="range" class="form-range" id="water-slider" min="0" max="1000" value="150" step="1" oninput="updateNumberInput(this); calculateAggregateTotal(); calculateBinderTotal(); calculateTotalDryWeight(); calculateRatios();">
                        </div>
                    </div>

                    <div class="mb-3 pb-3 row border-bottom justify-content-center">
                        <label class="col-md-3 col-form-label fw-bold">Water / Binder Ratio</label>
                        <div class="col-md-3 d-flex align-items-center">
                            <input type="text" class="form-control text-end" style="max-width:100px" id="waterBinderRatio" readonly>
                            <span class="cLabel"> : 1</span>
                        </div>
                    </div>

                    <div class="mb-3 pb-3 row border-bottom justify-content-center">
                        <label class="col-md-3 col-form-label fw-bold">Aggregate / Binder Ratio</label>
                        <div class="col-md-3 d-flex align-items-center">
                            <input type="text" class="form-control text-end" style="max-width:100px" id="aggregateBinderRatio" readonly>
                            <span class="cLabel"> : 1</span>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary mt-3 ms-auto me-0" onclick="document.getElementById('production-data-tab').click();">Next</button>
            </div>
            <!-- Production Data Tab -->
            <div class="tab-pane fade" id="production-data" role="tabpanel" aria-labelledby="production-data-tab">
                <div class="mt-3">
                    <h2>Production Data</h2>
                    <div class="mb-3 row border-bottom">
                        <label for="volumePerDay" class="col-sm-6 col-xl-8 col-form-label">Volume of concrete per day</label>
                        <div class="col-sm-6 col-xl-4">
                            <div class="input-group mb-2">
                                <input type="number" class="form-control" id="volumePerDay" value="100">
                                <span class="input-group-text"> m<sup>3</sup></span>
                            </div>
                            <input type="range" class="form-range" id="volumePerDay-slider" min="0" max="1000" value="100" step="1" oninput="updateNumberInput(this);">
                        </div>
                    </div>
                    <div class="mb-3 row border-bottom">
                        <label for="daysPerYear" class="col-sm-6 col-xl-8 col-form-label">Days worked per year</label>
                        <div class="col-sm-6 col-xl-4">
                            <div class="input-group mb-2">
                                <input type="number" class="form-control" id="daysPerYear" value="250">
                                <span class="input-group-text">Days</span>
                            </div>
                            <input type="range" class="form-range" id="daysPerYear-slider" min="0" max="365" value="250" step="1" oninput="updateNumberInput(this);">
                        </div>
                    </div>
                    <div class="mb-3 row border-bottom">
                        <label for="cementCost" class="col-sm-6 col-xl-8 col-form-label">Cement cost/tonne</label>
                        <div class="col-sm-6 col-xl-4">
                            <div class="input-group mb-2">
                                <span class="input-group-text">£/$/€</span>
                                <input type="number" class="form-control" id="cementCost" value="80">
                            </div>
                            <input type="range" class="form-range" id="cementCost-slider" min="0" max="365" value="250" step="1" oninput="updateNumberInput(this);">
                        </div>
                    </div>
                    <div class="mb-3 row border-bottom">
                        <label for="cementCO2" class="col-sm-6 col-xl-8 col-form-label">Cement CO2 Equivalent</label>
                        <div class="col-sm-6 col-xl-4">
                            <div class="input-group mb-2">
                                <input type="number" class="form-control" id="cementCO2" value="928">
                                <span class="input-group-text">kgCO<sub>2</sub>e/t</span>
                            </div>
                            <input type="range" class="form-range" id="cementCO2-slider" min="0" max="1000" value="928" step="1" oninput="updateNumberInput(this);">
                        </div>
                    </div>
                    <div class="mb-3 row border-bottom">
                        <label for="productionCost" class="col-sm-6 col-xl-8 col-form-label">Production Cost</label>
                        <div class="col-sm-6 col-xl-4">
                            <div class="input-group mb-2">
                                <input type="number" class="form-control" id="productionCost" value="100">
                                <span class="input-group-text">£/m<sup>3</sup></span>
                            </div>
                            <input type="range" class="form-range" id="productionCost-slider" min="0" max="1000" value="100" step="1" oninput="updateNumberInput(this);">
                        </div>
                    </div>
                    <div class="mb-3 row border-bottom">
                        <label for="salePrice" class="col-sm-6 col-xl-8 col-form-label">Sale price</label>
                        <div class="col-sm-6 col-xl-4">
                            <div class="input-group mb-2">
                                <input type="number" class="form-control" id="salePrice" value="150">
                                <span class="input-group-text">£/m<sup>3</sup></span>
                            </div>
                            <input type="range" class="form-range" id="salePrice-slider" min="0" max="1000" value="150" step="1" oninput="updateNumberInput(this);">
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary mt-3 ms-auto me-0" onclick="document.getElementById('material-moisture-tab').click();">Next</button>
            </div>
            <!-- Material Moisture Tab -->
            <div class="tab-pane fade" id="material-moisture" role="tabpanel" aria-labelledby="material-moisture-tab">
                <div class="mt-3">
                    <h2>Material Moisture</h2>
                    <div class="mb-3 row">
                        <label for="moistureMethod" class="col-sm-8 col-form-label">How is the moisture currently measured?</label>
                        <div class="col-sm-4">
                            <select class="form-select" id="moistureMethod" onchange="toggleMoistureFields();">
                                <option value="automatic">Automatic</option>
                                <option value="manual">Manual</option>
                            </select>
                        </div>
                    </div>

                    <!-- Nominal Moisture, Manual, and Automatic Inputs -->
                    <div id="moistureFields">
                        <h4>Moisture Content</h4>
                        <div class="mb-3 pb-3 row border-bottom">
                            <label for="sand1Nominal" class="col-sm-4 col-form-label">Sand (0-2 mm)</label>
                            <div class="col-sm-8">
                                <div class="input-group mb-2">
                                    <span class="input-group-text">Nominal Moisture</span>
                                    <input type="number" class="form-control" id="sand1Nominal" value="6.5" oninput="calculatePotentialManual(); calculatePotentialAutomatic();">
                                    <span class="input-group-text">%</span>
                                </div>
                                <div class="input-group mb-2 manual-field">
                                    <span class="input-group-text">Min</span>
                                    <input type="number" class="form-control" id="sand1Min" value="2.5" oninput="calculatePotentialManual();">
                                    <span class="input-group-text">%</span>
                                    <span class="input-group-text">Max</span>
                                    <input type="number" class="form-control" id="sand1Max" value="10.0" oninput="calculatePotentialManual();">
                                    <span class="input-group-text">%</span>
                                </div>
                                <div class="input-group mb-2 automatic-field" style="display: none;">
                                    <span class="input-group-text">Accuracy</span>
                                    <input type="number" class="form-control" id="sand1Accuracy" value="0.5" oninput="calculatePotentialAutomatic();">
                                    <span class="input-group-text">+/- %</span>
                                </div>
                                <span class="cLabel">Potential Maximum Unknown Moisture</span>
                                <input type="text" style="width:4rem;text-align:end;" id="sand1Potential" readonly>
                                <span class="cLabel">%</span>
                            </div>
                        </div>
                        <!-- Similar setup for other moisture materials -->
                        <div class="mb-3 pb-3 row border-bottom">
                            <label for="sand2Nominal" class="col-sm-4 col-form-label">Sand (0-4 mm)</label>
                            <div class="col-sm-8">
                                <div class="input-group mb-2">
                                    <span class="input-group-text">Nominal Moisture</span>
                                    <input type="number" class="form-control" id="sand2Nominal" value="5.5" oninput="calculatePotentialManual(); calculatePotentialAutomatic();">
                                    <span class="input-group-text">%</span>
                                </div>
                                <div class="input-group mb-2 manual-field">
                                    <span class="input-group-text">Min</span>
                                    <input type="number" class="form-control" id="sand2Min" value="4.0" oninput="calculatePotentialManual();">
                                    <span class="input-group-text">%</span>
                                    <span class="input-group-text">Max</span>
                                    <input type="number" class="form-control" id="sand2Max" value="7.0" oninput="calculatePotentialManual();">
                                    <span class="input-group-text">%</span>
                                </div>
                                <div class="input-group mb-2 automatic-field" style="display: none;">
                                    <span class="input-group-text">Accuracy</span>
                                    <input type="number" class="form-control" id="sand2Accuracy" value="0.5" oninput="calculatePotentialAutomatic();">
                                    <span class="input-group-text">+/- %</span>
                                </div>
                                <span class="cLabel">Potential Maximum Unknown Moisture</span>
                                <input type="text" style="width:4rem;text-align:end;" id="sand2Potential" readonly>
                                <span class="cLabel">%</span>
                            </div>
                        </div>
                        <!-- Aggregate Moisture Content -->
                        <div class="mb-3 pb-3 row border-bottom">
                            <label for="aggregateNominal" class="col-sm-4 col-form-label">Aggregate (8-16 mm)</label>
                            <div class="col-sm-8">
                                <div class="input-group mb-2">
                                    <span class="input-group-text">Nominal Moisture</span>
                                    <input type="number" class="form-control" id="aggregateNominal" value="2.5" oninput="calculatePotentialManual(); calculatePotentialAutomatic();">
                                    <span class="input-group-text">%</span>
                                </div>
                                <div class="input-group mb-2 manual-field">
                                    <span class="input-group-text">Min</span>
                                    <input type="number" class="form-control" id="aggregateMin" value="2.0" oninput="calculatePotentialManual();">
                                    <span class="input-group-text">%</span>
                                    <span class="input-group-text">Max</span>
                                    <input type="number" class="form-control" id="aggregateMax" value="4.0" oninput="calculatePotentialManual();">
                                    <span class="input-group-text">%</span>
                                </div>
                                <div class="input-group mb-2 automatic-field" style="display: none;">
                                    <span class="input-group-text">Accuracy</span>
                                    <input type="number" class="form-control" id="aggregateAccuracy" value="0.5" oninput="calculatePotentialAutomatic();">
                                    <span class="input-group-text">+/- %</span>
                                </div>
                                <span class="cLabel">Potential Maximum Unknown Moisture</span>
                                <input type="text" style="width:4rem;text-align:end;" id="aggregatePotential" readonly>
                                <span class="cLabel">%</span>
                            </div>
                        </div>
                        <!-- Other Aggregates Moisture Content -->
                        <div class="mb-3 pb-3 row border-bottom">
                            <label for="otherAggregatesNominal" class="col-sm-4 col-form-label">Other Aggregates</label>
                            <div class="col-sm-8">
                                <div class="input-group mb-2">
                                    <span class="input-group-text">Nominal Moisture</span>
                                    <input type="number" class="form-control" id="otherAggregatesNominal" value="0.0" oninput="calculatePotentialManual(); calculatePotentialAutomatic();">
                                    <span class="input-group-text">%</span>
                                </div>
                                <div class="input-group mb-2 manual-field">
                                    <span class="input-group-text">Min</span>
                                    <input type="number" class="form-control" id="otherAggregatesMin" value="0.0" oninput="calculatePotentialManual();">
                                    <span class="input-group-text">%</span>
                                    <span class="input-group-text">Max</span>
                                    <input type="number" class="form-control" id="otherAggregatesMax" value="0.0" oninput="calculatePotentialManual();">
                                    <span class="input-group-text">%</span>
                                </div>
                                <div class="input-group mb-2 automatic-field" style="display: none;">
                                    <span class="input-group-text">Accuracy</span>
                                    <input type="number" class="form-control" id="otherAggregatesAccuracy" value="0.5" oninput="calculatePotentialAutomatic();">
                                    <span class="input-group-text">+/- %</span>
                                </div>
                                <span class="cLabel">Potential Maximum Unknown Moisture</span>
                                <input type="text" style="width:4rem;text-align:end;" id="otherAggregatesPotential" readonly>
                                <span class="cLabel">%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary mt-3 ms-auto me-0" onclick="document.getElementById('wc-report-tab').click();">Next</button>
            </div>
            <div class="tab-pane fade" id="wc-report" role="tabpanel" aria-labelledby="wc-report-tab">
                <div class="mt-3">
                    <h2>Water/Cement Report</h2>
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
                                    <th id="toleranceColumnTitle">Using existing measurement tolerance</th>
                                    <th>With Hydronix</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Sand 0 - 2mm</td>
                                    <td id="sand1Recipe" class="text-end">1000</td>
                                    <td id="sand1Tolerance" class="text-end">0</td>
                                    <td id="sand1Hydronix" class="text-end">0</td>
                                </tr>
                                <tr>
                                    <td>Sand 0 - 4mm</td>
                                    <td id="sand2Recipe" class="text-end">1000</td>
                                    <td id="sand2Tolerance" class="text-end">0</td>
                                    <td id="sand2Hydronix" class="text-end">0</td>
                                </tr>
                                <tr>
                                    <td>Aggregate 8 - 16mm</td>
                                    <td id="aggregateRecipe" class="text-end">650</td>
                                    <td id="aggregateTolerance" class="text-end">0</td>
                                    <td id="aggregateHydronix" class="text-end">0</td>
                                </tr>
                                <tr>
                                    <td>Other Aggregates</td>
                                    <td id="otherAggregatesRecipe" class="text-end">0</td>
                                    <td id="otherAggregatesTolerance" class="text-end">0</td>
                                    <td id="otherAggregatesHydronix" class="text-end">0</td>
                                </tr>
                                <tr>
                                    <td>Weight of uncompensated moisture</td>
                                    <td id="uncompensatedMoistureRecipe" class="text-end">0</td>
                                    <td id="uncompensatedMoistureTolerance" class="text-end">0</td>
                                    <td id="uncompensatedMoistureHydronix" class="text-end">0</td>
                                </tr>
                                <tr>
                                    <th>Total Weight</th>
                                    <th id="totalWeightRecipe" class="text-end">0</th>
                                    <th id="totalWeightTolerance" class="text-end">0</th>
                                    <th id="totalWeightHydronix" class="text-end">0</th>
                                </tr>

                                <tr>
                                    <td colspan="4"></td>
                                </tr>

                                <tr>
                                    <td>OPC</td>
                                    <td id="opcRecipe" class="text-end">0</td>
                                    <td id="opcTolerance" class="text-end">0</td>
                                    <td id="opcHydronix" class="text-end">0</td>
                                </tr>
                                <tr>
                                    <td>PFA</td>
                                    <td id="pfaRecipe" class="text-end">0</td>
                                    <td id="pfaTolerance" class="text-end">0</td>
                                    <td id="pfaHydronix" class="text-end">0</td>
                                </tr>
                                <tr>
                                    <td>GGBS</td>
                                    <td id="ggbsRecipe" class="text-end">0</td>
                                    <td id="ggbsTolerance" class="text-end">0</td>
                                    <td id="ggbsHydronix" class="text-end">0</td>
                                </tr>
                                <tr>
                                    <td>Other Cement Replacements</td>
                                    <td id="otherCementRecipe" class="text-end">0</td>
                                    <td id="otherCementTolerance" class="text-end">0</td>
                                    <td id="otherCementHydronix" class="text-end">0</td>
                                </tr>
                                <tr>
                                    <th>Total Cementitious Materials (Binder)</th>
                                    <th id="totalCementitiousMaterialsRecipe" class="text-end">0</th>
                                    <th id="totalCementitiousMaterialsTolerance" class="text-end">0</th>
                                    <th id="totalCementitiousMaterialsHydronix" class="text-end">0</th>
                                </tr>

                                <tr>
                                    <td colspan="4"></td>
                                </tr>

                                <tr>
                                    <td>Mix design water (litres)</td>
                                    <td id="mixDesignWaterRecipe" class="text-end">0</td>
                                    <td id="mixDesignWaterTolerance" class="text-end">0</td>
                                    <td id="mixDesignWaterHydronix" class="text-end">0</td>
                                </tr>
                                <tr>
                                    <td>uncompensated Water in Aggregates (litres)</td>
                                    <td id="uncompensatedWaterRecipe" class="text-end">0</td>
                                    <td id="uncompensatedWaterTolerance" class="text-end">0</td>
                                    <td id="uncompensatedWaterHydronix" class="text-end">0</td>
                                </tr>
                                <tr>
                                    <th>Total Water in mix (litres)</th>
                                    <th id="totalWaterRecipe" class="text-end">0</th>
                                    <th id="totalWaterTolerance" class="text-end">0</th>
                                    <th id="totalWaterHydronix" class="text-end">0</th>
                                </tr>

                                <tr>
                                    <td colspan="4"></td>
                                </tr>

                                <tr>
                                    <td>Designed W/C ratio</td>
                                    <td id="designedWCRatioRecipe" class="text-end">0</td>
                                    <td id="designedWCRatioTolerance" class="text-end">0</td>
                                    <td id="designedWCRatioHydronix" class="text-end">0</td>
                                </tr>
                                <tr>
                                    <td>Produced W/C ratio</td>
                                    <td id="producedWCRatioRecipe">&nbsp;</td>
                                    <td id="producedWCRatioTolerance" class="text-end">0</td>
                                    <td id="producedWCRatioHydronix" class="text-end">0</td>
                                </tr>

                                <tr>
                                    <td colspan="4"></td>
                                </tr>

                                <tr>
                                    <td>Total Cement Needed to maintain SD target</td>
                                    <td id="totalCementNeededRecipe">&nbsp;</td>
                                    <td id="totalCementNeededTolerance" class="text-end">0</td>
                                    <td id="totalCementNeededHydronix" class="text-end">0</td>
                                </tr>
                                <tr>
                                    <th>Extra cement needed to maintain SD target</th>
                                    <th id="extraCementNeededRecipe">&nbsp;</th>
                                    <th id="extraCementNeededTolerance" class="text-end">0</th>
                                    <th id="extraCementNeededHydronix" class="text-end">0</th>
                                </tr>

                                <tr>
                                    <td colspan="4"></td>
                                </tr>

                                <tr>
                                    <th>Potential cement cost by not using Hydronix moisture measurement</th>
                                    <td id="">kg/m<sup>3</sup></td>
                                    <td id="potentialCementCost">0</td>
                                    <td id="">&nbsp;</td>
                                </tr>
                                <tr>
                                    <th>Extra Cement required to maintain w/c ratio per year</th>
                                    <td id="">Tonnes</td>
                                    <td id="extraCementPerYear">0</td>
                                    <td id="">&nbsp;</td>
                                </tr>

                                <tr>
                                    <td colspan="4"></td>
                                </tr>

                                <tr>
                                    <th>Cost of not using Hydronix per m<sup>3</sup></th>
                                    <td id="">£/$/€ <span id="costNotHydronixM"></span></td>
                                    <td id="">&nbsp;</td>
                                    <td id="">&nbsp;</td>
                                </tr>
                                <tr>
                                    <th>Cost of not using Hydronix per year</th>
                                    <td id="">£/$/€ <span id="costNotHydronixY"></span></td>
                                    <td id="">&nbsp;</td>
                                    <td id="">&nbsp;</td>
                                </tr>
                                <tr>
                                    <th>Environmental Cost of not using Hydronix per year</th>
                                    <td id=""><span id="envNotHydronixY"></span> kgCO<sub>2</sub>e/t</td>
                                    <td id="">&nbsp;</td>
                                    <td id="">&nbsp;</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <button class="btn btn-primary mt-3 ms-auto me-0" data-bs-toggle="modal" data-bs-target="#saveResultsModal">Get Report</button>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Modal -->
<div class="modal fade" id="saveResultsModal" tabindex="-1" aria-labelledby="saveResultsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resultsModalLabel">Send My Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="resultsForm">
                    <div class="mb-3">
                        <label for="nameField" class="form-label">Name</label>
                        <input type="text" class="form-control" id="nameField" placeholder="Enter your name" required>
                        <div class="invalid-feedback">
                            Please provide your name.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="companyField" class="form-label">Company</label>
                        <input type="text" class="form-control" id="companyField" placeholder="Enter your company" required>
                        <div class="invalid-feedback">
                            Please provide your company name.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="emailAddress" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="emailAddress" placeholder="Enter your email" required>
                        <div class="invalid-feedback">
                            Please provide a valid email address.
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" id="saveResultsButton" onclick="resultsJson()" disabled>Save Results</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php

/**
 * Enqueue scripts.
 */
function cb_hydronix_enqueue_cement_calc_scripts() {
    // Bootstrap Bundle JS.
    wp_enqueue_script(
        'bootstrap-bundle',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js',
        array(),
        null,
        true
    );
    // MathJS.
    wp_enqueue_script(
        'mathjs',
        'https://cdnjs.cloudflare.com/ajax/libs/mathjs/10.6.4/math.min.js',
        array(),
        null,
        true
    );
    // Local cementCalc.js, depends on mathjs and bootstrap.
    wp_enqueue_script(
        'cement-calc',
        get_stylesheet_directory_uri() . '/js/cementCalc.js',
        array( 'mathjs', 'bootstrap-bundle' ),
        null,
        true
    );
}
add_action( 'wp_enqueue_scripts', 'cb_hydronix_enqueue_cement_calc_scripts' );

get_footer();
