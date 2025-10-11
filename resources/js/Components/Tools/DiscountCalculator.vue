<template>
    <div class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="label">Original Price ($)</label>
                <input
                    v-model.number="originalPrice"
                    type="number"
                    step="0.01"
                    class="input"
                    placeholder="100.00"
                    @input="calculate"
                />
            </div>
            <div>
                <label class="label">Discount (%)</label>
                <input
                    v-model.number="discountPercent"
                    type="number"
                    step="0.1"
                    class="input"
                    placeholder="20"
                    @input="calculate"
                />
            </div>
        </div>

        <div v-if="result" class="space-y-4">
            <div class="bg-gradient-to-br from-green-500 to-green-600 text-white rounded-xl p-6 text-center">
                <div class="text-sm mb-2">Final Price</div>
                <div class="text-5xl font-bold">${{ result.finalPrice }}</div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="card bg-red-50">
                    <div class="text-sm text-gray-600 mb-1">You Save</div>
                    <div class="text-3xl font-bold text-red-600">${{ result.savings }}</div>
                    <div class="text-sm text-gray-600 mt-1">{{ discountPercent }}% off</div>
                </div>
                <div class="card bg-gray-50">
                    <div class="text-sm text-gray-600 mb-1">Original Price</div>
                    <div class="text-3xl font-bold text-gray-900">${{ result.originalPrice }}</div>
                </div>
            </div>

            <div class="card bg-blue-50">
                <h3 class="font-semibold text-gray-900 mb-3">Calculation Breakdown</h3>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Original Price:</span>
                        <span class="font-semibold">${{ result.originalPrice }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Discount ({{ discountPercent }}%):</span>
                        <span class="font-semibold text-red-600">-${{ result.savings }}</span>
                    </div>
                    <div class="border-t border-gray-300 pt-2 flex justify-between">
                        <span class="text-gray-900 font-semibold">Final Price:</span>
                        <span class="font-bold text-green-600">${{ result.finalPrice }}</span>
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

const originalPrice = ref(null);
const discountPercent = ref(null);
const result = ref(null);

const calculate = () => {
    if (!originalPrice.value || !discountPercent.value) {
        result.value = null;
        return;
    }

    if (originalPrice.value < 0 || discountPercent.value < 0 || discountPercent.value > 100) {
        alert('Please enter valid values!');
        return;
    }

    const savings = (originalPrice.value * discountPercent.value) / 100;
    const finalPrice = originalPrice.value - savings;

    result.value = {
        originalPrice: originalPrice.value.toFixed(2),
        savings: savings.toFixed(2),
        finalPrice: finalPrice.toFixed(2),
    };

    // Log usage
    axios.post(route('tools.log-usage', props.tool.slug), {
        input: { originalPrice: originalPrice.value, discountPercent: discountPercent.value }
    }).catch(() => {});
};

const reset = () => {
    originalPrice.value = null;
    discountPercent.value = null;
    result.value = null;
};
</script>
