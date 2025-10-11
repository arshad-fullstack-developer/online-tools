<template>
    <AdminLayout>
        <Head title="Manage Tools" />

        <div class="space-y-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Tools</h1>
                    <p class="text-gray-600 mt-1">Manage your online tools</p>
                </div>
                <Link :href="route('admin.tools.create')" class="btn btn-primary">
                    + Add New Tool
                </Link>
            </div>

            <!-- Tools Table -->
            <div class="card overflow-hidden p-0">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tool
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Category
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Views
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Usage
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="tool in tools.data" :key="tool.id" class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center">
                                            <span>⚙️</span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ tool.name }}</div>
                                            <div class="text-sm text-gray-500">{{ tool.slug }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-900">{{ tool.category.name }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ formatNumber(tool.view_count) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ formatNumber(tool.usage_count) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <button
                                        @click="toggleStatus(tool)"
                                        :class="[
                                            'px-2 py-1 text-xs font-semibold rounded-full',
                                            tool.is_active
                                                ? 'bg-green-100 text-green-800'
                                                : 'bg-red-100 text-red-800'
                                        ]"
                                    >
                                        {{ tool.is_active ? 'Active' : 'Inactive' }}
                                    </button>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                    <Link
                                        :href="route('tools.show', tool.slug)"
                                        class="text-primary-600 hover:text-primary-900"
                                        target="_blank"
                                    >
                                        View
                                    </Link>
                                    <Link
                                        :href="route('admin.tools.edit', tool.id)"
                                        class="text-blue-600 hover:text-blue-900"
                                    >
                                        Edit
                                    </Link>
                                    <button
                                        @click="deleteTool(tool)"
                                        class="text-red-600 hover:text-red-900"
                                    >
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div v-if="tools.links.length > 3" class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                    <div class="flex justify-between items-center">
                        <div class="text-sm text-gray-700">
                            Showing {{ tools.from }} to {{ tools.to }} of {{ tools.total }} results
                        </div>
                        <div class="flex space-x-2">
                            <Link
                                v-for="link in tools.links"
                                :key="link.label"
                                :href="link.url"
                                :class="[
                                    'px-3 py-2 text-sm rounded-md',
                                    link.active
                                        ? 'bg-primary-600 text-white'
                                        : 'bg-white text-gray-700 hover:bg-gray-100',
                                    !link.url && 'opacity-50 cursor-not-allowed'
                                ]"
                                v-html="link.label"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

defineProps({
    tools: Object,
});

const formatNumber = (num) => {
    if (num >= 1000000) return (num / 1000000).toFixed(1) + 'M';
    if (num >= 1000) return (num / 1000).toFixed(1) + 'K';
    return num;
};

const toggleStatus = (tool) => {
    if (confirm(`Are you sure you want to ${tool.is_active ? 'deactivate' : 'activate'} this tool?`)) {
        router.post(route('admin.tools.toggle-active', tool.id));
    }
};

const deleteTool = (tool) => {
    if (confirm(`Are you sure you want to delete "${tool.name}"? This action cannot be undone.`)) {
        router.delete(route('admin.tools.destroy', tool.id));
    }
};
</script>
