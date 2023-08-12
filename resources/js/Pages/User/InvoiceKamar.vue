<script setup>
import { Head, Link } from '@inertiajs/vue3';
import UserLayout from '@/Layouts/UserLayout.vue';
import { defineProps } from 'vue';
const props = defineProps({
    reservasi: {
        type: Object,
        default: () => ({})
    }
})

const rupiah = (num) => {
    return new Intl.NumberFormat("id-ID", {
        style: 'currency',
        currency: 'IDR',
    }).format(num)
}
</script>

<template>
    <UserLayout>

        <Head title="Dashboard User" />
        <section class="w-full">
            <div class="w-3/4 ml-4">
                <div class="w-full mx-auto py-8">
                    <div class="bg-white w-full rounded-lg shadow p-8">
                        <h2 class="text-2xl font-bold mb-4">Invoice Pemesanan Kamar Hotel</h2>

                        <div class="flex justify-between mb-6">
                            <div>
                                <h3 class="text-lg font-semibold">Hotel ABC</h3>
                                <p>Jl. Contoh No. 123, Kota, Negara</p>
                            </div>
                            <div>
                                <p>Tanggal: 12 Agustus 2023</p>
                                <p>Nomor Invoice: INV12345</p>
                            </div>
                        </div>

                        <div class="mb-6">
                            <h4 class="text-lg font-semibold">Detail Pemesanan</h4>
                            <table class="w-full mt-4">
                                <thead>
                                    <tr>
                                        <th class="py-2">Kamar</th>
                                        <th class="py-2">Check-in</th>
                                        <th class="py-2">Check-out</th>
                                        <th class="py-2">Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-2">Kamar Deluxe</td>
                                        <td class="py-2">15 Agustus 2023</td>
                                        <td class="py-2">20 Agustus 2023</td>
                                        <td class="py-2">Rp 2.500.000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="flex justify-end">
                            <div class="w-1/2">
                                <table class="w-full">
                                    <tbody>
                                        <tr>
                                            <td class="py-2">Subtotal:</td>
                                            <td class="py-2 text-right">Rp 2.500.000</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2">Pajak:</td>
                                            <td class="py-2 text-right">Rp 250.000</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2">Total:</td>
                                            <td class="py-2 text-right">Rp 2.750.000</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="mt-8">
                            <h4 class="text-lg font-semibold">Informasi Pembayaran</h4>
                            <p class="mt-4">Silakan lakukan pembayaran ke rekening berikut:</p>
                            <ul class="mt-2">
                                <li>Bank: Bank ABC</li>
                                <li>Nomor Rekening: 1234567890</li>
                                <li>Nama Penerima: Hotel ABC</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </UserLayout>
</template>
