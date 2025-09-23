function calculateAggregateTotal() {
    // Get values of each input field for aggregates
    const sand1 = parseFloat(document.getElementById('sand1').value) || 0;
    const sand2 = parseFloat(document.getElementById('sand2').value) || 0;
    const aggregate = parseFloat(document.getElementById('aggregate').value) || 0;
    const otherAggregates = parseFloat(document.getElementById('otherAggregates').value) || 0;

    // Calculate total weight for aggregates
    const totalWeight = sand1 + sand2 + aggregate + otherAggregates;

    // Set total weight value for aggregates
    document.getElementById('totalWeight').value = totalWeight;
}

function calculateBinderTotal() {
    // Get values of each input field for cementitious materials
    const opc = parseFloat(document.getElementById('opc').value) || 0;
    const pfa = parseFloat(document.getElementById('pfa').value) || 0;
    const ggbs = parseFloat(document.getElementById('ggbs').value) || 0;
    const otherCement = parseFloat(document.getElementById('otherCement').value) || 0;

    // Calculate total weight for cementitious materials
    const totalBinderWeight = opc + pfa + ggbs + otherCement;

    // Set total weight value for cementitious materials
    document.getElementById('totalBinderWeight').value = totalBinderWeight;
}

function calculateTotalDryWeight() {
    // Get total dry weight of aggregates and binder
    const totalWeightAggregates = parseFloat(document.getElementById('totalWeight').value) || 0;
    const totalWeightBinder = parseFloat(document.getElementById('totalBinderWeight').value) || 0;

    // Calculate total dry weight
    const totalDryWeight = totalWeightAggregates + totalWeightBinder;

    // Set total dry weight value for the recipe
    document.getElementById('totalDryWeight').value = totalDryWeight;
}

function calculateRatios() {
    // Get values for calculations
    const totalWeightBinder = parseFloat(document.getElementById('totalBinderWeight').value) || 0;
    const water = parseFloat(document.getElementById('water').value) || 0;
    const totalWeightAggregates = parseFloat(document.getElementById('totalWeight').value) || 0;

    // Calculate Water / Binder Ratio
    const waterBinderRatio = totalWeightBinder !== 0 ? (water / totalWeightBinder).toFixed(2) : 0;
    document.getElementById('waterBinderRatio').value = waterBinderRatio;

    // Calculate Aggregate / Binder Ratio
    const aggregateBinderRatio = totalWeightBinder !== 0 ? (totalWeightAggregates / totalWeightBinder).toFixed(2) : 0;
    document.getElementById('aggregateBinderRatio').value = aggregateBinderRatio;
}

// Initial calculations
calculateAggregateTotal();
calculateBinderTotal();
calculateTotalDryWeight();
calculateRatios();

// Recalculate when relevant values change
document.getElementById('water').addEventListener('input', calculateRatios);
document.getElementById('totalBinderWeight').addEventListener('input', calculateRatios);
document.getElementById('totalWeight').addEventListener('input', calculateRatios);

// Initialize Bootstrap tooltips
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
});

function toggleMoistureFields() {
    const moistureMethod = document.getElementById('moistureMethod').value;
    const manualFields = document.querySelectorAll('.manual-field');
    const automaticFields = document.querySelectorAll('.automatic-field');
    
    if (moistureMethod === 'manual') {
        manualFields.forEach(field => field.style.display = 'flex');
        automaticFields.forEach(field => field.style.display = 'none');
        calculatePotentialManual();
    } else if (moistureMethod === 'automatic') {
        manualFields.forEach(field => field.style.display = 'none');
        automaticFields.forEach(field => field.style.display = 'flex');
        calculatePotentialAutomatic();
    }
}

