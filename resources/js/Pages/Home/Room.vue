<script setup>
import HomeLayout from '@/Layouts/HomeLayout.vue'
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import TextInputIcon from '@/Components/TextInputIcon.vue';
import { Link, Head, useForm, usePage } from '@inertiajs/vue3';
import { ref, defineProps, watch, onMounted } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { gsap } from 'gsap';
import Modal from '@/Components/Modal.vue';
import loadingAnimation from '@/Components/loadingAnimation.vue';
import Reservasi from './Reservasi.vue';
const props = defineProps({
    kamar: {
        type: Object,
        default: () => ({}),
    },
    tipe_kamar: {
        type: Object,
        default: () => ({}),
    },
    search: String,
    formKamar: {
        type: Object,
        default: () => ({})
    },
    jumlah_tamu: Number,
    tipe: String,
    tgl_masuk: String,
    tgl_keluar: String,
})

const tipe = ref(null);
const tipeForm = useForm({})
watch(tipe, (value) => {
    tipeForm.get(route('Home.room', { tipe: value }), {
        preserveState: true,
        preserveScroll: true,
    })
})

// Localstorage Get data Pesanan
const ItemStorage = localStorage.getItem('pesanan');
const GetItem = ref({});
if (ItemStorage == null) {
    GetItem.value = {
        tipe: props.tipe,
        kode_kamar: '',
        diskon: '',
        tgl_masuk: props.tgl_masuk,
        tgl_keluar: props.tgl_keluar,
        jumlah_tamu: props.jumlah_tamu,
    }
} else {
    GetItem.value = JSON.parse(ItemStorage)
}
// Checkout Form
const checkoutForm = useForm({
    tipe: props.tipe,
    kode_kamar: '',
    diskon: '',
    tgl_masuk: GetItem.value.tgl_masuk,
    tgl_keluar: GetItem.value.tgl_keluar,
    jumlah_tamu: GetItem.value.jumlah_tamu,
})

//  Modal Checkout
const itemkamar = ref([]);
const showKamar = ref(false);

function showModal(item) {
    showKamar.value = true;
    itemkamar.value = item;
    checkoutForm.kode_kamar = item.kode;
    checkoutForm.tipe = item.tipe.tipe;
    checkoutForm.kode_kamar = item.kode;
    checkoutForm.tgl_masuk = GetItem.value.tgl_masuk == null ? props.tgl_masuk : GetItem.value.tgl_masuk;
    checkoutForm.tgl_keluar = GetItem.value.tgl_keluar == null ? props.tgl_keluar : GetItem.value.tgl_keluar;
    checkoutForm.jumlah_tamu = GetItem.value.jumlah_tamu == null ? props.jumlah_tamu : GetItem.value.jumlah_tamu;
}

function close() {
    showKamar.value = false;
    itemkamar.value = [];
}
// \Count Form
const count = ref(props.jumlah_tamu);

function plusGuest() {
    count.value++;
    checkoutForm.jumlah_tamu = count;
}
function minusGuest() {
    if (count.value >= 1) {
        count.value--;
    }
    checkoutForm.jumlah_tamu = count.value;
}
const ShowLoadingPage = ref(false);


// Fungsi Checkout Barang
function Checkout() {
    checkoutForm.get(route('Checkout.index'), {
        onBefore: () => {
            ShowLoadingPage.value = true;

            setInterval(() => {
                ShowLoadingPage.value = false;
            }, 2000);
        },
        onFinish: () => {
            ShowLoadingPage.value = false;
            const dataItem = checkoutForm.data();
            localStorage.setItem('pesanan', JSON.stringify(dataItem))
            localStorage.setItem('checkoutItem', JSON.stringify(itemkamar.value))
        },
        onError: (err) => {
            console.log(err)
        }
    })

}

function beforeEnter(el) {

    gsap.to(el, {
        scale: 0.5,
        duration: 1,
        // x: '-=100',
        ease: 'bounce.out',
    })
}

function enterActive(el) {


    gsap.to(el, {
        scale: 1,
        duration: 1,
        x: '0',
        ease: 'bounce.out',
    })

}

function afterEnter(el) {

    gsap.to(el, {
        scale: 1,
        duration: 1,
        x: '-=100',
        ease: 'bounce.out',
    })
}
</script>

