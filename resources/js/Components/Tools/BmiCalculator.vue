<template>
    <div class="bmi-calculator max-w-7xl mx-auto">
        <!-- Info Box -->
        <div class="bg-gradient-to-r from-primary-600 to-primary-700 text-white p-5 rounded-2xl mb-8 flex items-center shadow-lg">
            <div class="bg-white/20 p-3 rounded-full mr-4">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <span class="text-lg">Enter your details and click Calculate to get your BMI results</span>
        </div>

        <!-- Input Card -->
        <div class="bg-white border-2 border-gray-200 rounded-2xl shadow-xl overflow-hidden mb-8">
                <!-- Tabs -->
                <div class="flex border-b-2 border-gray-200">
                    <button
                        @click="unitSystem = 'us'"
                        :class="unitSystem === 'us' ? 'bg-primary-100 text-primary-700 border-b-3 border-primary-600' : 'bg-gray-50 text-gray-600 hover:bg-gray-100'"
                        class="flex-1 px-4 py-3 font-semibold transition-colors"
                    >
                        US Units
                    </button>
                    <button
                        @click="unitSystem = 'metric'"
                        :class="unitSystem === 'metric' ? 'bg-primary-100 text-primary-700 border-b-3 border-primary-600' : 'bg-gray-50 text-gray-600 hover:bg-gray-100'"
                        class="flex-1 px-4 py-3 font-semibold transition-colors"
                    >
                        Metric Units
                    </button>
                    <button
                        @click="unitSystem = 'other'"
                        :class="unitSystem === 'other' ? 'bg-primary-100 text-primary-700 border-b-3 border-primary-600' : 'bg-gray-50 text-gray-600 hover:bg-gray-100'"
                        class="flex-1 px-4 py-3 font-semibold transition-colors"
                    >
                        Other Units
                    </button>
                </div>

                <!-- Input Fields -->
                <div class="p-6 space-y-4">
                    <!-- Age -->
                    <div class="grid grid-cols-3 gap-4 items-center">
                        <label class="font-semibold text-gray-700">Age</label>
                        <input
                            v-model.number="age"
                            type="number"
                            class="col-span-1 px-3 py-2 border-2 border-gray-300 rounded focus:border-primary-500 focus:outline-none"
                        />
                        <span class="text-sm text-gray-600">ages: 2 - 120</span>
                    </div>

                    <!-- Gender -->
                    <div class="grid grid-cols-3 gap-4 items-center">
                        <label class="font-semibold text-gray-700">Gender</label>
                        <div class="col-span-2 flex items-center space-x-4">
                            <label class="flex items-center cursor-pointer">
                                <input v-model="gender" type="radio" value="male" class="mr-2" />
                                <span>Male</span>
                            </label>
                            <label class="flex items-center cursor-pointer">
                                <input v-model="gender" type="radio" value="female" class="mr-2" />
                                <span>Female</span>
                            </label>
                        </div>
                    </div>

                    <!-- Height - US Units (feet + inches) -->
                    <div v-if="unitSystem === 'us'" class="grid grid-cols-3 gap-4 items-center">
                        <label class="font-semibold text-gray-700">Height</label>
                        <div class="col-span-2 flex items-center space-x-2">
                            <input
                                v-model.number="heightFeet"
                                type="number"
                                class="w-20 px-3 py-2 border-2 border-gray-300 rounded focus:border-primary-500 focus:outline-none"
                            />
                            <span class="text-sm text-gray-600">feet</span>
                            <input
                                v-model.number="heightInches"
                                type="number"
                                step="0.1"
                                class="w-20 px-3 py-2 border-2 border-gray-300 rounded focus:border-primary-500 focus:outline-none"
                            />
                            <span class="text-sm text-gray-600">inches</span>
                        </div>
                    </div>

                    <!-- Height - Metric Units (cm) -->
                    <div v-if="unitSystem === 'metric'" class="grid grid-cols-3 gap-4 items-center">
                        <label class="font-semibold text-gray-700">Height</label>
                        <div class="col-span-2 flex items-center space-x-2">
                            <input
                                v-model.number="heightCm"
                                type="number"
                                step="0.1"
                                class="w-32 px-3 py-2 border-2 border-gray-300 rounded focus:border-primary-500 focus:outline-none"
                            />
                            <span class="text-sm text-gray-600">cm</span>
                        </div>
                    </div>

                    <!-- Height - Other Units (meters) -->
                    <div v-if="unitSystem === 'other'" class="grid grid-cols-3 gap-4 items-center">
                        <label class="font-semibold text-gray-700">Height</label>
                        <div class="col-span-2 flex items-center space-x-2">
                            <input
                                v-model.number="heightMeters"
                                type="number"
                                step="0.01"
                                class="w-32 px-3 py-2 border-2 border-gray-300 rounded focus:border-primary-500 focus:outline-none"
                            />
                            <span class="text-sm text-gray-600">meters</span>
                        </div>
                    </div>

                    <!-- Weight - US Units (pounds) -->
                    <div v-if="unitSystem === 'us'" class="grid grid-cols-3 gap-4 items-center">
                        <label class="font-semibold text-gray-700">Weight</label>
                        <div class="col-span-2 flex items-center space-x-2">
                            <input
                                v-model.number="weightLbs"
                                type="number"
                                step="0.1"
                                class="w-32 px-3 py-2 border-2 border-gray-300 rounded focus:border-primary-500 focus:outline-none"
                            />
                            <span class="text-sm text-gray-600">pounds</span>
                        </div>
                    </div>

                    <!-- Weight - Metric Units (kg) -->
                    <div v-if="unitSystem === 'metric'" class="grid grid-cols-3 gap-4 items-center">
                        <label class="font-semibold text-gray-700">Weight</label>
                        <div class="col-span-2 flex items-center space-x-2">
                            <input
                                v-model.number="weightKg"
                                type="number"
                                step="0.1"
                                class="w-32 px-3 py-2 border-2 border-gray-300 rounded focus:border-primary-500 focus:outline-none"
                            />
                            <span class="text-sm text-gray-600">kg</span>
                        </div>
                    </div>

                    <!-- Weight - Other Units (stones + pounds) -->
                    <div v-if="unitSystem === 'other'" class="grid grid-cols-3 gap-4 items-center">
                        <label class="font-semibold text-gray-700">Weight</label>
                        <div class="col-span-2 flex items-center space-x-2">
                            <input
                                v-model.number="weightStones"
                                type="number"
                                class="w-20 px-3 py-2 border-2 border-gray-300 rounded focus:border-primary-500 focus:outline-none"
                            />
                            <span class="text-sm text-gray-600">stones</span>
                            <input
                                v-model.number="weightPounds"
                                type="number"
                                step="0.1"
                                class="w-20 px-3 py-2 border-2 border-gray-300 rounded focus:border-primary-500 focus:outline-none"
                            />
                            <span class="text-sm text-gray-600">pounds</span>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex space-x-3 pt-6">
                        <button
                            @click="calculate"
                            class="flex-1 px-6 py-4 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-xl font-bold hover:from-primary-700 hover:to-primary-800 transition-all transform hover:scale-105 shadow-lg flex items-center justify-center"
                        >
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                            </svg>
                            Calculate
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

        <!-- Result Card (Shows Below Input) -->
        <div v-if="result" class="bg-white border-2 border-gray-200 rounded-2xl shadow-xl overflow-hidden">
                <div class="bg-gradient-to-r from-primary-600 to-primary-700 text-white px-6 py-4">
                    <h3 class="text-2xl font-bold flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        Your BMI Result
                    </h3>
                </div>

                <div class="p-6">
                    <!-- BMI Value -->
                    <div class="text-center mb-8">
                        <div class="text-5xl font-extrabold text-gray-900 mb-3">
                            {{ result.bmi }}
                            <span class="text-2xl text-gray-500">kg/m²</span>
                        </div>
                        <div class="inline-block px-6 py-2 bg-primary-100 text-primary-700 rounded-full text-xl font-bold">
                            {{ result.category }}
                        </div>
                    </div>

                <!-- BMI Progress Bar -->
                <div class="mb-6">
                    <div class="relative h-8 bg-gray-200 rounded-full overflow-hidden">
                        <!-- Color segments -->
                        <div class="absolute inset-0 flex">
                            <div class="flex-1 bg-red-500"></div>
                            <div class="flex-1 bg-green-500"></div>
                            <div class="flex-1 bg-yellow-500"></div>
                            <div class="flex-1 bg-red-600"></div>
                        </div>
                        
                        <!-- Indicator -->
                        <div 
                            class="absolute top-0 bottom-0 w-1 bg-gray-900 shadow-lg transition-all duration-500"
                            :style="{ left: indicatorPosition + '%' }"
                        >
                            <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-gray-900 text-white px-3 py-1 rounded text-sm font-bold whitespace-nowrap">
                                {{ result.bmi }}
                            </div>
                        </div>
                    </div>
                    
                    <!-- Labels -->
                    <div class="flex justify-between mt-2 text-xs font-semibold">
                        <span class="text-red-600">Underweight<br/>&lt;18.5</span>
                        <span class="text-green-600">Normal<br/>18.5-25</span>
                        <span class="text-yellow-600">Overweight<br/>25-30</span>
                        <span class="text-red-600">Obese<br/>&gt;30</span>
                    </div>
                </div>

                <!-- Additional Info -->
                <div class="bg-gray-50 rounded-xl p-5">
                    <h4 class="font-bold text-gray-900 mb-3">Additional Information</h4>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start">
                            <span class="text-primary-600 mr-2">✓</span>
                            <span><strong>Healthy BMI range:</strong> {{ result.healthyRange }}</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-primary-600 mr-2">✓</span>
                            <span><strong>Healthy weight:</strong> {{ result.healthyWeight }}</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-primary-600 mr-2">✓</span>
                            <span><strong>BMI Prime:</strong> {{ result.bmiPrime }}</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-primary-600 mr-2">✓</span>
                            <span><strong>Ponderal Index:</strong> {{ result.ponderalIndex }} kg/m³</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import axios from 'axios';

