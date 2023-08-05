<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[url('/img/halaman.jpg')] bg-cover">
        <div>
            <Link href="/">
            <ApplicationLogo class="w-auto h-auto fill-current text-black font-bold text-2xl uppercase" />
            </Link>
        </div>

        <div class="w-full sm:max-w-md  bg-transparent shadow-md overflow-hidden sm:rounded-lg relative">
            <div class="absolute w-full h-full bg-gray-900 opacity-70 -z-0"></div>
            <div class="w-full h-full relative z-50 mt-6 px-6 py-4">
                <slot />
            </div>
        </div>
    </div>
</template>
