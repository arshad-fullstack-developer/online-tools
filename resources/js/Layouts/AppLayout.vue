<template>
    <div class="min-h-screen bg-gray-50 flex flex-col">
        <!-- Navigation -->
        <nav class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-24">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <Link :href="route('home')" class="flex items-center group">
                            <div v-if="$page.props.settings?.logo" class="h-40 rounded-lg overflow-hidden">
                                <img :src="`/storage/${$page.props.settings.logo}`" :alt="$page.props.settings?.site_name || 'Logo'" class="h-full w-auto object-contain" />
                            </div>
                            <div v-else class="h-20 flex items-center">
                                <span class="text-3xl font-bold bg-gradient-to-r from-primary-600 to-primary-800 bg-clip-text text-transparent">
                                    {{ $page.props.settings?.site_name || 'Online Tools' }}
                                </span>
                            </div>
                        </Link>
                    </div>

                    <!-- Desktop Navigation -->
                    <div class="hidden md:flex items-center space-x-1">
                        <Link 
                            :href="route('home')"
                            class="px-4 py-2 rounded-lg font-medium transition-colors"
                            :class="$page.url === '/' ? 'text-primary-600 bg-primary-50' : 'text-gray-700 hover:text-primary-600 hover:bg-primary-50'"
                        >
                            Home
                        </Link>
                        <Link 
                            href="/about"
                            class="px-4 py-2 rounded-lg font-medium transition-colors"
                            :class="$page.url.startsWith('/about') ? 'text-primary-600 bg-primary-50' : 'text-gray-700 hover:text-primary-600 hover:bg-primary-50'"
                        >
                            About
                        </Link>
                        <Link 
                            href="/tools"
                            class="px-4 py-2 rounded-lg font-medium transition-colors"
                            :class="$page.url.startsWith('/tools') ? 'text-primary-600 bg-primary-50' : 'text-gray-700 hover:text-primary-600 hover:bg-primary-50'"
                        >
                            Tools
                        </Link>
                        <Link 
                            href="/blog"
                            class="px-4 py-2 rounded-lg font-medium transition-colors"
                            :class="$page.url.startsWith('/blog') ? 'text-primary-600 bg-primary-50' : 'text-gray-700 hover:text-primary-600 hover:bg-primary-50'"
                        >
                            Blog
                        </Link>
                        <Link 
                            href="/contact"
                            class="px-4 py-2 rounded-lg font-medium transition-colors"
                            :class="$page.url.startsWith('/contact') ? 'text-primary-600 bg-primary-50' : 'text-gray-700 hover:text-primary-600 hover:bg-primary-50'"
                        >
                            Contact
                        </Link>
                    </div>

                    <!-- Right Side -->
                    <div class="flex items-center space-x-3">
                        <Link 
                            v-if="$page.props.auth?.user" 
                            :href="route('admin.dashboard')"
                            class="hidden sm:inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 font-medium transition-colors"
                        >
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                            </svg>
                            Dashboard
                        </Link>

                        <!-- Mobile Menu Button -->
                        <button 
                            @click="mobileMenuOpen = !mobileMenuOpen"
                            class="md:hidden p-2 rounded-lg text-gray-700 hover:bg-gray-100"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path v-if="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Mobile Menu -->
                <div v-show="mobileMenuOpen" class="md:hidden py-4 border-t border-gray-200">
                    <div class="flex flex-col space-y-2">
                        <Link 
                            :href="route('home')"
                            class="px-4 py-2 rounded-lg font-medium"
                            :class="$page.url === '/' ? 'text-primary-600 bg-primary-50' : 'text-gray-700 hover:text-primary-600 hover:bg-primary-50'"
                            @click="mobileMenuOpen = false"
                        >
                            Home
                        </Link>
                        <Link 
                            href="/about"
                            class="px-4 py-2 rounded-lg font-medium"
                            :class="$page.url.startsWith('/about') ? 'text-primary-600 bg-primary-50' : 'text-gray-700 hover:text-primary-600 hover:bg-primary-50'"
                            @click="mobileMenuOpen = false"
                        >
                            About
                        </Link>
                        <Link 
                            href="/tools"
                            class="px-4 py-2 rounded-lg font-medium"
                            :class="$page.url.startsWith('/tools') ? 'text-primary-600 bg-primary-50' : 'text-gray-700 hover:text-primary-600 hover:bg-primary-50'"
                            @click="mobileMenuOpen = false"
                        >
                            Tools
                        </Link>
                        <Link 
                            href="/blog"
                            class="px-4 py-2 rounded-lg font-medium"
                            :class="$page.url.startsWith('/blog') ? 'text-primary-600 bg-primary-50' : 'text-gray-700 hover:text-primary-600 hover:bg-primary-50'"
                            @click="mobileMenuOpen = false"
                        >
                            Blog
                        </Link>
                        <Link 
                            href="/contact"
                            class="px-4 py-2 rounded-lg font-medium"
                            :class="$page.url.startsWith('/contact') ? 'text-primary-600 bg-primary-50' : 'text-gray-700 hover:text-primary-600 hover:bg-primary-50'"
                            @click="mobileMenuOpen = false"
                        >
                            Contact
                        </Link>
                        <Link 
                            v-if="$page.props.auth?.user" 
                            :href="route('admin.dashboard')"
                            class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 font-medium text-center"
                            @click="mobileMenuOpen = false"
                        >
                            Dashboard
                        </Link>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main>
            <slot />
        </main>

        <!-- Footer -->
        <footer class="bg-gradient-to-br from-primary-600 via-primary-700 to-purple-800 text-white mt-auto">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8 mb-8">
                    <!-- Brand Section -->
                    <div class="lg:col-span-2">
                        <div class="flex items-center mb-4">
                            <div v-if="$page.props.settings?.footer_logo" class="h-15 rounded-lg overflow-hidden">
                                <img :src="`/storage/${$page.props.settings.footer_logo}`" :alt="$page.props.settings?.site_name || 'Logo'" class="h-full w-auto object-contain" />
                            </div>
                            <div v-else-if="$page.props.settings?.logo" class="h-15 rounded-lg overflow-hidden">
                                <img :src="`/storage/${$page.props.settings.logo}`" :alt="$page.props.settings?.site_name || 'Logo'" class="h-full w-auto object-contain" />
                            </div>
                            <div v-else class="h-16 flex items-center">
                                <span class="text-3xl font-bold text-white">{{ $page.props.settings?.site_name || 'Online Tools' }}</span>
                            </div>
                        </div>
                        <p class="text-primary-100 mb-6 max-w-sm leading-relaxed">
                            Your go-to platform for free online tools. From calculators to converters, 
                            we've got everything you need - no registration required!
                        </p>
                        <!-- Social Links -->
                        <div class="flex space-x-3">
                            <a href="#" class="w-10 h-10 bg-white/10 backdrop-blur-sm rounded-lg flex items-center justify-center hover:bg-white/20 transition-all transform hover:scale-110">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-white/10 backdrop-blur-sm rounded-lg flex items-center justify-center hover:bg-white/20 transition-all transform hover:scale-110">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-white/10 backdrop-blur-sm rounded-lg flex items-center justify-center hover:bg-white/20 transition-all transform hover:scale-110">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Tools -->
                    <div>
                        <h3 class="font-bold text-white mb-4">Popular Tools</h3>
                        <ul class="space-y-3">
                            <li v-for="tool in $page.props.footerTools" :key="tool.id">
                                <Link :href="`/tools/${tool.slug}`" class="text-primary-100 hover:text-white transition-colors flex items-center group">
                                    <svg class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                    {{ tool.name }}
                                </Link>
                            </li>
                        </ul>
                    </div>

                    <!-- Categories -->
                    <div>
                        <h3 class="font-bold text-white mb-4">Categories</h3>
                        <ul class="space-y-3">
                            <li v-for="category in $page.props.categories" :key="category.id">
                                <Link :href="`/categories/${category.slug}`" class="text-primary-100 hover:text-white transition-colors flex items-center group">
                                    <svg class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                    {{ category.name }}
                                </Link>
                            </li>
                        </ul>
                    </div>

                    <!-- Legal -->
                    <div>
                        <h3 class="font-bold text-white mb-4">Legal</h3>
                        <ul class="space-y-3">
                            <li>
                                <Link href="/privacy-policy" class="text-primary-100 hover:text-white transition-colors flex items-center group">
                                    <svg class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                    Privacy Policy
                                </Link>
                            </li>
                            <li>
                                <Link href="/terms-of-service" class="text-primary-100 hover:text-white transition-colors flex items-center group">
                                    <svg class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                    Terms of Service
                                </Link>
                            </li>
                            <li>
                                <Link href="/cookie-policy" class="text-primary-100 hover:text-white transition-colors flex items-center group">
                                    <svg class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                    Cookie Policy
                                </Link>
                            </li>
                            <li>
                                <Link href="/disclaimer" class="text-primary-100 hover:text-white transition-colors flex items-center group">
                                    <svg class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                    Disclaimer
                                </Link>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Bottom Bar -->
                <div class="border-t border-white/20 pt-8">
                    <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                        <p class="text-primary-100 text-sm">
                            &copy; {{ new Date().getFullYear() }} {{ $page.props.settings?.site_name || 'Online Tools' }}. All rights reserved.
                        </p>
                        <div class="flex items-center space-x-6 text-sm">
                            <div class="flex items-center space-x-2 px-3 py-1 bg-white/10 backdrop-blur-sm rounded-full">
                                <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse shadow-lg shadow-green-400/50"></div>
                                <a href="https://innovatx.net" target="_blank" rel="noopener noreferrer" class="text-primary-100 hover:text-white transition-colors flex items-center space-x-2 group">
                                <span>A Product by</span>
                                <span class="font-bold text-white group-hover:underline">InnovatX Technologies</span>
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                            </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const mobileMenuOpen = ref(false);
</script>
