<template>
    <div class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="label">Start Date</label>
                <input
                    v-model="startDate"
                    type="date"
                    class="input"
                    @change="calculateDifference"
                />
            </div>
            <div>
                <label class="label">End Date</label>
                <input
                    v-model="endDate"
                    type="date"
                    class="input"
                    @change="calculateDifference"
                />
            </div>
        </div>

        <div v-if="difference" class="space-y-4">
            <div class="bg-gradient-to-br from-primary-500 to-primary-600 text-white rounded-xl p-6 text-center">
                <div class="text-5xl font-bold mb-2">{{ difference.totalDays }}</div>
                <div class="text-xl">Days</div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-primary-50 rounded-lg p-4 text-center">
                    <div class="text-2xl font-bold text-primary-600">{{ difference.years }}</div>
                    <div class="text-sm text-gray-600 mt-1">Years</div>
                </div>
                <div class="bg-primary-50 rounded-lg p-4 text-center">
                    <div class="text-2xl font-bold text-primary-600">{{ difference.months }}</div>
                    <div class="text-sm text-gray-600 mt-1">Months</div>
                </div>
                <div class="bg-primary-50 rounded-lg p-4 text-center">
                    <div class="text-2xl font-bold text-primary-600">{{ difference.weeks }}</div>
                    <div class="text-sm text-gray-600 mt-1">Weeks</div>
                </div>
                <div class="bg-primary-50 rounded-lg p-4 text-center">
                    <div class="text-2xl font-bold text-primary-600">{{ difference.days }}</div>
                    <div class="text-sm text-gray-600 mt-1">Days</div>
                </div>
            </div>

            <div class="card bg-gray-50">
                <h3 class="font-semibold text-gray-900 mb-3">Detailed Breakdown</h3>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Years:</span>
                        <span class="font-semibold text-gray-900">{{ difference.totalYears }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Months:</span>
                        <span class="font-semibold text-gray-900">{{ difference.totalMonths }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Weeks:</span>
                        <span class="font-semibold text-gray-900">{{ difference.totalWeeks }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Days:</span>
                        <span class="font-semibold text-gray-900">{{ difference.totalDays }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Hours:</span>
                        <span class="font-semibold text-gray-900">{{ difference.totalHours }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Minutes:</span>
                        <span class="font-semibold text-gray-900">{{ difference.totalMinutes }}</span>
                    </div>
                </div>
            </div>
        </div>

        <button @click="reset" class="btn btn-secondary">
            Reset
        </button>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';

const props = defineProps({
    tool: Object,
});

const startDate = ref('');
const endDate = ref('');
const difference = ref(null);

const calculateDifference = () => {
    if (!startDate.value || !endDate.value) return;

    const start = new Date(startDate.value);
    const end = new Date(endDate.value);

    if (start > end) {
        alert('Start date must be before end date!');
        return;
    }

    const diffMs = end - start;
    const totalDays = Math.floor(diffMs / (1000 * 60 * 60 * 24));
    const totalHours = Math.floor(diffMs / (1000 * 60 * 60));
    const totalMinutes = Math.floor(diffMs / (1000 * 60));
    const totalWeeks = Math.floor(totalDays / 7);

    let years = end.getFullYear() - start.getFullYear();
    let months = end.getMonth() - start.getMonth();
    let days = end.getDate() - start.getDate();

    if (days < 0) {
        months--;
        const prevMonth = new Date(end.getFullYear(), end.getMonth(), 0);
        days += prevMonth.getDate();
    }

    if (months < 0) {
        years--;
        months += 12;
    }

    const totalMonths = years * 12 + months;
    const totalYears = (totalDays / 365.25).toFixed(2);
    const weeks = Math.floor(totalDays / 7);

    difference.value = {
        years,
        months,
        weeks,
        days,
        totalYears,
        totalMonths,
        totalWeeks,
        totalDays,
        totalHours,
        totalMinutes,
    };

    // Log usage
    axios.post(route('tools.log-usage', props.tool.slug), {
        input: { startDate: startDate.value, endDate: endDate.value }
    }).catch(() => {});
};

const reset = () => {
    startDate.value = '';
    endDate.value = '';
    difference.value = null;
};
</script>
