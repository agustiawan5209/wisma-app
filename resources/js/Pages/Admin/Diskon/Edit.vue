<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref , defineProps} from 'vue';

const props = defineProps({
    kamar: {
        type: Object,
        default: ()=>({})
    }
})


const mergeObject = (arr) =>{
    const detail = arr;
    const dataKamar = [];
    for(var key in detail){
        if(detail[key].jenis === 'fasilitas'){
            dataKamar[key] = detail[key].detail
        }
    }
    return dataKamar;
}

const AddForm = useForm({
    foto: null,
    ruangan: props.kamar.ruangan,
    fasilitas: mergeObject(props.kamar.details),
    ket: props.kamar.ket,
    tipe_kamar: props.kamar.tipe_kamar
})
const UrlFile = ref(null);

function fileSelected(e) {
    AddForm.foto = e.target.files[0];
    UrlFile.value = URL.createObjectURL(e.target.files[0])
}
function submit() {
    AddForm.post(route('Kamar.update', {slug: props.kamar.id, kode:props.kamar.kode}), {
        // onFinish: () => {
        //     AddForm.reset()
        // }
    });
}

// console.log(AddForm.fasilitas)
const count = ref(mergeObject(props.kamar.details).length);
function back(){
    window.history.back()
}
</script>

<template>
    <AuthenticatedLayout>

        <template #header>

            <Head title="Form Artikel" />
            Form Pengumuman
        </template>
        <template #content>
            <section class="py-3 flex justify-center w-full">
                <div class="w-full">
                    <form @submit.prevent="submit"
                    class="w-full grid grid-cols-2 gap-7 bg-white px-4 py-3 rounded-lg shadow-md">
                    <PrimaryButton class="w-1/2 bg-red-500 hover:bg-red-600 focus:bg-red-800">Kembali</PrimaryButton>
                        <div class="col-span-2">
                            <label for="dropzone-file" v-if="AddForm.foto == null"
                                class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 " :class="AddForm.errors.foto ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : 'border-blue-500 focus:ring-blue-500 focus:border-blue-500'">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Masukan
                                            Gambar</span></p>
                                    <p class="text-xs text-gray-500">SVG, PNG, JPG or GIF (MAX.
                                        800x400px)</p>
                                </div>
                                <input id="dropzone-file" type="file" @input="fileSelected($event)" class="hidden" />
                            </label>
                            <img v-else :src="UrlFile" alt="">
                            <InputError :message="AddForm.errors.foto" />

                        </div>
                        <div class="block">
                            <InputLabel value="Tipe Kamar" />

                            <select id="countries" v-model="AddForm.tipe_kamar"
                                class="bg-white border  text-gray-900 text-sm rounded-lg  block w-full p-2.5 " :class="AddForm.errors.tipe_kamar ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : 'border-blue-500 focus:ring-blue-500 focus:border-blue-500'">
                                <option selected>----</option>
                                <option value="Luxury">Luxury</option>
                                <option value="Ekonomis">Ekonomis</option>
                            </select>
                            <InputError :message="AddForm.errors.tipe_kamar" />

                        </div>
                        <div class="block">
                            <InputLabel value="Ruangan/Kamar" />
                            <TextInput type="text" :active="AddForm.errors.ruangan" class="w-full" v-model="AddForm.ruangan" />
                            <InputError :message="AddForm.errors.ruangan" />
                        </div>
                        <h1 class="col-span-2 text-sm text-gray-500">Tambahkan Fasilitas Jika Tersedia</h1>
                        <transition-group tag="ul" name="list" >
                            <li class="block w-full" v-for="cn in count" :key="cn+'cn'">
                                <InputLabel value="Fasilitas" />
                                <TextInput type="text" :active="AddForm.errors.fasilitas" class="w-full" v-model="AddForm.fasilitas[cn]" />
                            </li>
                            <InputError :message="AddForm.errors.fasilitas" />
                        </transition-group>
                        <div class="col-span-2 flex flex-row gap-4">
                            <PrimaryButton type="button" @click="count++">Tambah Fasilitas</PrimaryButton>
                            <PrimaryButton type="button" @click="count == 0 ? count = 0 : count--">Kurang Fasilitas
                            </PrimaryButton>
                        </div>
                        <div class=" col-span-2 block">
                            <InputLabel value="Keterangan" />
                            <quill-editor theme="snow" v-model:content="AddForm.ket" contentType="html"
                                class="block p-2.5 w-full text-sm   rounded-lg border  focus:ring-primary focus:border-primary bg-gray-100 border-gray-600 placeholder-gray-400 text-gray-800 " />
                            <InputError :message="AddForm.errors.ket" />
                        </div>
                        <progress v-if="AddForm.progress" :value="AddForm.progress.percentage" max="100">
                            {{ AddForm.progress.percentage }}%
                          </progress>
                        <div class="col-span-2 mt-16">
                            <PrimaryButton type="submit" class="w-full text-center">Simpan</PrimaryButton>
                        </div>
                    </form>
                </div>
            </section>
        </template>

    </AuthenticatedLayout>
</template>

<style>
.list-enter-active,
.list-leave-active {
  transition: all 0.5s ease;
}
.list-enter-from,
.list-leave-to {
  opacity: 0;
  transform: translateX(30px);
}
</style>
