<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { ref, defineProps } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    voucher: {
        type: Object,
        default: () => ({})
    },
});

function back(){
    window.history.back()
}
</script>

<template>
    <AuthenticatedLayout>

        <template #header>

            <Head :title="voucher.kode" />
            Detail {{ voucher.kode }}
        </template>
        <template #content>
            <section class="p-3 w-full bg-white rounded-md shadow-md">
                <div class="max-w-full">
                    <PrimaryButton @click="back" class="w-1/4 bg-red-500 hover:bg-red-600 focus:bg-red-800">Kembali</PrimaryButton>

                    <table class="w-full table-auto">
                        <caption class="table-caption border-b-2">Detail Voucher {{ voucher.kode }}</caption>

                        <tr class="border-b border-black ">
                            <th class="py-2 w-1/4 text-left capitalize">Kode Voucher</th>
                            <td class="py-2 text-left"> : {{ voucher.kode }}</td>
                        </tr>
                        <tr class="border-b border-black ">
                            <th class="py-2 w-1/4 text-left capitalize">potongan voucher</th>
                            <td class="py-2 text-left"> : {{ voucher.potongan }}%</td>
                        </tr>
                        <tr class="border-b border-black ">
                            <th class="py-2 w-1/4 text-left capitalize">Tanggal Mulai voucher</th>
                            <td class="py-2 text-left"> : {{ voucher.tgl_mulai }}</td>
                        </tr>
                        <tr class="border-b border-black ">
                            <th class="py-2 w-1/4 text-left capitalize">Tanggal Berakhir voucher</th>
                            <td class="py-2 text-left"> : {{ voucher.tgl_mulai }}</td>
                        </tr>
                        <tr class="border-b border-black ">
                            <th class="py-2 w-1/4 text-left capitalize">Batas Pengguna voucher</th>
                            <td class="py-2 text-left"> : {{ voucher.max_user }}</td>
                        </tr>

                    </table>
                    <table>

                    </table>
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
