<template>
    <div class="space-y-6">
        <div>
            <label class="label">Enter your text</label>
            <textarea
                v-model="inputText"
                class="input min-h-[200px]"
                placeholder="Enter text to convert..."
            ></textarea>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
            <button @click="convertCase('upper')" class="btn btn-primary">
                UPPERCASE
            </button>
            <button @click="convertCase('lower')" class="btn btn-primary">
                lowercase
            </button>
            <button @click="convertCase('title')" class="btn btn-primary">
                Title Case
            </button>
            <button @click="convertCase('sentence')" class="btn btn-primary">
                Sentence case
            </button>
            <button @click="convertCase('camel')" class="btn btn-primary">
                camelCase
            </button>
            <button @click="convertCase('snake')" class="btn btn-primary">
                snake_case
            </button>
        </div>

        <div v-if="outputText">
            <label class="label">Converted Text</label>
            <textarea
                v-model="outputText"
                class="input min-h-[200px]"
                readonly
            ></textarea>
            <div class="flex space-x-3 mt-3">
                <button @click="copyToClipboard" class="btn btn-primary">
                    Copy to Clipboard
                </button>
                <button @click="clearAll" class="btn btn-secondary">
                    Clear
                </button>
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

const inputText = ref('');
const outputText = ref('');

const convertCase = (type) => {
    if (!inputText.value) {
        alert('Please enter some text first!');
        return;
    }

    let result = '';

    switch (type) {
        case 'upper':
            result = inputText.value.toUpperCase();
            break;
        case 'lower':
            result = inputText.value.toLowerCase();
            break;
        case 'title':
            result = inputText.value.toLowerCase().replace(/\b\w/g, char => char.toUpperCase());
            break;
        case 'sentence':
            result = inputText.value.toLowerCase().replace(/(^\w|\.\s+\w)/g, char => char.toUpperCase());
            break;
        case 'camel':
            result = inputText.value
                .toLowerCase()
                .replace(/[^a-zA-Z0-9]+(.)/g, (_, char) => char.toUpperCase());
            break;
        case 'snake':
            result = inputText.value
                .toLowerCase()
                .replace(/\s+/g, '_')
                .replace(/[^a-z0-9_]/g, '');
            break;
    }

    outputText.value = result;

    // Log usage
    axios.post(route('tools.log-usage', props.tool.slug), {
        input: { type }
    }).catch(() => {});
};

const copyToClipboard = () => {
    navigator.clipboard.writeText(outputText.value);
    alert('Copied to clipboard!');
};

const clearAll = () => {
    inputText.value = '';
    outputText.value = '';
};
</script>
