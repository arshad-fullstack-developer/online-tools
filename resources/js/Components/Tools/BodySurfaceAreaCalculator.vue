<template>
    <div class="bsa-calculator max-w-7xl mx-auto">
        <!-- Info Box -->
        <div class="bg-gradient-to-r from-primary-600 to-primary-700 text-white p-5 rounded-2xl mb-8 flex items-center shadow-lg">
            <div class="bg-white/20 p-3 rounded-full mr-4">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <span class="text-lg">Calculate body surface area using multiple medical formulas</span>
        </div>

        <!-- Input Card -->
        <div class="bg-white border-2 border-gray-200 rounded-2xl shadow-xl overflow-hidden mb-8">
            <!-- Tabs for Unit System -->
            <div class="flex border-b-2 border-gray-200">
                <button
                    @click="unitSystem = 'metric'"
                    :class="unitSystem === 'metric' ? 'bg-primary-100 text-primary-700 border-b-3 border-primary-600' : 'bg-gray-50 text-gray-600 hover:bg-gray-100'"
                    class="flex-1 px-4 py-3 font-semibold transition-colors"
                >
                    Metric Units
                </button>
                <button
                    @click="unitSystem = 'imperial'"
                    :class="unitSystem === 'imperial' ? 'bg-primary-100 text-primary-700 border-b-3 border-primary-600' : 'bg-gray-50 text-gray-600 hover:bg-gray-100'"
                    class="flex-1 px-4 py-3 font-semibold transition-colors"
                >
                    Imperial Units
                </button>
            </div>

            <div class="p-6 space-y-6">
                <!-- Metric Inputs -->
                <div v-if="unitSystem === 'metric'">
                    <!-- Height (cm) -->
                    <div>
                        <label class="block font-semibold text-gray-700 mb-2">Height</label>
                        <div class="flex items-center space-x-4">
                            <input
                                v-model.number="heightCm"
                                type="number"
                                step="0.1"
                                class="flex-1 px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-primary-500 focus:outline-none"
                                placeholder="Enter height"
                            />
                            <span class="text-gray-600 font-semibold">cm</span>
                        </div>
                    </div>

                    <!-- Weight (kg) -->
                    <div>
                        <label class="block font-semibold text-gray-700 mb-2">Weight</label>
                        <div class="flex items-center space-x-4">
                            <input
                                v-model.number="weightKg"
                                type="number"
                                step="0.1"
                                class="flex-1 px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-primary-500 focus:outline-none"
                                placeholder="Enter weight"
                            />
                            <span class="text-gray-600 font-semibold">kg</span>
                        </div>
                    </div>
                </div>

                <!-- Imperial Inputs -->
                <div v-if="unitSystem === 'imperial'">
                    <!-- Height (feet + inches) -->
                    <div>
                        <label class="block font-semibold text-gray-700 mb-2">Height</label>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex items-center space-x-2">
                                <input
                                    v-model.number="heightFeet"
                                    type="number"
                                    class="flex-1 px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-primary-500 focus:outline-none"
                                    placeholder="Feet"
                                />
                                <span class="text-gray-600 font-semibold">ft</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <input
                                    v-model.number="heightInches"
                                    type="number"
                                    step="0.1"
                                    class="flex-1 px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-primary-500 focus:outline-none"
                                    placeholder="Inches"
                                />
                                <span class="text-gray-600 font-semibold">in</span>
                            </div>
                        </div>
                    </div>

                    <!-- Weight (lbs) -->
                    <div>
                        <label class="block font-semibold text-gray-700 mb-2">Weight</label>
                        <div class="flex items-center space-x-4">
                            <input
                                v-model.number="weightLbs"
                                type="number"
                                step="0.1"
                                class="flex-1 px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-primary-500 focus:outline-none"
                                placeholder="Enter weight"
                            />
                            <span class="text-gray-600 font-semibold">lbs</span>
                        </div>
                    </div>
                </div>

                <!-- Formula Selection -->
                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Calculation Formula</label>
                    <select 
                        v-model="selectedFormula" 
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-primary-500 focus:outline-none"
                    >
                        <option value="all">All Formulas (Recommended)</option>
                        <option value="mosteller">Mosteller Formula (Most Common)</option>
                        <option value="dubois">DuBois & DuBois Formula</option>
                        <option value="haycock">Haycock Formula</option>
                        <option value="gehan">Gehan & George Formula</option>
                        <option value="boyd">Boyd Formula</option>
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Select "All Formulas" to compare results from different methods</p>
                </div>

                <!-- Buttons -->
                <div class="flex space-x-3 pt-4">
                    <button
                        @click="calculate"
                        class="flex-1 px-6 py-4 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-xl font-bold hover:from-primary-700 hover:to-primary-800 transition-all transform hover:scale-105 shadow-lg flex items-center justify-center"
                    >
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                        </svg>
                        Calculate BSA
                    </button>
                    <button
                        @click="clear"
                        class="px-6 py-4 bg-gray-200 text-gray-700 rounded-xl font-semibold hover:bg-gray-300 transition-all"
                    >
                        Clear
                    </button>
                </div>
            </div>
        </div>

        <!-- Result Card -->
        <div v-if="result" class="bg-white border-2 border-gray-200 rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-primary-600 to-primary-700 text-white px-6 py-4">
                <h3 class="text-2xl font-bold flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    Body Surface Area Results
                </h3>
            </div>

            <div class="p-6">
                <!-- Main Result (Average if multiple formulas) -->
                <div v-if="selectedFormula === 'all'" class="text-center mb-8">
                    <div class="text-sm text-gray-500 mb-2">Average BSA</div>
                    <div class="text-6xl font-extrabold text-primary-600 mb-3">
                        {{ result.average }}
                    </div>
                    <div class="text-2xl text-gray-600 font-semibold">
                        m² (square meters)
                    </div>
                </div>

                <!-- Individual Formula Results -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                    <div v-for="formula in result.formulas" :key="formula.name" 
                         class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl p-5 border-2 border-blue-200">
                        <div class="text-sm font-semibold text-gray-700 mb-2">{{ formula.name }}</div>
                        <div class="text-3xl font-bold text-blue-600 mb-1">{{ formula.value }} m²</div>
                        <div class="text-xs text-gray-500">{{ formula.description }}</div>
                    </div>
                </div>

                <!-- Reference Ranges -->
                <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl p-5 mb-6">
                    <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
                        </svg>
                        Reference Ranges
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                        <div class="bg-white rounded-lg p-3">
                            <div class="font-semibold text-purple-600">Adult Average</div>
                            <div class="text-gray-600">1.7 - 1.9 m²</div>
                        </div>
                        <div class="bg-white rounded-lg p-3">
                            <div class="font-semibold text-pink-600">Your Result</div>
                            <div class="text-gray-600">{{ result.average }} m² <span class="text-xs">({{ result.category }})</span></div>
                        </div>
                    </div>
                </div>

                <!-- Clinical Applications -->
                <div class="bg-gray-50 rounded-xl p-5">
                    <h4 class="font-bold text-gray-900 mb-3">📋 Clinical Applications</h4>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start">
                            <span class="text-primary-600 mr-2">✓</span>
                            <span><strong>Medication Dosing:</strong> Many chemotherapy and other medications are dosed based on BSA</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-primary-600 mr-2">✓</span>
                            <span><strong>Cardiac Index:</strong> Used to calculate cardiac output per body surface area</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-primary-600 mr-2">✓</span>
                            <span><strong>Renal Function:</strong> GFR (Glomerular Filtration Rate) is often normalized to BSA</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-primary-600 mr-2">✓</span>
                            <span><strong>Burn Assessment:</strong> Calculating percentage of body surface area affected by burns</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-primary-600 mr-2">✓</span>
                            <span class="text-xs text-gray-600">Note: BSA calculations are estimates. Always consult healthcare professionals for medical decisions.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';

