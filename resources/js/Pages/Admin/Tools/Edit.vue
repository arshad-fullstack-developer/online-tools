<template>
    <AdminLayout>
        <Head title="Edit Tool" />

        <div class="max-w-4xl">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900">Edit Tool</h1>
                <p class="text-gray-600 mt-1">Update tool information</p>
            </div>

            <form @submit.prevent="submit" class="card space-y-6">
                <!-- Basic Information -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="label">Tool Name *</label>
                            <input
                                v-model="form.name"
                                type="text"
                                class="input"
                                required
                            />
                            <div v-if="errors.name" class="text-red-600 text-sm mt-1">{{ errors.name }}</div>
                        </div>

                        <div>
                            <label class="label">Slug</label>
                            <input
                                v-model="form.slug"
                                type="text"
                                class="input"
                            />
                            <div v-if="errors.slug" class="text-red-600 text-sm mt-1">{{ errors.slug }}</div>
                        </div>

                        <div>
                            <label class="label">Category *</label>
                            <select v-model="form.category_id" class="input" required>
                                <option value="">Select Category</option>
                                <option v-for="category in categories" :key="category.id" :value="category.id">
                                    {{ category.name }}
                                </option>
                            </select>
                            <div v-if="errors.category_id" class="text-red-600 text-sm mt-1">{{ errors.category_id }}</div>
                        </div>

                        <div>
                            <label class="label">Component Name *</label>
                            <input
                                v-model="form.component_name"
                                type="text"
                                class="input"
                                placeholder="e.g., BmiCalculator"
                                required
                            />
                            <p class="text-xs text-gray-500 mt-1">Vue component name (e.g., BmiCalculator, WordCounter)</p>
                            <div v-if="errors.component_name" class="text-red-600 text-sm mt-1">{{ errors.component_name }}</div>
                        </div>

                        <div>
                            <label class="label">Icon</label>
                            <input
                                v-model="form.icon"
                                type="text"
                                class="input"
                            />
                        </div>

                        <div>
                            <label class="label">Order</label>
                            <input
                                v-model.number="form.order"
                                type="number"
                                class="input"
                            />
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="label">Description</label>
                        <textarea
                            v-model="form.description"
                            class="input"
                            rows="3"
                        ></textarea>
                    </div>

                    <div class="mt-4">
                        <label class="label">Content (How to Use, FAQ, etc.)</label>
                        <textarea
                            v-model="form.content"
                            class="input font-mono text-sm"
                            rows="6"
                        ></textarea>
                    </div>

                </div>

                <!-- SEO Settings -->
                <SeoFields 
                    v-model="seoData"
                    :default-title="form.name || 'Tool Name'"
                    :default-description="form.description || 'Tool description'"
                />

                <!-- Statistics -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Statistics</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-blue-50 rounded-lg p-4">
                            <div class="text-sm text-gray-600">Total Views</div>
                            <div class="text-2xl font-bold text-blue-600">{{ formatNumber(tool.view_count) }}</div>
                        </div>
                        <div class="bg-green-50 rounded-lg p-4">
                            <div class="text-sm text-gray-600">Total Usage</div>
                            <div class="text-2xl font-bold text-green-600">{{ formatNumber(tool.usage_count) }}</div>
                        </div>
                    </div>
                </div>

                <!-- Status -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Status</h2>
                    <div class="space-y-3">
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input
                                v-model="form.is_active"
                                type="checkbox"
                                class="rounded border-gray-300 text-primary-600 focus:ring-primary-500"
                            />
                            <span class="text-gray-700">Active (visible to users)</span>
                        </label>

                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input
                                v-model="form.is_featured"
                                type="checkbox"
                                class="rounded border-gray-300 text-primary-600 focus:ring-primary-500"
                            />
                            <span class="text-gray-700">Featured (show on homepage)</span>
                        </label>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex space-x-3 pt-4 border-t border-gray-200">
                    <button type="submit" class="btn btn-primary" :disabled="processing">
                        {{ processing ? 'Updating...' : 'Update Tool' }}
                    </button>
                    <Link :href="route('admin.tools.index')" class="btn btn-secondary">
                        Cancel
                    </Link>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import { computed } from 'vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import SeoFields from '@/Components/SeoFields.vue';

const props = defineProps({
    tool: Object,
    categories: Array,
    errors: Object,
});

const form = useForm({
    name: props.tool.name,
    slug: props.tool.slug,
    category_id: props.tool.category_id,
    description: props.tool.description,
    content: props.tool.content,
    icon: props.tool.icon,
    component_name: props.tool.component_name,
    order: props.tool.order,
    is_active: props.tool.is_active,
    is_featured: props.tool.is_featured,
    meta_title: props.tool.meta_title,
    meta_description: props.tool.meta_description,
    meta_keywords: props.tool.meta_keywords,
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

const processing = form.processing;

const submit = () => {
    form.put(route('admin.tools.update', props.tool.id));
};

const formatNumber = (num) => {
    if (num >= 1000000) return (num / 1000000).toFixed(1) + 'M';
    if (num >= 1000) return (num / 1000).toFixed(1) + 'K';
    return num;
};
</script>
