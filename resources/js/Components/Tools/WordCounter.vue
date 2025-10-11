<template>
    <div class="space-y-6">
        <div>
            <label class="label">Enter or paste your text</label>
            <textarea
                v-model="text"
                @input="countWords"
                class="input min-h-[300px] font-mono"
                placeholder="Start typing or paste your text here..."
            ></textarea>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-primary-50 rounded-lg p-4 text-center">
                <div class="text-3xl font-bold text-primary-600">{{ stats.words }}</div>
                <div class="text-sm text-gray-600 mt-1">Words</div>
            </div>
            <div class="bg-primary-50 rounded-lg p-4 text-center">
                <div class="text-3xl font-bold text-primary-600">{{ stats.characters }}</div>
                <div class="text-sm text-gray-600 mt-1">Characters</div>
            </div>
            <div class="bg-primary-50 rounded-lg p-4 text-center">
                <div class="text-3xl font-bold text-primary-600">{{ stats.sentences }}</div>
                <div class="text-sm text-gray-600 mt-1">Sentences</div>
            </div>
            <div class="bg-primary-50 rounded-lg p-4 text-center">
                <div class="text-3xl font-bold text-primary-600">{{ stats.paragraphs }}</div>
                <div class="text-sm text-gray-600 mt-1">Paragraphs</div>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            <div class="bg-gray-50 rounded-lg p-4">
                <div class="text-sm text-gray-600">Characters (no spaces)</div>
                <div class="text-xl font-semibold text-gray-900 mt-1">{{ stats.charactersNoSpaces }}</div>
            </div>
            <div class="bg-gray-50 rounded-lg p-4">
                <div class="text-sm text-gray-600">Reading Time</div>
                <div class="text-xl font-semibold text-gray-900 mt-1">{{ stats.readingTime }}</div>
            </div>
            <div class="bg-gray-50 rounded-lg p-4">
                <div class="text-sm text-gray-600">Speaking Time</div>
                <div class="text-xl font-semibold text-gray-900 mt-1">{{ stats.speakingTime }}</div>
            </div>
        </div>

        <div class="flex space-x-3">
            <button @click="clearText" class="btn btn-secondary">
                Clear Text
            </button>
            <button @click="copyStats" class="btn btn-primary">
                Copy Stats
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue';
import axios from 'axios';

const props = defineProps({
    tool: Object,
});

const text = ref('');
const stats = reactive({
    words: 0,
    characters: 0,
    charactersNoSpaces: 0,
    sentences: 0,
    paragraphs: 0,
    readingTime: '0 min',
    speakingTime: '0 min',
});

const countWords = () => {
    const content = text.value;

    // Words
    stats.words = content.trim() ? content.trim().split(/\s+/).length : 0;

    // Characters
    stats.characters = content.length;
    stats.charactersNoSpaces = content.replace(/\s/g, '').length;

    // Sentences
    stats.sentences = content.trim() ? content.split(/[.!?]+/).filter(s => s.trim()).length : 0;

    // Paragraphs
    stats.paragraphs = content.trim() ? content.split(/\n\n+/).filter(p => p.trim()).length : 0;

    // Reading time (average 200 words per minute)
    const readingMinutes = Math.ceil(stats.words / 200);
    stats.readingTime = readingMinutes === 0 ? '< 1 min' : `${readingMinutes} min`;

    // Speaking time (average 130 words per minute)
    const speakingMinutes = Math.ceil(stats.words / 130);
    stats.speakingTime = speakingMinutes === 0 ? '< 1 min' : `${speakingMinutes} min`;

    // Log usage if text is not empty
    if (content.trim() && stats.words > 0) {
        logUsage();
    }
};

const clearText = () => {
    text.value = '';
    countWords();
};

const copyStats = () => {
    const statsText = `Words: ${stats.words}\nCharacters: ${stats.characters}\nCharacters (no spaces): ${stats.charactersNoSpaces}\nSentences: ${stats.sentences}\nParagraphs: ${stats.paragraphs}\nReading Time: ${stats.readingTime}\nSpeaking Time: ${stats.speakingTime}`;
    navigator.clipboard.writeText(statsText);
    alert('Stats copied to clipboard!');
};

let usageTimeout = null;
const logUsage = () => {
    clearTimeout(usageTimeout);
    usageTimeout = setTimeout(() => {
        axios.post(route('tools.log-usage', props.tool.slug), {
            input: { wordCount: stats.words }
        }).catch(() => {});
    }, 2000);
};
</script>
