<script setup>
import { Link, Head } from '@inertiajs/vue3';
import { ref, defineProps } from 'vue'
import Carousel from '@/Components/Carousel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
</script>


<template>
    <header class="h-max bg-primary flex flex-col justify-center">
        <div class="w-full bg-white pl-0 sm:pl-10 md:pl-20 flex flow-row items-center justify-between">
            <div class="logo w-max h-full py-2">
                <img src="vite.svg" class="w-14 h-14 rounded-full shadow-lg " alt="logo wisma malaqbi">
            </div>
            <ul class="inline-flex space-x-2 py-2">
                <li class="">
                    <dl>
                        <dd>Telpon</dd>
                        <dt> 0823-4970-6696</dt>
                    </dl>
                </li>
                <li class="">
                    <dl>
                        <dd>Alamat</dd>
                        <dt> Jl. Pababari, Karema, Kec. Mamuju, Kabupaten Mamuju, Sulawesi Barat 91512</dt>
                    </dl>
                </li>
            </ul>
            <div class=" border-l border-black">
                <PrimaryButton>Masuk</PrimaryButton>
            </div>
        </div>
        <nav class="w-full h-1/3 bg-transparent flex justify-center items-center">
            <ul class=" inline-flex space-x-4 h-full w-max">
                <li
                    class="nav-home flex flex-col justify-center items-center  hover:bg-white text-white font-bold hover:text-gray-900 transition">
                    <Link :href="route('welcome')" class="px-3 md:px-8 py-1 md:py-1.5 font-sans text-xl">Home</Link>
                </li>
                <li
                    class="nav-home flex flex-col justify-center items-center  hover:bg-white text-white font-bold hover:text-gray-900 transition">
                    <Link :href="route('Home.about')" class="px-3 md:px-8 py-1 md:py-1.5 font-sans text-xl">Tentang Kami
                    </Link>
                </li>
                <li
                    class="nav-home flex flex-col justify-center items-center  hover:bg-white text-white font-bold hover:text-gray-900 transition">
                    <Link :href="route('Home.contact')" class="px-3 md:px-8 py-1 md:py-1.5 font-sans text-xl">Kontak</Link>
                </li>
                <li
                    class="nav-home flex flex-col justify-center items-center  hover:bg-white text-white font-bold hover:text-gray-900 transition">
                    <Link :href="route('Home.blog')" class="px-3 md:px-8 py-1 md:py-1.5 font-sans text-xl">Blog</Link>
                </li>
            </ul>
        </nav>
    </header>
    <main>
    <slot />
</main></template>
