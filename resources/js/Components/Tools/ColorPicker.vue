<template>
    <div class="space-y-6">
        <!-- Main Color Display -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border-2 border-gray-200">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Color Preview -->
                <div>
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Color Preview</h3>
                    <div 
                        class="w-full h-64 rounded-2xl shadow-lg border-4 border-white cursor-pointer transition-transform hover:scale-105"
                        :style="{ backgroundColor: currentColor }"
                        @click="openNativePicker"
                    ></div>
                    <input 
                        ref="nativeColorPicker"
                        type="color" 
                        v-model="currentColor"
                        @input="updateFromNative"
                        class="hidden"
                    />
                    <p class="text-center mt-4 text-gray-600 text-sm">Click to pick a color</p>
                </div>

                <!-- Color Formats -->
                <div>
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Color Formats</h3>
                    <div class="space-y-3">
                        <!-- HEX -->
                        <div class="bg-gray-50 rounded-xl p-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">HEX</label>
                            <div class="flex gap-2">
                                <input 
                                    v-model="hexInput"
                                    @input="updateFromHex"
                                    type="text"
                                    class="flex-1 px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-primary-500 focus:outline-none font-mono"
                                    placeholder="#000000"
                                />
                                <button @click="copyFormat('hex')" class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors">
                                    {{ copiedFormat === 'hex' ? '✓' : 'Copy' }}
                                </button>
                            </div>
                        </div>

                        <!-- RGB -->
                        <div class="bg-gray-50 rounded-xl p-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">RGB</label>
                            <div class="flex gap-2">
                                <input 
                                    :value="rgbString"
                                    readonly
                                    class="flex-1 px-4 py-2 border-2 border-gray-300 rounded-lg bg-white font-mono"
                                />
                                <button @click="copyFormat('rgb')" class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors">
                                    {{ copiedFormat === 'rgb' ? '✓' : 'Copy' }}
                                </button>
                            </div>
                        </div>

                        <!-- HSL -->
                        <div class="bg-gray-50 rounded-xl p-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">HSL</label>
                            <div class="flex gap-2">
                                <input 
                                    :value="hslString"
                                    readonly
                                    class="flex-1 px-4 py-2 border-2 border-gray-300 rounded-lg bg-white font-mono"
                                />
                                <button @click="copyFormat('hsl')" class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors">
                                    {{ copiedFormat === 'hsl' ? '✓' : 'Copy' }}
                                </button>
                            </div>
                        </div>

                        <!-- CMYK -->
                        <div class="bg-gray-50 rounded-xl p-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">CMYK</label>
                            <div class="flex gap-2">
                                <input 
                                    :value="cmykString"
                                    readonly
                                    class="flex-1 px-4 py-2 border-2 border-gray-300 rounded-lg bg-white font-mono"
                                />
                                <button @click="copyFormat('cmyk')" class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors">
                                    {{ copiedFormat === 'cmyk' ? '✓' : 'Copy' }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- RGB Sliders -->
        <div class="bg-white rounded-2xl shadow-xl p-6 border-2 border-gray-200">
            <h3 class="text-lg font-bold text-gray-900 mb-4">RGB Sliders</h3>
            <div class="space-y-4">
                <!-- Red -->
                <div>
                    <div class="flex justify-between mb-2">
                        <label class="text-sm font-semibold text-red-600">Red</label>
                        <span class="text-sm font-mono text-gray-700">{{ rgb.r }}</span>
                    </div>
                    <input 
                        v-model.number="rgb.r"
                        @input="updateFromRGB"
                        type="range" 
                        min="0" 
                        max="255"
                        class="w-full h-3 bg-gradient-to-r from-black to-red-600 rounded-lg appearance-none cursor-pointer"
                    />
                </div>

                <!-- Green -->
                <div>
                    <div class="flex justify-between mb-2">
                        <label class="text-sm font-semibold text-green-600">Green</label>
                        <span class="text-sm font-mono text-gray-700">{{ rgb.g }}</span>
                    </div>
                    <input 
                        v-model.number="rgb.g"
                        @input="updateFromRGB"
                        type="range" 
                        min="0" 
                        max="255"
                        class="w-full h-3 bg-gradient-to-r from-black to-green-600 rounded-lg appearance-none cursor-pointer"
                    />
                </div>

                <!-- Blue -->
                <div>
                    <div class="flex justify-between mb-2">
                        <label class="text-sm font-semibold text-blue-600">Blue</label>
                        <span class="text-sm font-mono text-gray-700">{{ rgb.b }}</span>
                    </div>
                    <input 
                        v-model.number="rgb.b"
                        @input="updateFromRGB"
                        type="range" 
                        min="0" 
                        max="255"
                        class="w-full h-3 bg-gradient-to-r from-black to-blue-600 rounded-lg appearance-none cursor-pointer"
                    />
                </div>
            </div>
        </div>

        <!-- Color Palette -->
        <div class="bg-white rounded-2xl shadow-xl p-6 border-2 border-gray-200">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Color Shades & Tints</h3>
            <div class="grid grid-cols-5 md:grid-cols-10 gap-2">
                <div 
                    v-for="(shade, index) in colorShades" 
                    :key="index"
                    @click="selectShade(shade)"
                    class="aspect-square rounded-lg cursor-pointer hover:scale-110 transition-transform border-2 border-gray-200 hover:border-primary-500"
                    :style="{ backgroundColor: shade }"
                    :title="shade"
                ></div>
            </div>
        </div>

        <!-- Saved Colors -->
        <div class="bg-white rounded-2xl shadow-xl p-6 border-2 border-gray-200">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-gray-900">Saved Colors</h3>
                <button 
                    @click="saveColor"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors font-medium"
                >
                    + Save Current Color
                </button>
            </div>
            <div v-if="savedColors.length > 0" class="grid grid-cols-5 md:grid-cols-10 gap-2">
                <div 
                    v-for="(color, index) in savedColors" 
                    :key="index"
                    class="relative group aspect-square rounded-lg cursor-pointer hover:scale-110 transition-transform border-2 border-gray-200"
                    :style="{ backgroundColor: color }"
                    @click="selectSavedColor(color)"
                >
                    <button 
                        @click.stop="removeSavedColor(index)"
                        class="absolute -top-2 -right-2 w-6 h-6 bg-red-600 text-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity text-xs"
                    >
                        ×
                    </button>
                </div>
            </div>
            <p v-else class="text-center text-gray-500 py-8">No saved colors yet</p>
        </div>

        <!-- Preset Colors -->
        <div class="bg-white rounded-2xl shadow-xl p-6 border-2 border-gray-200">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Preset Colors</h3>
            <div class="grid grid-cols-6 md:grid-cols-12 gap-2">
                <div 
                    v-for="(color, index) in presetColors" 
                    :key="index"
                    @click="selectPreset(color)"
                    class="aspect-square rounded-lg cursor-pointer hover:scale-110 transition-transform border-2 border-gray-200 hover:border-primary-500"
                    :style="{ backgroundColor: color }"
                    :title="color"
                ></div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, watch } from 'vue';
