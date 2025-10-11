<template>
    <AdminLayout>
        <Head title="Edit Blog Post" />

        <div class="max-w-5xl">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900">Edit Blog Post</h1>
            </div>

            <form @submit.prevent="submit" class="space-y-6">
                <!-- Featured Image -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Featured Image</h2>
                    
                    <div v-if="imagePreview" class="relative mb-4">
                        <img :src="imagePreview" class="w-full h-64 object-cover rounded-xl" />
                        <button type="button" @click="removeImage" class="absolute top-4 right-4 p-2 bg-red-600 text-white rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div v-else class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center cursor-pointer" @click="$refs.fileInput.click()">
                        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-gray-600">Click to upload new image</p>
                    </div>

                    <input ref="fileInput" type="file" accept="image/*" @change="handleImageUpload" class="hidden" />
                </div>

                <!-- Basic Info -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Basic Information</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Title *</label>
                            <input v-model="form.title" type="text" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500" />
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Slug *</label>
                            <input v-model="form.slug" type="text" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500" />
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Author</label>
                            <input v-model="form.author" type="text" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500" />
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Excerpt</label>
                            <textarea v-model="form.excerpt" rows="3" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Content *</label>
                            <RichTextEditor v-model="form.content" />
                        </div>
                    </div>
                </div>

                <!-- SEO -->
                <SeoFields 
                    v-model="seoData"
                    :default-title="form.title || 'Blog Post Title'"
                    :default-description="form.excerpt || 'Blog post description'"
                />

                <!-- Settings -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Publish Settings</h2>
                    
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <label class="text-sm font-semibold text-gray-700">Publish</label>
                                <p class="text-xs text-gray-500">Make this post visible</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" v-model="form.is_published" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-600"></div>
                            </label>
                        </div>

                        <div v-if="form.is_published">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Publish Date</label>
                            <input v-model="form.published_at" type="datetime-local" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500" />
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-between">
                    <Link :href="route('admin.blogs.index')" class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50">
                        Cancel
                    </Link>
                    <button type="submit" :disabled="form.processing" class="px-8 py-3 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-xl font-semibold hover:from-primary-700 hover:to-primary-800 shadow-lg">
                        {{ form.processing ? 'Updating...' : 'Update Post' }}
                    </button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import SeoFields from '@/Components/SeoFields.vue';
import RichTextEditor from '@/Components/RichTextEditor.vue';

const props = defineProps({
    blog: Object,
});

const imagePreview = ref(props.blog.featured_image ? `/storage/${props.blog.featured_image}` : null);
const fileInput = ref(null);

const form = useForm({
    title: props.blog.title,
    slug: props.blog.slug,
    excerpt: props.blog.excerpt,
    content: props.blog.content,
    featured_image: null,
    author: props.blog.author,
    is_published: props.blog.is_published,
    published_at: props.blog.published_at ? new Date(props.blog.published_at).toISOString().slice(0, 16) : null,
    meta_title: props.blog.meta_title,
    meta_description: props.blog.meta_description,
    meta_keywords: props.blog.meta_keywords,
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

const handleImageUpload = (event) => {
    const file = event.target.files[0];
    if (file) {
        form.featured_image = file;
        const reader = new FileReader();
        reader.onload = (e) => {
            imagePreview.value = e.target.result;
        };
        reader.readAsDataURL(file);
    }
};

const removeImage = () => {
    form.featured_image = null;
    imagePreview.value = null;
    if (fileInput.value) {
        fileInput.value.value = '';
    }
};

const submit = () => {
    form.post(route('admin.blogs.update', props.blog.id), {
        _method: 'put',
    });
};
</script>
