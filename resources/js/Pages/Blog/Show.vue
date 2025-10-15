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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Main Content - 3 columns -->
                <div class="lg:col-span-3">
                    <article class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8 md:p-12 lg:p-16">
                        <!-- Article Meta -->
                        <div class="flex flex-wrap items-center gap-3 mb-8 pb-6 border-b border-gray-200">
                            <span class="inline-flex items-center px-4 py-2 bg-primary-50 text-primary-700 rounded-lg text-sm font-medium">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                {{ blog.author }}
                            </span>
                            <span class="inline-flex items-center px-4 py-2 bg-gray-50 text-gray-700 rounded-lg text-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ formatDate(blog.published_at || blog.created_at) }}
                            </span>
                            <span class="inline-flex items-center px-4 py-2 bg-gray-50 text-gray-700 rounded-lg text-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ readingTime }} min read
                            </span>
                            <span class="inline-flex items-center px-4 py-2 bg-gray-50 text-gray-700 rounded-lg text-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                {{ blog.views }} views
                            </span>
                        </div>

                        <!-- Content -->
                        <div class="prose prose-lg prose-headings:font-bold prose-headings:text-gray-900 prose-h2:text-3xl prose-h2:mt-12 prose-h2:mb-6 prose-h2:pb-3 prose-h2:border-b prose-h2:border-gray-200 prose-h3:text-2xl prose-h3:mt-10 prose-h3:mb-4 prose-p:text-gray-700 prose-p:leading-relaxed prose-p:mb-6 prose-a:text-primary-600 prose-a:no-underline hover:prose-a:underline prose-strong:text-gray-900 prose-strong:font-semibold prose-ul:my-6 prose-li:my-2 prose-img:rounded-xl prose-img:shadow-lg max-w-none" v-html="blog.content"></div>

                        <!-- Share Section -->
                        <div class="mt-16 pt-8 border-t-2 border-gray-200">
                            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-2">Found this helpful?</h3>
                                    <p class="text-gray-600">Share it with your network</p>
                                </div>
                                <div class="flex flex-wrap gap-3">
                                    <a :href="`https://twitter.com/intent/tweet?text=${encodeURIComponent(blog.title)}&url=${currentUrl}`" target="_blank" class="inline-flex items-center px-6 py-3 bg-[#1DA1F2] text-white rounded-xl font-medium hover:bg-[#1a8cd8] transition-all transform hover:scale-105 shadow-lg">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                                        </svg>
                                        Twitter
                                    </a>
                                    <a :href="`https://www.facebook.com/sharer/sharer.php?u=${currentUrl}`" target="_blank" class="inline-flex items-center px-6 py-3 bg-[#1877F2] text-white rounded-xl font-medium hover:bg-[#166fe5] transition-all transform hover:scale-105 shadow-lg">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"></path>
                                        </svg>
                                        Facebook
                                    </a>
                                    <a :href="`https://www.linkedin.com/sharing/share-offsite/?url=${currentUrl}`" target="_blank" class="inline-flex items-center px-6 py-3 bg-[#0A66C2] text-white rounded-xl font-medium hover:bg-[#095196] transition-all transform hover:scale-105 shadow-lg">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"></path>
                                        </svg>
                                        LinkedIn
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>

                <!-- Sidebar - 1 column -->
                <div class="lg:col-span-1">
                    <div class="sticky top-24 space-y-6">
                        <!-- Author Card -->
                        <div class="bg-gradient-to-br from-primary-500 to-primary-700 rounded-2xl shadow-xl overflow-hidden">
                            <div class="p-6 text-white text-center">
                                <div class="w-24 h-24 rounded-full border-4 border-white/30 mx-auto mb-4 overflow-hidden bg-white">
                                    <img :src="`https://ui-avatars.com/api/?name=${encodeURIComponent(blog.author)}&background=0ea5e9&color=fff&size=96`" class="w-full h-full object-cover" />
                                </div>
                                <h3 class="font-bold text-xl mb-1">{{ blog.author }}</h3>
                                <p class="text-primary-100 text-sm mb-4">Author</p>
                                <p class="text-primary-50 text-sm leading-relaxed">
                                    Passionate about creating helpful tools and sharing knowledge with the community.
                                </p>
                            </div>
                            
                            <!-- Stats -->
                            <div class="bg-white/10 backdrop-blur-sm p-5 space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-primary-100 text-sm flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        Published
                                    </span>
                                    <span class="font-semibold text-white text-sm">{{ formatDate(blog.published_at || blog.created_at).split(',')[0] }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-primary-100 text-sm flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        Views
                                    </span>
                                    <span class="font-semibold text-white text-sm">{{ blog.views }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-primary-100 text-sm flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Read Time
                                    </span>
                                    <span class="font-semibold text-white text-sm">{{ readingTime }} min</span>
                                </div>
                            </div>
                        </div>

                        <!-- Related Posts -->
                        <div v-if="relatedPosts.length > 0" class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                            <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                                <h3 class="font-bold text-gray-900 text-lg flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                    </svg>
                                    Related Articles
                                </h3>
                            </div>
                            <div class="p-4 space-y-1">
                                <Link 
                                    v-for="post in relatedPosts" 
                                    :key="post.id"
                                    :href="route('blog.show', post.slug)"
                                    class="group block p-3 rounded-xl hover:bg-primary-50 transition-all duration-200"
                                >
                                    <div class="flex space-x-3">
                                        <div class="w-20 h-20 rounded-xl overflow-hidden flex-shrink-0 bg-gradient-to-br from-primary-100 to-primary-200 shadow-md">
                                            <img 
                                                v-if="post.featured_image" 
                                                :src="`/storage/${post.featured_image}`" 
                                                :alt="post.title"
                                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                                            />
                                            <div v-else class="w-full h-full flex items-center justify-center">
                                                <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="font-semibold text-gray-900 group-hover:text-primary-600 transition-colors line-clamp-2 text-sm mb-2 leading-snug">
                                                {{ post.title }}
                                            </h4>
                                            <div class="flex items-center text-xs text-gray-500">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                {{ formatDate(post.published_at || post.created_at).split(',')[0] }}
                                            </div>
                                        </div>
                                    </div>
                                </Link>
                            </div>
                        </div>

                        <!-- CTA Card -->
                        <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-2xl shadow-xl p-6 text-white">
                            <div class="text-center">
                                <div class="w-16 h-16 bg-primary-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold mb-2">Try Our Tools</h3>
                                <p class="text-gray-300 text-sm mb-4">
                                    Explore our collection of free online tools
                                </p>
                                <Link href="/tools" class="inline-block w-full px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-xl text-center transition-all transform hover:scale-105">
                                    Browse Tools →
                                </Link>
                            </div>
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
