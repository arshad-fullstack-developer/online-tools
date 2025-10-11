<template>
    <AppLayout>
        <Head title="Blog" />

        <!-- Hero Section -->
        <div class="relative bg-gradient-to-br from-primary-600 via-primary-700 to-purple-800 text-white py-24 overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; viewBox=&quot;0 0 60 60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;none&quot; fill-rule=&quot;evenodd&quot;%3E%3Cg fill=&quot;%23ffffff&quot; fill-opacity=&quot;1&quot;%3E%3Cpath d=&quot;M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z&quot;/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
            </div>
            
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-8">
                    <div class="inline-flex items-center px-4 py-2 bg-primary-500/20 backdrop-blur-sm rounded-full text-primary-300 text-sm font-semibold mb-6">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                        Our Blog
                    </div>
                    <h1 class="text-5xl md:text-7xl font-bold mb-6 bg-gradient-to-r from-white via-primary-100 to-white bg-clip-text text-transparent">
                        Stories & Insights
                    </h1>
                    <p class="text-xl text-slate-300 max-w-3xl mx-auto leading-relaxed">
                        Discover the latest articles, tutorials, and insights from our team
                    </p>
                </div>

                <!-- Search Bar -->
                <div class="max-w-2xl mx-auto">
                    <div class="relative">
                        <input 
                            type="text" 
                            placeholder="Search articles..." 
                            class="w-full px-6 py-4 pl-12 bg-white/10 backdrop-blur-sm border-2 border-white/20 rounded-2xl text-white placeholder-white/60 focus:outline-none focus:border-primary-400 transition-all"
                        />
                        <svg class="w-5 h-5 text-white/60 absolute left-4 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Blog Grid -->
        <div class="bg-gray-50 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Stats Bar -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="text-3xl font-bold text-gray-900">{{ blogs.total || 0 }}</div>
                                <div class="text-sm text-gray-600">Total Articles</div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="text-3xl font-bold text-gray-900">5+</div>
                                <div class="text-sm text-gray-600">Contributors</div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="text-3xl font-bold text-gray-900">∞</div>
                                <div class="text-sm text-gray-600">Topics Covered</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div v-if="blogs.data.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <article 
                    v-for="blog in blogs.data" 
                    :key="blog.id"
                    class="group bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-all transform hover:-translate-y-3 border border-gray-100"
                >
                    <!-- Featured Image -->
                    <div class="relative h-56 bg-gradient-to-br from-primary-400 via-primary-500 to-purple-600 overflow-hidden">
                        <img 
                            v-if="blog.featured_image" 
                            :src="`/storage/${blog.featured_image}`" 
                            :alt="blog.title"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                        />
                        <div v-else class="w-full h-full flex items-center justify-center text-white">
                            <svg class="w-24 h-24 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                        </div>
                        <div class="absolute top-4 right-4 px-3 py-1 bg-white bg-opacity-90 backdrop-blur-sm rounded-full text-xs font-semibold text-gray-700">
                            {{ blog.views }} views
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <div class="flex items-center space-x-4 text-sm text-gray-500 mb-4">
                            <span class="flex items-center px-3 py-1 bg-primary-50 text-primary-700 rounded-full font-medium">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                {{ blog.author }}
                            </span>
                            <span class="flex items-center text-gray-400">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ formatDate(blog.published_at || blog.created_at) }}
                            </span>
                        </div>

                        <h2 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-primary-600 transition-colors line-clamp-2 leading-tight">
                            {{ blog.title }}
                        </h2>

                        <p class="text-gray-600 mb-6 line-clamp-3 leading-relaxed">
                            {{ blog.excerpt || 'Click to read more about this post...' }}
                        </p>

                        <Link :href="route('blog.show', blog.slug)" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-xl font-semibold hover:from-primary-700 hover:to-primary-800 transition-all transform group-hover:scale-105 shadow-lg">
                            Read More
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </Link>
                    </div>
                </article>
            </div>

            <!-- Empty State -->
            <div v-else class="text-center py-20">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">No blog posts yet</h3>
                <p class="text-gray-600">Check back soon for new content!</p>
            </div>

                <!-- Pagination -->
                <div v-if="blogs.links.length > 3" class="mt-12 flex justify-center">
                    <div class="flex space-x-2">
                        <Link 
                            v-for="link in blogs.links" 
                            :key="link.label"
                            :href="link.url"
                            :class="[
                                'px-4 py-2 rounded-lg text-sm font-medium transition-all',
                                link.active 
                                    ? 'bg-primary-600 text-white shadow-lg' 
                                    : link.url 
                                        ? 'bg-white text-gray-700 hover:bg-gray-100 shadow' 
                                        : 'bg-gray-100 text-gray-400 cursor-not-allowed'
                            ]"
                            v-html="link.label"
                        ></Link>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    blogs: Object,
});

const formatDate = (dateString) => {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
};
</script>
