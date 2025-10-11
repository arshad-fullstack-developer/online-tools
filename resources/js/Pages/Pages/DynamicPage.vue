<template>
    <AppLayout>
        <Head>
            <title>{{ seo.title }}</title>
            <meta name="description" :content="seo.description" />
            <meta name="keywords" :content="seo.keywords" />
            <meta v-if="seo.og_image" property="og:image" :content="seo.og_image" />
        </Head>

        <!-- Hero Section -->
        <div class="relative bg-gradient-to-br from-primary-600 via-primary-700 to-purple-800 text-white py-20 overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; viewBox=&quot;0 0 60 60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;none&quot; fill-rule=&quot;evenodd&quot;%3E%3Cg fill=&quot;%23ffffff&quot; fill-opacity=&quot;1&quot;%3E%3Cpath d=&quot;M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z&quot;/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
            </div>
            
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-5xl md:text-6xl font-bold mb-4">{{ page.title }}</h1>
                <p v-if="page.excerpt" class="text-xl text-primary-100 max-w-3xl mx-auto">
                    {{ page.excerpt }}
                </p>
            </div>
        </div>

        <!-- Featured Image -->
        <div v-if="page.featured_image" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10">
            <img 
                :src="page.featured_image" 
                :alt="page.title"
                class="w-full h-64 object-cover rounded-2xl shadow-2xl"
            />
        </div>

        <!-- Tools Page Special Layout -->
        <div v-if="isToolsPage && categories" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div v-for="category in categories" :key="category.id" class="mb-16">
                <!-- Category Header -->
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center space-x-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-primary-400 to-primary-600 rounded-2xl flex items-center justify-center">
                            <span class="text-2xl">{{ getCategoryIcon(category.icon) }}</span>
                        </div>
                        <div>
                            <h2 class="text-3xl font-bold text-gray-900">{{ category.name }}</h2>
                            <p class="text-gray-600">{{ category.description }}</p>
                        </div>
                    </div>
                    <Link 
                        :href="route('categories.show', category.slug)"
                        class="hidden md:inline-flex items-center px-4 py-2 text-primary-600 hover:text-primary-700 font-medium"
                    >
                        View All
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </Link>
                </div>
                
                <!-- Tools Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <Link
                        v-for="tool in category.tools"
                        :key="tool.id"
                        :href="route('tools.show', tool.slug)"
                        class="group bg-white rounded-xl p-6 shadow-md hover:shadow-2xl transition-all duration-300 cursor-pointer border-2 border-transparent hover:border-primary-400 transform hover:-translate-y-1"
                    >
                        <div class="flex items-start space-x-4 mb-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-primary-400 to-primary-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <span class="text-2xl">{{ getToolIcon(tool.icon) }}</span>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-lg text-gray-900 group-hover:text-primary-600 transition-colors mb-2">
                                    {{ tool.name }}
                                </h3>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-4 line-clamp-2">
                            {{ tool.description }}
                        </p>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-primary-600 font-semibold group-hover:underline">
                                Use Tool →
                            </span>
                        </div>
                    </Link>
                </div>
            </div>
        </div>

        <!-- About Page Special Layout -->
        <div v-else-if="page.slug === 'about'" class="py-20">
            <!-- Mission Section -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 class="text-4xl font-bold text-gray-900 mb-6">Our Mission</h2>
                        <div class="prose prose-lg" v-html="page.content"></div>
                    </div>
                    <div class="bg-gradient-to-br from-primary-50 to-primary-100 rounded-2xl p-8">
                        <div class="space-y-6">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-primary-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 mb-2">100% Free Forever</h3>
                                    <p class="text-gray-600">All our tools are completely free with no hidden costs.</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-primary-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 mb-2">Privacy First</h3>
                                    <p class="text-gray-600">We don't track, store, or share your data.</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-primary-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 mb-2">Lightning Fast</h3>
                                    <p class="text-gray-600">All tools run instantly in your browser.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Section -->
            <div class="bg-gray-900 text-white py-16 mb-20">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                        <div>
                            <div class="text-5xl font-bold text-primary-400 mb-2">10+</div>
                            <div class="text-gray-400">Tools Available</div>
                        </div>
                        <div>
                            <div class="text-5xl font-bold text-primary-400 mb-2">100%</div>
                            <div class="text-gray-400">Free Forever</div>
                        </div>
                        <div>
                            <div class="text-5xl font-bold text-primary-400 mb-2">0</div>
                            <div class="text-gray-400">Registration Required</div>
                        </div>
                        <div>
                            <div class="text-5xl font-bold text-primary-400 mb-2">24/7</div>
                            <div class="text-gray-400">Always Available</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Values Section -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-4xl font-bold text-gray-900 text-center mb-12">Our Core Values</h2>
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <span class="text-3xl">🎯</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Simplicity</h3>
                        <p class="text-gray-600">No complicated interfaces, just tools that work.</p>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-700 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <span class="text-3xl">🚀</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Innovation</h3>
                        <p class="text-gray-600">Always looking for new ways to solve problems.</p>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-700 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <span class="text-3xl">❤️</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Community</h3>
                        <p class="text-gray-600">Built by users, for users.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Regular Page Content -->
        <div v-else class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="max-w-4xl mx-auto">
                <div 
                    class="prose prose-lg max-w-none"
                    v-html="page.content"
                ></div>
            </div>
        </div>

        <!-- Contact Page Special Layout -->
        <div v-if="page.slug === 'contact'" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
            <div class="grid md:grid-cols-2 gap-12">
                <!-- Contact Form -->
                <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Send us a Message</h2>
                    <p class="text-gray-600 mb-8">We'll get back to you within 24 hours</p>
                    <form @submit.prevent="submitContactForm" class="space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                            <input 
                                v-model="contactForm.name"
                                type="text" 
                                required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                placeholder="John Doe"
                            />
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                            <input 
                                v-model="contactForm.email"
                                type="email" 
                                required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                placeholder="john@example.com"
                            />
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Subject</label>
                            <input 
                                v-model="contactForm.subject"
                                type="text" 
                                required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                placeholder="How can we help?"
                            />
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Message</label>
                            <textarea 
                                v-model="contactForm.message"
                                rows="6" 
                                required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all resize-none"
                                placeholder="Tell us more about your inquiry..."
                            ></textarea>
                        </div>
                        <button 
                            type="submit"
                            :disabled="submitting"
                            class="w-full px-8 py-4 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-xl font-semibold hover:from-primary-700 hover:to-primary-800 transition-all transform hover:scale-105 flex items-center justify-center shadow-lg disabled:opacity-50 disabled:cursor-not-allowed"
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
                        <div v-if="submitMessage" class="mt-4 p-4 rounded-xl" :class="submitMessage.includes('Thank you') ? 'bg-green-50 text-green-800 border border-green-200' : 'bg-red-50 text-red-800 border border-red-200'">
                            {{ submitMessage }}
                        </div>
                    </form>
                </div>

                <!-- Contact Info -->
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Get in Touch</h2>
                    <div class="prose prose-lg mb-8" v-html="page.content"></div>

                    <div class="space-y-6">
                        <div class="flex items-start space-x-4 bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-2xl">
                            <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-700 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 mb-1 text-lg">Email Us</h3>
                                <p class="text-gray-700 font-medium">support@onlinetools.com</p>
                                <p class="text-sm text-gray-600 mt-1">We reply within 24 hours</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4 bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-2xl">
                            <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-700 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 mb-1 text-lg">Response Time</h3>
                                <p class="text-gray-700 font-medium">Usually within 24 hours</p>
                                <p class="text-sm text-gray-600 mt-1">Monday - Friday, 9AM - 6PM</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4 bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-2xl">
                            <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-700 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 mb-1 text-lg">Support</h3>
                                <p class="text-gray-700 font-medium">24/7 through contact form</p>
                                <p class="text-sm text-gray-600 mt-1">Always here to help you</p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Section -->
                    <div class="mt-8 bg-gray-50 rounded-2xl p-6 border border-gray-200">
                        <h3 class="font-bold text-gray-900 mb-4 text-lg">Quick Questions</h3>
                        <div class="space-y-4">
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1">Are all tools really free?</h4>
                                <p class="text-sm text-gray-600">Yes! 100% free with no hidden costs.</p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1">Do I need to create an account?</h4>
                                <p class="text-sm text-gray-600">No registration required. Use instantly!</p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1">Can I suggest a new tool?</h4>
                                <p class="text-sm text-gray-600">Absolutely! Use the form above to share your ideas.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';
