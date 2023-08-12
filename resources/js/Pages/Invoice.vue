<script setup>
import { defineProps } from 'vue';

const props = defineProps(['reservasi'])

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
const Bulan = [
    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', "oktober", 'November', 'Desember',
]
function today() {
    var tgl = new Date();

    return tgl.getDate() + ' ' + Bulan[tgl.getMonth()] + ' ' + tgl.getFullYear();
}
</script>

<template>
    <div>
        <div class="bg-white rounded-lg p-6">
            <div>
                <h2 class="text-xl font-bold mb-4 text-gray-800">Detail Transaksi</h2>
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <p class="text-gray-600 font-semibold">ID Transaksi:</p>
                        <p class="text-sm font-bold text-indigo-700">{{
                            reservasi.transaksi.kode_transaksi }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 font-semibold">Tanggal:</p>
                        <p class="text-sm font-bold text-indigo-700">{{
                            date(reservasi.transaksi.created_at) }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 font-semibold">Metode Pembayaran:</p>
                        <p class="text-sm font-bold text-indigo-700">{{
                            reservasi.transaksi.metode_bayar }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 font-semibold">Potongan/Diskon Pembayaran:</p>
                        <p class="text-sm font-bold text-indigo-700">{{
                            rupiah(reservasi.transaksi.diskon) }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 font-semibold">Total Pembayaran:</p>
                        <p class="text-sm font-bold text-indigo-700">{{
                            rupiah(reservasi.transaksi.sub_total) }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 font-semibold">Status Pembayaran:</p>
                        <p class="text-sm font-bold text-indigo-700">{{ reservasi.transaksi.status }}
                        </p>
                    </div>
                </div>

            </div>
            <hr class="my-4 border-gray-300">

            <div>
                <h2 class="text-xl font-bold mt-2 text-gray-800">Detail Reservasi</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-600 font-semibold">Kode Reservasi:</p>
                        <p class=" text-sm font-bold text-indigo-700">{{ reservasi.kode_reservasi }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 font-semibold">Status Reservasi:</p>
                        <p class=" text-sm font-bold text-indigo-700">{{ reservasi.status }}</p>
                    </div>
                </div>
            </div>
            <hr class="my-4 border-gray-300">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-600 font-semibold">Nama Tamu:</p>
                    <p class=" text-sm font-bold text-indigo-700">{{ reservasi.detail.nama }}</p>
                </div>
                <div>
                    <p class="text-gray-600 font-semibold">Email Tamu:</p>
                    <p class=" text-sm font-bold text-indigo-700">{{ reservasi.detail.email }}</p>
                </div>
                <div>
                    <p class="text-gray-600 font-semibold">Jumlah Tamu:</p>
                    <p class=" text-sm font-bold text-indigo-700">{{ reservasi.jumlah_tamu }}</p>
                </div>
                <div>
                    <p class="text-gray-600 font-semibold">Nomor Tamu:</p>
                    <p class=" text-sm font-bold text-indigo-700">{{ reservasi.detail.no_hp }}</p>
                </div>
            </div>
            <hr class="my-4 border-gray-300">


            <div class="grid grid-cols-2 gap-4">
                <div class="mt-2">
                    <p class="text-gray-600 font-semibold">Tipe Kamar:</p>
                    <p class=" text-sm font-bold text-indigo-700">{{ reservasi.detail.tipe_kamar }}</p>
                </div>

                <div class="mt-2">
                    <p class="text-gray-600 font-semibold">Tanggal Check-in:</p>
                    <p class=" text-sm font-bold text-indigo-700">{{ reservasi.tgl_masuk }}</p>
                </div>

                <div class="mt-2">
                    <p class="text-gray-600 font-semibold">Kode Kamar:</p>
                    <p class=" text-sm font-bold text-indigo-700">{{ reservasi.detail.kode_kamar }}</p>
                </div>

                <div class="mt-2">
                    <p class="text-gray-600 font-semibold">Tanggal Check-out:</p>
                    <p class=" text-sm font-bold text-indigo-700">{{ reservasi.tgl_keluar }}</p>
                </div>
            </div>

            <div class="flex justify-end w-full mt-20">
                <div class="mt-2 col-start-2 text-center  mr-20">
                    <p class="text-gray-600 font-semibold">Mammuju, {{ today() }}</p>
                    <img :src="'../img/qrCode.png'" alt="QR Code Wisma Malaqbi">
                    <p class=" text-sm font-semibold text-gray-900">Dir. Wisma Malaqbi</p>
                </div>
            </div>

            <!-- Add more details as needed -->
        </div>
    </div>
</template>
