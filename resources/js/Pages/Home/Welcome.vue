<script setup>
import HomeLayout from '@/Layouts/HomeLayout.vue'
import Carousel from '@/Components/Carousel.vue';
import { Link, Head } from '@inertiajs/vue3';
import { ref, defineProps } from 'vue';
import Animate from '@/Components/Animate.vue';
import Reservasi from './Reservasi.vue';

const props = defineProps({
    tipe_kamar: {
        type: Object,
        default: () => ({}),
    },
})
</script>

<template>
    <HomeLayout>

        <Head title="Home" />
        <section class="container mx-auto my-4 h-40-vh sm:h-60-vh md:h-80-vh rounded-6xl mb-5 overflow-hidden">
            <Carousel></Carousel>
        </section>

        <section class="container px-3 mx-auto h-auto mb-5">
            <Reservasi :tipe_kamar="tipe_kamar"></Reservasi>
        </section>
    </HomeLayout>
</template>