<template>
    <HomeLayout>

        <Head title="Home" />
        <section class="container mx-auto py-3">
            <loadingAnimation :show="ShowLoadingPage" />
            <section>
                <Reservasi :tipe_kamar="tipe_kamar" />
            </section>

            <h1 class="font-bold sm:text-xl md:text-2xl lg:text-3xl pl-4">Rekomendasi Kamar Untuk Anda</h1>

            <!-- Filter Kamar -->
            <div class="flex max-w-sm">
                <select id="countries" v-model="tipe"
                    class="bg-white border text-gray-900 text-sm rounded-lg block w-full p-2.5 ">
                    <option value="">----</option>
                    <option v-for="item in tipe_kamar" :value="item.tipe">{{ item.tipe }}</option>

                </select>
            </div>
            <!-- Grid Card Kamar -->
            <transition-group tag="div" :on-before-enter="beforeEnter" :on-enter="enterActive" :on-before-leave="afterEnter"
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 border border-white">
                <div class="col-span-1" v-for="item in kamar.data" v-bind:key="item.id">
                    <div class="box-border h-auto bg-transaparent shadow-md shadow-gray-400 p-3 rounded-md">
                        <fieldset class="shadow-lg shadow-gray-400 mb-5">
                            <img :src="'img/halaman.jpg'" alt="">
                        </fieldset>
                        <h3 class="drop-shadow-sm text-xl font-medium">{{ item.tipe_kamar }} <span
                                class="text-sm font-normal text-gray-600">Kode Kamar</span></h3>
                        <p class="text-[0.6rem] md:text-sm text-gray-500" v-html="item.ket"></p>
                        <!-- Fasilitas Kamar -->
                        <div class="fasilitas flex flex-col gap-1 mt-3 box-border">
                            <div class="flex gap-2 items-center">
                                <dl class="block">
                                    <dt class="text-xs sm:text-sm md:text-base">Fasilitas</dt>
                                    <!-- <dt class="text-xs whitespace-pre-wrap">Lorem ipsum dolor sit amet.</dt> -->
                                </dl>
                            </div>
                            <div class="block" v-for="col in item.details">
                                <div class="flex gap-2 items-center" v-if="col.jenis !== 'gambar'">
                                    <font-awesome-icon :icon="['fas', 'gear']" class="text-gray-400" />
                                    <dl class="block">
                                        <dt class="text-xs whitespace-pre-wrap w-1/2 capitalize">{{ col.detail }}</dt>
                                    </dl>
                                </div>
                            </div>
                        </div>

                        <!-- Action Button -->
                        <div class="flex flex-col xl:flex-row justify-between gap-2 xl:items-center mt-4">
                            <span class="text-xs sm:text-sm md:text-base whitespace-nowrap">Rp. 100.000</span>
                            <PrimaryButton type="button" @click="showModal(item)"
                                class="!text-xs whitespace-nowrap bg-red-200 hover:bg-red-300 active:bg-red-400 focus:bg-red-300 !text-yellow-600 active:!text-white">
                                Detail</PrimaryButton>
                        </div>
                    </div>
                </div>
            </transition-group>


            <!-- Modal Checkout Kamar -->
            <Modal :show="showKamar">
                <div class="box-border h-auto bg-transaparent shadow-md shadow-gray-400 p-3 rounded-md relative">
                    <PrimaryButton @click="close"
                        class="absolute right-3 bg-transparent active:bg-transparent hover:bg-transparent focus:bg-transparent">
                        <font-awesome-icon :icon="['fas', 'xmark']" class="text-xl text-red-100 " />
                    </PrimaryButton>
                    <fieldset class="shadow-lg shadow-gray-400 mb-5">
                        <img :src="'img/halaman.jpg'" alt="">
                    </fieldset>
                    <h3 class="drop-shadow-sm text-xl font-medium">{{ itemkamar.tipe_kamar }} <span
                            class="text-sm font-normal text-gray-600">Kode Kamar</span></h3>
                    <p class="text-[0.6rem] md:text-sm text-gray-500" v-html="itemkamar.ket"></p>
                    <!-- Fasilitas Kamar -->
                    <div class="fasilitas flex flex-col gap-1 mt-3 box-border">
                        <div class="flex gap-2 items-center">
                            <dl class="block">
                                <dt class="text-xs sm:text-sm md:text-base">Fasilitas</dt>
                                <!-- <dt class="text-xs whitespace-pre-wrap">Lorem ipsum dolor sit amet.</dt> -->
                            </dl>
                        </div>
                        <div class="block" v-for="col in itemkamar.details">
                            <div class="flex gap-2 items-center" v-if="col.jenis !== 'gambar'">
                                <font-awesome-icon :icon="['fas', 'gear']" class="text-gray-400" />
                                <dl class="block">
                                    <dt class="text-xs whitespace-pre-wrap w-1/2 capitalize">{{ col.detail }}</dt>
                                </dl>
                            </div>
                        </div>
                    </div>


                    <!-- Form -->
                    <form class="block mt-3 space-y-3" @submit.prevent="Checkout">
                        <div class="block">
                            <InputLabel class="text-gray-700" for="tipe_kamar" value="Tipe Kamar" />
                            <TextInputIcon>
                                <template #input>
                                    <select id="countries" v-model="checkoutForm.tipe"
                                        class="bg-white border pl-11 text-gray-900 text-sm rounded-lg  block w-full p-2.5 "
                                        :class="checkoutForm.errors.tipe ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : 'border-blue-500 focus:ring-blue-500 focus:border-blue-500'"
                                        :required="false">
                                        <option value="">----</option>
                                        <option v-for="col in tipe_kamar" :value="col.tipe">{{ col.tipe }}</option>
                                    </select>
                                </template>
                                <template #icon>
                                    <font-awesome-icon :icon="['fas', 'list']" class="h-4 w-4 text-gray-400" />
                                </template>
                            </TextInputIcon>

                            <InputError :message="checkoutForm.errors.tipe" />
                        </div>
                        <div class="block">
                            <InputLabel class="text-gray-700" for="Tanggal Check In" value="Tanggal Check In" />
                            <TextInputIcon>
                                <template #input>
                                    <TextInput class="w-full pl-8" type="date" v-model="checkoutForm.tgl_masuk" required />
                                </template>
                                <template #icon>
                                    <font-awesome-icon :icon="['fas', 'calendar-days']" class="h-4 w-4 text-gray-400" />
                                </template>
                            </TextInputIcon>
                            <InputError :message="checkoutForm.errors.tgl_masuk" />
                        </div>
                        <div class="block">
                            <InputLabel class="text-gray-700" for="Tanggal Check Out" value="Tanggal Check Out" />
                            <TextInputIcon>
                                <template #input>
                                    <TextInput class="w-full pl-8" type="date" v-model="checkoutForm.tgl_keluar" required />
                                </template>
                                <template #icon>
                                    <font-awesome-icon :icon="['fas', 'calendar-days']" class="h-4 w-4 text-gray-400" />
                                </template>
                            </TextInputIcon>
                            <InputError :message="checkoutForm.errors.tgl_keluar" />
                        </div>
                        <div class="block">
                            <InputLabel class="text-gray-700" for="Jumlah_Tamu" value="Jumlah Tamu" />
                            <div class="flex flex-row">
                                <PrimaryButton type="button" @click="minusGuest"
                                    class="bg-transparent hover:bg-transparent focus:bg-transparent active:bg-transparent !border-none !ring-0 focus:!ring-0 focus:!border-none active:!ring-0 focus:outline-none outline-none active:border-none !px-3 !text-black">
                                    <font-awesome-icon :icon="['fas', 'minus']" />
                                </PrimaryButton>
                                <kbd class="p-2 !text-gray-700 font-bold">{{ count }}</kbd>
                                <PrimaryButton type="button" @click="plusGuest"
                                    class="bg-transparent hover:bg-transparent focus:bg-transparent active:bg-transparent !border-none !ring-0 focus:!ring-0 focus:!border-none active:!ring-0 focus:outline-none outline-none active:border-none !px-3 !text-black">
                                    <font-awesome-icon :icon="['fas', 'plus']" />
                                </PrimaryButton>
                            </div>
                            <InputError :message="checkoutForm.errors.jumlah_tamu" />
                        </div>
                        <!-- Action Button -->
                        <div class="flex flex-col xl:flex-row justify-between gap-2 xl:items-center mt-4">
                            <span class="text-xs sm:text-sm md:text-base whitespace-nowrap">Rp. 100.000</span>
                            <PrimaryButton type="submit"
                                class="!text-xs whitespace-nowrap bg-red-200 hover:bg-red-300 active:bg-red-400 focus:bg-red-300 !text-yellow-600 active:!text-white">
                                Pesan
                                Sekarang</PrimaryButton>
                        </div>
                    </form>
                    <!-- ./Form -->

                </div>
            </Modal>
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