function calculatePotentialManual() {
    const sand1Nominal = parseFloat(document.getElementById('sand1Nominal').value) || 0;
    const sand1Max = parseFloat(document.getElementById('sand1Max').value) || 0;
    document.getElementById('sand1Potential').value = (sand1Max - sand1Nominal).toFixed(2);
    
    const sand2Nominal = parseFloat(document.getElementById('sand2Nominal').value) || 0;
    const sand2Max = parseFloat(document.getElementById('sand2Max').value) || 0;
    document.getElementById('sand2Potential').value = (sand2Max - sand2Nominal).toFixed(2);
}

function calculatePotentialAutomatic() {
    const sand1Accuracy = parseFloat(document.getElementById('sand1Accuracy').value) || 0;
    document.getElementById('sand1Potential').value = sand1Accuracy.toFixed(2);
    
    const sand2Accuracy = parseFloat(document.getElementById('sand2Accuracy').value) || 0;
    document.getElementById('sand2Potential').value = sand2Accuracy.toFixed(2);
}

document.getElementById('moistureMethod').addEventListener('change', toggleMoistureFields);
toggleMoistureFields();

function toggleMoistureFields() {
    const moistureMethod = document.getElementById('moistureMethod').value;
    const manualFields = document.querySelectorAll('.manual-field');
    const automaticFields = document.querySelectorAll('.automatic-field');
    
    if (moistureMethod === 'manual') {
        manualFields.forEach(field => field.style.display = 'flex');
        automaticFields.forEach(field => field.style.display = 'none');
        calculatePotentialManual();
    } else if (moistureMethod === 'automatic') {
        manualFields.forEach(field => field.style.display = 'none');
        automaticFields.forEach(field => field.style.display = 'flex');
        calculatePotentialAutomatic();
    }
}

function calculatePotentialManual() {
    const sand1Nominal = parseFloat(document.getElementById('sand1Nominal').value) || 0;
    const sand1Max = parseFloat(document.getElementById('sand1Max').value) || 0;
    document.getElementById('sand1Potential').value = (sand1Max - sand1Nominal).toFixed(2);
    
    const sand2Nominal = parseFloat(document.getElementById('sand2Nominal').value) || 0;
    const sand2Max = parseFloat(document.getElementById('sand2Max').value) || 0;
    document.getElementById('sand2Potential').value = (sand2Max - sand2Nominal).toFixed(2);
    
    const aggregateNominal = parseFloat(document.getElementById('aggregateNominal').value) || 0;
    const aggregateMax = parseFloat(document.getElementById('aggregateMax').value) || 0;
    document.getElementById('aggregatePotential').value = (aggregateMax - aggregateNominal).toFixed(2);
    
    const otherAggregatesNominal = parseFloat(document.getElementById('otherAggregatesNominal').value) || 0;
    const otherAggregatesMax = parseFloat(document.getElementById('otherAggregatesMax').value) || 0;
    document.getElementById('otherAggregatesPotential').value = (otherAggregatesMax - otherAggregatesNominal).toFixed(2);
}

function calculatePotentialAutomatic() {
    const sand1Accuracy = parseFloat(document.getElementById('sand1Accuracy').value) || 0;
    document.getElementById('sand1Potential').value = sand1Accuracy.toFixed(2);
    
    const sand2Accuracy = parseFloat(document.getElementById('sand2Accuracy').value) || 0;
    document.getElementById('sand2Potential').value = sand2Accuracy.toFixed(2);
    
    const aggregateAccuracy = parseFloat(document.getElementById('aggregateAccuracy').value) || 0;
    document.getElementById('aggregatePotential').value = aggregateAccuracy.toFixed(2);
    
    const otherAggregatesAccuracy = parseFloat(document.getElementById('otherAggregatesAccuracy').value) || 0;
    document.getElementById('otherAggregatesPotential').value = otherAggregatesAccuracy.toFixed(2);
}

document.getElementById('moistureMethod').addEventListener('change', toggleMoistureFields);
toggleMoistureFields();

// Add event listeners for recalculating manual and automatic potentials
document.querySelectorAll('.manual-field input, .automatic-field input, #sand1Nominal, #sand2Nominal, #aggregateNominal, #otherAggregatesNominal').forEach(input => {
    input.addEventListener('input', () => {
        if (document.getElementById('moistureMethod').value === 'manual') {
            calculatePotentialManual();
        } else {
            calculatePotentialAutomatic();
        }
    });
});

