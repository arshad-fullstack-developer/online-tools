<template>
    <AppLayout>
        <Head>
            <title>{{ seo.title }}</title>
            <meta name="description" :content="seo.description" />
            <meta name="keywords" :content="seo.keywords" />
        </Head>

        <!-- Hero Section -->
        <div class="bg-gradient-to-br from-primary-600 to-primary-800 text-white py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-5xl font-bold mb-4">All Tools</h1>
                <p class="text-xl text-primary-100 max-w-3xl mx-auto">
                    Browse our complete collection of free online tools
                </p>
            </div>
        </div>

        <!-- Tools by Category -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div v-for="category in categories" :key="category.id" class="mb-16">
                <!-- Category Header -->
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center space-x-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-primary-400 to-primary-600 rounded-2xl flex items-center justify-center">
                            <span class="text-2xl">{{ getCategoryIcon(category.icon) }}</span>
                        </div>
                        <div>
                            <h2 class="text-3xl font-bold text-gray-900">{{ category.name }}</h2>
                            <p class="text-gray-600">{{ category.description }}</p>
                        </div>
                    </div>
                    <Link 
                        :href="route('categories.show', category.slug)"
                        class="hidden md:inline-flex items-center px-4 py-2 text-primary-600 hover:text-primary-700 font-medium"
                    >
                        View All
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </Link>
                </div>

                <!-- Tools Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <Link
                        v-for="tool in category.tools"
                        :key="tool.id"
                        :href="route('tools.show', tool.slug)"
                        class="group bg-white rounded-xl p-6 shadow-md hover:shadow-2xl transition-all duration-300 cursor-pointer border-2 border-transparent hover:border-primary-400 transform hover:-translate-y-1"
                    >
                        <div class="flex items-start space-x-4 mb-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-primary-400 to-primary-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <span class="text-2xl">{{ getToolIcon(tool.icon) }}</span>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-lg text-gray-900 group-hover:text-primary-600 transition-colors mb-2">
                                    {{ tool.name }}
                                </h3>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-4 line-clamp-2">
                            {{ tool.description }}
                        </p>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-primary-600 font-semibold group-hover:underline">
                                Use Tool →
                            </span>
                        </div>
                    </Link>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { getCategoryIcon, getToolIcon } from '@/config/icons';

defineProps({
    categories: Array,
    seo: Object,
});

const formatNumber = (num) => {
    if (num >= 1000000) return (num / 1000000).toFixed(1) + 'M';
    if (num >= 1000) return (num / 1000).toFixed(1) + 'K';
    return num;
};
</script>
