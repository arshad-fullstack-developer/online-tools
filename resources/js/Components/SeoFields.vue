<template>
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
        <div class="flex items-center space-x-3 mb-6">
            <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <div>
                <h2 class="text-xl font-semibold text-gray-900">SEO Settings</h2>
                <p class="text-sm text-gray-600">Optimize for search engines</p>
            </div>
        </div>
        
        <div class="space-y-6">
            <!-- Meta Title -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Meta Title
                    <span class="text-xs font-normal text-gray-500 ml-2">(Recommended: 50-60 characters)</span>
                </label>
                <div class="relative">
                    <input 
                        :value="modelValue.meta_title"
                        @input="updateField('meta_title', $event.target.value)"
                        type="text"
                        :class="[
                            'w-full px-4 py-3 rounded-xl transition-all',
                            getTitleBorderClass(),
                            'focus:ring-2 focus:outline-none'
                        ]"
                        :placeholder="defaultTitle"
                    />
                    <div class="absolute right-3 top-3 flex items-center space-x-2">
                        <span :class="getTitleCountClass()" class="text-xs font-semibold px-2 py-1 rounded-full">
                            {{ titleLength }}/60
                        </span>
                        <div v-if="titleLength > 0" :class="getTitleIconClass()">
                            <svg v-if="titleLength <= 60" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <svg v-else class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="mt-2 h-2 bg-gray-200 rounded-full overflow-hidden">
                    <div 
                        :class="getTitleProgressClass()"
                        :style="{ width: Math.min((titleLength / 60) * 100, 100) + '%' }"
                        class="h-full transition-all duration-300"
                    ></div>
                </div>
                <p class="mt-1 text-xs text-gray-500">
                    <span v-if="titleLength === 0">Enter a meta title for better SEO</span>
                    <span v-else-if="titleLength < 50" class="text-yellow-600">⚠️ Too short - Add more characters</span>
                    <span v-else-if="titleLength <= 60" class="text-green-600">✓ Perfect length!</span>
                    <span v-else class="text-red-600">✗ Too long - Reduce characters</span>
                </p>
            </div>

            <!-- Meta Description -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Meta Description
                    <span class="text-xs font-normal text-gray-500 ml-2">(Recommended: 150-160 characters)</span>
                </label>
                <div class="relative">
                    <textarea 
                        :value="modelValue.meta_description"
                        @input="updateField('meta_description', $event.target.value)"
                        rows="3"
                        :class="[
                            'w-full px-4 py-3 rounded-xl transition-all',
                            getDescBorderClass(),
                            'focus:ring-2 focus:outline-none'
                        ]"
                        :placeholder="defaultDescription"
                    ></textarea>
                    <div class="absolute right-3 top-3 flex items-center space-x-2">
                        <span :class="getDescCountClass()" class="text-xs font-semibold px-2 py-1 rounded-full">
                            {{ descLength }}/160
                        </span>
                        <div v-if="descLength > 0" :class="getDescIconClass()">
                            <svg v-if="descLength <= 160" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <svg v-else class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="mt-2 h-2 bg-gray-200 rounded-full overflow-hidden">
                    <div 
                        :class="getDescProgressClass()"
                        :style="{ width: Math.min((descLength / 160) * 100, 100) + '%' }"
                        class="h-full transition-all duration-300"
                    ></div>
                </div>
                <p class="mt-1 text-xs text-gray-500">
                    <span v-if="descLength === 0">Enter a meta description for better SEO</span>
                    <span v-else-if="descLength < 150" class="text-yellow-600">⚠️ Too short - Add more characters</span>
                    <span v-else-if="descLength <= 160" class="text-green-600">✓ Perfect length!</span>
                    <span v-else class="text-red-600">✗ Too long - Reduce characters</span>
                </p>
            </div>

            <!-- Meta Keywords -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Meta Keywords
                    <span class="text-xs font-normal text-gray-500 ml-2">(Comma separated)</span>
                </label>
                <input 
                    :value="modelValue.meta_keywords"
                    @input="updateField('meta_keywords', $event.target.value)"
                    type="text"
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all"
                    placeholder="keyword1, keyword2, keyword3"
                />
                <div v-if="keywordCount > 0" class="mt-2 flex items-center space-x-2">
                    <span class="text-xs font-semibold px-2 py-1 bg-purple-100 text-purple-700 rounded-full">
                        {{ keywordCount }} keywords
                    </span>
                    <span v-if="keywordCount > 10" class="text-xs text-yellow-600">⚠️ Too many keywords (recommended: 5-10)</span>
                    <span v-else-if="keywordCount >= 5" class="text-xs text-green-600">✓ Good amount</span>
                </div>
            </div>

            <!-- SEO Preview -->
            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-sm font-semibold text-gray-700 mb-3">Google Search Preview</h3>
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                    <div class="text-xs text-green-700 mb-1">{{ siteUrl }}</div>
                    <div class="text-lg text-blue-600 hover:underline cursor-pointer mb-1 line-clamp-1">
                        {{ previewTitle }}
                    </div>
                    <div class="text-sm text-gray-600 line-clamp-2">
                        {{ previewDescription }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    modelValue: {
        type: Object,
        required: true
    },
    defaultTitle: {
        type: String,
        default: 'Page Title'
    },
    defaultDescription: {
        type: String,
        default: 'Page description'
    }
});