function updateColumnTitle() {
    const moistureMethod = document.getElementById('moistureMethod').value;
    const titleElement = document.getElementById('toleranceColumnTitle');
    if (moistureMethod === 'automatic') {
        titleElement.innerText = 'Using existing measurement tolerance (Automatic)';
    } else {
        titleElement.innerText = 'Using existing measurement tolerance (Manual)';
    }
}

function updateWCReport() {
    // Pull values from the Recipe tab inputs using Math.js for precision
    const sand1 = math.bignumber(parseFloat(document.getElementById('sand1').value) || 0);
    const sand2 = math.bignumber(parseFloat(document.getElementById('sand2').value) || 0);
    const aggregate = math.bignumber(parseFloat(document.getElementById('aggregate').value) || 0);
    const otherAggregates = math.bignumber(parseFloat(document.getElementById('otherAggregates').value) || 0);
    const opc = math.bignumber(parseFloat(document.getElementById('opc').value) || 0);
    const pfa = math.bignumber(parseFloat(document.getElementById('pfa').value) || 0);
    const ggbs = math.bignumber(parseFloat(document.getElementById('ggbs').value) || 0);
    const otherCement = math.bignumber(parseFloat(document.getElementById('otherCement').value) || 0);
    const water = math.bignumber(parseFloat(document.getElementById('water').value) || 0);
    const volumePerDay = math.bignumber(parseFloat(document.getElementById('volumePerDay').value) || 0);
    const daysPerYear = math.bignumber(parseFloat(document.getElementById('daysPerYear').value) || 0);

    // Initialize variables to ensure they're defined
    let uncompensatedMoisture = math.bignumber(0);
    let uncompensatedMoistureHydronix = math.bignumber(0);

    // Calculate total weights
    const totalWeight = math.add(math.add(sand1, sand2), math.add(aggregate, otherAggregates));
    const totalCementitiousMaterials = math.add(math.add(opc, pfa), math.add(ggbs, otherCement));

    // Update the 'Your Recipe' column in the WC Report
    document.getElementById('sand1Recipe').innerText = math.format(sand1, {notation: 'fixed', precision: 0});
    document.getElementById('sand2Recipe').innerText = math.format(sand2, {notation: 'fixed', precision: 0});
    document.getElementById('aggregateRecipe').innerText = math.format(aggregate, {notation: 'fixed', precision: 0});
    document.getElementById('otherAggregatesRecipe').innerText = math.format(otherAggregates, {notation: 'fixed', precision: 0});
    document.getElementById('opcRecipe').innerText = math.format(opc, {notation: 'fixed', precision: 0});
    document.getElementById('pfaRecipe').innerText = math.format(pfa, {notation: 'fixed', precision: 0});
    document.getElementById('ggbsRecipe').innerText = math.format(ggbs, {notation: 'fixed', precision: 0});
    document.getElementById('otherCementRecipe').innerText = math.format(otherCement, {notation: 'fixed', precision: 0});
    document.getElementById('totalWeightRecipe').innerText = math.format(totalWeight, {notation: 'fixed', precision: 0});
    document.getElementById('totalCementitiousMaterialsRecipe').innerText = math.format(totalCementitiousMaterials, {notation: 'fixed', precision: 0});

    // Set zero values for tolerance and Hydronix columns for OPC, PFA, GGBS, Other Cement
    document.getElementById('opcTolerance').innerText = '0.00';
    document.getElementById('pfaTolerance').innerText = '0.00';
    document.getElementById('ggbsTolerance').innerText = '0.00';
    document.getElementById('otherCementTolerance').innerText = '0.00';
    document.getElementById('opcHydronix').innerText = '0.00';
    document.getElementById('pfaHydronix').innerText = '0.00';
    document.getElementById('ggbsHydronix').innerText = '0.00';
    document.getElementById('otherCementHydronix').innerText = '0.00';

    // Update total cementitious materials for tolerance and Hydronix columns
    document.getElementById('totalCementitiousMaterialsTolerance').innerText = math.format(totalCementitiousMaterials, {notation: 'fixed', precision: 0});
    document.getElementById('totalCementitiousMaterialsHydronix').innerText = math.format(totalCementitiousMaterials, {notation: 'fixed', precision: 0});

    // Determine measurement method (manual or automatic)
    const moistureMethod = document.getElementById('moistureMethod').value;

    if (moistureMethod === 'automatic') {
        // Calculate tolerance values for 'Using existing measurement tolerance'
        const sand1Accuracy = math.bignumber(parseFloat(document.getElementById('sand1Accuracy').value) / 100);
        const sand2Accuracy = math.bignumber(parseFloat(document.getElementById('sand2Accuracy').value) / 100);
        const aggregateAccuracy = math.bignumber(parseFloat(document.getElementById('aggregateAccuracy').value) / 100);
        const otherAggregatesAccuracy = math.bignumber(parseFloat(document.getElementById('otherAggregatesAccuracy').value) / 100);

        const sand1Tolerance = math.multiply(sand1, sand1Accuracy);
        const sand2Tolerance = math.multiply(sand2, sand2Accuracy);
        const aggregateTolerance = math.multiply(aggregate, aggregateAccuracy);
        const otherAggregatesTolerance = math.multiply(otherAggregates, otherAggregatesAccuracy);
        uncompensatedMoisture = math.add(math.add(sand1Tolerance, sand2Tolerance), math.add(aggregateTolerance, otherAggregatesTolerance));
        const totalWeightTolerance = math.round(math.add(totalWeight, uncompensatedMoisture));

        // Update tolerance values in WC Report
        document.getElementById('sand1Tolerance').innerText = math.format(sand1Tolerance, {notation: 'fixed', precision: 2});
        document.getElementById('sand2Tolerance').innerText = math.format(sand2Tolerance, {notation: 'fixed', precision: 2});
        document.getElementById('aggregateTolerance').innerText = math.format(aggregateTolerance, {notation: 'fixed', precision: 2});
        document.getElementById('otherAggregatesTolerance').innerText = math.format(otherAggregatesTolerance, {notation: 'fixed', precision: 2});
        document.getElementById('uncompensatedMoistureTolerance').innerText = math.format(uncompensatedMoisture, {notation: 'fixed', precision: 2});
        document.getElementById('totalWeightTolerance').innerText = math.format(totalWeightTolerance, {notation: 'fixed', precision: 0});
    } else {
        // Manual method: use Min and Max values to calculate the worst-case moisture
        const sand1Max = math.bignumber(parseFloat(document.getElementById('sand1Max').value) || 0);
        const sand1Nominal = math.bignumber(parseFloat(document.getElementById('sand1Nominal').value) || 0);
        const sand2Max = math.bignumber(parseFloat(document.getElementById('sand2Max').value) || 0);
        const sand2Nominal = math.bignumber(parseFloat(document.getElementById('sand2Nominal').value) || 0);
        const aggregateMax = math.bignumber(parseFloat(document.getElementById('aggregateMax').value) || 0);
        const aggregateNominal = math.bignumber(parseFloat(document.getElementById('aggregateNominal').value) || 0);
        const otherAggregatesMax = math.bignumber(parseFloat(document.getElementById('otherAggregatesMax').value) || 0);
        const otherAggregatesNominal = math.bignumber(parseFloat(document.getElementById('otherAggregatesNominal').value) || 0);

        const sand1Tolerance = math.multiply(sand1, math.divide(math.subtract(sand1Max, sand1Nominal), 100));
        const sand2Tolerance = math.multiply(sand2, math.divide(math.subtract(sand2Max, sand2Nominal), 100));
        const aggregateTolerance = math.multiply(aggregate, math.divide(math.subtract(aggregateMax, aggregateNominal), 100));
        const otherAggregatesTolerance = math.multiply(otherAggregates, math.divide(math.subtract(otherAggregatesMax, otherAggregatesNominal), 100));
        uncompensatedMoisture = math.add(math.add(sand1Tolerance, sand2Tolerance), math.add(aggregateTolerance, otherAggregatesTolerance));
        const totalWeightTolerance = math.round(math.add(totalWeight, uncompensatedMoisture));

        // Update tolerance values in WC Report
        document.getElementById('sand1Tolerance').innerText = math.format(sand1Tolerance, {notation: 'fixed', precision: 2});
        document.getElementById('sand2Tolerance').innerText = math.format(sand2Tolerance, {notation: 'fixed', precision: 2});
        document.getElementById('aggregateTolerance').innerText = math.format(aggregateTolerance, {notation: 'fixed', precision: 2});
        document.getElementById('otherAggregatesTolerance').innerText = math.format(otherAggregatesTolerance, {notation: 'fixed', precision: 2});
        document.getElementById('uncompensatedMoistureTolerance').innerText = math.format(uncompensatedMoisture, {notation: 'fixed', precision: 2});
        document.getElementById('totalWeightTolerance').innerText = math.format(totalWeightTolerance, {notation: 'fixed', precision: 0});
    }

    // With Hydronix (Assuming reduced accuracy or fixed rate of moisture)
    const hydronixAccuracy = 0.2; // Example: 0.2% fixed rate
    const sand1Hydronix = math.multiply(sand1, math.divide(hydronixAccuracy, 100));
    const sand2Hydronix = math.multiply(sand2, math.divide(hydronixAccuracy, 100));
    const aggregateHydronix = math.multiply(aggregate, math.divide(hydronixAccuracy, 100));
    const otherAggregatesHydronix = math.multiply(otherAggregates, math.divide(hydronixAccuracy, 100));
    uncompensatedMoistureHydronix = math.add(math.add(sand1Hydronix, sand2Hydronix), math.add(aggregateHydronix, otherAggregatesHydronix));
    const totalWeightHydronix = math.round(math.add(totalWeight, uncompensatedMoistureHydronix));

    // Update 'With Hydronix' values in WC Report
    document.getElementById('sand1Hydronix').innerText = math.format(sand1Hydronix, {notation: 'fixed', precision: 2});
    document.getElementById('sand2Hydronix').innerText = math.format(sand2Hydronix, {notation: 'fixed', precision: 2});
    document.getElementById('aggregateHydronix').innerText = math.format(aggregateHydronix, {notation: 'fixed', precision: 2});
    document.getElementById('otherAggregatesHydronix').innerText = math.format(otherAggregatesHydronix, {notation: 'fixed', precision: 2});
    document.getElementById('uncompensatedMoistureHydronix').innerText = math.format(uncompensatedMoistureHydronix, {notation: 'fixed', precision: 2});
    document.getElementById('totalWeightHydronix').innerText = math.format(totalWeightHydronix, {notation: 'fixed', precision: 0});

    // Update total cementitious materials for tolerance and Hydronix columns
    document.getElementById('totalCementitiousMaterialsTolerance').innerText = math.format(totalCementitiousMaterials, {notation: 'fixed', precision: 0});
    document.getElementById('totalCementitiousMaterialsHydronix').innerText = math.format(totalCementitiousMaterials, {notation: 'fixed', precision: 0});

    // Update mix design water (Litres) for all columns
    document.getElementById('mixDesignWaterRecipe').innerText = math.format(water, {notation: 'fixed', precision: 2});
    document.getElementById('mixDesignWaterTolerance').innerText = math.format(water, {notation: 'fixed', precision: 2});
    document.getElementById('mixDesignWaterHydronix').innerText = math.format(water, {notation: 'fixed', precision: 2});

    // Update uncompensated water in aggregates (Litres)
    document.getElementById('uncompensatedWaterRecipe').innerText = '0.00';
    document.getElementById('uncompensatedWaterTolerance').innerText = math.format(uncompensatedMoisture, {notation: 'fixed', precision: 2});
    document.getElementById('uncompensatedWaterHydronix').innerText = math.format(uncompensatedMoistureHydronix, {notation: 'fixed', precision: 2});

    // Update total water in mix (Litres)
    const totalWaterRecipe = water;
    const totalWaterTolerance = math.add(water, uncompensatedMoisture);
    const totalWaterHydronix = math.add(water, uncompensatedMoistureHydronix);

    document.getElementById('totalWaterRecipe').innerText = math.format(totalWaterRecipe, {notation: 'fixed', precision: 2});
    document.getElementById('totalWaterTolerance').innerText = math.format(totalWaterTolerance, {notation: 'fixed', precision: 2});
    document.getElementById('totalWaterHydronix').innerText = math.format(totalWaterHydronix, {notation: 'fixed', precision: 2});

    // Update W/C ratios
    const designedWCRatio = math.divide(totalWaterRecipe, totalCementitiousMaterials);
    const producedWCRatioTolerance = math.divide(totalWaterTolerance, totalCementitiousMaterials);
    const producedWCRatioHydronix = math.divide(totalWaterHydronix, totalCementitiousMaterials);

    document.getElementById('designedWCRatioRecipe').innerText = math.format(designedWCRatio, {notation: 'fixed', precision: 2});
    document.getElementById('designedWCRatioTolerance').innerText = math.format(designedWCRatio, {notation: 'fixed', precision: 2});
    document.getElementById('designedWCRatioHydronix').innerText = math.format(designedWCRatio, {notation: 'fixed', precision: 2});

    document.getElementById('producedWCRatioTolerance').innerText = math.format(producedWCRatioTolerance, {notation: 'fixed', precision: 2});
    document.getElementById('producedWCRatioHydronix').innerText = math.format(producedWCRatioHydronix, {notation: 'fixed', precision: 2});

    // Update Total Cement Needed to maintain SD target
    const totalCementNeededTolerance = math.divide(totalWaterTolerance, designedWCRatio);
    const totalCementNeededHydronix = math.divide(totalWaterHydronix, designedWCRatio);

    document.getElementById('totalCementNeededTolerance').innerText = math.format(totalCementNeededTolerance, {notation: 'fixed', precision: 2});
    document.getElementById('totalCementNeededHydronix').innerText = math.format(totalCementNeededHydronix, {notation: 'fixed', precision: 2});

    // Update Extra Cement needed to maintain SD target
    const extraCementNeededTolerance = math.subtract(totalCementNeededTolerance, totalCementitiousMaterials);
    const extraCementNeededHydronix = math.subtract(totalCementNeededHydronix, totalCementitiousMaterials);

    document.getElementById('extraCementNeededTolerance').innerText = math.format(extraCementNeededTolerance, {notation: 'fixed', precision: 2});
    document.getElementById('extraCementNeededHydronix').innerText = math.format(extraCementNeededHydronix, {notation: 'fixed', precision: 2});

    // Update Potential Cement Cost by not using Hydronix moisture measurement
    const potentialCementCost = math.subtract(extraCementNeededTolerance, extraCementNeededHydronix);
    document.getElementById('potentialCementCost').innerText = math.format(potentialCementCost, {notation: 'fixed', precision: 2});

    // Update Extra Cement required to maintain w/c ratio per year
    const extraCementPerYear = math.divide(math.multiply(math.multiply(volumePerDay, daysPerYear), potentialCementCost), 1000);
    document.getElementById('extraCementPerYear').innerText = math.format(extraCementPerYear, {notation: 'fixed', precision: 2});

    // Calculate and update costNotHydronixM
    const cementCost = math.bignumber(parseFloat(document.getElementById('cementCost').value) || 0);
    const costNotHydronixM = math.divide(math.multiply(potentialCementCost, cementCost), 1000);
    document.getElementById('costNotHydronixM').innerText = math.format(costNotHydronixM, {notation: 'fixed', precision: 2});

    // cost per year
    var costNotHydronixY = math.multiply(math.multiply(volumePerDay, daysPerYear), costNotHydronixM);
    // document.getElementById('costNotHydronixY').innerText = math.format(costNotHydronixY, {notation: 'fixed', precision: 2}).toLocaleString('en-GB');
    document.getElementById('costNotHydronixY').innerText = Number(math.format(costNotHydronixY, {notation: 'fixed', precision: 0})).toLocaleString('en-GB');

    const cementCO2 = math.bignumber(parseFloat(document.getElementById('cementCO2').value) || 0);
    const envNotHydronixY = math.multiply(extraCementPerYear, cementCO2);
    document.getElementById('envNotHydronixY').innerText = Number(math.format(envNotHydronixY, {notation: 'fixed', precision: 2})).toLocaleString('en-GB', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

    updateColumnTitle();

}

// Add event listeners to update the WC Report when values change
document.querySelectorAll('input, select').forEach(element => {
    element.addEventListener('input', updateWCReport);
});

// Initial WC Report update
updateWCReport();

// Add scroll to top functionality for Next buttons
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

// Add event listeners to all Next buttons
document.addEventListener('DOMContentLoaded', function() {
    // Find all buttons with "Next" or "Back" text that navigate between tabs
    const navButtons = document.querySelectorAll('button');
    navButtons.forEach(button => {
        const buttonText = button.textContent.trim();
        if ((buttonText === 'Next' || buttonText === 'Back') && button.onclick) {
            button.addEventListener('click', function() {
                // Small delay to allow tab change to complete, then scroll to top
                setTimeout(scrollToTop, 100);
            });
        }
    });
});

function updateSlider(input) {
    const slider = document.getElementById(input.id + '-slider');
    slider.value = input.value;
}

function updateNumberInput(slider) {
    const numberInput = document.getElementById(slider.id.replace('-slider', ''));
    numberInput.value = slider.value;
}


// save results

document.addEventListener("DOMContentLoaded", function () {
    const saveResultsButton = document.getElementById("saveResults");

    if (saveResultsButton) {
        saveResultsButton.addEventListener("click", function () {
            const jsonData = prepareTableData();
            submitData(jsonData);
        });
    }
});


function submitData(data) {
    fetch("/wp-content/themes/cb-hydronix/cement-results.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: `data=${encodeURIComponent(JSON.stringify(data))}`,
    })
        .then(response => {
            if (response.redirected) {
                window.location.href = response.url;
            } else {
                console.error("Failed to save results.");
            }
        })
        .catch(error => console.error("Error:", error));
}