const props = defineProps({
    tool: Object,
});

const unitSystem = ref('us');
const age = ref(28);
const gender = ref('male');

// US Units
const heightFeet = ref(5);
const heightInches = ref(2);
const weightLbs = ref(160);

// Metric Units
const heightCm = ref(157);
const weightKg = ref(73);

// Other Units
const heightMeters = ref(1.57);
const weightStones = ref(11);
const weightPounds = ref(6);

const result = ref(null);

const calculate = () => {
    let heightInMeters = 0;
    let weightInKg = 0;

    // Convert to metric
    if (unitSystem.value === 'us') {
        const totalInches = (heightFeet.value * 12) + heightInches.value;
        heightInMeters = totalInches * 0.0254;
        weightInKg = weightLbs.value * 0.453592;
    } else if (unitSystem.value === 'metric') {
        heightInMeters = heightCm.value / 100;
        weightInKg = weightKg.value;
    } else {
        heightInMeters = heightMeters.value;
        weightInKg = (weightStones.value * 14 + weightPounds.value) * 0.453592;
    }

    const bmi = weightInKg / (heightInMeters * heightInMeters);
    const bmiPrime = bmi / 25;
    const ponderalIndex = weightInKg / Math.pow(heightInMeters, 3);

    let category = '';
    if (bmi < 16) category = 'Severe Thinness';
    else if (bmi < 17) category = 'Moderate Thinness';
    else if (bmi < 18.5) category = 'Mild Thinness';
    else if (bmi < 25) category = 'Normal';
    else if (bmi < 30) category = 'Overweight';
    else if (bmi < 35) category = 'Obese Class I';
    else if (bmi < 40) category = 'Obese Class II';
    else category = 'Obese Class III';

    // Healthy weight range
    const minHealthyWeight = 18.5 * (heightInMeters * heightInMeters);
    const maxHealthyWeight = 25 * (heightInMeters * heightInMeters);
    
    let healthyWeight = '';
    if (unitSystem.value === 'us') {
        healthyWeight = `${(minHealthyWeight * 2.20462).toFixed(1)} - ${(maxHealthyWeight * 2.20462).toFixed(1)} lbs`;
    } else {
        healthyWeight = `${minHealthyWeight.toFixed(1)} - ${maxHealthyWeight.toFixed(1)} kg`;
    }

    result.value = {
        bmi: bmi.toFixed(1),
        category,
        healthyRange: '18.5 kg/m² - 25 kg/m²',
        healthyWeight,
        bmiPrime: bmiPrime.toFixed(2),
        ponderalIndex: ponderalIndex.toFixed(1),
    };

    // Log usage
    axios.post(`/tools/${props.tool.slug}/log-usage`, {
        input: { age: age.value, gender: gender.value, unitSystem: unitSystem.value },
        result: result.value,
    }).catch(err => console.error(err));
};

const clear = () => {
    age.value = 28;
    gender.value = 'male';
    heightFeet.value = 5;
    heightInches.value = 2;
    weightLbs.value = 160;
    heightCm.value = 157;
    weightKg.value = 73;
    heightMeters.value = 1.57;
    weightStones.value = 11;
    weightPounds.value = 6;
    result.value = null;
};

// Indicator position for progress bar
const indicatorPosition = computed(() => {
    if (!result.value) return 0;
    const bmi = parseFloat(result.value.bmi);
    
    // Map BMI to percentage (10-40 range mapped to 0-100%)
    let position = 0;
    if (bmi < 18.5) {
        // Underweight: 0-25%
        position = (bmi / 18.5) * 25;
    } else if (bmi < 25) {
        // Normal: 25-50%
        position = 25 + ((bmi - 18.5) / (25 - 18.5)) * 25;
    } else if (bmi < 30) {
        // Overweight: 50-75%
        position = 50 + ((bmi - 25) / (30 - 25)) * 25;
    } else {
        // Obese: 75-100%
        position = 75 + Math.min(((bmi - 30) / 10) * 25, 25);
    }
    
    return Math.min(Math.max(position, 0), 100);
});
</script>
