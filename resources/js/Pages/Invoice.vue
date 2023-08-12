<script setup>
import { defineProps } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps(['reservasi'])

function printSelectedHTML() {
    var printContent = document.getElementById("printable-content").innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContent;
    window.print();
    document.body.innerHTML = originalContents;

}
const Bulan = [
    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', "oktober", 'November', 'Desember',
]
const date = (date) => {
    const tgl = new Date(date);

    return tgl.getDate() + ' ' + Bulan[tgl.getMonth()] + ' ' + tgl.getFullYear();
}
const rupiah = (num) => {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
    }).format(num);
}

function today() {
    var tgl = new Date();

    return tgl.getDate() + ' ' + Bulan[tgl.getMonth()] + ' ' + tgl.getFullYear();
}
</script>

<template>
    <div>
        <PrimaryButton @click="printSelectedHTML" class="w-1/4">
            <font-awesome-icon :icon="['fas', 'print']" /> Print Bukti Pemesanan Kamar
        </PrimaryButton>
        <div class="container mx-auto box-border relative" id="printable-content">
            <div class="bg-white rounded-lg p-6">
                <div class="w-full mx-auto py-8">
                    <div class="bg-white w-full rounded-lg shadow p-8">
                        <h2 class="text-2xl font-bold mb-4">Invoice Pemesanan Kamar Wisma Malaqbi</h2>

                        <div class="flex justify-between mb-6">
                            <div>
                                <h3 class="text-sm md:text-lg font-semibold">Wisma Malaqbi</h3>
                                <p>Jl. Pababari, Karema, <br> Kec. Mamuju, Kabupaten Mamuju, Sulawesi Barat 91512</p>
                            </div>
                            <div>
                                <p>Tanggal: {{ date(reservasi.transaksi.created_at) }}</p>
                                <p>ID Transaksi: <b>{{ reservasi.transaksi.kode_transaksi }}</b></p>
                            </div>
                        </div>

                        <div class="mb-6">
                            <h4 class="text-sm md:text-lg font-semibold">Detail Pemesanan</h4>
                            <table class="w-full mt-4">
                                <thead>
                                    <tr>
                                        <th class="py-2 border text-center">Kamar</th>
                                        <th class="py-2 border text-center">Check-in</th>
                                        <th class="py-2 border text-center">Check-out</th>
                                        <th class="py-2 border text-center">Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-2 border text-center">Kamar {{ reservasi.detail.tipe_kamar }}</td>
                                        <td class="py-2 border text-center">{{ reservasi.tgl_masuk }}</td>
                                        <td class="py-2 border text-center">{{ reservasi.tgl_keluar }}</td>
                                        <td class="py-2 border text-center">{{ rupiah(reservasi.transaksi.sub_total) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <table class="mb-2">
                            <caption class="text-sm md:text-lg font-semibold">Detail Pengguna</caption>
                            <tbody class="mt-2">
                                <tr>
                                    <td>Nama</td>
                                    <td>: {{ reservasi.detail.nama }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>: {{ reservasi.detail.email }}</td>
                                </tr>
                                <tr>
                                    <td>No. Telepon</td>
                                    <td>: {{ reservasi.detail.no_hp }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="flex justify-end">
                            <div class="w-1/2">
                                <table class="w-full">
                                    <tbody>
                                        <tr>
                                            <td class="py-2">Subtotal:</td>
                                            <td class="py-2 text-right">{{ rupiah(Number(reservasi.transaksi.sub_total +
                                                reservasi.transaksi.diskon)) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2">Potongan:</td>
                                            <td class="py-2 text-right">{{ rupiah(reservasi.transaksi.diskon) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2">Total:</td>
                                            <td class="py-2 text-right">{{ rupiah(reservasi.transaksi.sub_total) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- <div class="mt-8">
                        <h4 class="text-sm md:text-lg font-semibold">Informasi Pembayaran</h4>
                        <p class="mt-4">Silakan lakukan pembayaran ke rekening berikut:</p>
                        <ul class="mt-2">
                            <li>Bank: Bank ABC</li>
                            <li>Nomor Rekening: 1234567890</li>
                            <li>Nama Penerima: Hotel ABC</li>
                        </ul>
                    </div> -->
                    </div>
                </div>

                <div class="flex justify-end w-full">
                    <div class="mt-2 col-start-2 grid place-content-center  mr-20">
                        <p class="text-gray-800 text-sm font-semibold">Mammuju, {{ today() }}</p>
                        <img :src="'../img/qrCode.png'" class="w-32" alt="QR Code Wisma Malaqbi">
                        <p class=" text-sm font-semibold text-gray-900">Dir. Wisma Malaqbi</p>
                    </div>
                </div>

                <!-- Add more details as needed -->
            </div>
        </div>

    </div>
</template>
