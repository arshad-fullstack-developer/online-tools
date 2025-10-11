<template>
    <AdminLayout>
        <Head title="Dashboard" />

        <div class="space-y-6">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Tools Card -->
                <div class="relative bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl p-6 text-white shadow-lg overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-16 -mt-16"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="text-sm opacity-90 mb-1">Total Tools</div>
                        <div class="text-4xl font-bold">{{ stats.total_tools }}</div>
                    </div>
                </div>

                <!-- Active Tools Card -->
                <div class="relative bg-gradient-to-br from-blue-400 to-blue-500 rounded-2xl p-6 text-white shadow-lg overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-16 -mt-16"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="text-sm opacity-90 mb-1">Active Tools</div>
                        <div class="text-4xl font-bold">{{ stats.active_tools }}</div>
                    </div>
                </div>

                <!-- Total Views Card -->
                <div class="relative bg-gradient-to-br from-green-400 to-green-500 rounded-2xl p-6 text-white shadow-lg overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-16 -mt-16"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="text-sm opacity-90 mb-1">Profile Viewed</div>
                        <div class="text-4xl font-bold">{{ formatNumber(stats.total_views) }}</div>
                    </div>
                </div>

                <!-- Total Usage Card -->
                <div class="relative bg-gradient-to-br from-lime-400 to-lime-500 rounded-2xl p-6 text-white shadow-lg overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-16 -mt-16"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="text-sm opacity-90 mb-1">Total Usage</div>
                        <div class="text-4xl font-bold">{{ formatNumber(stats.total_usage) }}</div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Popular Tools -->
                <div class="card">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Most Popular Tools</h2>
                    <div class="space-y-3">
                        <div
                            v-for="tool in popularTools"
                            :key="tool.id"
                            class="flex items-center justify-between p-3 bg-gray-50 rounded-lg"
                        >
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center">
                                    <span class="text-lg">⚙️</span>
                                </div>
                                <div>
                                    <div class="font-medium text-gray-900">{{ tool.name }}</div>
                                    <div class="text-sm text-gray-500">{{ tool.category.name }}</div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm font-semibold text-primary-600">
                                    {{ formatNumber(tool.usage_count) }}
                                </div>
                                <div class="text-xs text-gray-500">uses</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="card">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Recent Activity</h2>
                    <div class="space-y-3">
                        <div
                            v-for="activity in recentActivity.slice(0, 10)"
                            :key="activity.id"
                            class="flex items-center justify-between text-sm"
                        >
                            <div class="flex items-center space-x-3">
                                <div :class="[
                                    'w-2 h-2 rounded-full',
                                    activity.action_type === 'view' ? 'bg-blue-500' : 'bg-green-500'
                                ]"></div>
                                <span class="text-gray-700">{{ activity.tool.name }}</span>
                            </div>
                            <span class="text-gray-500">{{ formatDate(activity.created_at) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Simple Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Tool Usage Progress Bars -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-semibold text-gray-900">Tool Usage</h2>
                        <span class="text-sm text-gray-500">Top Tools</span>
                    </div>
                    <div class="space-y-4">
                        <div v-for="(tool, index) in popularTools.slice(0, 5)" :key="tool.id">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center space-x-2">
                                    <span class="text-sm font-medium text-gray-700">{{ tool.name }}</span>
                                </div>
                                <span class="text-sm font-semibold text-gray-900">{{ formatNumber(tool.usage_count) }}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div 
                                    :class="[
                                        'h-2 rounded-full transition-all',
                                        index === 0 ? 'bg-gradient-to-r from-blue-500 to-blue-600' :
                                        index === 1 ? 'bg-gradient-to-r from-green-500 to-green-600' :
                                        index === 2 ? 'bg-gradient-to-r from-purple-500 to-purple-600' :
                                        index === 3 ? 'bg-gradient-to-r from-orange-500 to-orange-600' :
                                        'bg-gradient-to-r from-pink-500 to-pink-600'
                                    ]"
                                    :style="{ width: popularTools[0]?.usage_count > 0 ? (tool.usage_count / popularTools[0].usage_count * 100) + '%' : '0%' }"
                                ></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Category Distribution -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Category Distribution</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="text-center p-4 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl">
                            <div class="text-3xl font-bold text-blue-600 mb-1">{{ stats.total_categories }}</div>
                            <div class="text-sm text-gray-600">Total Categories</div>
                        </div>
                        <div class="text-center p-4 bg-gradient-to-br from-green-50 to-green-100 rounded-xl">
                            <div class="text-3xl font-bold text-green-600 mb-1">{{ stats.active_tools }}</div>
                            <div class="text-sm text-gray-600">Active Tools</div>
                        </div>
                        <div class="text-center p-4 bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl">
                            <div class="text-3xl font-bold text-purple-600 mb-1">{{ formatNumber(stats.total_views) }}</div>
                            <div class="text-sm text-gray-600">Total Views</div>
                        </div>
                        <div class="text-center p-4 bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl">
                            <div class="text-3xl font-bold text-orange-600 mb-1">{{ formatNumber(stats.total_usage) }}</div>
                            <div class="text-sm text-gray-600">Total Usage</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </AdminLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';

const props = defineProps({
    stats: Object,
    popularTools: Array,
    recentActivity: Array,
});

const formatNumber = (num) => {
    if (num >= 1000000) return (num / 1000000).toFixed(1) + 'M';
    if (num >= 1000) return (num / 1000).toFixed(1) + 'K';
    return num;
};

const formatDate = (dateString) => {
    const date = new Date(dateString);
    const now = new Date();
    const diff = Math.floor((now - date) / 1000);

    if (diff < 60) return 'Just now';
    if (diff < 3600) return Math.floor(diff / 60) + 'm ago';
    if (diff < 86400) return Math.floor(diff / 3600) + 'h ago';
    return Math.floor(diff / 86400) + 'd ago';
};
</script>
