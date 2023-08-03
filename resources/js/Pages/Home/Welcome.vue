<script setup>
import HomeLayout from '@/Layouts/HomeLayout.vue'
import Carousel from '@/Components/Carousel.vue';
import { Link, Head } from '@inertiajs/vue3';
import { ref, defineProps } from 'vue';
import Animate from '@/Components/Animate.vue';
</script>

<template>
    <HomeLayout>

        <Head title="Home" />
        <section class="w-full h-40-vh sm:h-60-vh md:h-screen mb-5 overflow-hidden">
            <Carousel></Carousel>
        </section>

        <section class="container mx-auto flex flex-wrap justify-center gap-4 mb-10">
            <div class="w-1/4 h-64 px-4 bg-primary shadow-md rounded-lg flex flex-col items-center justify-center">
                <div class=" border text-center rounded-2xl p-2 mb-2 text-white">
                    <font-awesome-icon class="text-2xl" :icon="['fas', 'home']" />
                    <h1>Fasilitas</h1>
                </div>
                <div class="px-3 bg-red-200 rounded-lg shadow-sm">
                    <p class="text-xs md:text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat
                        inventore esse numquam quasi in reprehenderit tempore, commodi nostrum nemo possimus fugiat
                        voluptatum est, unde ea voluptatem temporibus. Maiores, recusandae. Quibusdam.</p>
                </div>
            </div>
            <div class="w-1/4 h-64 px-4 bg-primary shadow-md rounded-lg flex flex-col items-center justify-center">
                <div class=" border text-center rounded-2xl p-2 mb-2 text-white">
                    <font-awesome-icon class="text-2xl" :icon="['fas', 'home']" />
                    <h1>Fasilitas</h1>
                </div>
                <div class="px-3 bg-red-200 rounded-lg shadow-sm">
                    <p class="text-xs md:text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat
                        inventore esse numquam quasi in reprehenderit tempore, commodi nostrum nemo possimus fugiat
                        voluptatum est, unde ea voluptatem temporibus. Maiores, recusandae. Quibusdam.</p>
                </div>
            </div>
            <div class="w-1/4 h-64 px-4 bg-primary shadow-md rounded-lg flex flex-col items-center justify-center">
                <div class=" border text-center rounded-2xl p-2 mb-2 text-white">
                    <font-awesome-icon class="text-2xl" :icon="['fas', 'home']" />
                    <h1>Fasilitas</h1>
                </div>
                <div class="px-3 bg-red-200 rounded-lg shadow-sm">
                    <p class="text-xs md:text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat
                        inventore esse numquam quasi in reprehenderit tempore, commodi nostrum nemo possimus fugiat
                        voluptatum est, unde ea voluptatem temporibus. Maiores, recusandae. Quibusdam.</p>
                </div>
        </div>
    </section>
</HomeLayout></template>
