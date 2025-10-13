<template>
    <AppLayout>
        <Head>
            <title>{{ seo.title }}</title>
            <meta name="description" :content="seo.description" />
            <meta name="keywords" :content="seo.keywords" />
        </Head>

        <!-- Hero Section -->
        <div class="relative bg-gradient-to-br from-primary-600 via-primary-700 to-purple-800 text-white overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; viewBox=&quot;0 0 60 60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;none&quot; fill-rule=&quot;evenodd&quot;%3E%3Cg fill=&quot;%23ffffff&quot; fill-opacity=&quot;1&quot;%3E%3Cpath d=&quot;M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z&quot;/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
            </div>
            
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32">
                <div class="text-center">
                    <!-- Badge -->
                    <div class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full mb-6">
                        <span class="text-sm font-medium">{{ homeContent.hero_badge }}</span>
                    </div>
                    
                    <!-- Main Heading -->
                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold mb-6 leading-tight">
                        <span class="block">{{ homeContent.hero_title }}</span>
                        <span class="block bg-gradient-to-r from-yellow-300 to-pink-300 bg-clip-text text-transparent">
                            {{ homeContent.hero_subtitle }}
                        </span>
                    </h1>
                    
                    <!-- Subheading -->
                    <p class="text-xl md:text-2xl text-primary-100 mb-10 max-w-3xl mx-auto leading-relaxed">
                        {{ homeContent.hero_description }}
                    </p>
                    
                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                        <a href="#tools" class="inline-flex items-center px-8 py-4 bg-white text-primary-700 rounded-xl font-semibold text-lg hover:bg-primary-50 transform hover:scale-105 transition-all duration-200 shadow-xl">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            Explore Tools
                        </a>
                        <a href="#categories" class="inline-flex items-center px-8 py-4 bg-white/10 backdrop-blur-sm text-white rounded-xl font-semibold text-lg hover:bg-white/20 transform hover:scale-105 transition-all duration-200 border-2 border-white/20">
                            Browse Categories
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                    
                    <!-- Stats -->
                    <div class="mt-16 grid grid-cols-3 gap-8 max-w-2xl mx-auto">
                        <div class="text-center">
                            <div class="text-4xl font-bold mb-2">{{ totalTools }}+</div>
                            <div class="text-primary-200 text-sm">Tools Available</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold mb-2">100%</div>
                            <div class="text-primary-200 text-sm">Free Forever</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold mb-2">100%</div>
                            <div class="text-primary-200 text-sm">Privacy Protected</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Wave Divider -->
            <div class="absolute bottom-0 left-0 right-0">
                <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                    <path d="M0 120L60 110C120 100 240 80 360 70C480 60 600 60 720 65C840 70 960 80 1080 85C1200 90 1320 90 1380 90L1440 90V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="#F9FAFB"/>
                </svg>
            </div>
        </div>

        <!-- Categories Section -->
        <div id="categories" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">{{ homeContent.categories_title }}</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    {{ homeContent.categories_description }}
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <Link
                    v-for="category in categories"
                    :key="category.id"
                    :href="route('categories.show', category.slug)"
                    class="group relative bg-white rounded-2xl p-6 shadow-md hover:shadow-2xl transition-all duration-300 cursor-pointer border-2 border-transparent hover:border-primary-500 transform hover:-translate-y-1"
                >
                    <div class="flex flex-col items-center text-center space-y-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-primary-400 to-primary-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <span class="text-3xl">{{ getCategoryIcon(category.icon) }}</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg text-gray-900 group-hover:text-primary-600 transition-colors mb-1">
                                {{ category.name }}
                            </h3>
                            <p class="text-sm text-gray-500 font-medium">
                                {{ category.active_tools_count }} tools available
                            </p>
                        </div>
                    </div>
                    <!-- Hover Arrow -->
                    <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity">
                        <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </Link>
            </div>
        </div>

        <!-- Featured Tools Section -->
        <div id="tools" v-if="featuredTools.length > 0" class="bg-gradient-to-b from-white to-gray-50 py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <div class="inline-flex items-center px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full mb-4">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <span class="text-sm font-semibold">Featured Tools</span>
                    </div>
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">{{ homeContent.featured_title }}</h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                        {{ homeContent.featured_description }}
                    </p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <Link
                        v-for="tool in featuredTools"
                        :key="tool.id"
                        :href="route('tools.show', tool.slug)"
                        class="group bg-white rounded-2xl p-6 shadow-md hover:shadow-2xl transition-all duration-300 cursor-pointer border-2 border-transparent hover:border-primary-400 transform hover:-translate-y-1"
                    >
                        <div class="flex items-start space-x-4 mb-4">
                            <div class="flex-shrink-0 w-14 h-14 bg-gradient-to-br from-primary-400 to-primary-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-lg">
                                <span class="text-2xl">{{ getToolIcon(tool.icon) }}</span>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-xl text-gray-900 group-hover:text-primary-600 transition-colors mb-2">
                                    {{ tool.name }}
                                </h3>
                                <span class="inline-block bg-primary-100 text-primary-700 text-xs font-semibold px-3 py-1 rounded-full">
                                    {{ tool.category.name }}
                                </span>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-4 line-clamp-2">
                            {{ tool.description }}
                        </p>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-primary-600 font-semibold group-hover:underline">
                                Try it now →
                            </span>
                            <div class="flex items-center text-gray-500">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                <span class="text-xs">Instant</span>
                            </div>
                        </div>
                    </Link>
                </div>
            </div>
        </div>

        <!-- Popular Tools Section -->
        <div v-if="popularTools.length > 0" class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">{{ homeContent.trending_title }}</h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                        {{ homeContent.trending_description }}
                    </p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <Link
                        v-for="tool in popularTools"
                        :key="tool.id"
                        :href="route('tools.show', tool.slug)"
                        class="group bg-gray-50 rounded-xl p-6 hover:bg-white hover:shadow-xl transition-all duration-300 cursor-pointer border border-gray-200 hover:border-primary-300"
                    >
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-white rounded-lg flex items-center justify-center shadow-sm group-hover:shadow-md transition-shadow">
                                <span class="text-2xl">{{ getToolIcon(tool.icon) }}</span>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-lg text-gray-900 group-hover:text-primary-600 transition-colors mb-2">
                                    {{ tool.name }}
                                </h3>
                                <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                                    {{ tool.description }}
                                </p>
                                <div class="flex items-center justify-between text-xs">
                                    <span class="bg-white px-3 py-1 rounded-full text-gray-700 font-medium shadow-sm">
                                        {{ tool.category.name }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </Link>
                </div>
            </div>
        </div>

        <!-- Dynamic Content Section (Before Footer) -->
        <div v-if="homeContent.bottom_content" class="bg-gradient-to-b from-gray-50 to-white py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12 border border-gray-100">
                    <!-- Content -->
                    <div class="prose prose-lg max-w-none" v-html="homeContent.bottom_content"></div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { Head, Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { getCategoryIcon, getToolIcon } from '@/config/icons';

const props = defineProps({
    categories: Array,
    featuredTools: Array,
    popularTools: Array,
    page: Object,
    homeContent: Object,
    totalTools: Number,
});

const page = usePage();

// Use page SEO or fallback to defaults
const seo = computed(() => ({
    title: props.page?.meta_title || page.props.settings?.site_name || 'Online Tools',
    description: props.page?.meta_description || page.props.settings?.site_description || 'Your All-in-One Tool Collection',
    keywords: props.page?.meta_keywords || '',
}));

const formatNumber = (num) => {
    if (num >= 1000000) return (num / 1000000).toFixed(1) + 'M';
    if (num >= 1000) return (num / 1000).toFixed(1) + 'K';
    return num;
};
</script>
