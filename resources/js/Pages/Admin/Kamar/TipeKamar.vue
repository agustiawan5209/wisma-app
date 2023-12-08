<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';

import { defineProps, ref, watch } from 'vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import Modal from '@/Components/Modal.vue';
import Pagination from '@/Components/Pagination.vue';
import FlashMessage from '@/Components/FlashMessage.vue';
import axios from 'axios';

const props = defineProps({
    kamar: {
        type: Object,
        default: () => ({}),
    },
    tipekamar: {
        type: Object,
        default: () => ({}),
    },
    search: String,
    tipe: String,

})

console.log(props.tipekamar)
// Search Form
const SearchForm = useForm({});
const search = ref(props.search);

watch(search, (value) => {
    SearchForm.get(route('Kamar.index', {
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
    modalAdd.value = false;
    modalEdit.value = false;
}

// Delete
const FormDelete = useForm({
    slug: null,
});
function deleteJadwal() {
    FormDelete.delete(route('Kamar.tipekamar.delete'), {
        onSuccess: () => {
            modalDelete.value = false;
            FormDelete.reset()
        }
    })
}

const modalAdd = ref(false);

const AddForm = useForm({
    tipe: '',
    harga: '',
    foto: '',
})

function addModal() {
    EditForm.slug = null;
    modalAdd.value = true;
}

function createData() {
    AddForm.post(route('Kamar.tipekamar.store'), {
        onSuccess: () => {
            AddForm.reset();
            closeModal()
        },
        onError: (err)=>{
            console.log(err)
        }
    })
}

// Edit Data

const modalEdit = ref(false);
const EditForm = useForm({
    slug: null,
    foto: null,
    tipe: props.tipekamar == null ? '' : props.tipekamar.tipe,
    harga: props.tipekamar == null ? '' : props.tipekamar.harga,
})
function EditModal(id) {
    EditForm.slug = id;
    axios.get(route('Kamar.tipekamar.getId', { slug: id }))
    .then(res=> {
        EditForm.tipe = res.data.tipe;
        EditForm.harga = res.data.harga;
        modalEdit.value = true;
    }).catch(err=>{
        console.log(err)
    })
}

function updateData() {
    EditForm.post(route('Kamar.tipekamar.update'), {
        onSuccess: () => {
            EditForm.reset();
           closeModal()
        },
        onError: (err)=>{
            console.log(err)
        }
    })
}

const rupiah = (num) => {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
    }).format(num);
}

</script>

<template>
    <Head title="Kamar" />

    <AuthenticatedLayout>
        <template #header>
            TIPE KAMAR
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
                            <PrimaryButton type="button" @click="addModal()">Tambah</PrimaryButton>
                            <div class="flex items-center space-x-3 w-full md:w-auto">

                            </div>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                                <tr>
                                    <th scope="col" class="border">No.</th>
                                    <th scope="col" class="px-4 py-3 border">tipe</th>
                                    <th scope="col" class="px-4 py-3 border">Harga Kamar</th>
                                    <th scope="col" class="px-4 py-3 border">Gambar Tipe Kamar</th>
                                    <th scope="col" class="px-4 py-3 border">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in kamar.data" class="border-b ">
                                    <th class="border text-center">{{ (kamar.current_page - 1) * kamar.per_page + index + 1
                                    }}.</th>
                                    <th scope="row"
                                        class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap text-start ">
                                        {{ item.tipe }}</th>
                                    <td class="px-4 py-3 border">{{ rupiah(item.harga) }}</td>
                                    <td class="px-4 py-3 border">
                                        <img :src="item.path_foto" width="200" alt="">
                                    </td>
                                    <td class="px-4 py-3 border flex items-center justify-start">
                                        <PrimaryButton type="button" @click="EditModal(item.id)"
                                            class="bg-green-500 hover:bg-green-600 active:bg-green-400 text-white">
                                            <font-awesome-icon :icon="['fas', 'pen']" />
                                        </PrimaryButton>
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
                    <Pagination :links="kamar.links" />
                </div>
            </section>
            <Modal :show="modalDelete" :maxWidth="'md'">
                <div class="max-w-full h-full flex justify-center items-center ">
                    <div class="block bg-white rounded-lg py-5">
                        <h3 class="mb-4">Apakah Anda Yakin?</h3>
                        <div class="flex justify-around">
                            <PrimaryButton type="button" @click="deleteJadwal()"
                                class="bg-blue-500 hover:bg-blue-600 active:bg-blue-800">Ya
                            </PrimaryButton>
                            <PrimaryButton type="button" @click="closeModal()"
                                class="bg-error hover:bg-red-600 active:bg-red-800">Batal</PrimaryButton>
                        </div>
                    </div>
                </div>
            </Modal>
            <Modal :show="modalAdd" :maxWidth="'md'">
                <div class="max-w-full h-full flex justify-center items-center py-4 ">
                    <form @submit.prevent="createData()" enctype="multipart/form-data" class="block bg-white rounded-lg py-5 px-3 border shadow-md">
                        <div class="mb-4 w-full">
                            <InputLabel value="Tipe" />
                            <TextInput type="text" v-model="AddForm.tipe" />
                            <InputError :message="AddForm.errors.tipe" />
                        </div>
                        <div class="mb-4 w-full">
                            <InputLabel value="Harga" />
                            <TextInput type="number" v-model="AddForm.harga" />
                            <InputError :message="AddForm.errors.harga" />

                        </div>
                        <div class="my-4 w-full">
                            <InputLabel value="Gambar" />
                            <TextInput type="file" @input="AddForm.foto = $event.target.files[0]" />
                            <InputError :message="AddForm.errors.foto" />

                        </div>

                        <div class="flex justify-around">
                            <PrimaryButton type="submit"
                                class="!bg-blue-500 hover:!bg-blue-600 active:!bg-blue-800">Simpan
                            </PrimaryButton>
                            <PrimaryButton type="button" @click="closeModal()"
                                class="bg-error hover:bg-red-600 active:bg-red-800">Batal</PrimaryButton>
                        </div>
                    </form>
                </div>
            </Modal>
            <Modal :show="modalEdit" :maxWidth="'md'">
                <div class="max-w-full h-full flex justify-center items-center py-4 ">
                    <form @submit.prevent="updateData()" enctype="multipart/form-data"  class="block bg-white rounded-lg py-5 px-3 border shadow-md">
                        <div class="mb-4 w-full">
                            <InputLabel value="Tipe" />
                            <TextInput type="text" v-model="EditForm.tipe" />
                        </div>
                        <div class="mb-4 w-full">
                            <InputLabel value="Harga" />
                            <TextInput type="number" v-model="EditForm.harga" />
                        </div>
                        <div class="my-4 w-full">
                            <InputLabel value="Gambar" />
                            <TextInput type="file" @input="EditForm.foto = $event.target.files[0]"  />
                        </div>
                        <div class="flex justify-around">
                            <PrimaryButton type="submit"
                                class="!bg-green-500 hover:!bg-green-600 active:!bg-green-800">Edit
                            </PrimaryButton>
                            <PrimaryButton type="button" @click="closeModal()"
                                class="bg-error hover:bg-red-600 active:bg-red-800">Batal</PrimaryButton>
                        </div>
                    </form>
                </div>
            </Modal>
        </template>
    </AuthenticatedLayout>
</template>
