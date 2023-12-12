<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { defineProps, ref, watch } from 'vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import Modal from '@/Components/Modal.vue';
import Pagination from '@/Components/Pagination.vue';
import FlashMessage from '@/Components/FlashMessage.vue';

const props = defineProps({
    transaksi: {
        type: Object,
        default: () => ({}),
    },

})


const rupiah = (num) => {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
    }).format(num);
}

const FormDate = useForm({
    min_date: '',
    max_date: '',
});
function searchDate() {
    FormDate.get(route('Laporan.index'), {
        preserveState: true,
        onError: (err) => {
            console.log(err)
        }
    })
}
let config = {
    responseType: 'blob',
}
function exportExcel(){
    axios.get(route('Laporan.cetakEXCEL',{
        max_date: FormDate.max_date,
        min_date: FormDate.min_date,
    }), config).then((res)=>{
       var fileExcel = URL.createObjectURL(new Blob([res.data]));
       var fileLink = document.createElement('a');
       fileLink.href  = fileExcel;
       fileLink.setAttribute('download', 'laporan.xlsx')
    //    document.body.appendChild(fileLink);
       fileLink.click()
    }).catch(err=>console.log(err))
}
function exportPDF(){
    axios.get(route('Laporan.cetakPDF',{
        max_date: FormDate.max_date,
        min_date: FormDate.min_date,
    }), config).then((res)=>{
       var fileExcel = URL.createObjectURL(new Blob([res.data]));
       var fileLink = document.createElement('a');
       fileLink.href  = fileExcel;
       fileLink.setAttribute('download', 'laporan.pdf')
    //    document.body.appendChild(fileLink);
       fileLink.click()
    }).catch(err=>console.log(err))
}
</script>

<template>
    <Head title="Transaksi" />

    <AuthenticatedLayout>
        <template #header>
            Transaksi Pemesanan Kamar
            <FlashMessage />
        </template>

        <template #content>
            <section class="bg-transparent px-3 sm:px-5">

                <!-- Start coding here -->
                <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden px-4">
                    <div
                        class="flex flex-col gap-7 items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                        <div class="w-full">
                            <form class="flex flex-wrap items-center" @submit.prevent="searchDate">
                                <div class="">
                                    <input id="min_date" type="date" v-model="FormDate.min_date" placeholder="Tanggal Awal" class="w-full rounded-md focus:ring-1">
                                </div>
                                <div class="">
                                    <input id="max_date" type="date" v-model="FormDate.max_date" placeholder="Tanggal Akhir" class="w-full rounded-md focus:ring-1">
                                </div>
                                <PrimaryButton>CARI Tanggal</PrimaryButton>
                            </form>
                        </div>
                        <div class="w-full">
                            <form class="flex gap-3 flex-wrap items-center" >
                                <!-- <PrimaryButton type="button" @click="exportPDF" class="bg-red-500 hover:bg-red-600 focus:bg-red-700 text-white">
                                    <span>Cetak PDF</span>
                                    <font-awesome-icon class="ml-2 text-lg" :icon="['fas', 'file-pdf']" />
                                </PrimaryButton> -->
                                <PrimaryButton type="button" @click="exportExcel" class="bg-emerald-500 hover:bg-emerald-600 focus:bg-emerald-700 text-white">
                                    <span>Cetak EXCEL </span>
                                    <font-awesome-icon class="ml-2 text-lg" :icon="['fas', 'file-excel']" />
                                </PrimaryButton>
                            </form>
                        </div>

                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                                <tr>
                                    <th scope="col" class="border">No.</th>
                                    <th scope="col" class="px-4 py-3 border">kode Transaksi</th>
                                    <th scope="col" class="px-4 py-3 border">Tanggal Transaksi</th>
                                    <th scope="col" class="px-4 py-3 border">kode Reservasi</th>
                                    <th scope="col" class="px-4 py-3 border">Nama Pelanggan</th>
                                    <th scope="col" class="px-4 py-3 border">No.HP Pelanggan</th>
                                    <th scope="col" class="px-4 py-3 border">Kode Kamar</th>
                                    <th scope="col" class="px-4 py-3 border">Jumlah Tamu</th>
                                    <th scope="col" class="px-4 py-3 border">Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in transaksi.data" class="border-b ">
                                    <th class="border text-center">{{ (transaksi.current_page - 1) * transaksi.per_page +
                                        index + 1
                                    }}.</th>
                                    <td class="px-4 py-3 border">{{ item.transaksi.kode_transaksi }}</td>
                                    <td class="px-4 py-3 border">{{ item.transaksi.tanggal }}</td>
                                    <td class="px-4 py-3 border">{{ item.kode_reservasi }}</td>
                                    <td class="px-4 py-3 border">{{ item.detail.nama }}</td>
                                    <td class="px-4 py-3 border">{{ item.detail.no_hp }}</td>
                                    <td class="px-4 py-3 border">{{ item.kode_kamar }}</td>
                                    <td class="px-4 py-3 border">{{ item.jumlah_tamu }}</td>
                                    <td class="px-4 py-3 border">{{ rupiah(item.transaksi.sub_total) }}</td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <Pagination :links="transaksi.links" />
                </div>
            </section>


        </template>
    </AuthenticatedLayout>
</template>
