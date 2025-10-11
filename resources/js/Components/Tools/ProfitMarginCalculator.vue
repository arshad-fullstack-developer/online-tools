<template>
    <div class="profit-margin-calculator max-w-7xl mx-auto">
        <!-- Info Box -->
        <div class="bg-gradient-to-r from-primary-600 to-primary-700 text-white p-5 rounded-2xl mb-8 flex items-center shadow-lg">
            <div class="bg-white/20 p-3 rounded-full mr-4">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <span class="text-lg">Calculate profit margin, markup, and break-even analysis for your business</span>
        </div>

        <!-- Calculation Mode Tabs -->
        <div class="bg-white border-2 border-gray-200 rounded-2xl shadow-xl overflow-hidden mb-8">
            <div class="flex border-b border-gray-200">
                <button
                    v-for="mode in calculationModes"
                    :key="mode.id"
                    @click="selectedMode = mode.id"
                    :class="[
                        'flex-1 px-6 py-4 font-semibold transition-all',
                        selectedMode === mode.id
                            ? 'bg-primary-600 text-white'
                            : 'bg-gray-50 text-gray-700 hover:bg-gray-100'
                    ]"
                >
                    {{ mode.label }}
                </button>
            </div>

            <div class="p-6">
                <!-- Profit Margin Calculator -->
                <div v-if="selectedMode === 'margin'" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-semibold text-gray-700 mb-2">Revenue / Selling Price ($)</label>
                            <input
                                v-model.number="margin.revenue"
                                type="number"
                                step="0.01"
                                min="0"
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-primary-500 focus:outline-none"
                                placeholder="1000"
                                @input="calculateMargin"
                            />
                            <p class="text-xs text-gray-500 mt-1">Total revenue or selling price</p>
                        </div>
                        <div>
                            <label class="block font-semibold text-gray-700 mb-2">Cost / COGS ($)</label>
                            <input
                                v-model.number="margin.cost"
                                type="number"
                                step="0.01"
                                min="0"
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-primary-500 focus:outline-none"
                                placeholder="600"
                                @input="calculateMargin"
                            />
                            <p class="text-xs text-gray-500 mt-1">Cost of goods sold</p>
                        </div>
                    </div>

                    <button
                        @click="calculateMargin"
                        class="w-full px-6 py-4 bg-gradient-to-r from-green-600 to-emerald-700 text-white rounded-xl font-bold hover:from-green-700 hover:to-emerald-800 transition-all transform hover:scale-105 shadow-lg"
                    >
                        Calculate Profit Margin
                    </button>
                </div>

                <!-- Markup Calculator -->
                <div v-if="selectedMode === 'markup'" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-semibold text-gray-700 mb-2">Cost Price ($)</label>
                            <input
                                v-model.number="markup.cost"
                                type="number"
                                step="0.01"
                                min="0"
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-primary-500 focus:outline-none"
                                placeholder="600"
                                @input="calculateMarkup"
                            />
                        </div>
                        <div>
                            <label class="block font-semibold text-gray-700 mb-2">Markup Percentage (%)</label>
                            <input
                                v-model.number="markup.percentage"
                                type="number"
                                step="0.1"
                                min="0"
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-primary-500 focus:outline-none"
                                placeholder="66.67"
                                @input="calculateMarkup"
                            />
                        </div>
                    </div>

                    <button
                        @click="calculateMarkup"
                        class="w-full px-6 py-4 bg-gradient-to-r from-green-600 to-emerald-700 text-white rounded-xl font-bold hover:from-green-700 hover:to-emerald-800 transition-all transform hover:scale-105 shadow-lg"
                    >
                        Calculate Selling Price
                    </button>
                </div>

                <!-- Break-Even Calculator -->
                <div v-if="selectedMode === 'breakeven'" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block font-semibold text-gray-700 mb-2">Fixed Costs ($)</label>
                            <input
                                v-model.number="breakeven.fixedCosts"
                                type="number"
                                step="0.01"
                                min="0"
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-primary-500 focus:outline-none"
                                placeholder="10000"
                                @input="calculateBreakeven"
                            />
                            <p class="text-xs text-gray-500 mt-1">Rent, salaries, etc.</p>
                        </div>
                        <div>
                            <label class="block font-semibold text-gray-700 mb-2">Price per Unit ($)</label>
                            <input
                                v-model.number="breakeven.pricePerUnit"
                                type="number"
                                step="0.01"
                                min="0"
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-primary-500 focus:outline-none"
                                placeholder="100"
                                @input="calculateBreakeven"
                            />
                        </div>
                        <div>
                            <label class="block font-semibold text-gray-700 mb-2">Variable Cost per Unit ($)</label>
                            <input
                                v-model.number="breakeven.variableCostPerUnit"
                                type="number"
                                step="0.01"
                                min="0"
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-primary-500 focus:outline-none"
                                placeholder="60"
                                @input="calculateBreakeven"
                            />
                        </div>
                    </div>

                    <button
                        @click="calculateBreakeven"
                        class="w-full px-6 py-4 bg-gradient-to-r from-green-600 to-emerald-700 text-white rounded-xl font-bold hover:from-green-700 hover:to-emerald-800 transition-all transform hover:scale-105 shadow-lg"
                    >
                        Calculate Break-Even Point
                    </button>
                </div>
            </div>
        </div>

        <!-- Results -->
        <div v-if="result" class="space-y-6">
            <!-- Profit Margin Results -->
            <div v-if="selectedMode === 'margin'" class="space-y-6">
                <!-- Main Result Card -->
                <div class="bg-gradient-to-br from-green-500 to-emerald-600 text-white rounded-2xl p-8 text-center shadow-xl">
                    <div class="text-sm uppercase tracking-wide mb-2 opacity-90">Profit Margin</div>
                    <div class="text-6xl font-bold mb-2">{{ result.profitMargin }}%</div>
                    <div class="text-sm opacity-90">Net Profit: ${{ result.profit }}</div>
                </div>

                <!-- Summary Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="bg-white rounded-2xl p-6 shadow-lg border-2 border-blue-200">
                        <div class="text-sm text-gray-600 mb-1">Revenue</div>
                        <div class="text-2xl font-bold text-blue-600">${{ result.revenue }}</div>
                    </div>
                    <div class="bg-white rounded-2xl p-6 shadow-lg border-2 border-red-200">
                        <div class="text-sm text-gray-600 mb-1">Cost</div>
                        <div class="text-2xl font-bold text-red-600">${{ result.cost }}</div>
                    </div>
                    <div class="bg-white rounded-2xl p-6 shadow-lg border-2 border-green-200">
                        <div class="text-sm text-gray-600 mb-1">Profit</div>
                        <div class="text-2xl font-bold text-green-600">${{ result.profit }}</div>
                    </div>
                    <div class="bg-white rounded-2xl p-6 shadow-lg border-2 border-purple-200">
                        <div class="text-sm text-gray-600 mb-1">Markup</div>
                        <div class="text-2xl font-bold text-purple-600">{{ result.markup }}%</div>
                    </div>
                </div>

                <!-- Visual Breakdown -->
                <div class="bg-white rounded-2xl shadow-xl p-6 border-2 border-gray-200">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Revenue Breakdown</h3>
                    <div class="mb-6">
                        <div class="flex h-16 rounded-xl overflow-hidden shadow-lg">
                            <div 
                                class="bg-red-500 flex items-center justify-center text-white font-semibold"
                                :style="{ width: result.costPercentage + '%' }"
                            >
                                Cost {{ result.costPercentage }}%
                            </div>
                            <div 
                                class="bg-green-500 flex items-center justify-center text-white font-semibold"
                                :style="{ width: result.profitMargin + '%' }"
                            >
                                Profit {{ result.profitMargin }}%
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-6 h-6 bg-red-500 rounded"></div>
                            <div>
                                <div class="text-xs text-gray-600">Cost</div>
                                <div class="font-bold text-gray-900">${{ result.cost }} ({{ result.costPercentage }}%)</div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-6 h-6 bg-green-500 rounded"></div>
                            <div>
                                <div class="text-xs text-gray-600">Profit</div>
                                <div class="font-bold text-gray-900">${{ result.profit }} ({{ result.profitMargin }}%)</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Formulas -->
                <div class="bg-blue-50 rounded-2xl p-6 border-2 border-blue-200">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">📐 Formulas Used</h3>
                    <div class="space-y-2 text-sm">
                        <div><strong>Profit:</strong> Revenue - Cost = ${{ result.profit }}</div>
                        <div><strong>Profit Margin:</strong> (Profit / Revenue) × 100 = {{ result.profitMargin }}%</div>
                        <div><strong>Markup:</strong> (Profit / Cost) × 100 = {{ result.markup }}%</div>
                    </div>
                </div>
            </div>

            <!-- Markup Results -->
            <div v-if="selectedMode === 'markup'" class="space-y-6">
                <div class="bg-gradient-to-br from-purple-500 to-indigo-600 text-white rounded-2xl p-8 text-center shadow-xl">
                    <div class="text-sm uppercase tracking-wide mb-2 opacity-90">Selling Price</div>
                    <div class="text-6xl font-bold mb-2">${{ result.sellingPrice }}</div>
                    <div class="text-sm opacity-90">Markup: {{ result.markupPercentage }}%</div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white rounded-2xl p-6 shadow-lg border-2 border-gray-200">
                        <div class="text-sm text-gray-600 mb-1">Cost Price</div>
                        <div class="text-2xl font-bold text-gray-900">${{ result.cost }}</div>
                    </div>
                    <div class="bg-white rounded-2xl p-6 shadow-lg border-2 border-green-200">
                        <div class="text-sm text-gray-600 mb-1">Profit</div>
                        <div class="text-2xl font-bold text-green-600">${{ result.profit }}</div>
                    </div>
                    <div class="bg-white rounded-2xl p-6 shadow-lg border-2 border-purple-200">
                        <div class="text-sm text-gray-600 mb-1">Profit Margin</div>
                        <div class="text-2xl font-bold text-purple-600">{{ result.profitMargin }}%</div>
                    </div>
                </div>

                <div class="bg-purple-50 rounded-2xl p-6 border-2 border-purple-200">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">📐 Formulas Used</h3>
                    <div class="space-y-2 text-sm">
                        <div><strong>Selling Price:</strong> Cost × (1 + Markup/100) = ${{ result.sellingPrice }}</div>
                        <div><strong>Profit:</strong> Selling Price - Cost = ${{ result.profit }}</div>
                        <div><strong>Profit Margin:</strong> (Profit / Selling Price) × 100 = {{ result.profitMargin }}%</div>
                    </div>
                </div>
            </div>

            <!-- Break-Even Results -->
            <div v-if="selectedMode === 'breakeven'" class="space-y-6">
                <div class="bg-gradient-to-br from-orange-500 to-red-600 text-white rounded-2xl p-8 text-center shadow-xl">
                    <div class="text-sm uppercase tracking-wide mb-2 opacity-90">Break-Even Point</div>
                    <div class="text-6xl font-bold mb-2">{{ result.breakevenUnits }}</div>
                    <div class="text-sm opacity-90">units to break even</div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white rounded-2xl p-6 shadow-lg border-2 border-orange-200">
                        <div class="text-sm text-gray-600 mb-1">Break-Even Revenue</div>
                        <div class="text-3xl font-bold text-orange-600">${{ result.breakevenRevenue }}</div>
                        <div class="text-xs text-gray-500 mt-1">Total revenue needed</div>
                    </div>
                    <div class="bg-white rounded-2xl p-6 shadow-lg border-2 border-blue-200">
                        <div class="text-sm text-gray-600 mb-1">Contribution Margin</div>
                        <div class="text-3xl font-bold text-blue-600">${{ result.contributionMargin }}</div>
                        <div class="text-xs text-gray-500 mt-1">Per unit ({{ result.contributionMarginRatio }}%)</div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-xl p-6 border-2 border-gray-200">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Cost Analysis</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600">Fixed Costs</span>
                            <span class="font-bold text-gray-900">${{ result.fixedCosts }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600">Variable Cost per Unit</span>
                            <span class="font-bold text-gray-900">${{ result.variableCost }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600">Price per Unit</span>
                            <span class="font-bold text-gray-900">${{ result.pricePerUnit }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-600">Contribution Margin per Unit</span>
                            <span class="font-bold text-green-600">${{ result.contributionMargin }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-orange-50 rounded-2xl p-6 border-2 border-orange-200">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">📐 Formulas Used</h3>
                    <div class="space-y-2 text-sm">
                        <div><strong>Contribution Margin:</strong> Price - Variable Cost = ${{ result.contributionMargin }}</div>
                        <div><strong>Break-Even Units:</strong> Fixed Costs / Contribution Margin = {{ result.breakevenUnits }} units</div>
                        <div><strong>Break-Even Revenue:</strong> Break-Even Units × Price = ${{ result.breakevenRevenue }}</div>
                    </div>
                </div>
            </div>

            <!-- Reset Button -->
            <button 
                @click="reset" 
                class="w-full px-6 py-3 bg-gray-200 text-gray-700 rounded-xl font-semibold hover:bg-gray-300 transition-all"
            >
                Reset Calculator
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';

const props = defineProps({
    tool: Object,
});

const selectedMode = ref('margin');

const calculationModes = [
    { id: 'margin', label: 'Profit Margin' },
    { id: 'markup', label: 'Markup' },
    { id: 'breakeven', label: 'Break-Even' },
];

const margin = ref({
    revenue: 1000,
    cost: 600,
});

const markup = ref({
    cost: 600,
    percentage: 66.67,
});

const breakeven = ref({
    fixedCosts: 10000,
    pricePerUnit: 100,
    variableCostPerUnit: 60,
});

const result = ref(null);

const calculateMargin = () => {
    if (!margin.value.revenue || !margin.value.cost) {
        result.value = null;
        return;
    }

    if (margin.value.revenue <= 0 || margin.value.cost < 0) {
        alert('Please enter valid positive values!');
        return;
    }

    const revenue = margin.value.revenue;
    const cost = margin.value.cost;
    const profit = revenue - cost;
    const profitMargin = ((profit / revenue) * 100).toFixed(2);
    const markupPercentage = cost > 0 ? ((profit / cost) * 100).toFixed(2) : 0;
    const costPercentage = ((cost / revenue) * 100).toFixed(2);

    result.value = {
        revenue: revenue.toFixed(2),
        cost: cost.toFixed(2),
        profit: profit.toFixed(2),
        profitMargin,
        markup: markupPercentage,
        costPercentage,
    };

    logUsage('margin', { revenue, cost });
};

const calculateMarkup = () => {
    if (!markup.value.cost || !markup.value.percentage) {
        result.value = null;
        return;
    }

    if (markup.value.cost <= 0 || markup.value.percentage < 0) {
        alert('Please enter valid positive values!');
        return;
    }

    const cost = markup.value.cost;
    const markupPercentage = markup.value.percentage;
    const sellingPrice = cost * (1 + markupPercentage / 100);
    const profit = sellingPrice - cost;
    const profitMargin = ((profit / sellingPrice) * 100).toFixed(2);

    result.value = {
        cost: cost.toFixed(2),
        sellingPrice: sellingPrice.toFixed(2),
        profit: profit.toFixed(2),
        markupPercentage: markupPercentage.toFixed(2),
        profitMargin,
    };

    logUsage('markup', { cost, markupPercentage });
};

const calculateBreakeven = () => {
    if (!breakeven.value.fixedCosts || !breakeven.value.pricePerUnit || !breakeven.value.variableCostPerUnit) {
        result.value = null;
        return;
    }

    if (breakeven.value.fixedCosts <= 0 || breakeven.value.pricePerUnit <= 0 || breakeven.value.variableCostPerUnit < 0) {
        alert('Please enter valid positive values!');
        return;
    }

    const fixedCosts = breakeven.value.fixedCosts;
    const pricePerUnit = breakeven.value.pricePerUnit;
    const variableCost = breakeven.value.variableCostPerUnit;
    const contributionMargin = pricePerUnit - variableCost;

    if (contributionMargin <= 0) {
        alert('Price per unit must be greater than variable cost per unit!');
        return;
    }

    const breakevenUnits = Math.ceil(fixedCosts / contributionMargin);
    const breakevenRevenue = (breakevenUnits * pricePerUnit).toFixed(2);
    const contributionMarginRatio = ((contributionMargin / pricePerUnit) * 100).toFixed(2);

    result.value = {
        fixedCosts: fixedCosts.toFixed(2),
        pricePerUnit: pricePerUnit.toFixed(2),
        variableCost: variableCost.toFixed(2),
        contributionMargin: contributionMargin.toFixed(2),
        contributionMarginRatio,
        breakevenUnits,
        breakevenRevenue,
    };

    logUsage('breakeven', { fixedCosts, pricePerUnit, variableCost });
};

const logUsage = (mode, data) => {
    axios.post(`/tools/${props.tool.slug}/log-usage`, {
        input: { mode, ...data }
    }).catch(() => {});
};

const reset = () => {
    margin.value = { revenue: 1000, cost: 600 };
    markup.value = { cost: 600, percentage: 66.67 };
    breakeven.value = { fixedCosts: 10000, pricePerUnit: 100, variableCostPerUnit: 60 };
    result.value = null;
};
</script>
