<template>
    <div class="water-calculator max-w-7xl mx-auto">
        <!-- Info Box -->
        <div class="bg-gradient-to-r from-primary-600 to-primary-700 text-white p-5 rounded-2xl mb-8 flex items-center shadow-lg">
            <div class="bg-white/20 p-3 rounded-full mr-4">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <span class="text-lg">Calculate your daily water intake based on your body weight and activity level</span>
        </div>

        <!-- Input Card -->
        <div class="bg-white border-2 border-gray-200 rounded-2xl shadow-xl overflow-hidden mb-8">
            <div class="p-6 space-y-6">
                <!-- Weight Input -->
                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Your Weight</label>
                    <div class="flex items-center space-x-4">
                        <input
                            v-model.number="weight"
                            type="number"
                            class="flex-1 px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-primary-500 focus:outline-none"
                            placeholder="Enter your weight"
                        />
                        <select v-model="weightUnit" class="px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-primary-500 focus:outline-none">
                            <option value="kg">kg</option>
                            <option value="lbs">lbs</option>
                        </select>
                    </div>
                </div>

                <!-- Gender -->
                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Gender</label>
                    <div class="flex space-x-4">
                        <label class="flex-1 cursor-pointer">
                            <input v-model="gender" type="radio" value="male" class="hidden peer" />
                            <div class="px-6 py-3 border-2 border-gray-300 rounded-xl text-center font-semibold transition-all peer-checked:border-primary-600 peer-checked:bg-primary-50 peer-checked:text-primary-700 hover:border-primary-400">
                                👨 Male
                            </div>
                        </label>
                        <label class="flex-1 cursor-pointer">
                            <input v-model="gender" type="radio" value="female" class="hidden peer" />
                            <div class="px-6 py-3 border-2 border-gray-300 rounded-xl text-center font-semibold transition-all peer-checked:border-primary-600 peer-checked:bg-primary-50 peer-checked:text-primary-700 hover:border-primary-400">
                                👩 Female
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Activity Level -->
                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Activity Level</label>
                    <select 
                        v-model="activityLevel" 
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-primary-500 focus:outline-none"
                    >
                        <option value="sedentary">Sedentary (Little or no exercise)</option>
                        <option value="light">Light (Exercise 1-3 days/week)</option>
                        <option value="moderate">Moderate (Exercise 3-5 days/week)</option>
                        <option value="active">Active (Exercise 6-7 days/week)</option>
                        <option value="very-active">Very Active (Intense exercise daily)</option>
                    </select>
                </div>

                <!-- Climate -->
                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Climate</label>
                    <div class="grid grid-cols-3 gap-3">
                        <label class="cursor-pointer">
                            <input v-model="climate" type="radio" value="cool" class="hidden peer" />
                            <div class="px-4 py-3 border-2 border-gray-300 rounded-xl text-center font-semibold transition-all peer-checked:border-primary-600 peer-checked:bg-primary-50 peer-checked:text-primary-700 hover:border-primary-400">
                                ❄️ Cool
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input v-model="climate" type="radio" value="moderate" class="hidden peer" />
                            <div class="px-4 py-3 border-2 border-gray-300 rounded-xl text-center font-semibold transition-all peer-checked:border-primary-600 peer-checked:bg-primary-50 peer-checked:text-primary-700 hover:border-primary-400">
                                ☀️ Moderate
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input v-model="climate" type="radio" value="hot" class="hidden peer" />
                            <div class="px-4 py-3 border-2 border-gray-300 rounded-xl text-center font-semibold transition-all peer-checked:border-primary-600 peer-checked:bg-primary-50 peer-checked:text-primary-700 hover:border-primary-400">
                                🔥 Hot
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Pregnant/Breastfeeding (for females) -->
                <div v-if="gender === 'female'">
                    <label class="block font-semibold text-gray-700 mb-2">Special Conditions</label>
                    <div class="space-y-2">
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input v-model="pregnant" type="checkbox" class="w-5 h-5 text-primary-600 rounded focus:ring-primary-500" />
                            <span>Pregnant</span>
                        </label>
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input v-model="breastfeeding" type="checkbox" class="w-5 h-5 text-primary-600 rounded focus:ring-primary-500" />
                            <span>Breastfeeding</span>
                        </label>
                    </div>
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
                        Calculate Water Intake
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
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd"></path>
                    </svg>
                    Your Daily Water Intake
                </h3>
            </div>

            <div class="p-6">
                <!-- Main Result -->
                <div class="text-center mb-8">
                    <div class="text-6xl font-extrabold text-blue-600 mb-3">
                        {{ result.liters }}L
                    </div>
                    <div class="text-2xl text-gray-600 font-semibold mb-2">
                        Recommended Daily Intake
                    </div>
                    <div class="text-gray-500">
                        {{ result.cups }} cups (250ml) • {{ result.glasses }} glasses (8oz)
                    </div>
                </div>

                <!-- Visual Water Tracker -->
                <div class="mb-8">
                    <div class="bg-gradient-to-t from-blue-400 to-blue-200 rounded-2xl p-6 relative overflow-hidden">
                        <div class="absolute inset-0 opacity-20">
                            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                                <path d="M0,50 Q25,40 50,50 T100,50 L100,100 L0,100 Z" fill="white" />
                            </svg>
                        </div>
                        <div class="relative text-center text-white">
                            <div class="text-4xl mb-2">💧</div>
                            <div class="text-lg font-semibold">Stay Hydrated!</div>
                            <div class="text-sm opacity-90">Drink water throughout the day</div>
                        </div>
                    </div>
                </div>

                <!-- Breakdown -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="bg-blue-50 rounded-xl p-4 text-center">
                        <div class="text-sm text-gray-600 mb-1">Milliliters</div>
                        <div class="text-2xl font-bold text-blue-600">{{ result.ml }}</div>
                        <div class="text-xs text-gray-500">ml/day</div>
                    </div>
                    <div class="bg-cyan-50 rounded-xl p-4 text-center">
                        <div class="text-sm text-gray-600 mb-1">Ounces</div>
                        <div class="text-2xl font-bold text-cyan-600">{{ result.oz }}</div>
                        <div class="text-xs text-gray-500">fl oz/day</div>
                    </div>
                    <div class="bg-teal-50 rounded-xl p-4 text-center">
                        <div class="text-sm text-gray-600 mb-1">Per Hour</div>
                        <div class="text-2xl font-bold text-teal-600">{{ result.perHour }}</div>
                        <div class="text-xs text-gray-500">ml/hour (awake)</div>
                    </div>
                </div>

                <!-- Hydration Schedule -->
                <div class="bg-gradient-to-r from-blue-50 to-cyan-50 rounded-xl p-5 mb-6">
                    <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                        </svg>
                        Suggested Hydration Schedule
                    </h4>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 text-sm">
                        <div class="bg-white rounded-lg p-3">
                            <div class="font-semibold text-blue-600">🌅 Morning</div>
                            <div class="text-gray-600">{{ result.schedule.morning }}</div>
                        </div>
                        <div class="bg-white rounded-lg p-3">
                            <div class="font-semibold text-yellow-600">☀️ Midday</div>
                            <div class="text-gray-600">{{ result.schedule.midday }}</div>
                        </div>
                        <div class="bg-white rounded-lg p-3">
                            <div class="font-semibold text-orange-600">🌆 Afternoon</div>
                            <div class="text-gray-600">{{ result.schedule.afternoon }}</div>
                        </div>
                        <div class="bg-white rounded-lg p-3">
                            <div class="font-semibold text-purple-600">🌙 Evening</div>
                            <div class="text-gray-600">{{ result.schedule.evening }}</div>
                        </div>
                    </div>
                </div>

                <!-- Tips & Info -->
                <div class="bg-gray-50 rounded-xl p-5">
                    <h4 class="font-bold text-gray-900 mb-3">💡 Hydration Tips</h4>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start">
                            <span class="text-primary-600 mr-2">✓</span>
                            <span><strong>Start your day:</strong> Drink 1-2 glasses of water when you wake up</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-primary-600 mr-2">✓</span>
                            <span><strong>Before meals:</strong> Drink water 30 minutes before eating</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-primary-600 mr-2">✓</span>
                            <span><strong>During exercise:</strong> Drink extra {{ result.exerciseExtra }} during workouts</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-primary-600 mr-2">✓</span>
                            <span><strong>Listen to your body:</strong> Drink when thirsty and check urine color (pale yellow is ideal)</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-primary-600 mr-2">✓</span>
                            <span class="text-xs text-gray-600">Note: These are general recommendations. Consult your doctor for personalized advice, especially if you have medical conditions.</span>
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

