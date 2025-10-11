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
                <h1 class="text-5xl font-bold mb-4">Blog & Resources</h1>
                <p class="text-xl text-primary-100 max-w-3xl mx-auto">
                    Tips, tutorials, and insights about using online tools effectively
                </p>
            </div>
        </div>

        <!-- Coming Soon Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center max-w-3xl mx-auto">
                <div class="w-32 h-32 bg-gradient-to-br from-primary-100 to-primary-200 rounded-full flex items-center justify-center mx-auto mb-8">
                    <span class="text-6xl">📝</span>
                </div>
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Coming Soon!</h2>
                <p class="text-xl text-gray-600 mb-8">
                    We're working hard to bring you valuable content, tutorials, and tips. 
                    Our blog will feature articles about productivity, tool guides, and much more.
                </p>
                <div class="bg-primary-50 rounded-2xl p-8 mb-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">What to Expect</h3>
                    <div class="grid md:grid-cols-2 gap-6 text-left">
                        <div class="flex items-start space-x-3">
                            <svg class="w-6 h-6 text-primary-600 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1">Tool Tutorials</h4>
                                <p class="text-gray-600 text-sm">Step-by-step guides on how to use our tools effectively</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <svg class="w-6 h-6 text-primary-600 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1">Productivity Tips</h4>
                                <p class="text-gray-600 text-sm">Learn how to boost your productivity with online tools</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <svg class="w-6 h-6 text-primary-600 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1">Use Cases</h4>
                                <p class="text-gray-600 text-sm">Real-world examples and practical applications</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <svg class="w-6 h-6 text-primary-600 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1">Updates & News</h4>
                                <p class="text-gray-600 text-sm">Stay informed about new tools and features</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <Link :href="route('home')" class="inline-flex items-center px-8 py-4 bg-primary-600 text-white rounded-xl font-semibold text-lg hover:bg-primary-700 transform hover:scale-105 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Go to Homepage
                    </Link>
                    <Link href="/tools" class="inline-flex items-center px-8 py-4 border-2 border-primary-600 text-primary-600 rounded-xl font-semibold text-lg hover:bg-primary-600 hover:text-white transform hover:scale-105 transition-all duration-200">
                        Browse Tools
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </Link>
                </div>
            </div>
        </div>

        <!-- Newsletter Section -->
        <div class="bg-gray-900 text-white py-16">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-bold mb-4">Get Notified When We Launch</h2>
                <p class="text-gray-400 mb-8">
                    Be the first to know when we publish new articles and tutorials
                </p>
                <div class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                    <input 
                        type="email" 
                        placeholder="Enter your email" 
                        class="flex-1 px-6 py-4 rounded-xl text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary-500"
                    />
                    <button class="px-8 py-4 bg-primary-600 text-white rounded-xl font-semibold hover:bg-primary-700 transition-colors">
                        Notify Me
                    </button>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    seo: Object,
});
</script>
