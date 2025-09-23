# Cement Calculator Documentation

## Overview
The `cementCalc.js` file implements a comprehensive cement/concrete mix design calculator that helps users analyze concrete recipes, calculate water-cement ratios, and compare costs and environmental impacts between traditional mixing methods and Hydronix moisture measurement systems.

## Core Functionality

### 1. Recipe Calculations

#### `calculateAggregateTotal()`
Calculates the total weight of all aggregate components in a concrete mix.

**Inputs:**
- `sand1`: Weight of first sand type
- `sand2`: Weight of second sand type  
- `aggregate`: Weight of aggregate
- `otherAggregates`: Weight of other aggregate materials

**Output:** Updates `totalWeight` field with sum of all aggregate weights.

#### `calculateBinderTotal()`
Calculates the total weight of all cementitious (binder) materials.

**Inputs:**
- `opc`: Ordinary Portland Cement weight
- `pfa`: Pulverized Fuel Ash weight
- `ggbs`: Ground Granulated Blast-furnace Slag weight
- `otherCement`: Other cement materials weight

**Output:** Updates `totalBinderWeight` field with sum of all binder weights.

#### `calculateTotalDryWeight()`
Calculates the combined dry weight of aggregates and binders.

**Output:** Updates `totalDryWeight` field with sum of aggregate and binder totals.

#### `calculateRatios()`
Calculates critical concrete mix ratios:
- **Water/Binder Ratio**: Water weight ÷ Total binder weight
- **Aggregate/Binder Ratio**: Total aggregate weight ÷ Total binder weight

### 2. Moisture Measurement Methods

The calculator supports two moisture measurement approaches:

#### Manual Method (`calculatePotentialManual()`)
Uses nominal and maximum moisture values to calculate potential moisture variance.

**Formula:** `Potential = (Maximum Moisture % - Nominal Moisture %) × Material Weight`

#### Automatic Method (`calculatePotentialAutomatic()`)
Uses accuracy percentages for automatic moisture measurement systems.

**Formula:** `Potential = Accuracy % × Material Weight`

#### `toggleMoistureFields()`
Switches between manual and automatic moisture calculation modes, showing/hiding relevant input fields.

### 3. Water-Cement (WC) Report Generation

#### `updateWCReport()`
The main function that generates comprehensive analysis comparing three scenarios:
1. **Your Recipe**: Base recipe values
2. **Using Existing Measurement Tolerance**: Current measurement accuracy
3. **With Hydronix**: Using Hydronix moisture measurement (0.2% accuracy)

**Key Calculations:**

**Moisture Tolerance Calculations:**
- For automatic: `Tolerance = Material Weight × (Accuracy % ÷ 100)`
- For manual: `Tolerance = Material Weight × ((Max% - Nominal%) ÷ 100)`

**Water Content Analysis:**
- **Mix Design Water**: Specified water in recipe
- **Uncompensated Water**: Additional water from moisture in aggregates
- **Total Water**: Mix design water + uncompensated water

**W/C Ratio Analysis:**
- **Designed W/C Ratio**: Target ratio from recipe
- **Produced W/C Ratio**: Actual ratio including moisture variations

**Cement Requirements:**
- **Total Cement Needed**: Required cement to maintain target W/C ratio
- **Extra Cement Needed**: Additional cement beyond recipe requirements
- **Potential Cement Cost**: Cost difference between methods

**Annual Impact Calculations:**
- **Extra Cement Per Year**: `(Volume/Day × Days/Year × Extra Cement) ÷ 1000`
- **Annual Cost Impact**: `Volume/Day × Days/Year × Cost per m³`
- **Environmental Impact**: `Extra Cement/Year × CO₂ per kg cement`

### 4. User Interface Features

#### Bootstrap Integration
- Initializes Bootstrap tooltips for enhanced UX
- Uses Bootstrap validation classes for form feedback

#### Input Synchronization
- Bidirectional sync between number inputs and range sliders
- Real-time calculation updates on input changes

#### Form Validation
```javascript
function validateEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}
```

### 5. Data Management

#### `prepareTableData()`
Extracts all calculated values from the WC Report table for saving/submission.

**Process:**
1. Scans table for elements with IDs
2. Extracts text content and element IDs
3. Returns array of `{id, value}` objects

#### `submitData(data)` & `resultsJson()`
Handles form submission and data persistence:
1. Validates required fields (email, name, company)
2. Combines calculation results with user information
3. Submits to `/cement-results.php` via POST request
4. Handles redirect on successful submission

### 6. Mathematical Precision

The calculator uses **Math.js library** for high-precision decimal calculations to avoid floating-point errors common in financial/engineering calculations.

**Benefits:**
- Accurate calculations for large numbers
- Consistent decimal precision
- Proper rounding for display purposes

## Event Listeners

The application sets up comprehensive event handling:

```javascript
// Real-time calculation updates
document.querySelectorAll('input, select').forEach(element => {
    element.addEventListener('input', updateWCReport);
});

// Moisture method switching
document.getElementById('moistureMethod').addEventListener('change', toggleMoistureFields);

// Form validation
emailField.addEventListener('input', validateAndToggleButton);
```

## Key Features

1. **Real-time Calculations**: All values update automatically as inputs change
2. **Dual Moisture Methods**: Supports both manual and automatic measurement approaches
3. **Comprehensive Analysis**: Compares recipe, tolerance, and Hydronix scenarios
4. **Cost & Environmental Impact**: Calculates annual financial and CO₂ implications
5. **Data Persistence**: Saves complete analysis results with user information
6. **Input Validation**: Ensures data quality before submission
7. **Responsive UI**: Bootstrap integration for mobile-friendly interface

## Dependencies

- **Math.js**: For precision mathematics
- **Bootstrap**: For UI components and validation
- **Modern Browser**: ES6+ features used throughout

## File Structure Integration

This calculator integrates with:
- `/cement-results.php`: Backend data processing
- HTML form elements with specific IDs
- Bootstrap CSS framework
- WordPress theme structure

## Use Cases

1. **Concrete Mix Design**: Engineers designing concrete formulations
2. **Cost Analysis**: Comparing equipment investment vs. material savings
3. **Quality Control**: Understanding moisture impact on concrete properties
4. **Environmental Assessment**: Calculating CO₂ reduction potential
5. **Equipment Justification**: ROI analysis for Hydronix moisture measurement systems
