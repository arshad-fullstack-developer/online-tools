<template>
    <div class="calories-calculator max-w-7xl mx-auto">
        <!-- Info Box -->
        <div class="bg-gradient-to-r from-primary-600 to-primary-700 text-white p-5 rounded-2xl mb-8 flex items-center shadow-lg">
            <div class="bg-white/20 p-3 rounded-full mr-4">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <span class="text-lg">Calculate calories burned during various physical activities</span>
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

                <!-- Activity Selection -->
                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Activity Type</label>
                    <select 
                        v-model="selectedActivity" 
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-primary-500 focus:outline-none"
                    >
                        <option value="">Select an activity</option>
                        <optgroup label="Walking & Running">
                            <option value="walking-slow">Walking (2 mph, slow pace)</option>
                            <option value="walking-moderate">Walking (3.5 mph, moderate pace)</option>
                            <option value="walking-brisk">Walking (4.5 mph, brisk pace)</option>
                            <option value="running-5mph">Running (5 mph)</option>
                            <option value="running-6mph">Running (6 mph)</option>
                            <option value="running-7mph">Running (7 mph)</option>
                            <option value="running-8mph">Running (8 mph)</option>
                        </optgroup>
                        <optgroup label="Cycling">
                            <option value="cycling-leisure">Cycling (leisure, <10 mph)</option>
                            <option value="cycling-moderate">Cycling (moderate, 12-14 mph)</option>
                            <option value="cycling-vigorous">Cycling (vigorous, 14-16 mph)</option>
                            <option value="cycling-racing">Cycling (racing, >16 mph)</option>
                        </optgroup>
                        <optgroup label="Swimming">
                            <option value="swimming-leisure">Swimming (leisure)</option>
                            <option value="swimming-moderate">Swimming (moderate)</option>
                            <option value="swimming-vigorous">Swimming (vigorous)</option>
                        </optgroup>
                        <optgroup label="Gym & Fitness">
                            <option value="aerobics-low">Aerobics (low impact)</option>
                            <option value="aerobics-high">Aerobics (high impact)</option>
                            <option value="weight-training">Weight Training</option>
                            <option value="yoga">Yoga</option>
                            <option value="pilates">Pilates</option>
                            <option value="elliptical">Elliptical Trainer</option>
                            <option value="rowing">Rowing Machine</option>
                        </optgroup>
                        <optgroup label="Sports">
                            <option value="basketball">Basketball</option>
                            <option value="soccer">Soccer</option>
                            <option value="tennis">Tennis</option>
                            <option value="volleyball">Volleyball</option>
                            <option value="golf">Golf (walking with clubs)</option>
                        </optgroup>
                        <optgroup label="Daily Activities">
                            <option value="cleaning">House Cleaning</option>
                            <option value="gardening">Gardening</option>
                            <option value="dancing">Dancing</option>
                            <option value="stairs">Climbing Stairs</option>
                        </optgroup>
                    </select>
                </div>

                <!-- Duration Input -->
                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Duration</label>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <input
                                v-model.number="hours"
                                type="number"
                                min="0"
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-primary-500 focus:outline-none"
                                placeholder="Hours"
                            />
                            <p class="text-xs text-gray-500 mt-1">Hours</p>
                        </div>
                        <div>
                            <input
                                v-model.number="minutes"
                                type="number"
                                min="0"
                                max="59"
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-primary-500 focus:outline-none"
                                placeholder="Minutes"
                            />
                            <p class="text-xs text-gray-500 mt-1">Minutes</p>
                        </div>
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
                        Calculate Calories
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
                        <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
                    </svg>
                    Calories Burned
                </h3>
            </div>

            <div class="p-6">
                <!-- Main Result -->
                <div class="text-center mb-8">
                    <div class="text-6xl font-extrabold text-primary-600 mb-3">
                        {{ result.calories }}
                    </div>
                    <div class="text-2xl text-gray-600 font-semibold">
                        Calories Burned
                    </div>
                    <div class="mt-4 text-gray-500">
                        {{ result.activityName }} for {{ result.duration }}
                    </div>
                </div>

                <!-- Breakdown -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="bg-blue-50 rounded-xl p-4 text-center">
                        <div class="text-sm text-gray-600 mb-1">Per Hour</div>
                        <div class="text-2xl font-bold text-blue-600">{{ result.perHour }}</div>
                        <div class="text-xs text-gray-500">cal/hour</div>
                    </div>
                    <div class="bg-green-50 rounded-xl p-4 text-center">
                        <div class="text-sm text-gray-600 mb-1">Per Minute</div>
                        <div class="text-2xl font-bold text-green-600">{{ result.perMinute }}</div>
                        <div class="text-xs text-gray-500">cal/min</div>
                    </div>
                    <div class="bg-purple-50 rounded-xl p-4 text-center">
                        <div class="text-sm text-gray-600 mb-1">MET Value</div>
                        <div class="text-2xl font-bold text-purple-600">{{ result.met }}</div>
                        <div class="text-xs text-gray-500">metabolic equivalent</div>
                    </div>
                </div>

                <!-- Additional Info -->
                <div class="bg-gray-50 rounded-xl p-5">
                    <h4 class="font-bold text-gray-900 mb-3">Additional Information</h4>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start">
                            <span class="text-primary-600 mr-2">✓</span>
                            <span><strong>Activity Intensity:</strong> {{ result.intensity }}</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-primary-600 mr-2">✓</span>
                            <span><strong>To burn 500 calories:</strong> {{ result.timeFor500 }}</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-primary-600 mr-2">✓</span>
                            <span><strong>Equivalent to:</strong> {{ result.equivalent }}</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-primary-600 mr-2">✓</span>
                            <span class="text-xs text-gray-600">Note: Actual calories burned may vary based on individual metabolism, fitness level, and exercise intensity.</span>
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

