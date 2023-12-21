<script setup>
import HomeLayout from '@/Layouts/HomeLayout.vue'
import Carousel from '@/Components/Carousel.vue';
import { Link, Head } from '@inertiajs/vue3';
import { ref, defineProps } from 'vue'
</script>

<template>
    <HomeLayout>

        <Head title="Home" />
        <div class="p-5 mx-auto sm:p-10 md:p-16 bg-gray-800 text-gray-100">
            <div class="flex flex-col max-w-3xl mx-auto overflow-hidden rounded">
                <img :src="'/img/3.jpg'" alt="" class="w-full h-60 sm:h-96 bg-gray-500">
                <div
                    class="p-6 pb-12 m-4 mx-auto -mt-16 space-y-6 lg:max-w-2xl sm:px-10 sm:mx-12 lg:rounded-md bg-gray-900">
                    <div class="space-y-2">
                        <a rel="noopener noreferrer" href="#" class="inline-block text-2xl font-semibold sm:text-3xl">Wisma
                            Malaqbi</a>

                    </div>
                    <div class="text-gray-100">
                        <p>Wisma Malaqbi adalah sebuah destinasi penginapan yang menghadirkan kenyamanan dan kemewahan bagi
                            setiap tamu yang menginap. Terletak di lokasi strategis, wisma ini menawarkan pengalaman
                            menginap yang istimewa dengan empat jenis kamar yang memenuhi berbagai kebutuhan, yaitu VVIP,
                            VIP, Deluxe, dan Ekonomis.
                        <ul class="space-y-4 pt-4 list-decimal pl-5">
                            <li>
                                VVIP: <br>
                                Kamar VVIP Wisma Malaqbi adalah pilihan utama bagi mereka yang menginginkan tingkat privasi
                                dan kemewahan tertinggi. Dengan desain interior yang elegan dan fasilitas premium, kamar ini
                                memberikan pengalaman menginap yang luar biasa. Tamu dapat menikmati pemandangan indah,
                                layanan kamar 24 jam, serta akses eksklusif ke fasilitas-fasilitas unggulan.
                            </li>
                            <li>
                                VIP:
                                <br>
                                Kamar VIP dirancang untuk memberikan kenyamanan ekstra dengan sentuhan kemewahan. Dekorasi
                                yang
                                modern dan perabotan berkualitas tinggi menciptakan suasana yang hangat dan menyenangkan.
                                Fasilitas
                                yang disediakan termasuk layanan kamar, televisi layar datar, dan akses mudah ke berbagai
                                fasilitas
                                umum di dalam wisma.
                            </li>
                            <li>
                                Deluxe:
                                <br>
                                Kamar Deluxe menyuguhkan keseimbangan sempurna antara kenyamanan dan nilai estetika. Dengan
                                ruang
                                yang luas dan desain yang modern, kamar ini menawarkan tempat istirahat yang nyaman bagi
                                tamu.
                                Fasilitas seperti kamar mandi pribadi, AC, dan area istirahat membuat pengalaman menginap
                                semakin
                                menyenangkan.
                            </li>
                            <li>
                                Ekonomis:
                                <br>
                                Bagi wisatawan yang mencari opsi penginapan yang lebih terjangkau, kamar Ekonomis Wisma
                                Malaqbi
                                adalah pilihan yang ideal. Meskipun harga terjangkau, kamar ini tetap menyediakan kenyamanan
                                dan
                                fasilitas yang memadai. Suasana ramah dan layanan yang baik membuat tamu merasa di rumah
                                selama masa
                                menginap mereka.
                            </li>
                    </ul>
                    </p>
                </div>
            </div>
        </div>
    </div>
</HomeLayout></template>
