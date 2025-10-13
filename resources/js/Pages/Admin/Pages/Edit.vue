<template>
    <AdminLayout>
        <Head title="Edit Page" />

        <div class="max-w-4xl">
            <!-- Header -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900">Edit Page</h1>
                <p class="text-gray-600 mt-1">Update page content and settings</p>
            </div>

            <!-- Form -->
            <form @submit.prevent="submit" class="space-y-6">
                <!-- Basic Information -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Basic Information</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Title *</label>
                            <input 
                                v-model="form.title"
                                type="text" 
                                required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                placeholder="Page Title"
                            />
                            <p v-if="form.errors.title" class="mt-1 text-sm text-red-600">{{ form.errors.title }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Slug *</label>
                            <input 
                                v-model="form.slug"
                                type="text" 
                                required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                placeholder="page-url-slug"
                            />
                            <p class="mt-1 text-xs text-gray-500">URL: {{ siteUrl }}/{{ form.slug || 'page-slug' }}</p>
                            <p v-if="form.errors.slug" class="mt-1 text-sm text-red-600">{{ form.errors.slug }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Excerpt</label>
                            <textarea 
                                v-model="form.excerpt"
                                rows="3"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                placeholder="Short description for the page"
                            ></textarea>
                            <p v-if="form.errors.excerpt" class="mt-1 text-sm text-red-600">{{ form.errors.excerpt }}</p>
                        </div>

                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label class="block text-sm font-semibold text-gray-700">Content *</label>
                                <button 
                                    v-if="isHtmlTogglePage || form.slug === 'home'"
                                    @click="toggleHtmlMode" 
                                    type="button"
                                    class="text-xs px-3 py-1 bg-gray-200 hover:bg-gray-300 rounded-lg transition-colors"
                                >
                                    {{ isHtmlMode ? '📝 Switch to Editor' : '💻 Switch to HTML' }}
                                </button>
                            </div>
                            
                            <!-- HTML Mode (for home page and other pages) -->
                            <textarea 
                                v-if="(form.slug === 'home' || isHtmlTogglePage) && isHtmlMode"
                                v-model="form.content"
                                rows="20"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all font-mono text-sm"
                                placeholder="Enter HTML content..."
                            ></textarea>
                            
                            <!-- Rich Text Editor (default) -->
                            <RichTextEditor v-else v-model="form.content" />
                            
                            <p v-if="form.errors.content" class="mt-1 text-sm text-red-600">{{ form.errors.content }}</p>
                            <p v-if="(form.slug === 'home' || isHtmlTogglePage) && isHtmlMode" class="mt-1 text-xs text-gray-500">
                                💡 HTML mode: Full HTML support with custom classes and styling
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Homepage Content (Only for slug='home') -->
                <div v-if="form.slug === 'home'" class="bg-gradient-to-br from-primary-50 to-purple-50 rounded-2xl shadow-lg border-2 border-primary-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-2 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-primary-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Homepage Dynamic Content
                    </h2>
                    <p class="text-sm text-gray-600 mb-6">Customize all text on the homepage</p>
                    
                    <div class="space-y-4">
                        <!-- Hero Section -->
                        <div class="bg-white rounded-xl p-4 border border-primary-100">
                            <h3 class="font-semibold text-gray-900 mb-3">Hero Section</h3>
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Badge Text</label>
                                    <input 
                                        v-model="form.hero_badge"
                                        type="text"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                        placeholder="✨ 100% Free • No Registration Required"
                                    />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Main Title</label>
                                    <input 
                                        v-model="form.hero_title"
                                        type="text"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                        placeholder="Free Online Tools"
                                    />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Subtitle</label>
                                    <input 
                                        v-model="form.hero_subtitle"
                                        type="text"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                        placeholder="& Calculators"
                                    />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                    <textarea 
                                        v-model="form.hero_description"
                                        rows="2"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                        placeholder="Powerful, easy-to-use tools for everyday tasks..."
                                    ></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Categories Section -->
                        <div class="bg-white rounded-xl p-4 border border-primary-100">
                            <h3 class="font-semibold text-gray-900 mb-3">Categories Section</h3>
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                                    <input 
                                        v-model="form.categories_title"
                                        type="text"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                        placeholder="Browse by Category"
                                    />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                    <textarea 
                                        v-model="form.categories_description"
                                        rows="2"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                        placeholder="Choose from our organized collection..."
                                    ></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Featured Tools Section -->
                        <div class="bg-white rounded-xl p-4 border border-primary-100">
                            <h3 class="font-semibold text-gray-900 mb-3">Featured Tools Section</h3>
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                                    <input 
                                        v-model="form.featured_title"
                                        type="text"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                        placeholder="Most Popular Tools"
                                    />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                    <textarea 
                                        v-model="form.featured_description"
                                        rows="2"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                        placeholder="Start with our most-used tools..."
                                    ></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Trending Tools Section -->
                        <div class="bg-white rounded-xl p-4 border border-primary-100">
                            <h3 class="font-semibold text-gray-900 mb-3">Trending Tools Section</h3>
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                                    <input 
                                        v-model="form.trending_title"
                                        type="text"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                        placeholder="Trending Now"
                                    />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                    <textarea 
                                        v-model="form.trending_description"
                                        rows="2"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                        placeholder="See what others are using..."
                                    ></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <SeoFields 
                    v-model="seoData"
                    :default-title="form.title || 'Page Title'"
                    :default-description="form.excerpt || 'Page description'"
                />

                <!-- Page Settings -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Page Settings</h2>
                    
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <label class="text-sm font-semibold text-gray-700">Active</label>
                                <p class="text-xs text-gray-500">Make this page visible to users</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" v-model="form.is_active" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-600"></div>
                            </label>
                        </div>

                        <div class="flex items-center justify-between">
                            <div>
                                <label class="text-sm font-semibold text-gray-700">Show in Menu</label>
                                <p class="text-xs text-gray-500">Display this page in navigation menu</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" v-model="form.show_in_menu" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-600"></div>
                            </label>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Display Order</label>
                            <input 
                                v-model.number="form.order"
                                type="number"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                placeholder="0"
                            />
                            <p class="mt-1 text-xs text-gray-500">Lower numbers appear first</p>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-between">
                    <Link :href="route('admin.pages.index')" class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition-all">
                        Cancel
                    </Link>
                    <button 
                        type="submit"
                        :disabled="form.processing"
                        class="px-8 py-3 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-xl font-semibold hover:from-primary-700 hover:to-primary-800 transition-all transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed shadow-lg"
                    >
                        <span v-if="!form.processing">Update Page</span>
                        <span v-else>Updating...</span>
                    </button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import SeoFields from '@/Components/SeoFields.vue';
import RichTextEditor from '@/Components/RichTextEditor.vue';

const props = defineProps({
    page: Object,
});

const siteUrl = window.location.origin;
const isHtmlMode = ref(false);

// Pages that should have HTML toggle (legal pages, about, contact)
const htmlTogglePages = ['privacy-policy', 'terms-of-service', 'cookie-policy', 'disclaimer', 'about', 'contact'];
const isHtmlTogglePage = computed(() => htmlTogglePages.includes(props.page.slug));

const toggleHtmlMode = () => {
    isHtmlMode.value = !isHtmlMode.value;
};

const form = useForm({
    title: props.page.title,
    slug: props.page.slug,
    excerpt: props.page.excerpt,
    content: props.page.content,
    hero_badge: props.page.hero_badge,
    hero_title: props.page.hero_title,
    hero_subtitle: props.page.hero_subtitle,
    hero_description: props.page.hero_description,
    categories_title: props.page.categories_title,
    categories_description: props.page.categories_description,
    featured_title: props.page.featured_title,
    featured_description: props.page.featured_description,
    trending_title: props.page.trending_title,
    trending_description: props.page.trending_description,
    meta_title: props.page.meta_title,
    meta_description: props.page.meta_description,
    meta_keywords: props.page.meta_keywords,
    og_image: props.page.og_image,
    order: props.page.order,
    is_active: props.page.is_active,
    show_in_menu: props.page.show_in_menu,
});

const seoData = computed({
    get: () => ({
        meta_title: form.meta_title,
        meta_description: form.meta_description,
        meta_keywords: form.meta_keywords,
    }),
    set: (value) => {
        form.meta_title = value.meta_title;
        form.meta_description = value.meta_description;
        form.meta_keywords = value.meta_keywords;
    }
});

const submit = () => {
    form.put(route('admin.pages.update', props.page.id));
};
</script>
