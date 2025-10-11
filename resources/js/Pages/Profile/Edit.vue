<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>
    <AdminLayout>
        <Head title="Profile Settings" />

        <div class="space-y-6">
            <!-- Profile Header -->
            <div class="bg-gradient-to-r from-primary-600 to-primary-700 rounded-2xl p-8 text-white shadow-lg">
                <div class="flex items-center space-x-6">
                    <div class="w-24 h-24 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center text-4xl">
                        👤
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold mb-2">Profile Settings</h1>
                        <p class="text-primary-100">Manage your account information and security</p>
                    </div>
                </div>
            </div>

            <!-- Profile Information -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">Profile Information</h2>
                        <p class="text-sm text-gray-600">Update your account's profile information and email address</p>
                    </div>
                </div>
                <UpdateProfileInformationForm
                    :must-verify-email="mustVerifyEmail"
                    :status="status"
                />
            </div>

            <!-- Update Password -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">Update Password</h2>
                        <p class="text-sm text-gray-600">Ensure your account is using a long, random password to stay secure</p>
                    </div>
                </div>
                <UpdatePasswordForm />
            </div>

            <!-- Delete Account -->
            <div class="bg-white rounded-2xl shadow-lg border border-red-100 p-8">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-red-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">Delete Account</h2>
                        <p class="text-sm text-gray-600">Permanently delete your account and all associated data</p>
                    </div>
                </div>
                <DeleteUserForm />
            </div>
        </div>
    </AdminLayout>
</template>
