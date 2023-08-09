<script setup>
import { ref, defineProps, computed } from 'vue';
import HomeLayout from '@/Layouts/HomeLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { useForm, usePage } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import loadingAnimation from '@/Components/loadingAnimation.vue';
const props = defineProps({
    kamar: {
        type: Object,
        default: () => ({}),
    },
    user: {
        type: Object,
        default: () => ({}),
    },
    jumlah_tamu: Number,
    tipe: String,
    tgl_masuk: String,
    tgl_keluar: String,
})
const item = JSON.parse(localStorage.getItem('checkoutItem'));
const pesanan = JSON.parse(localStorage.getItem('pesanan'));
const sub_total = ref(item.tipe.harga);
const form = useForm({
    tipe: props.kamar.tipe.tipe,
    kode_kamar: props.kamar.kode,
    diskon: '',
    sub_total: props.kamar.tipe.harga,
    status: 'PENDING',
    tgl_masuk: props.tgl_masuk,
    tgl_keluar: props.tgl_keluar,
    jumlah_tamu: props.jumlah_tamu,

    // User
    user_email: props.user.email,
    user_name: props.user.name,
    user_no_hp: props.user.detail.no_hp,

    // Metode Pembayaran
    metode_bayar: 'Tunai',
    ket: '',
})
const loadingPage = ref(false);
const ErrorPage = ref([])
function checkout() {
    form.get(route('Checkout.checkout'), {
            onBefore: () => {
                loadingPage.value=true;
            },
            onFinish:()=>{
                loadingPage.value = false;
            },
            onError: (err) => {
                ErrorPage.value = err;
                console.log(err)
            },
        });
}
</script>

