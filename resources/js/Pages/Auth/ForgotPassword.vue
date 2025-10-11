<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <div class="min-h-screen flex">
        <Head title="Forgot Password" />

        <!-- Left Side - Gradient Background -->
        <div class="hidden lg:flex lg:w-1/2 relative bg-gradient-to-br from-primary-600 via-primary-700 to-purple-800 overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; viewBox=&quot;0 0 60 60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;none&quot; fill-rule=&quot;evenodd&quot;%3E%3Cg fill=&quot;%23ffffff&quot; fill-opacity=&quot;1&quot;%3E%3Cpath d=&quot;M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z&quot;/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
            </div>

            <div class="relative flex flex-col justify-center items-center w-full px-12 text-white">
                <div class="max-w-md">
                    <div class="flex items-center space-x-3 mb-8">
                        <div class="w-16 h-16 bg-white/10 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                            <span class="text-4xl">🛠️</span>
                        </div>
                        <h1 class="text-3xl font-bold">Online Tools</h1>
                    </div>
                    <h2 class="text-4xl font-bold mb-4">Reset Password</h2>
                    <p class="text-xl text-primary-100 mb-8">
                        Don't worry! Enter your email and we'll send you a reset link.
                    </p>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-primary-100">Quick & secure process</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-primary-100">Check your email inbox</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-primary-100">Create a new password</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-gray-50">
            <div class="w-full max-w-md">
                <!-- Logo for mobile -->
                <div class="lg:hidden flex items-center justify-center space-x-2 mb-8">
                    <div class="w-12 h-12 bg-gradient-to-br from-primary-500 to-primary-700 rounded-lg flex items-center justify-center">
                        <span class="text-2xl">🛠️</span>
                    </div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-primary-600 to-primary-800 bg-clip-text text-transparent">
                        Online Tools
                    </span>
                </div>

                <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                    <div class="mb-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">Forgot Password?</h2>
                        <p class="text-gray-600">
                            No problem. Just enter your email address and we'll send you a password reset link.
                        </p>
                    </div>

                    <div v-if="status" class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg text-sm">
                        {{ status }}
                    </div>

                    <form @submit.prevent="submit" class="space-y-6">
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                            <input
                                id="email"
                                type="email"
                                v-model="form.email"
                                required
                                autofocus
                                autocomplete="username"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                placeholder="admin@example.com"
                            />
                            <p v-if="form.errors.email" class="mt-2 text-sm text-red-600">{{ form.errors.email }}</p>
                        </div>

                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="w-full px-6 py-4 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-xl font-semibold hover:from-primary-700 hover:to-primary-800 transition-all transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none shadow-lg"
                        >
                            <span v-if="!form.processing">Email Password Reset Link</span>
                            <span v-else class="flex items-center justify-center">
                                <svg class="animate-spin h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Sending...
                            </span>
                        </button>
                    </form>

                    <div class="mt-6 text-center space-y-2">
                        <Link :href="route('login')" class="block text-sm text-primary-600 hover:text-primary-700 font-medium">
                            ← Back to Login
                        </Link>
                        <Link :href="route('home')" class="block text-sm text-gray-600 hover:text-primary-600 font-medium">
                            Back to Homepage
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