const weight = ref(70);
const weightUnit = ref('kg');
const selectedActivity = ref('');
const hours = ref(0);
const minutes = ref(30);
const result = ref(null);

// MET values for different activities
const activities = {
    'walking-slow': { name: 'Walking (slow pace)', met: 2.0, intensity: 'Light' },
    'walking-moderate': { name: 'Walking (moderate pace)', met: 3.5, intensity: 'Light' },
    'walking-brisk': { name: 'Walking (brisk pace)', met: 4.5, intensity: 'Moderate' },
    'running-5mph': { name: 'Running (5 mph)', met: 8.0, intensity: 'Vigorous' },
    'running-6mph': { name: 'Running (6 mph)', met: 9.8, intensity: 'Vigorous' },
    'running-7mph': { name: 'Running (7 mph)', met: 11.0, intensity: 'Vigorous' },
    'running-8mph': { name: 'Running (8 mph)', met: 11.8, intensity: 'Very Vigorous' },
    'cycling-leisure': { name: 'Cycling (leisure)', met: 4.0, intensity: 'Light' },
    'cycling-moderate': { name: 'Cycling (moderate)', met: 8.0, intensity: 'Moderate' },
    'cycling-vigorous': { name: 'Cycling (vigorous)', met: 10.0, intensity: 'Vigorous' },
    'cycling-racing': { name: 'Cycling (racing)', met: 12.0, intensity: 'Very Vigorous' },
    'swimming-leisure': { name: 'Swimming (leisure)', met: 6.0, intensity: 'Moderate' },
    'swimming-moderate': { name: 'Swimming (moderate)', met: 8.0, intensity: 'Vigorous' },
    'swimming-vigorous': { name: 'Swimming (vigorous)', met: 10.0, intensity: 'Very Vigorous' },
    'aerobics-low': { name: 'Aerobics (low impact)', met: 5.0, intensity: 'Moderate' },
    'aerobics-high': { name: 'Aerobics (high impact)', met: 7.0, intensity: 'Vigorous' },
    'weight-training': { name: 'Weight Training', met: 6.0, intensity: 'Moderate' },
    'yoga': { name: 'Yoga', met: 2.5, intensity: 'Light' },
    'pilates': { name: 'Pilates', met: 3.0, intensity: 'Light' },
    'elliptical': { name: 'Elliptical Trainer', met: 5.0, intensity: 'Moderate' },
    'rowing': { name: 'Rowing Machine', met: 7.0, intensity: 'Vigorous' },
    'basketball': { name: 'Basketball', met: 6.5, intensity: 'Vigorous' },
    'soccer': { name: 'Soccer', met: 7.0, intensity: 'Vigorous' },
    'tennis': { name: 'Tennis', met: 7.3, intensity: 'Vigorous' },
    'volleyball': { name: 'Volleyball', met: 4.0, intensity: 'Moderate' },
    'golf': { name: 'Golf (walking)', met: 4.3, intensity: 'Moderate' },
    'cleaning': { name: 'House Cleaning', met: 3.5, intensity: 'Light' },
    'gardening': { name: 'Gardening', met: 4.0, intensity: 'Moderate' },
    'dancing': { name: 'Dancing', met: 4.5, intensity: 'Moderate' },
    'stairs': { name: 'Climbing Stairs', met: 8.0, intensity: 'Vigorous' },
};

