<template>
    <div class="space-y-6">
        <div>
            <label class="label">Enter JSON</label>
            <textarea
                v-model="inputJson"
                class="input min-h-[300px] font-mono text-sm"
                placeholder='{"name": "John", "age": 30}'
            ></textarea>
        </div>

        <div class="flex space-x-3">
            <button @click="formatJson" class="btn btn-primary">
                Format & Validate
            </button>
            <button @click="minifyJson" class="btn btn-secondary">
                Minify
            </button>
            <button @click="clear" class="btn btn-secondary">
                Clear
            </button>
        </div>

        <div v-if="error" class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
            <strong>Error:</strong> {{ error }}
        </div>

        <div v-if="outputJson">
            <div class="flex justify-between items-center mb-2">
                <label class="label mb-0">Formatted JSON</label>
                <button @click="copyToClipboard" class="text-sm text-primary-600 hover:text-primary-700 font-medium">
                    Copy
                </button>
            </div>
            <pre class="bg-gray-900 text-green-400 p-4 rounded-lg overflow-x-auto font-mono text-sm">{{ outputJson }}</pre>
        </div>

        <div v-if="stats" class="card bg-gray-50">
            <h3 class="font-semibold text-gray-900 mb-3">JSON Statistics</h3>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <span class="text-gray-600">Size:</span>
                    <span class="font-semibold text-gray-900 ml-2">{{ stats.size }} bytes</span>
                </div>
                <div>
                    <span class="text-gray-600">Lines:</span>
                    <span class="font-semibold text-gray-900 ml-2">{{ stats.lines }}</span>
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

const inputJson = ref('');
const outputJson = ref('');
const error = ref('');
const stats = ref(null);

const formatJson = () => {
    if (!inputJson.value.trim()) {
        error.value = 'Please enter some JSON to format!';
        return;
    }

    try {
        const parsed = JSON.parse(inputJson.value);
        outputJson.value = JSON.stringify(parsed, null, 2);
        error.value = '';
        
        stats.value = {
            size: new Blob([outputJson.value]).size,
            lines: outputJson.value.split('\n').length,
        };

        // Log usage
        axios.post(route('tools.log-usage', props.tool.slug), {
            input: { action: 'format' }
        }).catch(() => {});
    } catch (e) {
        error.value = e.message;
        outputJson.value = '';
        stats.value = null;
    }
};

const minifyJson = () => {
    if (!inputJson.value.trim()) {
        error.value = 'Please enter some JSON to minify!';
        return;
    }

    try {
        const parsed = JSON.parse(inputJson.value);
        outputJson.value = JSON.stringify(parsed);
        error.value = '';
        
        stats.value = {
            size: new Blob([outputJson.value]).size,
            lines: 1,
        };

        // Log usage
        axios.post(route('tools.log-usage', props.tool.slug), {
            input: { action: 'minify' }
        }).catch(() => {});
    } catch (e) {
        error.value = e.message;
        outputJson.value = '';
        stats.value = null;
    }
};

const copyToClipboard = () => {
    navigator.clipboard.writeText(outputJson.value);
    alert('Copied to clipboard!');
};

const clear = () => {
    inputJson.value = '';
    outputJson.value = '';
    error.value = '';
    stats.value = null;
};
</script>
