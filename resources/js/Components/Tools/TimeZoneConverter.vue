<template>
    <div class="timezone-converter max-w-7xl mx-auto">
        <!-- Info Box -->
        <div class="bg-gradient-to-r from-primary-600 to-primary-700 text-white p-5 rounded-2xl mb-8 flex items-center shadow-lg">
            <div class="bg-white/20 p-3 rounded-full mr-4">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <span class="text-lg">Convert time between different time zones instantly</span>
        </div>

        <!-- Input Card -->
        <div class="bg-white border-2 border-gray-200 rounded-2xl shadow-xl overflow-hidden mb-8">
            <div class="p-6 space-y-6">
                <!-- Current Time Display -->
                <div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-xl p-6 text-center">
                    <div class="text-sm uppercase tracking-wide mb-2 opacity-90">Current Time</div>
                    <div class="text-5xl font-bold mb-2">{{ currentTime }}</div>
                    <div class="text-sm opacity-90">{{ currentDate }}</div>
                </div>

                <!-- From Time Zone -->
                <div class="space-y-4">
                    <h3 class="text-lg font-bold text-gray-900">From</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-semibold text-gray-700 mb-2">Time Zone</label>
                            <select
                                v-model="fromTimezone"
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-primary-500 focus:outline-none"
                                @change="convert"
                            >
                                <option v-for="tz in props.timezones" :key="tz.value" :value="tz.value">
                                    {{ tz.label }}
                                </option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-semibold text-gray-700 mb-2">Date & Time</label>
                            <input
                                v-model="fromDateTime"
                                type="datetime-local"
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-primary-500 focus:outline-none"
                                @change="convert"
                            />
                        </div>
                    </div>
                </div>

                <!-- Swap Button -->
                <div class="flex justify-center">
                    <button
                        @click="swapTimezones"
                        class="p-3 bg-gray-100 hover:bg-gray-200 rounded-full transition-all transform hover:rotate-180 duration-300"
                        title="Swap timezones"
                    >
                        <svg class="w-6 h-6 text-gray-700" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>

                <!-- To Time Zone -->
                <div class="space-y-4">
                    <h3 class="text-lg font-bold text-gray-900">To</h3>
                    <div>
                        <label class="block font-semibold text-gray-700 mb-2">Time Zone</label>
                        <select
                            v-model="toTimezone"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-primary-500 focus:outline-none"
                            @change="convert"
                        >
                            <option v-for="tz in props.timezones" :key="tz.value" :value="tz.value">
                                {{ tz.label }}
                            </option>
                        </select>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="flex flex-wrap gap-2">
                    <button
                        @click="setCurrentTime"
                        class="px-4 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors text-sm font-semibold"
                    >
                        Use Current Time
                    </button>
                    <button
                        @click="addHours(1)"
                        class="px-4 py-2 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-colors text-sm font-semibold"
                    >
                        +1 Hour
                    </button>
                    <button
                        @click="addHours(24)"
                        class="px-4 py-2 bg-purple-100 text-purple-700 rounded-lg hover:bg-purple-200 transition-colors text-sm font-semibold"
                    >
                        +1 Day
                    </button>
                    <button
                        @click="addHours(-1)"
                        class="px-4 py-2 bg-orange-100 text-orange-700 rounded-lg hover:bg-orange-200 transition-colors text-sm font-semibold"
                    >
                        -1 Hour
                    </button>
                </div>

                <button
                    @click="convert"
                    class="w-full px-6 py-4 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-xl font-bold hover:from-primary-700 hover:to-primary-800 transition-all transform hover:scale-105 shadow-lg"
                >
                    Convert Time Zone
                </button>
            </div>
        </div>

        <!-- Results -->
        <div v-if="result" class="space-y-6">
            <!-- Main Result Card -->
            <div class="bg-gradient-to-br from-green-500 to-emerald-600 text-white rounded-2xl p-8 text-center shadow-xl">
                <div class="text-sm uppercase tracking-wide mb-2 opacity-90">Converted Time</div>
                <div class="text-6xl font-bold mb-2">{{ result.time }}</div>
                <div class="text-xl opacity-90 mb-1">{{ result.date }}</div>
                <div class="text-sm opacity-75">{{ result.timezone }}</div>
            </div>

            <!-- Time Difference -->
            <div class="bg-white rounded-2xl shadow-xl p-6 border-2 border-gray-200">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Time Difference</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-blue-50 rounded-xl p-4 border border-blue-200">
                        <div class="text-sm text-gray-600 mb-1">Offset Difference</div>
                        <div class="text-3xl font-bold text-blue-600">{{ result.offsetDiff }}</div>
                        <div class="text-xs text-gray-500 mt-1">hours</div>
                    </div>
                    <div class="bg-purple-50 rounded-xl p-4 border border-purple-200">
                        <div class="text-sm text-gray-600 mb-1">Day Difference</div>
                        <div class="text-3xl font-bold text-purple-600">{{ result.dayDiff }}</div>
                        <div class="text-xs text-gray-500 mt-1">{{ result.dayDiff === 0 ? 'Same day' : result.dayDiff > 0 ? 'day(s) ahead' : 'day(s) behind' }}</div>
                    </div>
                </div>
            </div>

            <!-- Comparison Table -->
            <div class="bg-white rounded-2xl shadow-xl p-6 border-2 border-gray-200">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Time Comparison</h3>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700">Time Zone</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700">Date & Time</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700">UTC Offset</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-gray-100">
                                <td class="px-4 py-3 font-medium text-gray-900">{{ result.fromTimezone }}</td>
                                <td class="px-4 py-3 text-gray-700">{{ result.fromDateTime }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ result.fromOffset }}</td>
                            </tr>
                            <tr class="bg-green-50">
                                <td class="px-4 py-3 font-medium text-gray-900">{{ result.toTimezone }}</td>
                                <td class="px-4 py-3 font-bold text-green-700">{{ result.toDateTime }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ result.toOffset }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Popular Time Zones -->
            <div class="bg-white rounded-2xl shadow-xl p-6 border-2 border-gray-200">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Same Time in Popular Time Zones</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div 
                        v-for="tz in props.popularTimezones" 
                        :key="tz.value"
                        class="bg-gray-50 rounded-lg p-4 hover:bg-gray-100 transition-colors"
                    >
                        <div class="text-sm font-semibold text-gray-900 mb-1">{{ tz.city }}</div>
                        <div class="text-2xl font-bold text-primary-600">{{ getTimeInZone(tz.value) }}</div>
                        <div class="text-xs text-gray-500 mt-1">{{ tz.label }}</div>
                    </div>
                </div>
            </div>

            <!-- Reset Button -->
            <button 
                @click="reset" 
                class="w-full px-6 py-3 bg-gray-200 text-gray-700 rounded-xl font-semibold hover:bg-gray-300 transition-all"
            >
                Reset Converter
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted, computed } from 'vue';
import axios from 'axios';

