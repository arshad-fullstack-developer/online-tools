<template>
    <AppLayout>
        <Head>
            <title>{{ seo.title }}</title>
            <meta name="description" :content="seo.description" />
            <meta name="keywords" :content="seo.keywords" />
        </Head>

        <!-- Schema Markup -->
        <component :is="'script'" v-if="seo.schema" type="application/ld+json">
            {{ JSON.stringify(seo.schema) }}
        </component>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Breadcrumb -->
            <nav class="flex mb-6 text-sm text-gray-600">
                <Link :href="route('home')" class="hover:text-primary-600">Home</Link>
                <span class="mx-2">/</span>
                <Link :href="route('categories.show', tool.category.slug)" class="hover:text-primary-600">
                    {{ tool.category.name }}
                </Link>
                <span class="mx-2">/</span>
                <span class="text-gray-900">{{ tool.name }}</span>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <!-- Tool Header -->
                    <div class="card mb-6">
                        <div class="flex items-start space-x-4 mb-6">
                            <div class="flex-shrink-0 w-16 h-16 bg-primary-100 rounded-xl flex items-center justify-center">
                                <span class="text-3xl">{{ getToolIcon(tool.icon) }}</span>
                            </div>
                            <div class="flex-1">
                                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ tool.name }}</h1>
                                <p class="text-gray-600">{{ tool.description }}</p>
                            </div>
                        </div>

                        <!-- Tool Component -->
                        <component 
                            :is="getToolComponent(tool.component_name)" 
                            :tool="tool"
                            :timezones="props.timezones"
                            :popularTimezones="props.popularTimezones"
                        />
                    </div>

                    <!-- Tool Content (How to Use, FAQ, etc.) -->
                    <div v-if="tool.content" class="card">
                        <div class="prose max-w-none" v-html="tool.content"></div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Related Tools -->
                    <div v-if="relatedTools.length > 0" class="card">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Related Tools</h3>
                        <div class="space-y-3">
                            <Link
                                v-for="relatedTool in relatedTools"
                                :key="relatedTool.id"
                                :href="route('tools.show', relatedTool.slug)"
                                class="block p-3 rounded-lg hover:bg-gray-50 transition-colors group"
                            >
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0 w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center group-hover:bg-primary-200 transition-colors">
                                        <span class="text-sm">{{ getToolIcon(relatedTool.icon) }}</span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 group-hover:text-primary-600 transition-colors truncate">
                                            {{ relatedTool.name }}
                                        </p>
                                    </div>
                                </div>
                            </Link>
                        </div>
                    </div>

                    <!-- Ad Space -->
                    <div class="card mt-6 bg-gray-100 text-center py-12">
                        <p class="text-gray-500 text-sm">Ad Space</p>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { defineAsyncComponent } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { getToolIcon } from '@/config/icons';

// Import tool components
const WordCounter = defineAsyncComponent(() => import("@/Components/Tools/WordCounter.vue"));
const AgeCalculator = defineAsyncComponent(() => import("@/Components/Tools/AgeCalculator.vue"));
const TextCaseConverter = defineAsyncComponent(() => import("@/Components/Tools/TextCaseConverter.vue"));
const JsonFormatter = defineAsyncComponent(() => import("@/Components/Tools/JsonFormatter.vue"));
const SlugGenerator = defineAsyncComponent(() => import('@/Components/Tools/SlugGenerator.vue'));
const DateDifferenceCalculator = defineAsyncComponent(() => import('@/Components/Tools/DateDifferenceCalculator.vue'));
const DiscountCalculator = defineAsyncComponent(() => import('@/Components/Tools/DiscountCalculator.vue'));
const LoanEmiCalculator = defineAsyncComponent(() => import('@/Components/Tools/LoanEmiCalculator.vue'));
const Base64Tool = defineAsyncComponent(() => import('@/Components/Tools/Base64Tool.vue'));
const PasswordGenerator = defineAsyncComponent(() => import('@/Components/Tools/PasswordGenerator.vue'));
const BmiCalculator = defineAsyncComponent(() => import('@/Components/Tools/BmiCalculator.vue'));
const CaloriesBurnedCalculator = defineAsyncComponent(() => import('@/Components/Tools/CaloriesBurnedCalculator.vue'));
const WaterIntakeCalculator = defineAsyncComponent(() => import('@/Components/Tools/WaterIntakeCalculator.vue'));
const BodySurfaceAreaCalculator = defineAsyncComponent(() => import('@/Components/Tools/BodySurfaceAreaCalculator.vue'));
const SitemapGenerator = defineAsyncComponent(() => import('@/Components/Tools/SitemapGenerator.vue'));
const ProfitMarginCalculator = defineAsyncComponent(() => import('@/Components/Tools/ProfitMarginCalculator.vue'));
const TimeZoneConverter = defineAsyncComponent(() => import('@/Components/Tools/TimeZoneConverter.vue'));
const AIContentDetector = defineAsyncComponent(() => import('@/Components/Tools/AIContentDetector.vue'));
const HtmlFormatter = defineAsyncComponent(() => import('@/Components/Tools/HtmlFormatter.vue'));
const ColorPicker = defineAsyncComponent(() => import('@/Components/Tools/ColorPicker.vue'));

const props = defineProps({
    tool: Object,
    relatedTools: Array,
    seo: Object,
    timezones: {
        type: Array,
        default: () => []
    },
    popularTimezones: {
        type: Array,
        default: () => []
    },
});

const getToolComponent = (componentName) => {
    const components = {
        WordCounter,
        AgeCalculator,
        TextCaseConverter,
        JsonFormatter,
        SlugGenerator,
        DateDifferenceCalculator,
        DiscountCalculator,
        LoanEmiCalculator,
        Base64Tool,
        PasswordGenerator,
        BmiCalculator,
        CaloriesBurnedCalculator,
        WaterIntakeCalculator,
        BodySurfaceAreaCalculator,
        SitemapGenerator,
        ProfitMarginCalculator,
        TimeZoneConverter,
        AIContentDetector,
        HtmlFormatter,
        ColorPicker,
    };
    
    return components[componentName] || null;
};
</script>

<style scoped>
.prose {
    @apply text-gray-700;
}

.prose h2 {
    @apply text-2xl font-bold text-gray-900 mt-8 mb-4;
}

.prose h3 {
    @apply text-xl font-semibold text-gray-900 mt-6 mb-3;
}

.prose p {
    @apply mb-4;
}

.prose ul {
    @apply list-disc list-inside mb-4 space-y-2;
}

.prose li {
    @apply text-gray-700;
}
</style>
