<script setup>
import HomeLayout from '@/Layouts/HomeLayout.vue'
import Carousel from '@/Components/Carousel.vue';
import { Link, Head } from '@inertiajs/vue3';
import { ref, defineProps, onMounted } from 'vue';
import Animate from '@/Components/Animate.vue';
import Reservasi from './Reservasi.vue';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

// Inisialisasi GSAP dan aktifkan ScrollTrigger
gsap.registerPlugin(ScrollTrigger);

const props = defineProps({
    tipe_kamar: {
        type: Object,
        default: () => ({}),
    },
})

const roomVVIP = ref(null);
onMounted(() => {
    function initScrollAnimations() {
        gsap.from(roomVVIP.value, {
            scale: 0.5,
            y: 50,
            duration: 1,
            ease: 'circ.out',
            scrollTrigger: {
                trigger: roomVVIP.value,
                start: 'top 80%',
                end: 'top 50%',
                scrub: true,
            },
        });
    }
    initScrollAnimations();
})
</script>

<template>
    <HomeLayout>

        <Head title="Home" />
        <section class="container w-full flex flex-wrap justify-center gap-2 mx-auto my-4  mb-5 overflow-hidden">

            <div class="w-72 rounded-md shadow-lg border" v-for="item in tipe_kamar">
                <img v-if="item.foto !== null" :src="item.path_foto" :alt="item.id"
                    class="object-cover object-center w-full rounded-t-md h-72 ">
                <div class="flex flex-col justify-between p-6 space-y-8">
                    <div class="space-y-2">
                        <h2 class="text-3xl font-semibold tracki">{{ item.tipe }}</h2>
                        <p class=""></p>
                    </div>
                    <Link :href="route('Home.room')"
                        class="flex items-center justify-center w-full p-3 font-semibold tracki rounded-md bg-primary text-white">Pesan Sekarang</Link>
                </div>
            </div>
        </section>

        <section class="container px-3 mx-auto h-auto mb-5 py-2">
            <Reservasi :tipe_kamar="tipe_kamar"></Reservasi>
        </section>
        <section class="container mx-auto">


        </section>
</HomeLayout></template>
