<template>
    <AdminLayout>
        <Head title="Create Page" />

        <div class="max-w-4xl">
            <!-- Header -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900">Create New Page</h1>
                <p class="text-gray-600 mt-1">Add a new page to your website</p>
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
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Content *</label>
                            <RichTextEditor v-model="form.content" />
                            <p v-if="form.errors.content" class="mt-1 text-sm text-red-600">{{ form.errors.content }}</p>
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
                        <span v-if="!form.processing">Create Page</span>
                        <span v-else>Creating...</span>
                    </button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import { computed, watch } from 'vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import SeoFields from '@/Components/SeoFields.vue';
import RichTextEditor from '@/Components/RichTextEditor.vue';

const siteUrl = window.location.origin;

const form = useForm({
    title: '',
    slug: '',
    excerpt: '',
    content: '',
    meta_title: '',
    meta_description: '',
    meta_keywords: '',
    order: 0,
    is_active: true,
    show_in_menu: true,
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
    form.post(route('admin.pages.store'));
};

// Auto-generate slug from title
const generateSlug = () => {
    if (form.title && !form.slug) {
        form.slug = form.title
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '');
    }
};

watch(() => form.title, generateSlug);
</script>
