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
    diskon: {
        type: Object,
        default: () => ({}),
    },
    search: String,
    tipe: String,

})
// Search Form
const SearchForm = useForm({});
const search = ref(props.search);

watch(search, (value) => {
    SearchForm.get(route('Diskon.index', {
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
function DeleteDiskon() {
    FormDelete.delete(route('Diskon.delete'), {
        onSuccess: () => {
            modalDelete.value = false;
            FormDelete.reset()
        }
    })
}
</script>

<template>
    <Head title="Diskon" />

    <AuthenticatedLayout>
        <template #header>
            Pengumuman
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
                        <div
                            class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                            <Link :href="route('Diskon.create')">
                            <PrimaryButton>Tambah</PrimaryButton>
                            </Link>
                            <div class="flex items-center space-x-3 w-full md:w-auto">

                            </div>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                                <tr>
                                    <th scope="col" class="border">No.</th>
                                    <th scope="col" class="px-4 py-3 border">kode Diskon</th>
                                    <th scope="col" class="px-4 py-3 border">Potongan Diskon</th>
                                    <th scope="col" class="px-4 py-3 border">Tanggal Mulai Diskon</th>
                                    <th scope="col" class="px-4 py-3 border">Tanggal Akhir Diskon</th>
                                    <th scope="col" class="px-4 py-3 border">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in diskon.data" class="border-b ">
                                    <th class="border text-center">{{ (diskon.current_page - 1) * diskon.per_page + index + 1
                                    }}.</th>
                                    <td class="px-4 py-3 border">{{ item.kode }}</td>
                                    <td class="px-4 py-3 border">{{ item.potongan }}%</td>
                                    <td class="px-4 py-3 border">{{ item.tgl_mulai }}</td>
                                    <td class="px-4 py-3 border">{{ item.tgl_akhir }}</td>
                                    <td class="px-4 py-3 border flex items-center justify-start">
                                        <Link :href="route('Diskon.edit', { kode: item.kode, slug: item.id, ket: item.ket, })">
                                            <PrimaryButton class="bg-green-500 hover:bg-green-600 active:bg-green-400 text-white">
                                            <font-awesome-icon :icon="['fas', 'pen']" />
                                        </PrimaryButton>
                                        </Link>
                                        <Link :href="route('Diskon.show', { kode: item.kode, slug: item.id, ket: item.ket, })">
                                            <PrimaryButton class="bg-blue-500 hover:bg-blue-600 active:bg-blue-400 text-white">
                                            <font-awesome-icon :icon="['fas', 'eye']" />
                                        </PrimaryButton>
                                        </Link>
                                        <PrimaryButton type="button"
                                            class="!bg-error text-white hover:bg-red-600 active:bg-red-400 block"
                                            @click="showModaldelete(item.id)">
                                            <font-awesome-icon :icon="['fas', 'trash-can']" />

                                        </PrimaryButton>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <Pagination :links="diskon.links" />
                </div>
            </section>
            <Modal :show="modalDelete" :maxWidth="'md'">
                <div class="max-w-full h-full flex justify-center items-center ">
                    <div class="block bg-white rounded-lg py-5">
                        <h3 class="mb-4">Apakah Anda Yakin?</h3>
                        <div class="flex justify-around">
                            <PrimaryButton type="button" @click="DeleteDiskon()"
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
