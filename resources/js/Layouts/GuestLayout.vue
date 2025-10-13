<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link, usePage } from '@inertiajs/vue3';

const page = usePage();
</script>

<template>
    <div
        class="flex min-h-screen flex-col items-center bg-gray-100 pt-6 sm:justify-center sm:pt-0"
    >
        <div>
            <Link href="/">
                <!-- Show footer_logo if exists, otherwise show regular logo, fallback to ApplicationLogo -->
                <div v-if="page.props.settings?.footer_logo" class="h-20 rounded-lg overflow-hidden">
                    <img :src="`/storage/${page.props.settings.footer_logo}`" :alt="page.props.settings?.site_name || 'Logo'" class="h-full w-auto object-contain" />
                </div>
                <div v-else-if="page.props.settings?.logo" class="h-20 rounded-lg overflow-hidden">
                    <img :src="`/storage/${page.props.settings.logo}`" :alt="page.props.settings?.site_name || 'Logo'" class="h-full w-auto object-contain" />
                </div>
                <ApplicationLogo v-else class="h-20 w-20 fill-current text-gray-500" />
            </Link>
        </div>

        <div
            class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>
