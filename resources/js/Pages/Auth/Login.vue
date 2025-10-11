<script setup>
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const page = usePage();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <div class="min-h-screen flex">
        <Head title="Log in" />

        <!-- Left Side - Gradient Background -->
        <div class="hidden lg:flex lg:w-1/2 relative bg-gradient-to-br from-primary-600 via-primary-700 to-purple-800 overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; viewBox=&quot;0 0 60 60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;none&quot; fill-rule=&quot;evenodd&quot;%3E%3Cg fill=&quot;%23ffffff&quot; fill-opacity=&quot;1&quot;%3E%3Cpath d=&quot;M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z&quot;/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
            </div>

            <div class="relative flex flex-col justify-center items-center w-full px-12 text-white">
                <div class="max-w-md">
                    <div class="flex items-center justify-center mb-8">
                        <div v-if="page.props.settings?.logo" class="h-32 rounded-lg overflow-hidden">
                            <img :src="`/storage/${page.props.settings.logo}`" :alt="page.props.settings?.site_name || 'Logo'" class="h-full w-auto object-contain" />
                        </div>
                        <div v-else class="w-32 h-32 bg-white/10 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                            <span class="text-6xl">🛠️</span>
                        </div>
                    </div>
                    <h2 class="text-4xl font-bold mb-4">Welcome Back!</h2>
                    <p class="text-xl text-primary-100 mb-8">
                        Access your admin dashboard to manage tools, categories, and pages.
                    </p>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-primary-100">Manage all your tools</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-primary-100">View analytics & statistics</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-primary-100">Update content dynamically</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-gray-50">
            <div class="w-full max-w-md">
                <!-- Logo for mobile -->
                <div class="lg:hidden flex items-center justify-center mb-8">
                    <div v-if="page.props.settings?.logo" class="h-20 rounded-lg overflow-hidden">
                        <img :src="`/storage/${page.props.settings.logo}`" :alt="page.props.settings?.site_name || 'Logo'" class="h-full w-auto object-contain" />
                    </div>
                    <div v-else class="w-20 h-20 bg-gradient-to-br from-primary-500 to-primary-700 rounded-lg flex items-center justify-center">
                        <span class="text-4xl">🛠️</span>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                    <div class="mb-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">Sign In</h2>
                        <p class="text-gray-600">Enter your credentials to access your account</p>
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

                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                            <input
                                id="password"
                                type="password"
                                v-model="form.password"
                                required
                                autocomplete="current-password"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                placeholder="••••••••"
                            />
                            <p v-if="form.errors.password" class="mt-2 text-sm text-red-600">{{ form.errors.password }}</p>
                        </div>

                        <div class="flex items-center justify-between">
                            <label class="flex items-center">
                                <input
                                    type="checkbox"
                                    v-model="form.remember"
                                    class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500"
                                />
                                <span class="ml-2 text-sm text-gray-600">Remember me</span>
                            </label>

                            <Link
                                v-if="canResetPassword"
                                :href="route('password.request')"
                                class="text-sm font-medium text-primary-600 hover:text-primary-700"
                            >
                                Forgot password?
                            </Link>
                        </div>

                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="w-full px-6 py-4 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-xl font-semibold hover:from-primary-700 hover:to-primary-800 transition-all transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none shadow-lg"
                        >
                            <span v-if="!form.processing">Sign In</span>
                            <span v-else class="flex items-center justify-center">
                                <svg class="animate-spin h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Signing in...
                            </span>
                        </button>
                    </form>

                    <div class="mt-6 text-center">
                        <Link :href="route('home')" class="text-sm text-gray-600 hover:text-primary-600 font-medium">
                            ← Back to Homepage
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