import axios from 'axios';

const props = defineProps({
    page: Object,
    seo: Object,
    categories: Array,
    isToolsPage: Boolean,
});

const contactForm = ref({
    name: '',
    email: '',
    subject: '',
    message: '',
});

const iconMap = {
    'type': '📝',
    'calendar': '📅',
    'dollar-sign': '💰',
    'code': '💻',
    'text': '🔤',
    'braces': '{}',
    'link': '🔗',
    'cake': '🎂',
    'calendar-range': '📆',
    'percent': '%',
    'calculator': '🧮',
    'binary': '01',
    'key': '🔑',
    'activity': '💪',
    'heart': '❤️',
    'scale': '⚖️',
    'fire': '🔥',
    'droplet': '💧',
    'body': '🧍',
    'health': '🏥',
    'code': '💻',
    'map': '🗺️',
    'trending-up': '📈',
    'chart': '📊',
    'cpu': '🤖',
    'coins': '💰',
};

const getCategoryIcon = (icon) => iconMap[icon] || '🛠️';
const getToolIcon = (icon) => iconMap[icon] || '⚙️';

const formatNumber = (num) => {
    if (num >= 1000000) return (num / 1000000).toFixed(1) + 'M';
    if (num >= 1000) return (num / 1000).toFixed(1) + 'K';
    return num;
};

const submitting = ref(false);
const submitMessage = ref('');

const submitContactForm = async () => {
    submitting.value = true;
    submitMessage.value = '';
    
    try {
        const response = await axios.post('/api/contact', contactForm.value);
        
        if (response.data.success) {
            submitMessage.value = response.data.message;
            contactForm.value = {
                name: '',
                email: '',
                subject: '',
                message: '',
            };
        }
    } catch (error) {
        submitMessage.value = error.response?.data?.message || 'Sorry, there was an error sending your message. Please try again later.';
    } finally {
        submitting.value = false;
    }
};
</script>

<style scoped>
.prose {
    color: #374151;
}

.prose h2 {
    font-size: 2rem;
    font-weight: 700;
    margin-top: 2rem;
    margin-bottom: 1rem;
    color: #111827;
}

.prose h3 {
    font-size: 1.5rem;
    font-weight: 600;
    margin-top: 1.5rem;
    margin-bottom: 0.75rem;
    color: #111827;
}

.prose p {
    margin-bottom: 1rem;
    line-height: 1.75;
}

.prose ul, .prose ol {
    margin-left: 1.5rem;
    margin-bottom: 1rem;
}

.prose li {
    margin-bottom: 0.5rem;
}

.prose a {
    color: #0ea5e9;
    text-decoration: underline;
}

.prose a:hover {
    color: #0284c7;
}
</style>
