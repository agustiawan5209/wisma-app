<script setup>
import HomeLayout from '@/Layouts/HomeLayout.vue'
import Carousel from '@/Components/Carousel.vue';
import { Link, Head } from '@inertiajs/vue3';
import { ref, defineProps } from 'vue';
</script>

<template>
    <HomeLayout>

        <Head title="Home" />
        <section class="w-full h-40-vh sm:h-60-vh md:h-screen mb-20 overflow-hidden">
            <Carousel></Carousel>
        </section>
    </HomeLayout>
</template>