import axios from 'axios';

const props = defineProps({
    tool: Object,
});

const currentColor = ref('#3B82F6');
const hexInput = ref('#3B82F6');
const rgb = ref({ r: 59, g: 130, b: 246 });
const copiedFormat = ref('');
const savedColors = ref([]);
const nativeColorPicker = ref(null);

const presetColors = [
    '#FF0000', '#FF4500', '#FF8C00', '#FFD700', '#FFFF00', '#ADFF2F',
    '#00FF00', '#00FA9A', '#00CED1', '#1E90FF', '#0000FF', '#8A2BE2',
    '#FF00FF', '#FF1493', '#DC143C', '#B22222', '#8B0000', '#000000',
    '#FFFFFF', '#F5F5F5', '#DCDCDC', '#C0C0C0', '#A9A9A9', '#808080',
];

// Computed properties
const rgbString = computed(() => `rgb(${rgb.value.r}, ${rgb.value.g}, ${rgb.value.b})`);

const hslString = computed(() => {
    const hsl = rgbToHsl(rgb.value.r, rgb.value.g, rgb.value.b);
    return `hsl(${Math.round(hsl.h)}, ${Math.round(hsl.s)}%, ${Math.round(hsl.l)}%)`;
});

const cmykString = computed(() => {
    const cmyk = rgbToCmyk(rgb.value.r, rgb.value.g, rgb.value.b);
    return `cmyk(${cmyk.c}%, ${cmyk.m}%, ${cmyk.y}%, ${cmyk.k}%)`;
});

const colorShades = computed(() => {
    const shades = [];
    const baseColor = rgb.value;
    
    // Generate 10 shades from light to dark
    for (let i = 0; i < 10; i++) {
        const factor = i / 9; // 0 to 1
        const r = Math.round(255 + (baseColor.r - 255) * factor);
        const g = Math.round(255 + (baseColor.g - 255) * factor);
        const b = Math.round(255 + (baseColor.b - 255) * factor);
        shades.push(rgbToHex(r, g, b));
    }
    
    return shades;
});

// Color conversion functions
function rgbToHex(r, g, b) {
    return '#' + [r, g, b].map(x => {
        const hex = x.toString(16);
        return hex.length === 1 ? '0' + hex : hex;
    }).join('').toUpperCase();
}

