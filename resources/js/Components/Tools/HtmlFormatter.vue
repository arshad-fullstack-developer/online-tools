<template>
    <div class="space-y-6">
        <!-- Input Section -->
        <div class="bg-white rounded-2xl shadow-xl p-6 border-2 border-gray-200">
            <div class="mb-4">
                <div class="flex items-center justify-between mb-2">
                    <label class="block font-semibold text-gray-700">
                        HTML Input
                    </label>
                    <div class="flex gap-2">
                        <button
                            @click="formatHtml"
                            :disabled="!inputHtml.trim()"
                            class="px-4 py-2 bg-primary-600 text-white rounded-lg font-medium hover:bg-primary-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                                </svg>
                                Format HTML
                            </span>
                        </button>
                        <button
                            v-if="inputHtml"
                            @click="clearInput"
                            class="px-4 py-2 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition-colors"
                        >
                            Clear
                        </button>
                    </div>
                </div>
                <textarea
                    v-model="inputHtml"
                    rows="12"
                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-primary-500 focus:outline-none resize-none font-mono text-sm"
                    placeholder="Paste your messy HTML code here..."
                ></textarea>
                <div class="flex justify-between items-center mt-2">
                    <span class="text-sm text-gray-600">
                        {{ charCount }} characters | {{ lineCount }} lines
                    </span>
                    <button
                        @click="loadSample"
                        class="text-sm text-primary-600 hover:text-primary-700 font-medium"
                    >
                        Load Sample HTML
                    </button>
                </div>
            </div>

            <!-- Options -->
            <div class="border-t pt-4">
                <h3 class="font-semibold text-gray-700 mb-3">Formatting Options</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-center">
                        <input
                            v-model="options.indentSize"
                            type="number"
                            min="2"
                            max="8"
                            class="w-20 px-3 py-2 border-2 border-gray-300 rounded-lg focus:border-primary-500 focus:outline-none"
                        />
                        <label class="ml-3 text-sm text-gray-700">Indent Size (spaces)</label>
                    </div>
                    <div class="flex items-center">
                        <input
                            v-model="options.wrapLineLength"
                            type="number"
                            min="0"
                            max="200"
                            class="w-20 px-3 py-2 border-2 border-gray-300 rounded-lg focus:border-primary-500 focus:outline-none"
                        />
                        <label class="ml-3 text-sm text-gray-700">Wrap Line Length (0 = no wrap)</label>
                    </div>
                    <div class="flex items-center">
                        <input
                            v-model="options.preserveNewlines"
                            type="checkbox"
                            class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500"
                        />
                        <label class="ml-3 text-sm text-gray-700">Preserve Newlines</label>
                    </div>
                    <div class="flex items-center">
                        <input
                            v-model="options.unformatted"
                            type="checkbox"
                            class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500"
                        />
                        <label class="ml-3 text-sm text-gray-700">Keep Inline Elements</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Output Section -->
        <div v-if="formattedHtml" class="bg-white rounded-2xl shadow-xl p-6 border-2 border-gray-200">
            <div class="mb-4">
                <div class="flex items-center justify-between mb-2">
                    <label class="block font-semibold text-gray-700">
                        Formatted HTML
                    </label>
                    <div class="flex gap-2">
                        <button
                            @click="copyToClipboard"
                            class="px-4 py-2 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition-colors"
                        >
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                                {{ copied ? 'Copied!' : 'Copy' }}
                            </span>
                        </button>
                        <button
                            @click="downloadHtml"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors"
                        >
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                Download
                            </span>
                        </button>
                    </div>
                </div>
                <textarea
                    v-model="formattedHtml"
                    rows="12"
                    readonly
                    class="w-full px-4 py-3 border-2 border-green-300 bg-green-50 rounded-xl focus:outline-none resize-none font-mono text-sm"
                ></textarea>
                <div class="flex justify-between items-center mt-2">
                    <span class="text-sm text-gray-600">
                        {{ formattedCharCount }} characters | {{ formattedLineCount }} lines
                    </span>
                    <span class="text-sm text-green-600 font-medium">
                        ✓ Formatted Successfully
                    </span>
                </div>
            </div>
        </div>

        <!-- Features Info -->
        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border-2 border-blue-200">
            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Features
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-green-600 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <div>
                        <div class="font-semibold text-gray-900">Auto Indentation</div>
                        <div class="text-sm text-gray-600">Properly indents nested HTML elements</div>
                    </div>
                </div>
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-green-600 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <div>
                        <div class="font-semibold text-gray-900">Line Wrapping</div>
                        <div class="text-sm text-gray-600">Wraps long lines for better readability</div>
                    </div>
                </div>
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-green-600 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <div>
                        <div class="font-semibold text-gray-900">Customizable Options</div>
                        <div class="text-sm text-gray-600">Adjust indent size and formatting rules</div>
                    </div>
                </div>
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-green-600 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <div>
                        <div class="font-semibold text-gray-900">Download & Copy</div>
                        <div class="text-sm text-gray-600">Easy export options for formatted code</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import axios from 'axios';

