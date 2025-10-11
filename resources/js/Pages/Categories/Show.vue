<template>
    <AppLayout>
        <Head>
            <title>{{ seo.title }}</title>
            <meta name="description" :content="seo.description" />
            <meta name="keywords" :content="seo.keywords" />
        </Head>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Breadcrumb -->
            <nav class="flex mb-6 text-sm text-gray-600">
                <Link :href="route('home')" class="hover:text-primary-600">Home</Link>
                <span class="mx-2">/</span>
                <span class="text-gray-900">{{ category.name }}</span>
            </nav>

            <!-- Category Header -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ category.name }}</h1>
                <p class="text-xl text-gray-600">{{ category.description }}</p>
            </div>

            <!-- Tools Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <Link
                    v-for="tool in tools"
                    :key="tool.id"
                    :href="route('tools.show', tool.slug)"
                    class="card hover:shadow-lg transition-shadow duration-200 cursor-pointer group"
                >
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center group-hover:bg-primary-200 transition-colors">
                            <span class="text-2xl">{{ getToolIcon(tool.icon) }}</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-900 group-hover:text-primary-600 transition-colors mb-2">
                                {{ tool.name }}
                            </h3>
                            <p class="text-sm text-gray-600 mb-3">
                                {{ tool.description }}
                            </p>
                            <div class="flex items-center justify-between text-xs text-gray-500">
                                <span v-if="tool.is_featured" class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded">
                                    Featured
                                </span>
                            </div>
                        </div>
                    </div>
                </Link>
            </div>

            <!-- Empty State -->
            <div v-if="tools.length === 0" class="text-center py-12">
                <div class="text-6xl mb-4">🔧</div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">No Tools Available</h3>
                <p class="text-gray-600">Tools in this category are coming soon!</p>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    category: Object,
    tools: Array,
    seo: Object,
});

const iconMap = {
    'type': '📝',
    'text': '🔤',
    'braces': '{}',
    'link': '🔗',
    'cake': '🎂',
    'calendar-range': '📆',
    'percent': '%',
    'calculator': '🧮',
    'binary': '01',
    'key': '🔑',
    'activity': '💪',
    'heart': '❤️',
    'scale': '⚖️',
    'fire': '🔥',
    'droplet': '💧',
    'body': '🧍',
    'health': '🏥',
    'code': '💻',
    'map': '🗺️',
    'trending-up': '📈',
    'chart': '📊',
    'coins': '💰',
};

const getToolIcon = (icon) => iconMap[icon] || '⚙️';

const formatNumber = (num) => {
    if (num >= 1000000) return (num / 1000000).toFixed(1) + 'M';
    if (num >= 1000) return (num / 1000).toFixed(1) + 'K';
    return num;
};
</script>