document.addEventListener('DOMContentLoaded', function () {
    const emailField = document.getElementById('emailAddress');
    const saveResultsButton = document.getElementById('saveResultsButton');

    // Add event listener to validate email input
    emailField.addEventListener('input', function () {
        if (validateEmail(emailField.value)) {
            emailField.classList.remove('is-invalid');
            emailField.classList.add('is-valid');
            saveResultsButton.disabled = false;
        } else {
            emailField.classList.remove('is-valid');
            emailField.classList.add('is-invalid');
            saveResultsButton.disabled = true;
        }
    });
});

// Function to validate email format
function validateEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}

// Helper function to toggle validation styles
function toggleValidationStyles(field, isValid) {
    if (isValid) {
        field.classList.remove('is-invalid');
        field.classList.add('is-valid');
    } else {
        field.classList.remove('is-valid');
        field.classList.add('is-invalid');
    }
}

// Triggered on Save Results button click
function resultsJson() {
    const emailField = document.getElementById('emailAddress');
    const nameField = document.getElementById('nameField');
    const companyField = document.getElementById('companyField');

    // Validate fields
    const isEmailValid = validateEmail(emailField.value);
    const isNameValid = nameField.value.trim() !== '';
    const isCompanyValid = companyField.value.trim() !== '';

    // Provide feedback for invalid fields
    toggleValidationStyles(emailField, isEmailValid);
    toggleValidationStyles(nameField, isNameValid);
    toggleValidationStyles(companyField, isCompanyValid);

    if (isEmailValid && isNameValid && isCompanyValid) {
        const email = emailField.value;
        const name = nameField.value.trim();
        const company = companyField.value.trim();

        // Disable the button and show loading state
        const saveButton = document.getElementById('saveResultsButton');
        const originalText = saveButton.textContent;
        saveButton.disabled = true;
        saveButton.textContent = 'Sending...';

        // Prepare JSON data
        const jsonData = prepareTableData();
        jsonData.push({ id: 'email', value: email });
        jsonData.push({ id: 'name', value: name });
        jsonData.push({ id: 'company', value: company });

        // First, submit the data to create the post
        fetch('/wp-content/themes/cb-hydronix/cement-results.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `data=${encodeURIComponent(JSON.stringify(jsonData))}`,
        })
            .then(response => {
                if (response.ok) {
                    return response.text().then(text => {
                        // Extract post ID from the redirect URL
                        const urlMatch = text.match(/cement-results\/(\d+)/);
                        if (urlMatch) {
                            const postId = urlMatch[1];
                            
                            // Now send the email with the post ID
                            return sendResultsEmail(name, company, email, postId);
                        } else {
                            throw new Error('Could not extract post ID from response');
                        }
                    });
                } else {
                    throw new Error('Failed to save results');
                }
            })
            .then(emailResponse => {
                if (emailResponse.success) {
                    // Show success message and redirect
                    alert('Results saved and email sent successfully!');
                    window.location.href = emailResponse.data.results_url;
                } else {
                    // Results saved but email failed - still redirect but show warning
                    alert('Results saved but email failed to send: ' + emailResponse.data.message);
                    window.location.href = emailResponse.data.results_url || '/cement-results/';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred: ' + error.message);
                
                // Re-enable button
                saveButton.disabled = false;
                saveButton.textContent = originalText;
            });
    } else {
        alert('Please fill out all required fields correctly.');
    }
}