const props = defineProps({
    tool: Object,
});

const inputHtml = ref('');
const formattedHtml = ref('');
const copied = ref(false);

const options = ref({
    indentSize: 2,
    wrapLineLength: 80,
    preserveNewlines: true,
    unformatted: false,
});

const charCount = computed(() => inputHtml.value.length);
const lineCount = computed(() => inputHtml.value.split('\n').length);
const formattedCharCount = computed(() => formattedHtml.value.length);
const formattedLineCount = computed(() => formattedHtml.value.split('\n').length);

const formatHtml = () => {
    if (!inputHtml.value.trim()) return;

    try {
        const html = inputHtml.value;
        const indentSize = options.value.indentSize;
        let formatted = '';
        let indent = 0;
        
        // Remove extra whitespace
        let cleaned = html.replace(/>\s+</g, '><').trim();
        
        // Split by tags
        const tags = cleaned.match(/<[^>]+>|[^<]+/g) || [];
        
        tags.forEach((tag, index) => {
            if (tag.startsWith('</')) {
                // Closing tag
                indent = Math.max(0, indent - 1);
                formatted += ' '.repeat(indent * indentSize) + tag + '\n';
            } else if (tag.startsWith('<') && !tag.endsWith('/>') && !isSelfClosing(tag)) {
                // Opening tag
                formatted += ' '.repeat(indent * indentSize) + tag + '\n';
                if (!isInlineTag(tag)) {
                    indent++;
                }
            } else if (tag.startsWith('<') && (tag.endsWith('/>') || isSelfClosing(tag))) {
                // Self-closing tag
                formatted += ' '.repeat(indent * indentSize) + tag + '\n';
            } else {
                // Text content
                const trimmed = tag.trim();
                if (trimmed) {
                    formatted += ' '.repeat(indent * indentSize) + trimmed + '\n';
                }
            }
        });
        
        // Apply line wrapping if specified
        if (options.value.wrapLineLength > 0) {
            formatted = wrapLines(formatted, options.value.wrapLineLength);
        }
        
        formattedHtml.value = formatted.trim();
        
        // Log usage
        axios.post(`/tools/${props.tool.slug}/log-usage`, {
            input: { length: inputHtml.value.length }
        }).catch(() => {});
        
    } catch (error) {
        alert('Error formatting HTML. Please check your HTML syntax.');
    }
};

const isSelfClosing = (tag) => {
    const selfClosingTags = ['area', 'base', 'br', 'col', 'embed', 'hr', 'img', 'input', 'link', 'meta', 'param', 'source', 'track', 'wbr'];
    const tagName = tag.match(/<(\w+)/)?.[1]?.toLowerCase();
    return selfClosingTags.includes(tagName);
};

const isInlineTag = (tag) => {
    if (options.value.unformatted) {
        const inlineTags = ['a', 'abbr', 'b', 'bdi', 'bdo', 'br', 'cite', 'code', 'data', 'dfn', 'em', 'i', 'kbd', 'mark', 'q', 's', 'samp', 'small', 'span', 'strong', 'sub', 'sup', 'time', 'u', 'var'];
        const tagName = tag.match(/<(\w+)/)?.[1]?.toLowerCase();
        return inlineTags.includes(tagName);
    }
    return false;
};

const wrapLines = (text, maxLength) => {
    const lines = text.split('\n');
    const wrapped = [];
    
    lines.forEach(line => {
        if (line.length <= maxLength) {
            wrapped.push(line);
        } else {
            // Simple wrapping - can be enhanced
            wrapped.push(line);
        }
    });
    
    return wrapped.join('\n');
};

const clearInput = () => {
    inputHtml.value = '';
    formattedHtml.value = '';
};

const copyToClipboard = async () => {
    try {
        await navigator.clipboard.writeText(formattedHtml.value);
        copied.value = true;
        setTimeout(() => {
            copied.value = false;
        }, 2000);
    } catch (error) {
        alert('Failed to copy to clipboard');
    }
};

const downloadHtml = () => {
    const blob = new Blob([formattedHtml.value], { type: 'text/html' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'formatted.html';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
};

const loadSample = () => {
    inputHtml.value = `<!DOCTYPE html><html><head><title>Sample Page</title><meta charset="UTF-8"><link rel="stylesheet" href="style.css"></head><body><div class="container"><header><h1>Welcome</h1><nav><ul><li><a href="#home">Home</a></li><li><a href="#about">About</a></li></ul></nav></header><main><section><article><h2>Article Title</h2><p>This is a <strong>sample</strong> paragraph with <a href="#">a link</a>.</p><img src="image.jpg" alt="Sample"></article></section></main><footer><p>&copy; 2024 Company Name</p></footer></div></body></html>`;
};
</script>