function hexToRgb(hex) {
    const result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? {
        r: parseInt(result[1], 16),
        g: parseInt(result[2], 16),
        b: parseInt(result[3], 16)
    } : null;
}

function rgbToHsl(r, g, b) {
    r /= 255;
    g /= 255;
    b /= 255;
    
    const max = Math.max(r, g, b);
    const min = Math.min(r, g, b);
    let h, s, l = (max + min) / 2;
    
    if (max === min) {
        h = s = 0;
    } else {
        const d = max - min;
        s = l > 0.5 ? d / (2 - max - min) : d / (max + min);
        
        switch (max) {
            case r: h = ((g - b) / d + (g < b ? 6 : 0)) / 6; break;
            case g: h = ((b - r) / d + 2) / 6; break;
            case b: h = ((r - g) / d + 4) / 6; break;
        }
    }
    
    return { h: h * 360, s: s * 100, l: l * 100 };
}

function rgbToCmyk(r, g, b) {
    let c = 1 - (r / 255);
    let m = 1 - (g / 255);
    let y = 1 - (b / 255);
    let k = Math.min(c, m, y);
    
    if (k === 1) {
        c = m = y = 0;
    } else {
        c = Math.round(((c - k) / (1 - k)) * 100);
        m = Math.round(((m - k) / (1 - k)) * 100);
        y = Math.round(((y - k) / (1 - k)) * 100);
        k = Math.round(k * 100);
    }
    
    return { c, m, y, k };
}

// Update functions
function updateFromNative() {
    const rgbVal = hexToRgb(currentColor.value);
    if (rgbVal) {
        rgb.value = rgbVal;
        hexInput.value = currentColor.value.toUpperCase();
        logUsage();
    }
}

function updateFromHex() {
    if (/^#[0-9A-F]{6}$/i.test(hexInput.value)) {
        const rgbVal = hexToRgb(hexInput.value);
        if (rgbVal) {
            rgb.value = rgbVal;
            currentColor.value = hexInput.value;
            logUsage();
        }
    }
}

function updateFromRGB() {
    currentColor.value = rgbToHex(rgb.value.r, rgb.value.g, rgb.value.b);
    hexInput.value = currentColor.value;
    logUsage();
}

function openNativePicker() {
    nativeColorPicker.value?.click();
}

function selectShade(shade) {
    const rgbVal = hexToRgb(shade);
    if (rgbVal) {
        rgb.value = rgbVal;
        currentColor.value = shade;
        hexInput.value = shade;
    }
}

function selectPreset(color) {
    const rgbVal = hexToRgb(color);
    if (rgbVal) {
        rgb.value = rgbVal;
        currentColor.value = color;
        hexInput.value = color;
    }
}

function selectSavedColor(color) {
    const rgbVal = hexToRgb(color);
    if (rgbVal) {
        rgb.value = rgbVal;
        currentColor.value = color;
        hexInput.value = color;
    }
}

function saveColor() {
    if (!savedColors.value.includes(currentColor.value)) {
        savedColors.value.push(currentColor.value);
        localStorage.setItem('savedColors', JSON.stringify(savedColors.value));
    }
}

function removeSavedColor(index) {
    savedColors.value.splice(index, 1);
    localStorage.setItem('savedColors', JSON.stringify(savedColors.value));
}

async function copyFormat(format) {
    let textToCopy = '';
    
    switch(format) {
        case 'hex':
            textToCopy = hexInput.value;
            break;
        case 'rgb':
            textToCopy = rgbString.value;
            break;
        case 'hsl':
            textToCopy = hslString.value;
            break;
        case 'cmyk':
            textToCopy = cmykString.value;
            break;
    }
    
    try {
        await navigator.clipboard.writeText(textToCopy);
        copiedFormat.value = format;
        setTimeout(() => {
            copiedFormat.value = '';
        }, 2000);
    } catch (error) {
        alert('Failed to copy to clipboard');
    }
}

function logUsage() {
    axios.post(`/tools/${props.tool.slug}/log-usage`, {
        input: { color: currentColor.value }
    }).catch(() => {});
}

// Load saved colors from localStorage
if (localStorage.getItem('savedColors')) {
    try {
        savedColors.value = JSON.parse(localStorage.getItem('savedColors'));
    } catch (e) {
        savedColors.value = [];
    }
}
</script>

<style scoped>
input[type="range"]::-webkit-slider-thumb {
    appearance: none;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: white;
    cursor: pointer;
    border: 2px solid #3B82F6;
    box-shadow: 0 2px 4px rgba(0,0,0,0.2);
}

input[type="range"]::-moz-range-thumb {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: white;
    cursor: pointer;
    border: 2px solid #3B82F6;
    box-shadow: 0 2px 4px rgba(0,0,0,0.2);
}
</style>