const props = defineProps({
    tool: Object,
});

const unitSystem = ref('metric');
const heightCm = ref(170);
const weightKg = ref(70);
const heightFeet = ref(5);
const heightInches = ref(7);
const weightLbs = ref(154);
const selectedFormula = ref('all');
const result = ref(null);

const calculate = () => {
    // Convert to metric if needed
    let height = heightCm.value;
    let weight = weightKg.value;

    if (unitSystem.value === 'imperial') {
        // Convert height to cm
        height = (heightFeet.value * 12 + heightInches.value) * 2.54;
        // Convert weight to kg
        weight = weightLbs.value * 0.453592;
    }

    if (!height || !weight || height <= 0 || weight <= 0) {
        alert('Please enter valid height and weight');
        return;
    }

    const formulas = [];

    // Mosteller Formula (Most commonly used)
    // BSA (m²) = √[(height (cm) × weight (kg)) / 3600]
    if (selectedFormula.value === 'all' || selectedFormula.value === 'mosteller') {
        const bsa = Math.sqrt((height * weight) / 3600);
        formulas.push({
            name: 'Mosteller',
            value: bsa.toFixed(3),
            description: 'Most commonly used formula'
        });
    }

    // DuBois & DuBois Formula
    // BSA (m²) = 0.007184 × height (cm)^0.725 × weight (kg)^0.425
    if (selectedFormula.value === 'all' || selectedFormula.value === 'dubois') {
        const bsa = 0.007184 * Math.pow(height, 0.725) * Math.pow(weight, 0.425);
        formulas.push({
            name: 'DuBois & DuBois',
            value: bsa.toFixed(3),
            description: 'Classic formula from 1916'
        });
    }

    // Haycock Formula
    // BSA (m²) = 0.024265 × height (cm)^0.3964 × weight (kg)^0.5378
    if (selectedFormula.value === 'all' || selectedFormula.value === 'haycock') {
        const bsa = 0.024265 * Math.pow(height, 0.3964) * Math.pow(weight, 0.5378);
        formulas.push({
            name: 'Haycock',
            value: bsa.toFixed(3),
            description: 'Good for children and adults'
        });
    }

    // Gehan & George Formula
    // BSA (m²) = 0.0235 × height (cm)^0.42246 × weight (kg)^0.51456
    if (selectedFormula.value === 'all' || selectedFormula.value === 'gehan') {
        const bsa = 0.0235 * Math.pow(height, 0.42246) * Math.pow(weight, 0.51456);
        formulas.push({
            name: 'Gehan & George',
            value: bsa.toFixed(3),
            description: 'Used in pediatric oncology'
        });
    }

    // Boyd Formula (more complex, approximation)
    // BSA (m²) = 0.0003207 × height (cm)^0.3 × weight (g)^(0.7285 - 0.0188 × log(weight in g))
    if (selectedFormula.value === 'all' || selectedFormula.value === 'boyd') {
        const weightGrams = weight * 1000;
        const bsa = 0.0003207 * Math.pow(height, 0.3) * Math.pow(weightGrams, 0.7285 - 0.0188 * Math.log10(weightGrams));
        formulas.push({
            name: 'Boyd',
            value: bsa.toFixed(3),
            description: 'Complex but accurate formula'
        });
    }

    // Calculate average
    const sum = formulas.reduce((acc, f) => acc + parseFloat(f.value), 0);
    const average = (sum / formulas.length).toFixed(3);

    // Determine category
    let category = 'Normal';
    const avgNum = parseFloat(average);
    if (avgNum < 1.5) category = 'Below Average';
    else if (avgNum >= 1.5 && avgNum <= 2.0) category = 'Normal';
    else category = 'Above Average';

    result.value = {
        formulas,
        average,
        category,
    };

    // Log usage
    axios.post(`/tools/${props.tool.slug}/log-usage`, {
        input: { height, weight, formula: selectedFormula.value },
        result: result.value,
    }).catch(err => console.error(err));
};

const clear = () => {
    heightCm.value = 170;
    weightKg.value = 70;
    heightFeet.value = 5;
    heightInches.value = 7;
    weightLbs.value = 154;
    selectedFormula.value = 'all';
    result.value = null;
};
</script>
