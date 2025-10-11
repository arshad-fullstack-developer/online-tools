<template>
    <AdminLayout>
        <Head title="Edit Category" />

        <div class="max-w-4xl">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900">Edit Category</h1>
                <p class="text-gray-600 mt-1">Update category information</p>
            </div>

            <form @submit.prevent="submit" class="card space-y-6">
                <!-- Basic Information -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="label">Category Name *</label>
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
                </div>

                <!-- SEO Settings -->
                <SeoFields 
                    v-model="seoData"
                    :default-title="form.name || 'Category Name'"
                    :default-description="form.description || 'Category description'"
                />

                <!-- Status -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Status</h2>
                    <label class="flex items-center space-x-3 cursor-pointer">
                        <input
                            v-model="form.is_active"
                            type="checkbox"
                            class="rounded border-gray-300 text-primary-600 focus:ring-primary-500"
                        />
                        <span class="text-gray-700">Active (visible to users)</span>
                    </label>
                </div>

                <!-- Actions -->
                <div class="flex space-x-3 pt-4 border-t border-gray-200">
                    <button type="submit" class="btn btn-primary" :disabled="processing">
                        {{ processing ? 'Updating...' : 'Update Category' }}
                    </button>
                    <Link :href="route('admin.categories.index')" class="btn btn-secondary">
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
    category: Object,
    errors: Object,
});

const form = useForm({
    name: props.category.name,
    slug: props.category.slug,
    description: props.category.description,
    icon: props.category.icon,
    order: props.category.order,
    is_active: props.category.is_active,
    meta_title: props.category.meta_title,
    meta_description: props.category.meta_description,
    meta_keywords: props.category.meta_keywords,
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
    form.put(route('admin.categories.update', props.category.id));
};
</script>
