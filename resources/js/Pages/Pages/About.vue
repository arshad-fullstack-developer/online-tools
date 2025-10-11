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
                <h1 class="text-5xl font-bold mb-4">About Online Tools</h1>
                <p class="text-xl text-primary-100 max-w-3xl mx-auto">
                    Your trusted platform for free, easy-to-use online tools
                </p>
            </div>
        </div>

        <!-- Mission Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">Our Mission</h2>
                    <p class="text-lg text-gray-600 mb-4">
                        We believe that everyone should have access to powerful, easy-to-use tools without barriers. 
                        That's why we created Online Tools - a completely free platform that requires no registration, 
                        no downloads, and no hassle.
                    </p>
                    <p class="text-lg text-gray-600 mb-4">
                        Whether you're a student, professional, or just someone looking to get things done quickly, 
                        our tools are designed to save you time and make your life easier.
                    </p>
                    <p class="text-lg text-gray-600">
                        We're constantly adding new tools and improving existing ones based on user feedback. 
                        Your input helps us build better tools for everyone.
                    </p>
                </div>
                <div class="bg-gradient-to-br from-primary-50 to-primary-100 rounded-2xl p-8">
                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-primary-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 mb-2">100% Free Forever</h3>
                                <p class="text-gray-600">All our tools are completely free with no hidden costs or premium features.</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-primary-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 mb-2">Privacy First</h3>
                                <p class="text-gray-600">We don't track, store, or share your data. What you do stays with you.</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-primary-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 mb-2">Lightning Fast</h3>
                                <p class="text-gray-600">All tools run instantly in your browser with no server delays.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="bg-gray-900 text-white py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                    <div>
                        <div class="text-5xl font-bold text-primary-400 mb-2">10+</div>
                        <div class="text-gray-400">Tools Available</div>
                    </div>
                    <div>
                        <div class="text-5xl font-bold text-primary-400 mb-2">100%</div>
                        <div class="text-gray-400">Free Forever</div>
                    </div>
                    <div>
                        <div class="text-5xl font-bold text-primary-400 mb-2">0</div>
                        <div class="text-gray-400">Registration Required</div>
                    </div>
                    <div>
                        <div class="text-5xl font-bold text-primary-400 mb-2">24/7</div>
                        <div class="text-gray-400">Always Available</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Values Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <h2 class="text-4xl font-bold text-gray-900 text-center mb-12">Our Core Values</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <span class="text-3xl">🎯</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Simplicity</h3>
                    <p class="text-gray-600">
                        We believe in keeping things simple. No complicated interfaces, just tools that work.
                    </p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-700 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <span class="text-3xl">🚀</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Innovation</h3>
                    <p class="text-gray-600">
                        We're always looking for new ways to solve problems and improve user experience.
                    </p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-700 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <span class="text-3xl">❤️</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Community</h3>
                    <p class="text-gray-600">
                        Built by users, for users. Your feedback shapes the future of our platform.
                    </p>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="bg-gradient-to-r from-primary-600 to-purple-600 text-white py-16">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-4xl font-bold mb-4">Ready to Get Started?</h2>
                <p class="text-xl text-primary-100 mb-8">
                    Explore our collection of free tools and see how we can help you today.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <Link href="/tools" class="inline-flex items-center px-8 py-4 bg-white text-primary-700 rounded-xl font-semibold text-lg hover:bg-primary-50 transform hover:scale-105 transition-all duration-200 shadow-xl">
                        Browse All Tools
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </Link>
                    <Link href="/contact" class="inline-flex items-center px-8 py-4 bg-white/10 backdrop-blur-sm text-white rounded-xl font-semibold text-lg hover:bg-white/20 transform hover:scale-105 transition-all duration-200 border-2 border-white/20">
                        Contact Us
                    </Link>
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
