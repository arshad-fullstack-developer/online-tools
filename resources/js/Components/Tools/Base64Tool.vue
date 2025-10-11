<template>
    <div class="space-y-6">
        <div class="flex space-x-4 border-b border-gray-200">
            <button
                @click="mode = 'encode'"
                :class="[
                    'px-4 py-2 font-medium transition-colors',
                    mode === 'encode'
                        ? 'text-primary-600 border-b-2 border-primary-600'
                        : 'text-gray-600 hover:text-gray-900'
                ]"
            >
                Encode
            </button>
            <button
                @click="mode = 'decode'"
                :class="[
                    'px-4 py-2 font-medium transition-colors',
                    mode === 'decode'
                        ? 'text-primary-600 border-b-2 border-primary-600'
                        : 'text-gray-600 hover:text-gray-900'
                ]"
            >
                Decode
            </button>
        </div>

        <div v-if="mode === 'encode'">
            <label class="label">Text to Encode</label>
            <textarea
                v-model="inputText"
                class="input min-h-[200px] font-mono"
                placeholder="Enter text to encode to Base64..."
            ></textarea>
            <button @click="encode" class="btn btn-primary mt-3">
                Encode to Base64
            </button>
        </div>

        <div v-else>
            <label class="label">Base64 String to Decode</label>
            <textarea
                v-model="inputText"
                class="input min-h-[200px] font-mono"
                placeholder="Enter Base64 string to decode..."
            ></textarea>
            <button @click="decode" class="btn btn-primary mt-3">
                Decode from Base64
            </button>
        </div>

        <div v-if="outputText">
            <label class="label">Result</label>
            <textarea
                v-model="outputText"
                class="input min-h-[200px] font-mono"
                readonly
            ></textarea>
            <div class="flex space-x-3 mt-3">
                <button @click="copyToClipboard" class="btn btn-primary">
                    Copy to Clipboard
                </button>
                <button @click="clear" class="btn btn-secondary">
                    Clear
                </button>
            </div>
        </div>

        <div v-if="error" class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
            {{ error }}
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';

const props = defineProps({
    tool: Object,
});

const mode = ref('encode');
const inputText = ref('');
const outputText = ref('');
const error = ref('');

const encode = () => {
    if (!inputText.value) {
        error.value = 'Please enter some text to encode!';
        return;
    }

    try {
        outputText.value = btoa(inputText.value);
        error.value = '';

        // Log usage
        axios.post(route('tools.log-usage', props.tool.slug), {
            input: { action: 'encode' }
        }).catch(() => {});
    } catch (e) {
        error.value = 'Error encoding text. Please check your input.';
        outputText.value = '';
    }
};

const decode = () => {
    if (!inputText.value) {
        error.value = 'Please enter a Base64 string to decode!';
        return;
    }

    try {
        outputText.value = atob(inputText.value);
        error.value = '';

        // Log usage
        axios.post(route('tools.log-usage', props.tool.slug), {
            input: { action: 'decode' }
        }).catch(() => {});
    } catch (e) {
        error.value = 'Invalid Base64 string. Please check your input.';
        outputText.value = '';
    }
};

const copyToClipboard = () => {
    navigator.clipboard.writeText(outputText.value);
    alert('Copied to clipboard!');
};

const clear = () => {
    inputText.value = '';
    outputText.value = '';
    error.value = '';
};
</script>
