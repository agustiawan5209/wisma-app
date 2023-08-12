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
    search: String,
    tgl: String,

})
// Search Form
const SearchForm = useForm({});
const search = ref(props.search);

watch(search, (value) => {
    SearchForm.get(route('Transaksi.index', {
        search: value,
    }), {
        preserveState: true,
        preserveScroll: true,
    });
})


// Modal
const modalDelete = ref(false);
function showModaldelete(param) {
    modalDelete.value = true;
    FormDelete.slug = param;
}
function closeModal() {
    modalDelete.value = false;
    FormDelete.slug = null;
}

// Delete
const FormDelete = useForm({
    slug: null,
});
function DeleteTransaksi() {
    FormDelete.delete(route('Transaksi.delete'), {
        onSuccess: () => {
            modalDelete.value = false;
            FormDelete.reset()
        }
    })
}
const rupiah = (num) => {
  return new  Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
    }).format(num);
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
                        class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                        <div class="w-full md:w-1/2">
                            <form class="flex items-center">
                                <label for="simple-search" class="sr-only">Search</label>
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor"
                                            viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="text" id="simple-search" v-model="search"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 "
                                        placeholder="Search" required="">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                                <tr>
                                    <th scope="col" class="border">No.</th>
                                    <th scope="col" class="px-4 py-3 border">kode Transaksi</th>
                                    <th scope="col" class="px-4 py-3 border">kode Reservasi</th>
                                    <th scope="col" class="px-4 py-3 border">Kode Kamar</th>
                                    <th scope="col" class="px-4 py-3 border">Potongan</th>
                                    <th scope="col" class="px-4 py-3 border">Sub Total</th>
                                    <th scope="col" class="px-4 py-3 border">Status</th>
                                    <th scope="col" class="px-4 py-3 border">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in transaksi.data" class="border-b ">
                                    <th class="border text-center">{{ (transaksi.current_page - 1) * transaksi.per_page +
                                        index + 1
                                    }}.</th>
                                    <td class="px-4 py-3 border">{{ item.transaksi.kode_transaksi }}</td>
                                    <td class="px-4 py-3 border">{{ item.kode_reservasi }}</td>
                                    <td class="px-4 py-3 border">{{ item.kode_kamar }}%</td>
                                    <td class="px-4 py-3 border">{{ rupiah(item.transaksi.diskon) }}</td>
                                    <td class="px-4 py-3 border">{{ rupiah(item.transaksi.sub_total) }}</td>
                                    <td class="px-4 py-3 border">
                                        <div class=" text-center cursor-pointer relative text-sm rounded-lg bg-gray-800 group"
                                            role="alert">
                                            <div class="absolute w-full scale-0 h-full bg-white opacity-10 group-hover:scale-100 transition-all"></div>
                                            <span class="font-medium text-blue-400 p-4">{{ item.transaksi.status }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 border flex items-center justify-start">
                                        <!-- <Link :href="route('Transaksi.confirm', { kode: item.kode, slug: item.id, ket: item.ket, })">
                                            <PrimaryButton class="bg-green-500 hover:bg-green-600 active:bg-green-400 text-white">
                                            <font-awesome-icon :icon="['fas', 'pen']" />
                                        </PrimaryButton>
                                        </Link> -->
                                        <Link
                                            :href="route('Transaksi.show', { kode: item.kode_reservasi, slug: item.id, ket: item.transaksi.kode_transaksi, })">
                                        <PrimaryButton class="bg-blue-500 hover:bg-blue-600 active:bg-blue-400 text-white">
                                            <font-awesome-icon :icon="['fas', 'eye']" />
                                        </PrimaryButton>
                                        </Link>
                                        <!-- <PrimaryButton type="button"
                                            class="!bg-error text-white hover:bg-red-600 active:bg-red-400 block"
                                            @click="showModaldelete(item.id)">
                                            <font-awesome-icon :icon="['fas', 'trash-can']" />

                                        </PrimaryButton> -->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <Pagination :links="transaksi.links" />
                </div>
            </section>
            <Modal :show="modalDelete" :maxWidth="'md'">
                <div class="max-w-full h-full flex justify-center items-center ">
                    <div class="block bg-white rounded-lg py-5">
                        <h3 class="mb-4">Apakah Anda Yakin?</h3>
                        <div class="flex justify-around">
                            <PrimaryButton type="button" @click="DeleteTransaksi()"
                                class="bg-blue-500 hover:bg-blue-600 active:bg-blue-800">Ya
                            </PrimaryButton>
                            <PrimaryButton type="button" @click="closeModal()"
                                class="bg-error hover:bg-red-600 active:bg-red-800">Batal</PrimaryButton>
                        </div>
                    </div>
                </div>
            </Modal>
        </template>
    </AuthenticatedLayout>
</template>