const props = defineProps({
    tool: Object,
    timezones: {
        type: Array,
        default: () => []
    },
    popularTimezones: {
        type: Array,
        default: () => []
    },
});

const currentTime = ref('');
const currentDate = ref('');
const fromTimezone = ref('America/New_York');
const toTimezone = ref('Europe/London');
const fromDateTime = ref('');
const result = ref(null);

let clockInterval = null;

const updateClock = () => {
    const now = new Date();
    currentTime.value = now.toLocaleTimeString('en-US', { 
        hour: '2-digit', 
        minute: '2-digit', 
        second: '2-digit',
        hour12: true 
    });
    currentDate.value = now.toLocaleDateString('en-US', { 
        weekday: 'long', 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric' 
    });
};

const setCurrentTime = () => {
    const now = new Date();
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, '0');
    const day = String(now.getDate()).padStart(2, '0');
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    
    fromDateTime.value = `${year}-${month}-${day}T${hours}:${minutes}`;
    convert();
};

const addHours = (hours) => {
    if (!fromDateTime.value) {
        setCurrentTime();
        return;
    }
    
    const date = new Date(fromDateTime.value);
    date.setHours(date.getHours() + hours);
    
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    const hrs = String(date.getHours()).padStart(2, '0');
    const mins = String(date.getMinutes()).padStart(2, '0');
    
    fromDateTime.value = `${year}-${month}-${day}T${hrs}:${mins}`;
    convert();
};

const swapTimezones = () => {
    const temp = fromTimezone.value;
    fromTimezone.value = toTimezone.value;
    toTimezone.value = temp;
    convert();
};

