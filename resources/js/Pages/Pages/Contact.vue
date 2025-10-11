<template>
    <AppLayout>
        <Head>
            <title>{{ seo.title }}</title>
            <meta name="description" :content="seo.description" />
            <meta name="keywords" :content="seo.keywords" />
        </Head>

        <!-- Hero Section -->
        <div class="bg-gradient-to-br from-primary-600 to-primary-800 text-white py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-5xl font-bold mb-4">Contact Us</h1>
                <p class="text-xl text-primary-100 max-w-3xl mx-auto">
                    Have questions or feedback? We'd love to hear from you!
                </p>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="grid md:grid-cols-2 gap-12">
                <!-- Contact Form -->
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Send us a Message</h2>
                    <form @submit.prevent="submitForm" class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                            <input 
                                v-model="form.name"
                                type="text" 
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                placeholder="Your name"
                            />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input 
                                v-model="form.email"
                                type="email" 
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                placeholder="your@email.com"
                            />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                            <input 
                                v-model="form.subject"
                                type="text" 
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                placeholder="What is this about?"
                            />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                            <textarea 
                                v-model="form.message"
                                rows="6" 
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                placeholder="Tell us more..."
                            ></textarea>
                        </div>
                        <button 
                            type="submit"
                            :disabled="submitting"
                            class="w-full px-8 py-4 bg-primary-600 text-white rounded-lg font-semibold hover:bg-primary-700 transition-colors flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            <svg v-if="!submitting" class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <svg v-else class="animate-spin w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            {{ submitting ? 'Sending...' : 'Send Message' }}
                        </button>
                        <div v-if="submitMessage" class="mt-4 p-4 rounded-lg" :class="submitMessage.includes('Thank you') ? 'bg-green-50 text-green-800 border border-green-200' : 'bg-red-50 text-red-800 border border-red-200'">
                            {{ submitMessage }}
                        </div>
                    </form>
                </div>

                <!-- Contact Info -->
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Get in Touch</h2>
                    <p class="text-gray-600 mb-8">
                        We're here to help! Whether you have a question, suggestion, or just want to say hello, 
                        feel free to reach out to us.
                    </p>

                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Email</h3>
                                <p class="text-gray-600">support@onlinetools.com</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Response Time</h3>
                                <p class="text-gray-600">Usually within 24 hours</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Support</h3>
                                <p class="text-gray-600">24/7 through contact form</p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Section -->
                    <div class="mt-12 bg-gray-50 rounded-2xl p-6">
                        <h3 class="font-bold text-gray-900 mb-4">Frequently Asked Questions</h3>
                        <div class="space-y-4">
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1">Are all tools really free?</h4>
                                <p class="text-sm text-gray-600">Yes! All our tools are 100% free with no hidden costs.</p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1">Do I need to create an account?</h4>
                                <p class="text-sm text-gray-600">No registration required. Just visit and use any tool instantly.</p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1">Can I suggest a new tool?</h4>
                                <p class="text-sm text-gray-600">Absolutely! We love hearing your ideas. Use the form to share your suggestions.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';
import axios from 'axios';

defineProps({
    seo: Object,
});

const form = ref({
    name: '',
    email: '',
    subject: '',
    message: '',
});

const submitting = ref(false);
const submitMessage = ref('');

const submitForm = async () => {
    submitting.value = true;
    submitMessage.value = '';
    
    try {
        const response = await axios.post('/api/contact', form.value);
        
        if (response.data.success) {
            submitMessage.value = response.data.message;
            form.value = {
                name: '',
                email: '',
                subject: '',
                message: '',
            };
        }
    } catch (error) {
        console.error('Contact form error:', error);
        console.error('Error response:', error.response);
        
        if (error.response) {
            // Server responded with error
            submitMessage.value = error.response.data?.message || `Error: ${error.response.status} - ${error.response.statusText}`;
        } else if (error.request) {
            // Request made but no response
            submitMessage.value = 'No response from server. Please check your connection.';
        } else {
            // Something else happened
            submitMessage.value = error.message || 'Sorry, there was an error sending your message. Please try again later.';
        }
    } finally {
        submitting.value = false;
    }
};
</script>
