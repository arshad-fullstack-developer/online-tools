<template>
    <div class="space-y-6">
        <div>
            <label class="label">Enter Text or Title</label>
            <input
                v-model="inputText"
                type="text"
                class="input"
                placeholder="Enter text to convert to slug..."
                @input="generateSlug"
            />
        </div>

        <div v-if="slug">
            <label class="label">Generated Slug</label>
            <div class="flex space-x-2">
                <input
                    v-model="slug"
                    type="text"
                    class="input font-mono"
                    readonly
                />
                <button @click="copyToClipboard" class="btn btn-primary whitespace-nowrap">
                    Copy
                </button>
            </div>
        </div>

        <div class="card bg-gray-50">
            <h3 class="font-semibold text-gray-900 mb-3">Slug Options</h3>
            <div class="space-y-3">
                <label class="flex items-center space-x-3 cursor-pointer">
                    <input
                        v-model="options.lowercase"
                        type="checkbox"
                        class="rounded border-gray-300 text-primary-600 focus:ring-primary-500"
                        @change="generateSlug"
                    />
                    <span class="text-gray-700">Convert to lowercase</span>
                </label>

                <label class="flex items-center space-x-3 cursor-pointer">
                    <input
                        v-model="options.removeSpecialChars"
                        type="checkbox"
                        class="rounded border-gray-300 text-primary-600 focus:ring-primary-500"
                        @change="generateSlug"
                    />
                    <span class="text-gray-700">Remove special characters</span>
                </label>
            </div>
        </div>

        <button @click="clear" class="btn btn-secondary">
            Clear
        </button>
    </div>
</template>

<script setup>
import { ref, reactive } from 'vue';
import axios from 'axios';

const props = defineProps({
    tool: Object,
});

const inputText = ref('');
const slug = ref('');
const options = reactive({
    lowercase: true,
    removeSpecialChars: true,
});

const generateSlug = () => {
    if (!inputText.value) {
        slug.value = '';
        return;
    }

    let result = inputText.value;

    // Convert to lowercase
    if (options.lowercase) {
        result = result.toLowerCase();
    }

    // Replace spaces with hyphens
    result = result.replace(/\s+/g, '-');

    // Remove special characters
    if (options.removeSpecialChars) {
        result = result.replace(/[^a-z0-9-]/gi, '');
    }

    // Remove multiple consecutive hyphens
    result = result.replace(/-+/g, '-');

    // Remove leading and trailing hyphens
    result = result.replace(/^-+|-+$/g, '');

    slug.value = result;

    // Log usage
    if (result) {
        axios.post(route('tools.log-usage', props.tool.slug), {
            input: { text: inputText.value }
        }).catch(() => {});
    }
};

const copyToClipboard = () => {
    navigator.clipboard.writeText(slug.value);
    alert('Slug copied to clipboard!');
};

const clear = () => {
    inputText.value = '';
    slug.value = '';
};
</script>
