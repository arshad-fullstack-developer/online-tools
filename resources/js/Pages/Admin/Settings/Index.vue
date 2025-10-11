<template>
    <AdminLayout>
        <Head title="General Settings" />

        <div class="max-w-5xl">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900">General Settings</h1>
                <p class="text-gray-600 mt-1">Manage your site configuration and branding</p>
            </div>

            <form @submit.prevent="submit" class="space-y-6">
                <!-- Site Information -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">Site Information</h2>
                            <p class="text-sm text-gray-600">Basic details about your website</p>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Site Name *</label>
                            <input 
                                v-model="form.site_name"
                                type="text" 
                                required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                placeholder="Online Tools"
                            />
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Site Tagline</label>
                            <input 
                                v-model="form.site_tagline"
                                type="text"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                placeholder="Your All-in-One Tool Collection"
                            />
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Site Description</label>
                            <textarea 
                                v-model="form.site_description"
                                rows="3"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                placeholder="Brief description of your website"
                            ></textarea>
                        </div>
                    </div>
                </div>

                <!-- Branding -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">Branding</h2>
                            <p class="text-sm text-gray-600">Upload your logo and favicon</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Logo Upload -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Header Logo</label>
                            <div v-if="logoPreview" class="relative mb-4">
                                <img :src="logoPreview" class="w-full h-32 object-contain bg-gray-50 rounded-xl border-2 border-gray-200 p-4" />
                                <button type="button" @click="removeLogo" class="absolute top-2 right-2 p-1.5 bg-red-600 text-white rounded-lg hover:bg-red-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            <div v-else class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center cursor-pointer hover:border-primary-500 transition-colors" @click="$refs.logoInput.click()">
                                <svg class="w-12 h-12 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <p class="text-sm text-gray-600">Click to upload logo</p>
                            </div>
                            <input ref="logoInput" type="file" accept="image/*" @change="handleLogoUpload" class="hidden" />
                        </div>

                        <!-- Footer Logo Upload -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Footer Logo</label>
                            <div v-if="footerLogoPreview" class="relative mb-4">
                                <img :src="footerLogoPreview" class="w-full h-32 object-contain bg-gray-50 rounded-xl border-2 border-gray-200 p-4" />
                                <button type="button" @click="removeFooterLogo" class="absolute top-2 right-2 p-1.5 bg-red-600 text-white rounded-lg hover:bg-red-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            <div v-else class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center cursor-pointer hover:border-primary-500 transition-colors" @click="$refs.footerLogoInput.click()">
                                <svg class="w-12 h-12 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <p class="text-sm text-gray-600">Click to upload footer logo</p>
                            </div>
                            <input ref="footerLogoInput" type="file" accept="image/*" @change="handleFooterLogoUpload" class="hidden" />
                        </div>

                        <!-- Favicon Upload -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Favicon</label>
                            <div v-if="faviconPreview" class="relative mb-4">
                                <img :src="faviconPreview" class="w-full h-32 object-contain bg-gray-50 rounded-xl border-2 border-gray-200 p-4" />
                                <button type="button" @click="removeFavicon" class="absolute top-2 right-2 p-1.5 bg-red-600 text-white rounded-lg hover:bg-red-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            <div v-else class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center cursor-pointer hover:border-primary-500 transition-colors" @click="$refs.faviconInput.click()">
                                <svg class="w-12 h-12 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <p class="text-sm text-gray-600">Click to upload favicon</p>
                            </div>
                            <input ref="faviconInput" type="file" accept="image/*" @change="handleFaviconUpload" class="hidden" />
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">Contact Information</h2>
                            <p class="text-sm text-gray-600">How users can reach you</p>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Contact Email</label>
                            <input 
                                v-model="form.contact_email"
                                type="email"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                placeholder="contact@example.com"
                            />
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Contact Phone</label>
                            <input 
                                v-model="form.contact_phone"
                                type="text"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                placeholder="+1 234 567 8900"
                            />
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Address</label>
                            <textarea 
                                v-model="form.address"
                                rows="2"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                placeholder="123 Main St, City, Country"
                            ></textarea>
                        </div>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 bg-gradient-to-br from-pink-500 to-pink-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">Social Media Links</h2>
                            <p class="text-sm text-gray-600">Connect your social profiles</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Facebook</label>
                            <input 
                                v-model="form.facebook"
                                type="url"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                placeholder="https://facebook.com/yourpage"
                            />
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Twitter</label>
                            <input 
                                v-model="form.twitter"
                                type="url"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                placeholder="https://twitter.com/yourhandle"
                            />
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Instagram</label>
                            <input 
                                v-model="form.instagram"
                                type="url"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                placeholder="https://instagram.com/yourprofile"
                            />
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">LinkedIn</label>
                            <input 
                                v-model="form.linkedin"
                                type="url"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                placeholder="https://linkedin.com/company/yourcompany"
                            />
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end space-x-4">
                    <button 
                        type="submit"
                        :disabled="form.processing"
                        class="px-8 py-3 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-xl font-semibold hover:from-primary-700 hover:to-primary-800 transition-all transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed shadow-lg"
                    >
                        <span v-if="!form.processing">Save Settings</span>
                        <span v-else>Saving...</span>
                    </button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';

const props = defineProps({
    settings: Object,
});

const logoPreview = ref(props.settings.logo ? `/storage/${props.settings.logo}` : null);
const footerLogoPreview = ref(props.settings.footer_logo ? `/storage/${props.settings.footer_logo}` : null);
const faviconPreview = ref(props.settings.favicon ? `/storage/${props.settings.favicon}` : null);
const logoInput = ref(null);
const footerLogoInput = ref(null);
const faviconInput = ref(null);

const form = useForm({
    site_name: props.settings.site_name,
    site_tagline: props.settings.site_tagline,
    site_description: props.settings.site_description,
    logo: null,
    footer_logo: null,
    favicon: null,
    contact_email: props.settings.contact_email,
    contact_phone: props.settings.contact_phone,
    address: props.settings.address,
    facebook: props.settings.facebook,
    twitter: props.settings.twitter,
    instagram: props.settings.instagram,
    linkedin: props.settings.linkedin,
});

const handleLogoUpload = (event) => {
    const file = event.target.files[0];
    if (file) {
        form.logo = file;
        const reader = new FileReader();
        reader.onload = (e) => {
            logoPreview.value = e.target.result;
        };
        reader.readAsDataURL(file);
    }
};

const removeLogo = () => {
    form.logo = null;
    logoPreview.value = null;
    if (logoInput.value) {
        logoInput.value.value = '';
    }
};

const handleFooterLogoUpload = (event) => {
    const file = event.target.files[0];
    if (file) {
        form.footer_logo = file;
        const reader = new FileReader();
        reader.onload = (e) => {
            footerLogoPreview.value = e.target.result;
        };
        reader.readAsDataURL(file);
    }
};

const removeFooterLogo = () => {
    form.footer_logo = null;
    footerLogoPreview.value = null;
    if (footerLogoInput.value) {
        footerLogoInput.value.value = '';
    }
};

const handleFaviconUpload = (event) => {
    const file = event.target.files[0];
    if (file) {
        form.favicon = file;
        const reader = new FileReader();
        reader.onload = (e) => {
            faviconPreview.value = e.target.result;
        };
        reader.readAsDataURL(file);
    }
};

const removeFavicon = () => {
    form.favicon = null;
    faviconPreview.value = null;
    if (faviconInput.value) {
        faviconInput.value.value = '';
    }
};

const submit = () => {
    form.post(route('admin.settings.update'));
};
</script>
