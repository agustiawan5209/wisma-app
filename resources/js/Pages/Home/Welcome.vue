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
        <section class="container mx-auto my-4 h-40-vh sm:h-60-vh md:h-80-vh rounded-6xl mb-5 overflow-hidden">
            <Carousel></Carousel>
        </section>

    </HomeLayout>
</template>