const calculate = () => {
    if (!selectedActivity.value || !weight.value || (hours.value === 0 && minutes.value === 0)) {
        alert('Please fill in all fields');
        return;
    }

    const activity = activities[selectedActivity.value];
    const totalMinutes = (hours.value * 60) + minutes.value;
    const totalHours = totalMinutes / 60;
    
    // Convert weight to kg if needed
    let weightInKg = weight.value;
    if (weightUnit.value === 'lbs') {
        weightInKg = weight.value * 0.453592;
    }

    // Calories = MET × weight (kg) × time (hours)
    const caloriesBurned = Math.round(activity.met * weightInKg * totalHours);
    const caloriesPerHour = Math.round(activity.met * weightInKg);
    const caloriesPerMinute = (caloriesPerHour / 60).toFixed(1);

    // Calculate time needed for 500 calories
    const minutesFor500 = Math.round((500 / caloriesPerHour) * 60);
    const hoursFor500 = Math.floor(minutesFor500 / 60);
    const remainingMinutes = minutesFor500 % 60;
    const timeFor500 = hoursFor500 > 0 
        ? `${hoursFor500}h ${remainingMinutes}min` 
        : `${remainingMinutes} minutes`;

    // Food equivalents
    const foodEquivalents = [
        { food: 'apple', calories: 95 },
        { food: 'banana', calories: 105 },
        { food: 'slice of pizza', calories: 285 },
        { food: 'chocolate bar', calories: 250 },
        { food: 'can of soda', calories: 140 },
    ];
    
    const closestFood = foodEquivalents.reduce((prev, curr) => 
        Math.abs(curr.calories - caloriesBurned) < Math.abs(prev.calories - caloriesBurned) ? curr : prev
    );
    
    const foodCount = (caloriesBurned / closestFood.calories).toFixed(1);

    result.value = {
        calories: caloriesBurned,
        activityName: activity.name,
        duration: totalHours >= 1 
            ? `${hours.value}h ${minutes.value}min` 
            : `${minutes.value} minutes`,
        perHour: caloriesPerHour,
        perMinute: caloriesPerMinute,
        met: activity.met,
        intensity: activity.intensity,
        timeFor500,
        equivalent: `${foodCount} ${closestFood.food}${foodCount > 1 ? 's' : ''}`,
    };

    // Log usage
    axios.post(`/tools/${props.tool.slug}/log-usage`, {
        input: { weight: weight.value, activity: selectedActivity.value, duration: totalMinutes },
        result: result.value,
    }).catch(err => console.error(err));
};

const clear = () => {
    weight.value = 70;
    weightUnit.value = 'kg';
    selectedActivity.value = '';
    hours.value = 0;
    minutes.value = 30;
    result.value = null;
};
</script>