<template>
    <HomeLayout>
        <Head title="Checkout Pemesanan Kamar"/>
        <loadingAnimation :show="loadingPage"/>
        <section class="container mx-auto py-12">
            <div class="flex flex-col items-center border-b bg-white py-4 sm:flex-row sm:px-10 lg:px-20 xl:px-32">
                <a href="#" class="text-2xl font-bold text-gray-800">Wisma Malaqbi</a>
                <div class="mt-4 py-2 text-xs sm:mt-0 sm:ml-auto sm:text-base">
                    <div class="relative">
                        <ul class="relative flex w-full items-center justify-between space-x-2 sm:space-x-4">
                            <li class="flex items-center space-x-3 text-left sm:space-x-4">
                                <a class="flex h-6 w-6 items-center justify-center rounded-full bg-emerald-200 text-xs font-semibold text-emerald-700"
                                    href="#"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg></a>
                                <span class="font-semibold text-gray-900">Booking Kamar</span>
                            </li>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                            <li class="flex items-center space-x-3 text-left sm:space-x-4">
                                <a class="flex h-6 w-6 items-center justify-center rounded-full bg-gray-600 text-xs font-semibold text-white ring ring-gray-600 ring-offset-2"
                                    href="#">2</a>
                                <span class="font-semibold text-gray-900">Pemesanan</span>
                            </li>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                            <li class="flex items-center space-x-3 text-left sm:space-x-4">
                                <a class="flex h-6 w-6 items-center justify-center rounded-full bg-gray-400 text-xs font-semibold text-white"
                                    href="#">3</a>
                                <span class="font-semibold text-gray-500">Payment</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="w-full list-item sm:px-10 lg:px-20 xl:px-32">
                <li class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 " v-for="err in form.errors" :key="err">
                    <span class="font-medium">Danger alert!</span> {{ err }}
                </li>
            </ul>
            <form @submit.prevent="checkout" class="grid sm:px-10 lg:grid-cols-2 lg:px-20 xl:px-32">
                <div class="px-4 pt-8">
                    <p class="text-xl font-medium">Detail Pesanan kamar</p>
                    <p class="text-gray-400">Cek pilihan kamar kamu. dan pilih metode pembayaran.</p>
                    <div class="mt-8 space-y-3 rounded-lg border bg-white px-2 py-4 sm:px-6">
                        <div class="flex flex-col rounded-lg bg-white sm:flex-row">
                            <img class="m-2 h-24 w-28 rounded-md border object-cover object-center"
                                :src="item.foto.path_gambar" alt="" />
                            <div class="flex w-full flex-col px-4 py-4">
                                <span class="font-semibold">{{ item.tipe.tipe }} - {{ item.ruangan }}</span>
                                <span class="float-right text-gray-400">Fasilitas</span>
                                <div class="block my-1" v-for="col in item.details">
                                    <div class="flex gap-2 items-center" v-if="col.jenis !== 'gambar'">
                                        <font-awesome-icon :icon="['fas', 'gear']" class="text-gray-400" />
                                        <dl class="block">
                                            <dt class="text-xs whitespace-pre-wrap w-1/2 capitalize">{{ col.detail }}</dt>
                                        </dl>
                                    </div>
                                </div>
                                <p class="text-lg font-bold">{{ item.tipe.rupiah }}</p>
                            </div>
                        </div>
                    </div>

                    <p class="mt-8 text-lg font-medium">Metode Pembayaran {{ form.metode_bayar }}</p>
                    <div class="mt-5 grid gap-6" >
                        <div class="relative">
                            <input class="peer hidden" id="radio_1" type="radio" name="metodeBayar" value="Tunai"
                                v-model="form.metode_bayar" />
                            <span
                                class="peer-checked:border-gray-700 absolute right-4 top-1/2 box-content block h-3 w-3 -translate-y-1/2 rounded-full border-8 border-gray-300 bg-white"></span>
                            <label
                                class="peer-checked:border-2 peer-checked:border-gray-700 peer-checked:bg-gray-50 flex items-center cursor-pointer select-none rounded-lg border border-gray-300 p-4"
                                for="radio_1">

                                <font-awesome-icon :icon="['fas', 'wallet']" class="w-14 text-2xl object-contain" />
                                <div class="ml-5">
                                    <span class="mt-2 font-semibold">Tunai</span>
                                </div>
                            </label>
                        </div>
                        <div class="relative">
                            <input class="peer hidden" id="radio_2" type="radio" name="metodeBayar" value="Transfer"
                                v-model="form.metode_bayar" />
                            <span
                                class="peer-checked:border-gray-700 absolute right-4 top-1/2 box-content block h-3 w-3 -translate-y-1/2 rounded-full border-8 border-gray-300 bg-white"></span>
                            <label
                                class="peer-checked:border-2 peer-checked:border-gray-700 peer-checked:bg-gray-50 flex cursor-pointer select-none rounded-lg border border-gray-300 p-4"
                                for="radio_2">
                                <font-awesome-icon :icon="['fas', 'wallet']" class="w-14 text-2xl object-contain" />

                                <div class="ml-5">
                                    <span class="mt-2 font-semibold">Transfer</span>
                                </div>
                            </label>

                        </div>
                        <Transition name="fade">
                            <table class="table w-full" v-if="form.metode_bayar == 'Transfer'">
                                <caption class="table-caption">
                                    <h3 class="capitalize text-base">Kirim Pembayaran Anda Ke NO. Rekening Di Bawah Ini</h3>
                                </caption>
                                <tr>
                                    <th class="border">Nama</th>
                                    <td class="border">: Wisma Malaqbi</td>
                                </tr>
                                <tr>
                                    <th class="border">No. Rek</th>
                                    <td class="border">: 1982991001</td>
                                </tr>
                                <tr>
                                    <th class="border">Bank</th>
                                    <td class="border">: BRI</td>
                                </tr>
                            </table>
                        </Transition>
                    </div>
                </div>
                <div class="mt-10 bg-gray-50 px-4 pt-8 lg:mt-0">
                    <p class="text-xl font-medium">Detail Pengguna</p>
                    <p class="text-gray-400">Complete your order by providing your payment details.</p>
                    <div class="">
                        <label for="email" class="mt-4 mb-2 block text-sm font-medium">Email</label>
                        <div class="relative">
                            <input type="text" id="email" name="email" v-model="form.user_email"
                                class="w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                placeholder="your.email@gmail.com" />
                            <div class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>
                        </div>
                        <label for="card-holder" class="mt-4 mb-2 block text-sm font-medium">Nama Pemesan</label>
                        <div class="relative">
                            <input type="text" id="card-holder" name="card-holder" v-model="form.user_name"
                                class="w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm uppercase shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                placeholder="Your full name here" />
                            <div class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
                                </svg>
                            </div>
                        </div>

                        <label for="billing-address" class="mt-4 mb-2 block text-sm font-medium">Catatan Pembayaran</label>
                        <div class="flex flex-col">
                            <div class="relative flex-shrink-0 w-full">
                                <input type="text" id="billing-description" name="billing-description" v-model="form.ket"
                                    class="w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="Catatan" />
                                <div class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
                                    <font-awesome-icon :icon="['fas', 'comments']" class="text-gray-400" />
                                </div>

                            </div>
                            <InputError :message="form.errors.ket" />
                        </div>

                        <!-- Total -->
                        <div class="mt-6 flex items-center justify-between">
                            <p class="text-sm font-medium text-gray-900">Total</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ item.tipe.rupiah }}</p>
                        </div>
                    </div>
                    <button type="submit"
                        class="mt-4 mb-8 w-full rounded-md bg-gray-900 px-6 py-3 font-medium text-white">Lanjutkan
                        Pemesanan</button>
                </div>
            </form>

        </section>
    </HomeLayout>
</template>

<style>
.fade-enter-active,
.fade-enter-leave {
    transition: all 0.5s ease;
}

.fade-enter-from,
.fade-enter-to {
    opacity: 0;
    transform: translateX(30px);
}</style>
