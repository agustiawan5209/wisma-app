<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div
        class=" w-full h-screen overflow-auto md:overflow-hidden ">
        <div class="w-full h-full flex flex-row ">
            <div class="w-1/2 h-full hidden md:block relative bg-[url('/img/halaman.jpg')] bg-cover">
                <div class="absolute bg-gray-800 opacity-60 w-full h-full z-0"></div>
                <div class="w-full h-full flex justify-center items-center ">
                    <Link href="/" class="z-50 ">
                    <ApplicationLogo class="w-full h-auto fill-current text-white font-bold text-2xl uppercase" />
                    </Link>
                </div>

            </div>
            <div class="w-full md:w-1/2 h-max md:h-full flex justify-center items-center md:px-10 md:py-20 overflow-auto">
                <div class="w-full bg-transparent overflow-hidden relative z-50 mt-6 px-6 py-4 shadow-sm rounded-lg border border-gray-400">
                    <div class="w-full relative ">
                        <slot />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