// Function to send results email via AJAX
function sendResultsEmail(name, company, email, postId) {
    const formData = new FormData();
    formData.append('action', 'send_cement_results_email');
    formData.append('name', name);
    formData.append('company', company);
    formData.append('email', email);
    formData.append('post_id', postId);
    formData.append('nonce', cementCalcNonce); // We'll need to add this nonce to the PHP template

    return fetch(ajaxUrl, { // We'll need to add ajaxUrl to the PHP template
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .catch(error => {
        console.error('Email error:', error);
        return { success: false, data: { message: 'Email service unavailable' } };
    });
}

// Function to scrape table data
// function prepareTableData() {
//     const jsonArray = [];
//     const tableCells = document.querySelectorAll('#wcReportTable td[id], #wcReportTable th[id]');

//     tableCells.forEach(cell => {
//         const id = cell.id.trim();
//         const value = cell.textContent.trim();
//         if (id) {
//             jsonArray.push({ id, value });
//         }
//     });

//     return jsonArray;
// }

function prepareTableData() {
    const jsonArray = [];

    // Select all <td> and <th> elements with an id OR containing a child with an id
    const tableCells = document.querySelectorAll('#wcReportTable td[id], #wcReportTable th[id], #wcReportTable td span[id], #wcReportTable th span[id]');

    tableCells.forEach(cell => {
        let id = cell.id.trim();
        let value = cell.textContent.trim();

        // If the cell has no id but contains a child with an id, use the child's id and text
        if (!id) {
            const childWithId = cell.querySelector('[id]');
            if (childWithId) {
                id = childWithId.id.trim();
                value = childWithId.textContent.trim();
            }
        }

        // Add to JSON array if an id is present
        if (id) {
            jsonArray.push({ id, value });
        }
    });

    return jsonArray;
}
