<script setup>
import { Head, Link } from '@inertiajs/vue3';
import UserLayout from '@/Layouts/UserLayout.vue';
import { defineProps } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    reservasi:{
        type: Object,
        default:()=>({})
    }
})

const rupiah = (num)=>{
    return new Intl.NumberFormat("id-ID",{
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
                <div class="bg-white rounded-lg shadow p-4">
                    <h2 class="text-2xl font-bold mb-4">Selamat Datang, {{ $page.props.auth.user.name }}</h2>
                    <p>Selamat datang di dashboard pengguna Anda. Di sini Anda dapat mengelola profil Anda, melihat
                        pemesanan yang telah Anda buat, dan mengatur preferensi pengguna.</p>
                </div>

                <div class="bg-white rounded-lg shadow mt-4 p-4">
                    <h2 class="text-2xl font-bold mb-4">Pemesanan Terakhir</h2>
                    <div class="flex items-center mb-4">
                        <div class="w-1/4">
                            <img :src="reservasi.detail.kamar.foto.path_gambar" alt="Room Image" class="w-full rounded-lg">
                        </div>
                        <div class="w-3/4 ml-4">
                            <h3 class="text-lg font-semibold">{{ reservasi.detail.tipe_kamar }}</h3>
                            <p class="text-gray-600">Check-in: {{ reservasi.tgl_masuk }}</p>
                            <p class="text-gray-600">Check-out: {{ reservasi.tgl_keluar }}</p>
                            <p class="text-gray-600">Harga: {{ rupiah(reservasi.transaksi.sub_total) }}</p>
                            <Link :href="route('User.invoice', {kode: reservasi.kode_reservasi})" class="text-gray-600">
                                <PrimaryButton type="button">Invoice</PrimaryButton>
                            </Link>
                        </div>
                    </div>
                    <Link :href="route('User.reservasi')" class="text-blue-500 font-semibold">Lihat semua pemesanan</Link>
                </div>
            </div>
        </section>
    </UserLayout>
</template>
