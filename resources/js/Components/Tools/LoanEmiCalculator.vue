<template>
    <div class="loan-emi-calculator max-w-7xl mx-auto">
        <!-- Info Box -->
        <div class="bg-gradient-to-r from-primary-600 to-primary-700 text-white p-5 rounded-2xl mb-8 flex items-center shadow-lg">
            <div class="bg-white/20 p-3 rounded-full mr-4">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path>
                    <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <span class="text-lg">Calculate your monthly EMI, total interest, and view complete amortization schedule</span>
        </div>

        <!-- Input Card -->
        <div class="bg-white border-2 border-gray-200 rounded-2xl shadow-xl overflow-hidden mb-8">
            <div class="p-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block font-semibold text-gray-700 mb-2">Loan Amount ($)</label>
                        <input
                            v-model.number="loanAmount"
                            type="number"
                            step="1000"
                            min="1000"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-primary-500 focus:outline-none"
                            placeholder="100000"
                            @input="calculate"
                        />
                        <input
                            v-model.number="loanAmount"
                            type="range"
                            min="10000"
                            max="10000000"
                            step="10000"
                            class="w-full mt-2"
                            @input="calculate"
                        />
                        <p class="text-xs text-gray-500 mt-1">$10K - $10M</p>
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-700 mb-2">Interest Rate (% per year)</label>
                        <input
                            v-model.number="interestRate"
                            type="number"
                            step="0.1"
                            min="0.1"
                            max="30"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-primary-500 focus:outline-none"
                            placeholder="7.5"
                            @input="calculate"
                        />
                        <input
                            v-model.number="interestRate"
                            type="range"
                            min="1"
                            max="30"
                            step="0.1"
                            class="w-full mt-2"
                            @input="calculate"
                        />
                        <p class="text-xs text-gray-500 mt-1">1% - 30%</p>
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-700 mb-2">Loan Tenure (Years)</label>
                        <input
                            v-model.number="tenure"
                            type="number"
                            step="1"
                            min="1"
                            max="30"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-primary-500 focus:outline-none"
                            placeholder="20"
                            @input="calculate"
                        />
                        <input
                            v-model.number="tenure"
                            type="range"
                            min="1"
                            max="30"
                            step="1"
                            class="w-full mt-2"
                            @input="calculate"
                        />
                        <p class="text-xs text-gray-500 mt-1">1 - 30 years</p>
                    </div>
                </div>

                <!-- Prepayment Option -->
                <div class="bg-blue-50 rounded-xl p-4 border border-blue-200">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"></path>
                            </svg>
                            Prepayment (Optional)
                        </h3>
                        <label class="flex items-center cursor-pointer">
                            <input 
                                v-model="enablePrepayment" 
                                type="checkbox"
                                class="w-4 h-4 text-primary-600 rounded focus:ring-primary-500"
                                @change="calculate"
                            />
                            <span class="ml-2 text-sm font-medium text-gray-700">Enable</span>
                        </label>
                    </div>
                    <div v-if="enablePrepayment" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Prepayment Amount ($)</label>
                            <input
                                v-model.number="prepaymentAmount"
                                type="number"
                                step="1000"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-primary-500 focus:outline-none"
                                placeholder="10000"
                                @input="calculate"
                            />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Prepayment Frequency</label>
                            <select 
                                v-model="prepaymentFrequency"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-primary-500 focus:outline-none"
                                @change="calculate"
                            >
                                <option value="yearly">Yearly</option>
                                <option value="monthly">Monthly</option>
                                <option value="one-time">One-Time</option>
                            </select>
                        </div>
                    </div>
                </div>

                <button
                    @click="calculate"
                    class="w-full px-6 py-4 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-xl font-bold hover:from-primary-700 hover:to-primary-800 transition-all transform hover:scale-105 shadow-lg flex items-center justify-center"
                >
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"></path>
                    </svg>
                    Calculate EMI
                </button>
            </div>
        </div>

        <!-- Results -->
        <div v-if="result" class="space-y-6">
            <!-- Main EMI Card -->
            <div class="bg-gradient-to-br from-primary-500 to-primary-600 text-white rounded-2xl p-8 text-center shadow-xl">
                <div class="text-sm uppercase tracking-wide mb-2 opacity-90">Monthly EMI</div>
                <div class="text-6xl font-bold mb-2">${{ result.emi }}</div>
                <div class="text-sm opacity-90">for {{ result.totalMonths }} months</div>
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-2xl p-6 shadow-lg border-2 border-blue-200">
                    <div class="flex items-center justify-between mb-2">
                        <div class="text-sm text-gray-600">Principal Amount</div>
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="text-3xl font-bold text-blue-600">${{ result.principal }}</div>
                    <div class="text-xs text-gray-500 mt-1">{{ result.principalPercentage }}% of total</div>
                </div>
                <div class="bg-white rounded-2xl p-6 shadow-lg border-2 border-red-200">
                    <div class="flex items-center justify-between mb-2">
                        <div class="text-sm text-gray-600">Total Interest</div>
                        <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="text-3xl font-bold text-red-600">${{ result.totalInterest }}</div>
                    <div class="text-xs text-gray-500 mt-1">{{ result.interestPercentage }}% of total</div>
                </div>
                <div class="bg-white rounded-2xl p-6 shadow-lg border-2 border-green-200">
                    <div class="flex items-center justify-between mb-2">
                        <div class="text-sm text-gray-600">Total Payment</div>
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="text-3xl font-bold text-green-600">${{ result.totalAmount }}</div>
                    <div class="text-xs text-gray-500 mt-1">Over {{ tenure }} years</div>
                </div>
            </div>

            <!-- Savings with Prepayment -->
            <div v-if="enablePrepayment && result.savings" class="bg-gradient-to-r from-green-500 to-green-600 text-white rounded-2xl p-6 shadow-xl">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-sm opacity-90 mb-1">💰 Total Savings with Prepayment</div>
                        <div class="text-4xl font-bold">${{ result.savings }}</div>
                        <div class="text-sm opacity-90 mt-1">Tenure reduced by {{ result.tenureReduction }} months</div>
                    </div>
                    <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Payment Breakdown Chart -->
            <div class="bg-white rounded-2xl shadow-xl p-6 border-2 border-gray-200">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Payment Breakdown</h3>
                
                <!-- Visual Bar Chart -->
                <div class="mb-6">
                    <div class="flex h-12 rounded-xl overflow-hidden shadow-lg">
                        <div 
                            class="bg-blue-500 flex items-center justify-center text-white font-semibold text-sm"
                            :style="{ width: result.principalPercentage + '%' }"
                        >
                            {{ result.principalPercentage }}%
                        </div>
                        <div 
                            class="bg-red-500 flex items-center justify-center text-white font-semibold text-sm"
                            :style="{ width: result.interestPercentage + '%' }"
                        >
                            {{ result.interestPercentage }}%
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-6 h-6 bg-blue-500 rounded"></div>
                        <div>
                            <div class="text-xs text-gray-600">Principal</div>
                            <div class="font-bold text-gray-900">${{ result.principal }}</div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-6 h-6 bg-red-500 rounded"></div>
                        <div>
                            <div class="text-xs text-gray-600">Interest</div>
                            <div class="font-bold text-gray-900">${{ result.totalInterest }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Loan Summary -->
            <div class="bg-white rounded-2xl shadow-xl p-6 border-2 border-gray-200">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Loan Summary</h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="text-gray-600">Monthly EMI</span>
                        <span class="font-bold text-xl text-primary-600">${{ result.emi }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="text-gray-600">Loan Amount</span>
                        <span class="font-semibold text-gray-900">${{ result.principal }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="text-gray-600">Total Interest</span>
                        <span class="font-semibold text-gray-900">${{ result.totalInterest }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="text-gray-600">Total Payment</span>
                        <span class="font-semibold text-gray-900">${{ result.totalAmount }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="text-gray-600">Loan Tenure</span>
                        <span class="font-semibold text-gray-900">{{ tenure }} years ({{ result.totalMonths }} months)</span>
                    </div>
                    <div class="flex justify-between items-center py-2">
                        <span class="text-gray-600">Interest Rate</span>
                        <span class="font-semibold text-gray-900">{{ interestRate }}% per year</span>
                    </div>
                </div>
            </div>

            <!-- Amortization Schedule -->
            <div class="bg-white rounded-2xl shadow-xl p-6 border-2 border-gray-200">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-900">Amortization Schedule</h3>
                    <button
                        @click="showFullSchedule = !showFullSchedule"
                        class="text-sm px-4 py-2 bg-primary-100 text-primary-700 rounded-lg hover:bg-primary-200 transition-colors"
                    >
                        {{ showFullSchedule ? 'Show Yearly' : 'Show All Months' }}
                    </button>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700">{{ showFullSchedule ? 'Month' : 'Year' }}</th>
                                <th class="px-4 py-3 text-right font-semibold text-gray-700">EMI</th>
                                <th class="px-4 py-3 text-right font-semibold text-gray-700">Principal</th>
                                <th class="px-4 py-3 text-right font-semibold text-gray-700">Interest</th>
                                <th class="px-4 py-3 text-right font-semibold text-gray-700">Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr 
                                v-for="(row, index) in displaySchedule" 
                                :key="index"
                                class="border-b border-gray-100 hover:bg-gray-50"
                            >
                                <td class="px-4 py-3 font-medium text-gray-900">{{ row.period }}</td>
                                <td class="px-4 py-3 text-right text-gray-900">${{ row.emi }}</td>
                                <td class="px-4 py-3 text-right text-blue-600">${{ row.principal }}</td>
                                <td class="px-4 py-3 text-right text-red-600">${{ row.interest }}</td>
                                <td class="px-4 py-3 text-right font-semibold text-gray-900">${{ row.balance }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <button
                    @click="downloadSchedule"
                    class="mt-4 w-full px-4 py-3 bg-green-600 text-white rounded-xl font-semibold hover:bg-green-700 transition-all flex items-center justify-center"
                >
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    Download Schedule (CSV)
                </button>
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
import { ref, computed } from 'vue';
import axios from 'axios';

const props = defineProps({
    tool: Object,
});

const loanAmount = ref(100000);
const interestRate = ref(7.5);
const tenure = ref(20);
const enablePrepayment = ref(false);
const prepaymentAmount = ref(0);
const prepaymentFrequency = ref('yearly');
const result = ref(null);
const amortizationSchedule = ref([]);
const showFullSchedule = ref(false);

const displaySchedule = computed(() => {
    if (!amortizationSchedule.value.length) return [];
    
    if (showFullSchedule.value) {
        return amortizationSchedule.value;
    }
    
    // Show yearly summary
    const yearlySchedule = [];
    for (let year = 1; year <= tenure.value; year++) {
        const yearData = amortizationSchedule.value.filter(row => 
            row.month > (year - 1) * 12 && row.month <= year * 12
        );
        
        if (yearData.length > 0) {
            const lastMonth = yearData[yearData.length - 1];
            yearlySchedule.push({
                period: `Year ${year}`,
                emi: (parseFloat(lastMonth.emi) * 12).toFixed(2),
                principal: yearData.reduce((sum, row) => sum + parseFloat(row.principalPaid), 0).toFixed(2),
                interest: yearData.reduce((sum, row) => sum + parseFloat(row.interestPaid), 0).toFixed(2),
                balance: lastMonth.balance,
            });
        }
    }
    
    return yearlySchedule;
});

const calculate = () => {
    if (!loanAmount.value || !interestRate.value || !tenure.value) {
        result.value = null;
        return;
    }

    if (loanAmount.value <= 0 || interestRate.value <= 0 || tenure.value <= 0) {
        alert('Please enter valid positive values!');
        return;
    }

    const principal = loanAmount.value;
    const monthlyRate = interestRate.value / 12 / 100;
    const totalMonths = tenure.value * 12;

    // EMI Formula: P * r * (1 + r)^n / ((1 + r)^n - 1)
    const emi = (principal * monthlyRate * Math.pow(1 + monthlyRate, totalMonths)) / 
                (Math.pow(1 + monthlyRate, totalMonths) - 1);

    // Calculate amortization schedule
    let balance = principal;
    const schedule = [];
    let totalInterestPaid = 0;

    for (let month = 1; month <= totalMonths; month++) {
        const interestPaid = balance * monthlyRate;
        const principalPaid = emi - interestPaid;
        balance -= principalPaid;
        totalInterestPaid += interestPaid;

        if (balance < 0) balance = 0;

        schedule.push({
            month,
            period: `Month ${month}`,
            emi: emi.toFixed(2),
            principalPaid: principalPaid.toFixed(2),
            interestPaid: interestPaid.toFixed(2),
            balance: balance.toFixed(2),
        });

        if (balance <= 0) break;
    }

    amortizationSchedule.value = schedule;

    const totalAmount = emi * totalMonths;
    const totalInterest = totalAmount - principal;

    const principalPercentage = ((principal / totalAmount) * 100).toFixed(1);
    const interestPercentage = ((totalInterest / totalAmount) * 100).toFixed(1);

    result.value = {
        emi: emi.toFixed(2),
        principal: principal.toFixed(2),
        totalInterest: totalInterest.toFixed(2),
        totalAmount: totalAmount.toFixed(2),
        totalMonths,
        principalPercentage,
        interestPercentage,
    };

    // Calculate prepayment savings if enabled
    if (enablePrepayment.value && prepaymentAmount.value > 0) {
        calculateWithPrepayment();
    }

    // Log usage
    axios.post(`/tools/${props.tool.slug}/log-usage`, {
        input: { loanAmount: loanAmount.value, interestRate: interestRate.value, tenure: tenure.value }
    }).catch(() => {});
};

const calculateWithPrepayment = () => {
    const principal = loanAmount.value;
    const monthlyRate = interestRate.value / 12 / 100;
    const totalMonths = tenure.value * 12;
    const emi = parseFloat(result.value.emi);

    let balance = principal;
    let totalInterestPaid = 0;
    let monthsPaid = 0;

    for (let month = 1; month <= totalMonths; month++) {
        const interestPaid = balance * monthlyRate;
        let principalPaid = emi - interestPaid;
        
        // Apply prepayment
        if (prepaymentFrequency.value === 'monthly' || 
            (prepaymentFrequency.value === 'yearly' && month % 12 === 0) ||
            (prepaymentFrequency.value === 'one-time' && month === 12)) {
            principalPaid += prepaymentAmount.value;
        }

        balance -= principalPaid;
        totalInterestPaid += interestPaid;
        monthsPaid = month;

        if (balance <= 0) break;
    }

    const originalInterest = parseFloat(result.value.totalInterest);
    const savings = (originalInterest - totalInterestPaid).toFixed(2);
    const tenureReduction = totalMonths - monthsPaid;

    result.value.savings = savings;
    result.value.tenureReduction = tenureReduction;
};

const downloadSchedule = () => {
    let csv = 'Period,EMI,Principal,Interest,Balance\n';
    
    amortizationSchedule.value.forEach(row => {
        csv += `${row.period},${row.emi},${row.principalPaid},${row.interestPaid},${row.balance}\n`;
    });

    const blob = new Blob([csv], { type: 'text/csv' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'loan-amortization-schedule.csv';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
};

const reset = () => {
    loanAmount.value = 100000;
    interestRate.value = 7.5;
    tenure.value = 20;
    enablePrepayment.value = false;
    prepaymentAmount.value = 0;
    prepaymentFrequency.value = 'yearly';
    result.value = null;
    amortizationSchedule.value = [];
};
</script>
