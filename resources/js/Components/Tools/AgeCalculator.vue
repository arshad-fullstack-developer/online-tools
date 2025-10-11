<template>
    <div class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="label">Date of Birth</label>
                <input
                    v-model="birthDate"
                    type="date"
                    class="input"
                    :max="today"
                    @change="calculateAge"
                />
            </div>
            <div>
                <label class="label">Calculate Age On (Optional)</label>
                <input
                    v-model="targetDate"
                    type="date"
                    class="input"
                    :min="birthDate"
                    @change="calculateAge"
                />
            </div>
        </div>

        <div v-if="age" class="space-y-4">
            <div class="bg-gradient-to-br from-primary-500 to-primary-600 text-white rounded-xl p-6 text-center">
                <div class="text-5xl font-bold mb-2">{{ age.years }}</div>
                <div class="text-xl">Years Old</div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                <div class="bg-primary-50 rounded-lg p-4 text-center">
                    <div class="text-2xl font-bold text-primary-600">{{ age.months }}</div>
                    <div class="text-sm text-gray-600 mt-1">Months</div>
                </div>
                <div class="bg-primary-50 rounded-lg p-4 text-center">
                    <div class="text-2xl font-bold text-primary-600">{{ age.days }}</div>
                    <div class="text-sm text-gray-600 mt-1">Days</div>
                </div>
                <div class="bg-primary-50 rounded-lg p-4 text-center">
                    <div class="text-2xl font-bold text-primary-600">{{ age.hours }}</div>
                    <div class="text-sm text-gray-600 mt-1">Hours</div>
                </div>
            </div>

            <div class="card bg-gray-50">
                <h3 class="font-semibold text-gray-900 mb-3">Detailed Breakdown</h3>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Months:</span>
                        <span class="font-semibold text-gray-900">{{ age.totalMonths }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Weeks:</span>
                        <span class="font-semibold text-gray-900">{{ age.totalWeeks }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Days:</span>
                        <span class="font-semibold text-gray-900">{{ age.totalDays }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Hours:</span>
                        <span class="font-semibold text-gray-900">{{ age.totalHours }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Minutes:</span>
                        <span class="font-semibold text-gray-900">{{ age.totalMinutes }}</span>
                    </div>
                </div>
            </div>

            <div v-if="age.nextBirthday" class="card bg-gradient-to-br from-purple-50 to-pink-50">
                <h3 class="font-semibold text-gray-900 mb-2">🎂 Next Birthday</h3>
                <p class="text-gray-700">
                    {{ age.nextBirthday.date }} ({{ age.nextBirthday.daysUntil }} days to go)
                </p>
            </div>
        </div>

        <button @click="reset" class="btn btn-secondary">
            Reset
        </button>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const props = defineProps({
    tool: Object,
});

const today = new Date().toISOString().split('T')[0];
const birthDate = ref('');
const targetDate = ref(today);
const age = ref(null);

const calculateAge = () => {
    if (!birthDate.value) return;

    const birth = new Date(birthDate.value);
    const target = new Date(targetDate.value || today);

    if (birth > target) {
        alert('Birth date cannot be in the future!');
        return;
    }

    const diffMs = target - birth;
    const diffDays = Math.floor(diffMs / (1000 * 60 * 60 * 24));
    
    let years = target.getFullYear() - birth.getFullYear();
    let months = target.getMonth() - birth.getMonth();
    let days = target.getDate() - birth.getDate();

    if (days < 0) {
        months--;
        const prevMonth = new Date(target.getFullYear(), target.getMonth(), 0);
        days += prevMonth.getDate();
    }

    if (months < 0) {
        years--;
        months += 12;
    }

    const totalMonths = years * 12 + months;
    const totalWeeks = Math.floor(diffDays / 7);
    const totalHours = Math.floor(diffMs / (1000 * 60 * 60));
    const totalMinutes = Math.floor(diffMs / (1000 * 60));
    const hours = Math.floor(diffDays * 24);

    // Calculate next birthday
    let nextBirthday = new Date(target.getFullYear(), birth.getMonth(), birth.getDate());
    if (nextBirthday < target) {
        nextBirthday.setFullYear(target.getFullYear() + 1);
    }
    const daysUntilBirthday = Math.ceil((nextBirthday - target) / (1000 * 60 * 60 * 24));

    age.value = {
        years,
        months,
        days,
        hours,
        totalMonths,
        totalWeeks,
        totalDays: diffDays,
        totalHours,
        totalMinutes,
        nextBirthday: {
            date: nextBirthday.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' }),
            daysUntil: daysUntilBirthday,
        },
    };

    // Log usage
    axios.post(route('tools.log-usage', props.tool.slug), {
        input: { birthDate: birthDate.value }
    }).catch(() => {});
};

const reset = () => {
    birthDate.value = '';
    targetDate.value = today;
    age.value = null;
};
</script>