const emit = defineEmits(['update:modelValue']);

const siteUrl = window.location.origin;

const titleLength = computed(() => (props.modelValue.meta_title || '').length);
const descLength = computed(() => (props.modelValue.meta_description || '').length);
const keywordCount = computed(() => {
    if (!props.modelValue.meta_keywords) return 0;
    return props.modelValue.meta_keywords.split(',').filter(k => k.trim()).length;
});

const previewTitle = computed(() => props.modelValue.meta_title || props.defaultTitle);
const previewDescription = computed(() => props.modelValue.meta_description || props.defaultDescription);

const updateField = (field, value) => {
    emit('update:modelValue', {
        ...props.modelValue,
        [field]: value
    });
};

// Title styling
const getTitleBorderClass = () => {
    if (titleLength.value === 0) return 'border-2 border-gray-200';
    if (titleLength.value < 50) return 'border-2 border-yellow-300';
    if (titleLength.value <= 60) return 'border-2 border-green-400';
    return 'border-2 border-red-400';
};

const getTitleCountClass = () => {
    if (titleLength.value === 0) return 'bg-gray-100 text-gray-600';
    if (titleLength.value < 50) return 'bg-yellow-100 text-yellow-700';
    if (titleLength.value <= 60) return 'bg-green-100 text-green-700';
    return 'bg-red-100 text-red-700';
};

const getTitleIconClass = () => {
    if (titleLength.value <= 60) return 'text-green-600';
    return 'text-red-600';
};

const getTitleProgressClass = () => {
    if (titleLength.value < 50) return 'bg-yellow-400';
    if (titleLength.value <= 60) return 'bg-green-500';
    return 'bg-red-500';
};

// Description styling
const getDescBorderClass = () => {
    if (descLength.value === 0) return 'border-2 border-gray-200';
    if (descLength.value < 150) return 'border-2 border-yellow-300';
    if (descLength.value <= 160) return 'border-2 border-green-400';
    return 'border-2 border-red-400';
};

const getDescCountClass = () => {
    if (descLength.value === 0) return 'bg-gray-100 text-gray-600';
    if (descLength.value < 150) return 'bg-yellow-100 text-yellow-700';
    if (descLength.value <= 160) return 'bg-green-100 text-green-700';
    return 'bg-red-100 text-red-700';
};

const getDescIconClass = () => {
    if (descLength.value <= 160) return 'text-green-600';
    return 'text-red-600';
};

const getDescProgressClass = () => {
    if (descLength.value < 150) return 'bg-yellow-400';
    if (descLength.value <= 160) return 'bg-green-500';
    return 'bg-red-500';
};
</script>
