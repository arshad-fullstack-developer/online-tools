<template>
    <div class="space-y-6">
        <div class="bg-gray-50 rounded-lg p-4">
            <label class="label">Generated Password</label>
            <div class="flex space-x-2">
                <input
                    v-model="password"
                    type="text"
                    class="input font-mono text-lg"
                    readonly
                />
                <button @click="copyPassword" class="btn btn-primary whitespace-nowrap">
                    Copy
                </button>
            </div>
        </div>

        <div>
            <label class="label">Password Length: {{ length }}</label>
            <input
                v-model="length"
                type="range"
                min="4"
                max="64"
                class="w-full"
                @input="generatePassword"
            />
            <div class="flex justify-between text-sm text-gray-600 mt-1">
                <span>4</span>
                <span>64</span>
            </div>
        </div>

        <div class="space-y-3">
            <label class="flex items-center space-x-3 cursor-pointer">
                <input
                    v-model="options.uppercase"
                    type="checkbox"
                    class="rounded border-gray-300 text-primary-600 focus:ring-primary-500"
                    @change="generatePassword"
                />
                <span class="text-gray-700">Include Uppercase Letters (A-Z)</span>
            </label>

            <label class="flex items-center space-x-3 cursor-pointer">
                <input
                    v-model="options.lowercase"
                    type="checkbox"
                    class="rounded border-gray-300 text-primary-600 focus:ring-primary-500"
                    @change="generatePassword"
                />
                <span class="text-gray-700">Include Lowercase Letters (a-z)</span>
            </label>

            <label class="flex items-center space-x-3 cursor-pointer">
                <input
                    v-model="options.numbers"
                    type="checkbox"
                    class="rounded border-gray-300 text-primary-600 focus:ring-primary-500"
                    @change="generatePassword"
                />
                <span class="text-gray-700">Include Numbers (0-9)</span>
            </label>

            <label class="flex items-center space-x-3 cursor-pointer">
                <input
                    v-model="options.symbols"
                    type="checkbox"
                    class="rounded border-gray-300 text-primary-600 focus:ring-primary-500"
                    @change="generatePassword"
                />
                <span class="text-gray-700">Include Symbols (!@#$%^&*)</span>
            </label>
        </div>

        <div v-if="strength" class="card bg-gray-50">
            <div class="flex items-center justify-between mb-2">
                <span class="text-sm font-medium text-gray-700">Password Strength:</span>
                <span :class="strengthClass" class="text-sm font-semibold">
                    {{ strength.label }}
                </span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div
                    :class="strengthBarClass"
                    class="h-2 rounded-full transition-all duration-300"
                    :style="{ width: strength.percentage + '%' }"
                ></div>
            </div>
        </div>

        <button @click="generatePassword" class="btn btn-primary w-full">
            Generate New Password
        </button>
    </div>
</template>

<script setup>
import { ref, reactive, computed, onMounted } from 'vue';
import axios from 'axios';

const props = defineProps({
    tool: Object,
});

const password = ref('');
const length = ref(16);
const options = reactive({
    uppercase: true,
    lowercase: true,
    numbers: true,
    symbols: true,
});
const strength = ref(null);

const generatePassword = () => {
    const uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const lowercase = 'abcdefghijklmnopqrstuvwxyz';
    const numbers = '0123456789';
    const symbols = '!@#$%^&*()_+-=[]{}|;:,.<>?';

    let chars = '';
    if (options.uppercase) chars += uppercase;
    if (options.lowercase) chars += lowercase;
    if (options.numbers) chars += numbers;
    if (options.symbols) chars += symbols;

    if (!chars) {
        alert('Please select at least one character type!');
        return;
    }

    let result = '';
    for (let i = 0; i < length.value; i++) {
        result += chars.charAt(Math.floor(Math.random() * chars.length));
    }

    password.value = result;
    calculateStrength();

    // Log usage
    axios.post(route('tools.log-usage', props.tool.slug), {
        input: { length: length.value, options }
    }).catch(() => {});
};

const calculateStrength = () => {
    let score = 0;
    const pwd = password.value;

    // Length
    if (pwd.length >= 8) score += 20;
    if (pwd.length >= 12) score += 20;
    if (pwd.length >= 16) score += 20;

    // Character variety
    if (/[a-z]/.test(pwd)) score += 10;
    if (/[A-Z]/.test(pwd)) score += 10;
    if (/[0-9]/.test(pwd)) score += 10;
    if (/[^a-zA-Z0-9]/.test(pwd)) score += 10;

    let label = 'Weak';
    if (score >= 80) label = 'Very Strong';
    else if (score >= 60) label = 'Strong';
    else if (score >= 40) label = 'Medium';

    strength.value = { score, percentage: score, label };
};

const strengthClass = computed(() => {
    if (!strength.value) return '';
    if (strength.value.score >= 80) return 'text-green-600';
    if (strength.value.score >= 60) return 'text-blue-600';
    if (strength.value.score >= 40) return 'text-yellow-600';
    return 'text-red-600';
});

const strengthBarClass = computed(() => {
    if (!strength.value) return '';
    if (strength.value.score >= 80) return 'bg-green-500';
    if (strength.value.score >= 60) return 'bg-blue-500';
    if (strength.value.score >= 40) return 'bg-yellow-500';
    return 'bg-red-500';
});

const copyPassword = () => {
    navigator.clipboard.writeText(password.value);
    alert('Password copied to clipboard!');
};

onMounted(() => {
    generatePassword();
});
</script>
