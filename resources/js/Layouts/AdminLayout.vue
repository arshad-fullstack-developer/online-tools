<template>
    <div class="min-h-screen bg-gray-50 flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gradient-to-b from-slate-800 via-slate-900 to-slate-950 text-white flex-shrink-0 hidden lg:block">
            <div class="flex flex-col h-full">
                <!-- Logo -->
                <div class="p-6">
                    <Link :href="route('home')" class="flex items-center">
                        <div v-if="$page.props.settings?.logo" class="h-07 rounded-xl overflow-hidden">
                            <img :src="`/storage/${$page.props.settings.logo}`" :alt="$page.props.settings?.site_name || 'Logo'" class="h-full w-auto object-contain" />
                        </div>
                        <div v-else class="h-12 flex items-center">
                            <span class="text-xl font-bold">{{ $page.props.settings?.site_name || 'Online Tools' }}</span>
                        </div>
                    </Link>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-4 space-y-2">
                    <Link 
                        :href="route('admin.dashboard')"
                        :class="[
                            'flex items-center space-x-3 px-4 py-3 rounded-xl transition-all',
                            route().current('admin.dashboard') 
                                ? 'bg-gradient-to-r from-primary-500 to-primary-600 text-white shadow-lg' 
                                : 'text-slate-300 hover:bg-slate-800'
                        ]"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span class="font-medium">Dashboard</span>
                    </Link>

                    <Link 
                        :href="route('admin.tools.index')"
                        :class="[
                            'flex items-center space-x-3 px-4 py-3 rounded-xl transition-all',
                            route().current('admin.tools.*') 
                                ? 'bg-gradient-to-r from-primary-500 to-primary-600 text-white shadow-lg' 
                                : 'text-slate-300 hover:bg-slate-800'
                        ]"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="font-medium">Tools</span>
                    </Link>

                    <Link 
                        :href="route('admin.categories.index')"
                        :class="[
                            'flex items-center space-x-3 px-4 py-3 rounded-xl transition-all',
                            route().current('admin.categories.*') 
                                ? 'bg-gradient-to-r from-primary-500 to-primary-600 text-white shadow-lg' 
                                : 'text-slate-300 hover:bg-slate-800'
                        ]"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        <span class="font-medium">Categories</span>
                    </Link>

                    <Link 
                        :href="route('admin.pages.index')"
                        :class="[
                            'flex items-center space-x-3 px-4 py-3 rounded-xl transition-all',
                            route().current('admin.pages.*') 
                                ? 'bg-gradient-to-r from-primary-500 to-primary-600 text-white shadow-lg' 
                                : 'text-slate-300 hover:bg-slate-800'
                        ]"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        <span class="font-medium">Pages</span>
                    </Link>

                    <Link 
                        :href="route('admin.blogs.index')"
                        :class="[
                            'flex items-center space-x-3 px-4 py-3 rounded-xl transition-all',
                            route().current('admin.blogs.*') 
                                ? 'bg-gradient-to-r from-primary-500 to-primary-600 text-white shadow-lg' 
                                : 'text-slate-300 hover:bg-slate-800'
                        ]"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                        <span class="font-medium">Blog</span>
                    </Link>

                    <Link 
                        :href="route('admin.settings.index')"
                        :class="[
                            'flex items-center space-x-3 px-4 py-3 rounded-xl transition-all',
                            route().current('admin.settings.*') 
                                ? 'bg-gradient-to-r from-primary-500 to-primary-600 text-white shadow-lg' 
                                : 'text-slate-300 hover:bg-slate-800'
                        ]"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="font-medium">Settings</span>
                    </Link>

                    <div class="my-4 border-t border-slate-700"></div>

                    <Link 
                        :href="route('home')"
                        class="flex items-center space-x-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800 transition-all"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                        </svg>
                        <span class="font-medium">View Site</span>
                    </Link>
                </nav>

                <!-- Footer -->
                <div class="p-4 border-t border-slate-700">
                    <p class="text-xs text-slate-400 text-center">Online Tools Admin</p>
                    <p class="text-xs text-slate-500 text-center mt-1">© 2025 All Rights Reserved</p>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-h-screen">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-10">
                <div class="px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <!-- Mobile Menu Button -->
                            <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                            <h1 class="text-2xl font-bold text-gray-900">{{ pageTitle }}</h1>
                        </div>
                        
                        <div class="flex items-center space-x-4">
                            <!-- Search -->
                            <div class="relative hidden md:block">
                                <input 
                                    v-model="searchQuery"
                                    type="text" 
                                    placeholder="Search tools, categories..." 
                                    class="w-80 pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                    @keyup.enter="handleSearch"
                                />
                                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>

                            <!-- Notifications -->
                            <div class="relative">
                                <button @click="notificationsOpen = !notificationsOpen" class="relative p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                    </svg>
                                    <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                                </button>

                                <!-- Notifications Dropdown -->
                                <div v-show="notificationsOpen" @click.away="notificationsOpen = false" class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl border border-gray-200 py-2">
                                    <div class="px-4 py-2 border-b border-gray-200">
                                        <h3 class="font-semibold text-gray-900">Notifications</h3>
                                    </div>
                                    <div class="max-h-96 overflow-y-auto">
                                        <a href="#" class="block px-4 py-3 hover:bg-gray-50 transition-colors">
                                            <div class="flex items-start space-x-3">
                                                <div class="w-2 h-2 bg-blue-500 rounded-full mt-2"></div>
                                                <div class="flex-1">
                                                    <p class="text-sm text-gray-900">New tool added successfully</p>
                                                    <p class="text-xs text-gray-500 mt-1">2 minutes ago</p>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="block px-4 py-3 hover:bg-gray-50 transition-colors">
                                            <div class="flex items-start space-x-3">
                                                <div class="w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                                                <div class="flex-1">
                                                    <p class="text-sm text-gray-900">Category updated</p>
                                                    <p class="text-xs text-gray-500 mt-1">1 hour ago</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="px-4 py-2 border-t border-gray-200">
                                        <a href="#" class="text-sm text-primary-600 hover:text-primary-700 font-medium">View all notifications</a>
                                    </div>
                                </div>
                            </div>

                            <!-- User Menu -->
                            <div class="relative">
                                <button @click="userMenuOpen = !userMenuOpen" class="flex items-center space-x-3 pl-4 border-l border-gray-200 hover:bg-gray-50 rounded-lg p-2 transition-colors">
                                    <img :src="`https://ui-avatars.com/api/?name=${encodeURIComponent($page.props.auth?.user?.name || 'Admin')}&background=0ea5e9&color=fff`" alt="Admin" class="w-10 h-10 rounded-full" />
                                    <div class="hidden md:block text-left">
                                        <div class="text-sm font-semibold text-gray-900">{{ $page.props.auth?.user?.name || 'Admin' }}</div>
                                        <div class="text-xs text-gray-500">Site Admin</div>
                                    </div>
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>

                                <!-- User Dropdown -->
                                <div v-show="userMenuOpen" @click.away="userMenuOpen = false" class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-xl border border-gray-200 py-2">
                                    <div class="px-4 py-3 border-b border-gray-200">
                                        <p class="text-sm font-semibold text-gray-900">{{ $page.props.auth?.user?.name || 'Admin' }}</p>
                                        <p class="text-xs text-gray-500">{{ $page.props.auth?.user?.email || 'admin@example.com' }}</p>
                                    </div>
                                    
                                    <div class="py-2">
                                        <Link :href="route('admin.dashboard')" class="flex items-center space-x-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                            </svg>
                                            <span>Dashboard</span>
                                        </Link>
                                        
                                        <Link :href="route('admin.profile.edit')" class="flex items-center space-x-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            <span>Profile Settings</span>
                                        </Link>
                                        
                                        <Link :href="route('home')" target="_blank" class="flex items-center space-x-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                                            </svg>
                                            <span>View Site</span>
                                        </Link>
                                    </div>
                                    
                                    <div class="border-t border-gray-200"></div>
                                    
                                    <div class="py-2">
                                        <Link 
                                            :href="route('logout')" 
                                            method="post" 
                                            as="button"
                                            class="flex items-center space-x-3 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors w-full text-left"
                                        >
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                            </svg>
                                            <span>Logout</span>
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-6">
                <!-- Flash Messages -->
                <div v-if="$page.props.flash?.success" class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
                    {{ $page.props.flash.success }}
                </div>
                <div v-if="$page.props.flash?.error" class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
                    {{ $page.props.flash.error }}
                </div>

                <slot />
            </main>
        </div>
    </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const sidebarOpen = ref(false);
const notificationsOpen = ref(false);
const userMenuOpen = ref(false);
const searchQuery = ref('');

const pageTitle = computed(() => {
    const currentRoute = route().current();
    if (currentRoute === 'admin.dashboard') return 'Dashboard';
    if (currentRoute?.includes('admin.tools')) return 'Tools Management';
    if (currentRoute?.includes('admin.categories')) return 'Categories Management';
    if (currentRoute?.includes('admin.pages')) return 'Pages Management';
    if (currentRoute?.includes('admin.profile')) return 'Profile Settings';
    return 'Admin Panel';
});

const handleSearch = () => {
    if (searchQuery.value.trim()) {
        // Implement search functionality
        console.log('Searching for:', searchQuery.value);
    }
};
</script>
