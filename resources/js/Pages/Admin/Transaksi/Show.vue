<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { ref, defineProps } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    reservasi: {
        type: Object,
        default: () => ({})
    },
});

function back() {
    window.history.back()
}

const date = (date) => {
    const tgl = new Date(date);

    return tgl.toLocaleDateString();
}
const rupiah = (num) => {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
    }).format(num);
}
</script>

<template>
    <AuthenticatedLayout>

        <template #header>

            <Head :title="reservasi.kode_reservasi" />
            Detail {{ reservasi.kode_reservasi }}
        </template>
        <template #content>
            <section class="p-3 w-full bg-white rounded-md shadow-md">
                <div class="max-w-full">
                    <PrimaryButton @click="back" class="w-1/4 bg-red-500 hover:bg-red-600 focus:bg-red-800">Kembali
                    </PrimaryButton>

                    <div class="container mx-auto p-4">
                        <div class="bg-white rounded-lg shadow-lg p-6">
                            <h2 class="text-2xl font-bold mb-4 text-gray-800">Detail Transaksi</h2>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="mb-6" v-if="reservasi.transaksi.bukti != null">
                                    <h4 class="text-sm md:text-lg font-semibold">Bukti Pemesanan</h4>
                                    <img :src="reservasi.transaksi.bukti_path" alt="" width="100" height="200">
                                </div>
                                <div>
                                    <p class="text-gray-600 font-semibold">ID Transaksi:</p>
                                    <p class="text-sm md:text-lg font-bold text-indigo-700">{{
                                        reservasi.transaksi.kode_transaksi }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 font-semibold">Tanggal:</p>
                                    <p class="text-sm md:text-lg font-bold text-indigo-700">{{
                                        date(reservasi.transaksi.created_at) }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 font-semibold">Metode Pembayaran:</p>
                                    <p class="text-sm md:text-lg font-bold text-indigo-700">{{
                                        reservasi.transaksi.metode_bayar }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 font-semibold">Potongan/Diskon Pembayaran:</p>
                                    <p class="text-sm md:text-lg font-bold text-indigo-700">{{
                                        rupiah(reservasi.transaksi.diskon) }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 font-semibold">Total Pembayaran:</p>
                                    <p class="text-sm md:text-lg font-bold text-indigo-700">{{
                                        rupiah(reservasi.transaksi.sub_total) }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 font-semibold">Status Pembayaran:</p>
                                    <p class="text-sm md:text-lg font-bold text-indigo-700">{{ reservasi.transaksi.status }}
                                    </p>
                                </div>
                            </div>

                            <hr>
                            <h2 class="text-2xl font-bold mt-4 text-gray-800">Detail Reservasi</h2>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-gray-600 font-semibold">Kode Reservasi:</p>
                                    <p class="text-lg font-bold text-indigo-700">{{ reservasi.kode_reservasi }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 font-semibold">Status:</p>
                                    <p class="text-lg font-bold text-indigo-700">{{ reservasi.status }}</p>
                                </div>
                            </div>
                            <hr class="my-4 border-gray-300">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-gray-600 font-semibold">Nama Tamu:</p>
                                    <p class="text-lg font-bold text-indigo-700">{{ reservasi.detail.nama }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 font-semibold">Email Tamu:</p>
                                    <p class="text-lg font-bold text-indigo-700">{{ reservasi.detail.email }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 font-semibold">Jumlah Tamu:</p>
                                    <p class="text-lg font-bold text-indigo-700">{{ reservasi.jumlah_tamu }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 font-semibold">Nomor Tamu:</p>
                                    <p class="text-lg font-bold text-indigo-700">{{ reservasi.detail.no_hp }}</p>
                                </div>
                            </div>
                            <hr class="my-4 border-gray-300">


                           <div class="grid grid-cols-2 gap-4">
                            <div class="mt-4">
                                <p class="text-gray-600 font-semibold">Tipe Kamar:</p>
                                <p class="text-lg font-bold text-indigo-700">{{ reservasi.detail.tipe_kamar }}</p>
                            </div>

                            <div class="mt-4">
                                <p class="text-gray-600 font-semibold">Tanggal Check-in:</p>
                                <p class="text-lg font-bold text-indigo-700">{{ reservasi.tgl_masuk }}</p>
                            </div>

                            <div class="mt-4">
                                <p class="text-gray-600 font-semibold">Kode Kamar:</p>
                                <p class="text-lg font-bold text-indigo-700">{{ reservasi.detail.kode_kamar }}</p>
                            </div>

                            <div class="mt-4">
                                <p class="text-gray-600 font-semibold">Tanggal Check-out:</p>
                                <p class="text-lg font-bold text-indigo-700">{{ reservasi.tgl_keluar }}</p>
                            </div>
                           </div>

                            <!-- Add more details as needed -->
                        </div>
                    </div>
                </div>
            </section>
        </template>

    </AuthenticatedLayout>
</template>


<style>
.fade-enter-active {
    transition: all 0.3s ease-out;
}

.fade-leave-active {
    transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}

.fade-enter-from,
.fade-leave-to {
    transform: translateX(30%);
    opacity: 0;
}</style>
