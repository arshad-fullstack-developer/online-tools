<template>
    <AppLayout>
        <Head :title="blog.meta_title || blog.title" />
        <meta name="description" :content="blog.meta_description || blog.excerpt" />

        <!-- Hero Section with Featured Image -->
        <div class="relative h-[500px] bg-gradient-to-br from-primary-600 via-primary-700 to-purple-800 overflow-hidden">
            <div v-if="blog.featured_image" class="absolute inset-0">
                <img :src="`/storage/${blog.featured_image}`" :alt="blog.title" class="w-full h-full object-cover opacity-30" />
                <div class="absolute inset-0 bg-gradient-to-t from-primary-900 via-primary-900/50 to-transparent"></div>
            </div>
            
            <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex flex-col justify-end pb-16">
                <!-- Back Button -->
                <Link :href="route('blog.index')" class="inline-flex items-center text-white hover:text-primary-300 mb-8 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Blog
                </Link>

                <!-- Meta Info -->
                <div class="flex flex-wrap items-center gap-4 text-sm text-white/80 mb-6">
                    <span class="flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        {{ blog.author }}
                    </span>
                    <span class="flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        {{ formatDate(blog.published_at || blog.created_at) }}
                    </span>
                    <span class="flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        {{ blog.views }} views
                    </span>
                    <span class="flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ readingTime }} min read
                    </span>
                </div>

                <!-- Title -->
                <h1 class="text-5xl md:text-6xl font-bold text-white mb-4 leading-tight">{{ blog.title }}</h1>

                <!-- Excerpt -->
                <p v-if="blog.excerpt" class="text-xl text-white/90 max-w-3xl">
                    {{ blog.excerpt }}
                </p>
            </div>
        </div>

        <!-- Article Content -->
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <article class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8 md:p-12">
                        <div class="prose prose-lg max-w-none" v-html="blog.content"></div>

                        <!-- Share Section -->
                        <div class="mt-12 pt-8 border-t border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Share this article</h3>
                            <div class="flex space-x-3">
                                <a :href="`https://twitter.com/intent/tweet?text=${encodeURIComponent(blog.title)}&url=${currentUrl}`" target="_blank" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                                    Twitter
                                </a>
                                <a :href="`https://www.facebook.com/sharer/sharer.php?u=${currentUrl}`" target="_blank" class="px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800 transition-colors">
                                    Facebook
                                </a>
                                <a :href="`https://www.linkedin.com/sharing/share-offsite/?url=${currentUrl}`" target="_blank" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                    LinkedIn
                                </a>
                            </div>
                        </div>
                    </article>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Author Card -->
                    <div class="bg-gradient-to-br from-primary-500 to-primary-700 rounded-2xl shadow-xl p-6 text-white">
                        <div class="flex items-center space-x-4 mb-4">
                            <img :src="`https://ui-avatars.com/api/?name=${encodeURIComponent(blog.author)}&background=ffffff&color=0ea5e9&size=64`" class="w-16 h-16 rounded-full border-4 border-white/30" />
                            <div>
                                <h3 class="font-bold text-lg">{{ blog.author }}</h3>
                                <p class="text-primary-100 text-sm">Author</p>
                            </div>
                        </div>
                        <p class="text-primary-50 text-sm">
                            Passionate about creating helpful tools and sharing knowledge with the community.
                        </p>
                    </div>

                    <!-- Quick Stats -->
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6">
                        <h3 class="font-bold text-gray-900 mb-4">Article Stats</h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600 text-sm">Published</span>
                                <span class="font-semibold text-gray-900">{{ formatDate(blog.published_at || blog.created_at) }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600 text-sm">Views</span>
                                <span class="font-semibold text-gray-900">{{ blog.views }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600 text-sm">Reading Time</span>
                                <span class="font-semibold text-gray-900">{{ readingTime }} min</span>
                            </div>
                        </div>
                    </div>

                    <!-- Related Posts -->
                    <div v-if="relatedPosts.length > 0" class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6">
                        <h3 class="font-bold text-gray-900 mb-4">Related Articles</h3>
                        <div class="space-y-4">
                            <Link 
                                v-for="post in relatedPosts" 
                                :key="post.id"
                                :href="route('blog.show', post.slug)"
                                class="group block"
                            >
                                <div class="flex space-x-3">
                                    <div class="w-20 h-20 rounded-lg overflow-hidden flex-shrink-0 bg-gradient-to-br from-gray-200 to-gray-300">
                                        <img 
                                            v-if="post.featured_image" 
                                            :src="`/storage/${post.featured_image}`" 
                                            :alt="post.title"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                                        />
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="font-semibold text-gray-900 group-hover:text-primary-600 transition-colors line-clamp-2 text-sm mb-1">
                                            {{ post.title }}
                                        </h4>
                                        <p class="text-xs text-gray-500">{{ formatDate(post.published_at || post.created_at) }}</p>
                                    </div>
                                </div>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    blog: Object,
    relatedPosts: Array,
});

const currentUrl = window.location.href;

const readingTime = computed(() => {
    const words = props.blog.content.replace(/<[^>]*>/g, '').split(/\s+/).length;
    return Math.ceil(words / 200);
});

const formatDate = (dateString) => {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
};
</script>

<style>
.prose {
    color: #374151;
}
.prose h2 {
    font-size: 1.875rem;
    font-weight: 700;
    margin-top: 2rem;
    margin-bottom: 1rem;
}
.prose h3 {
    font-size: 1.5rem;
    font-weight: 600;
    margin-top: 1.5rem;
    margin-bottom: 0.75rem;
}
.prose p {
    margin-bottom: 1.25rem;
    line-height: 1.75;
}
.prose ul, .prose ol {
    margin-bottom: 1.25rem;
    padding-left: 1.5rem;
}
.prose li {
    margin-bottom: 0.5rem;
}
.prose a {
    color: #0ea5e9;
    text-decoration: underline;
}
.prose a:hover {
    color: #0284c7;
}
.prose img {
    border-radius: 0.5rem;
    margin: 2rem 0;
}
.prose code {
    background-color: #f3f4f6;
    padding: 0.125rem 0.375rem;
    border-radius: 0.25rem;
    font-size: 0.875em;
}
.prose pre {
    background-color: #1f2937;
    color: #f9fafb;
    padding: 1rem;
    border-radius: 0.5rem;
    overflow-x: auto;
    margin: 1.5rem 0;
}
</style>
