<script setup>
import HomeLayout from '@/Layouts/HomeLayout.vue'
import Carousel from '@/Components/Carousel.vue';
import { Link, Head, useForm } from '@inertiajs/vue3';
import { ref, defineProps, watch } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    kamar: {
        type: Object,
        default: () => ({}),
    },
    search: String,
})

const tipe = ref(null);
const tipeForm = useForm({})
watch(tipe, (value) => {
    tipeForm.get(route('Home.room', { tipe: value }), {
        preserveState: true,
        preserveScroll: true,
    })
})
</script>

<template>
    <HomeLayout>

        <Head title="Home" />
        <section class="container mx-auto py-3">
            <h1 class="font-bold sm:text-xl md:text-2xl lg:text-3xl pl-4">Rekomendasi Kamar Untuk Anda</h1>

            <!-- Filter Kamar -->
            <div class="flex max-w-sm">
                <select id="countries" v-model="tipe"
                    class="bg-white border text-gray-900 text-sm rounded-lg block w-full p-2.5 ">
                    <option value="">----</option>
                    <option value="Luxury">Luxury</option>
                    <option value="Ekonomis">Ekonomis</option>
                </select>
            </div>
            <!-- Grid Card Kamar -->
            <transition-group name="slide" tag="div"
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 border border-white">
                <div class="col-span-1 box-border h-auto bg-transaparent shadow-md shadow-gray-400 p-3"
                    v-for="item in kamar.data" :key="item.kode">
                    <fieldset class="shadow-lg shadow-gray-400 mb-5">
                        <img :src="'img/halaman.jpg'" alt="">
                    </fieldset>
                    <h3 class="drop-shadow-sm text-xl font-medium">{{ item.tipe_kamar }} <span class="text-sm font-normal text-gray-600">Kode Kamar</span></h3>
                    <p class="text-[0.6rem] md:text-sm text-gray-500" v-html="item.ket"></p>
                    <!-- Fasilitas Kamar -->
                    <div class="fasilitas flex flex-wrap gap-4 mt-3 box-border">
                        <div class="flex gap-2 items-center">
                            <font-awesome-icon :icon="['fas', 'gear']" class="text-gray-400" />
                            <dl class="block">
                                <dt class="text-xs sm:text-sm md:text-base">Fasilitas</dt>
                                <dt class="text-xs whitespace-pre-wrap">Lorem ipsum dolor sit amet.</dt>
                            </dl>
                        </div>
                        <div class="block" v-for="col in item.details">
                            <div class="flex gap-2 items-center" v-if="col.jenis !== 'gambar'">
                                <font-awesome-icon :icon="['fas', 'gear']" class="text-gray-400" />
                                <dl class="block">
                                    <dt class="text-xs sm:text-sm md:text-base">{{ col.jenis }}</dt>
                                    <dt class="text-xs whitespace-pre-wrap w-1/2">{{ col.detail }}</dt>
                                </dl>
                            </div>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <div class="flex flex-col xl:flex-row justify-between gap-2 xl:items-center mt-4">
                        <span class="text-xs sm:text-sm md:text-base whitespace-nowrap">Rp. 100.000</span>
                        <PrimaryButton type="button"
                            class="!text-xs whitespace-nowrap bg-red-200 hover:bg-red-300 active:bg-red-400 focus:bg-red-300 !text-yellow-600 active:!text-white">
                            Pesan
                            Sekarang</PrimaryButton>
                    </div>
                </div>
            </transition-group>

        </section>
    </HomeLayout>
</template>

<style>
.slide-enter-active,
.slide-enter-leave {
    transition: all ease-in 600ms;
}

.slide-enter-from,
.slide-leave-to {
    opacity: 0;
    transform: scale(0);
}
</style>