const convert = () => {
    if (!fromDateTime.value) {
        result.value = null;
        return;
    }

    try {
        // Create a date string that represents the time in the "from" timezone
        // We need to interpret the input as being in the source timezone
        const dateTimeStr = fromDateTime.value;
        
        // Create formatter for the source timezone
        const fromFormatter = new Intl.DateTimeFormat('en-US', {
            timeZone: fromTimezone.value,
            year: 'numeric',
            month: '2-digit',
            day: '2-digit',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: false
        });
        
        // Parse the input date/time and treat it as if it's in the "from" timezone
        // First, create a date object from the input
        const localDate = new Date(dateTimeStr);
        
        // Get the offset difference between browser timezone and "from" timezone
        const browserOffset = localDate.getTimezoneOffset(); // in minutes
        const fromTzDate = new Date(localDate.toLocaleString('en-US', { timeZone: fromTimezone.value }));
        const fromTzOffset = (localDate - fromTzDate) / 60000; // difference in minutes
        
        // Adjust the date to represent the correct moment in time
        const adjustedDate = new Date(localDate.getTime() - fromTzOffset * 60000);
        
        // Now convert to target timezone
        const toTime = adjustedDate.toLocaleTimeString('en-US', { 
            hour: '2-digit', 
            minute: '2-digit',
            second: '2-digit',
            hour12: true,
            timeZone: toTimezone.value
        });
        
        const toDateStr = adjustedDate.toLocaleDateString('en-US', { 
            weekday: 'long',
            year: 'numeric', 
            month: 'long', 
            day: 'numeric',
            timeZone: toTimezone.value
        });

        // Calculate offsets
        const fromOffset = getTimezoneOffset(fromTimezone.value);
        const toOffset = getTimezoneOffset(toTimezone.value);
        const offsetDiff = (parseFloat(toOffset.replace('UTC', '').replace(':', '.')) - 
                           parseFloat(fromOffset.replace('UTC', '').replace(':', '.'))).toFixed(1);

        // Calculate day difference
        const fromDayStr = adjustedDate.toLocaleDateString('en-US', { timeZone: fromTimezone.value });
        const toDayStr = adjustedDate.toLocaleDateString('en-US', { timeZone: toTimezone.value });
        const fromDay = new Date(fromDayStr);
        const toDay = new Date(toDayStr);
        const dayDiff = Math.round((toDay - fromDay) / (1000 * 60 * 60 * 24));

        result.value = {
            time: toTime,
            date: toDateStr,
            timezone: props.timezones.find(tz => tz.value === toTimezone.value)?.label || toTimezone.value,
            fromTimezone: props.timezones.find(tz => tz.value === fromTimezone.value)?.label || fromTimezone.value,
            toTimezone: props.timezones.find(tz => tz.value === toTimezone.value)?.label || toTimezone.value,
            fromDateTime: adjustedDate.toLocaleString('en-US', { 
                timeZone: fromTimezone.value,
                dateStyle: 'medium',
                timeStyle: 'medium'
            }),
            toDateTime: adjustedDate.toLocaleString('en-US', { 
                timeZone: toTimezone.value,
                dateStyle: 'medium',
                timeStyle: 'medium'
            }),
            fromOffset,
            toOffset,
            offsetDiff,
            dayDiff,
        };

        // Log usage
        axios.post(`/tools/${props.tool.slug}/log-usage`, {
            input: { from: fromTimezone.value, to: toTimezone.value }
        }).catch(() => {});

    } catch (error) {
        console.error('Conversion error:', error);
        alert('Error converting time. Please check your inputs.');
    }
};

const getTimezoneOffset = (timezone) => {
    const date = new Date();
    const utcDate = new Date(date.toLocaleString('en-US', { timeZone: 'UTC' }));
    const tzDate = new Date(date.toLocaleString('en-US', { timeZone: timezone }));
    const offset = (tzDate - utcDate) / (1000 * 60 * 60);
    const sign = offset >= 0 ? '+' : '';
    const hours = Math.floor(Math.abs(offset));
    const minutes = Math.round((Math.abs(offset) - hours) * 60);
    return `UTC${sign}${hours}:${minutes.toString().padStart(2, '0')}`;
};

const getTimeInZone = (timezone) => {
    if (!fromDateTime.value) return '--:--';
    
    try {
        const localDate = new Date(fromDateTime.value);
        const fromTzDate = new Date(localDate.toLocaleString('en-US', { timeZone: fromTimezone.value }));
        const fromTzOffset = (localDate - fromTzDate) / 60000;
        const adjustedDate = new Date(localDate.getTime() - fromTzOffset * 60000);
        
        return adjustedDate.toLocaleTimeString('en-US', { 
            hour: '2-digit', 
            minute: '2-digit',
            hour12: true,
            timeZone: timezone
        });
    } catch {
        return '--:--';
    }
};

const reset = () => {
    fromTimezone.value = 'America/New_York';
    toTimezone.value = 'Europe/London';
    fromDateTime.value = '';
    result.value = null;
    setCurrentTime();
};

onMounted(() => {
    updateClock();
    clockInterval = setInterval(updateClock, 1000);
    setCurrentTime();
});

onUnmounted(() => {
    if (clockInterval) {
        clearInterval(clockInterval);
    }
});
</script>
