<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref } from 'vue';

const AddForm = useForm({
    foto: null,
    judul: '',
    kategori: '',
    isi: '',
    tanggal: '',
})
const UrlFile = ref(null);

function fileSelected(e) {
    AddForm.foto = e.target.files[0];
    UrlFile.value = URL.createObjectURL(e.target.files[0])
}
function submit() {
    AddForm.post(route('Artikel.store'), {
        onFinish: () => {
            AddForm.reset()
        }
    });
}
</script>

<template>
    <AuthenticatedLayout>

        <Head title="Form Artikel" />
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Form Pengumuman</h2>
        </template>
        <section class="py-3 flex justify-center w-full">
            <div class="max-w-2xl">
                <form @submit.prevent="submit"
                    class="w-full grid grid-cols-2 gap-7 bg-white px-4 py-3 rounded-lg shadow-md">
                    <div class="col-span-2">
                        <label for="dropzone-file" v-if="AddForm.foto == null"
                            class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Masukan
                                        Gambar</span></p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                            </div>
                            <input id="dropzone-file" type="file" @input="fileSelected($event)" class="hidden" />
                        </label>
                        <img v-else :src="UrlFile" alt="">
                        <InputError :message="AddForm.errors.foto" />

                    </div>
                    <div class="block">
                        <InputLabel value="Tanggal Pengumuman" />
                        <TextInput type="date" id="tanggal" v-model="AddForm.tanggal" />
                        <InputError :message="AddForm.errors.tanggal" />
                    </div>
                    <div class="block">
                        <InputLabel value="judul Pengumuman" />
                        <TextInput type="text" v-model="AddForm.judul" />
                        <InputError :message="AddForm.errors.judul" />
                    </div>
                    <div class="block">
                        <InputLabel value="kategori" />
                        <TextInput type="text" v-model="AddForm.kategori" />
                        <InputError :message="AddForm.errors.kategori" />
                    </div>
                    <div class=" col-span-2 block">
                        <InputLabel value="Keterangan" />
                        <quill-editor theme="snow" v-model:content="AddForm.isi" contentType="html"
                            class="block p-2.5 w-full text-sm   rounded-lg border  focus:ring-primary focus:border-primary bg-gray-100 border-gray-600 placeholder-gray-400 text-gray-800 " />
                        <InputError :message="AddForm.errors.isi" />
                    </div>
                    <div class="col-span-2 mt-16">
                        <PrimaryButton type="submit" class="w-full text-center">Simpan</PrimaryButton>
                    </div>
                </form>
            </div>
        </section>

    </AuthenticatedLayout>
</template>
