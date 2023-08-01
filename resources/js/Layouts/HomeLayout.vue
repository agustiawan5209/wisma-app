<script setup>
import { Link, Head } from '@inertiajs/vue3';
import {ref, defineProps} from 'vue'
import Carousel from '@/Components/Carousel.vue';
</script>


<template>
    <header class="h-max bg-primary flex flex-col justify-center">
        <div class="w-full h-2/3 bg-white pl-0 sm:pl-10 md:pl-20">
            <div class="logo w-max h-full">
                <img src="vite.svg" class="w-24 h-24 rounded-full shadow-sm" alt="logo wisma malaqbi">
            </div>
        </div>
        <nav class="w-full h-1/3 bg-transparent flex justify-center items-center">
            <ul class=" inline-flex space-x-4 h-full w-max">
                <li class="nav-home flex flex-col justify-center items-center  hover:bg-white text-white font-bold hover:text-gray-900 transition">
                    <Link class="px-3 md:px-8 py-1 md:py-1.5 font-sans text-xl">Home</Link>
                </li>
                <li class="nav-home flex flex-col justify-center items-center  hover:bg-white text-white font-bold hover:text-gray-900 transition">
                    <Link class="px-3 md:px-8 py-1 md:py-1.5 font-sans text-xl">Tentang Kami</Link>
                </li>
                <li class="nav-home flex flex-col justify-center items-center  hover:bg-white text-white font-bold hover:text-gray-900 transition">
                    <Link class="px-3 md:px-8 py-1 md:py-1.5 font-sans text-xl">Kontak</Link>
                </li>
                <li class="nav-home flex flex-col justify-center items-center  hover:bg-white text-white font-bold hover:text-gray-900 transition">
                    <Link class="px-3 md:px-8 py-1 md:py-1.5 font-sans text-xl">Blog</Link>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <slot/>
    </main>
</template>
