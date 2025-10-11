<template>
    <AdminLayout>
        <Head title="Manage Categories" />

        <div class="space-y-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Categories</h1>
                    <p class="text-gray-600 mt-1">Manage tool categories</p>
                </div>
                <Link :href="route('admin.categories.create')" class="btn btn-primary">
                    + Add New Category
                </Link>
            </div>

            <!-- Categories Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div
                    v-for="category in categories"
                    :key="category.id"
                    class="card"
                >
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center">
                                <span class="text-2xl">🛠️</span>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">{{ category.name }}</h3>
                                <p class="text-sm text-gray-500">{{ category.tools_count }} tools</p>
                            </div>
                        </div>
                        <span
                            :class="[
                                'px-2 py-1 text-xs font-semibold rounded-full',
                                category.is_active
                                    ? 'bg-green-100 text-green-800'
                                    : 'bg-red-100 text-red-800'
                            ]"
                        >
                            {{ category.is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>

                    <p class="text-sm text-gray-600 mb-4">{{ category.description }}</p>

                    <div class="flex space-x-2">
                        <Link
                            :href="route('categories.show', category.slug)"
                            class="text-sm text-primary-600 hover:text-primary-700 font-medium"
                            target="_blank"
                        >
                            View
                        </Link>
                        <Link
                            :href="route('admin.categories.edit', category.id)"
                            class="text-sm text-blue-600 hover:text-blue-700 font-medium"
                        >
                            Edit
                        </Link>
                        <button
                            @click="deleteCategory(category)"
                            class="text-sm text-red-600 hover:text-red-700 font-medium"
                        >
                            Delete
                        </button>
                    </div>
                </div>
            </div>

            <!-- Empty State -->
            <div v-if="categories.length === 0" class="card text-center py-12">
                <div class="text-6xl mb-4">📁</div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">No Categories Yet</h3>
                <p class="text-gray-600 mb-4">Get started by creating your first category</p>
                <Link :href="route('admin.categories.create')" class="btn btn-primary">
                    + Add New Category
                </Link>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

defineProps({
    categories: Array,
});

const deleteCategory = (category) => {
    if (category.tools_count > 0) {
        alert('Cannot delete category with tools. Please move or delete the tools first.');
        return;
    }

    if (confirm(`Are you sure you want to delete "${category.name}"? This action cannot be undone.`)) {
        router.delete(route('admin.categories.destroy', category.id));
    }
};
</script>