const weight = ref(70);
const weightUnit = ref('kg');
const gender = ref('male');
const activityLevel = ref('moderate');
const climate = ref('moderate');
const pregnant = ref(false);
const breastfeeding = ref(false);
const result = ref(null);

const calculate = () => {
    if (!weight.value) {
        alert('Please enter your weight');
        return;
    }

    // Convert weight to kg if needed
    let weightInKg = weight.value;
    if (weightUnit.value === 'lbs') {
        weightInKg = weight.value * 0.453592;
    }

    // Base calculation: 30-35ml per kg of body weight
    let baseIntake = weightInKg * 33; // ml per day

    // Activity level multiplier
    const activityMultipliers = {
        'sedentary': 1.0,
        'light': 1.1,
        'moderate': 1.2,
        'active': 1.3,
        'very-active': 1.5,
    };
    baseIntake *= activityMultipliers[activityLevel.value];

    // Climate adjustment
    const climateAdjustments = {
        'cool': 0,
        'moderate': 200,
        'hot': 500,
    };
    baseIntake += climateAdjustments[climate.value];

    // Gender adjustment (males generally need slightly more)
    if (gender.value === 'male') {
        baseIntake *= 1.05;
    }

    // Pregnancy/breastfeeding adjustment
    if (pregnant.value) {
        baseIntake += 300; // Additional 300ml for pregnancy
    }
    if (breastfeeding.value) {
        baseIntake += 700; // Additional 700ml for breastfeeding
    }

    // Round to nearest 100ml
    const totalMl = Math.round(baseIntake / 100) * 100;
    const liters = (totalMl / 1000).toFixed(1);
    const cups = Math.round(totalMl / 250); // 250ml cups
    const glasses = Math.round(totalMl / 237); // 8oz glasses
    const oz = Math.round(totalMl / 29.5735); // fluid ounces
    const perHour = Math.round(totalMl / 16); // Assuming 16 waking hours

    // Schedule breakdown (divide into 4 parts)
    const perPeriod = Math.round(totalMl / 4);
    const schedule = {
        morning: `${Math.round(perPeriod / 250)} cups`,
        midday: `${Math.round(perPeriod / 250)} cups`,
        afternoon: `${Math.round(perPeriod / 250)} cups`,
        evening: `${Math.round(perPeriod / 250)} cups`,
    };

    result.value = {
        ml: totalMl,
        liters,
        cups,
        glasses,
        oz,
        perHour,
        schedule,
        exerciseExtra: '500-1000ml',
    };

    // Log usage
    axios.post(`/tools/${props.tool.slug}/log-usage`, {
        input: { weight: weight.value, activityLevel: activityLevel.value, climate: climate.value },
        result: result.value,
    }).catch(err => console.error(err));
};

const clear = () => {
    weight.value = 70;
    weightUnit.value = 'kg';
    gender.value = 'male';
    activityLevel.value = 'moderate';
    climate.value = 'moderate';
    pregnant.value = false;
    breastfeeding.value = false;
    result.value = null;
};
</script>
