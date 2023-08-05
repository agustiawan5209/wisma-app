<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref, defineProps } from 'vue';

const props = defineProps({
    diskon: {
        type: Object,
        default: () => ({})
    },
    tipe_kamar: {
        type: Object,
        default: () => ({})
    },
    kamar: {
        type: Object,
        default: () => ({})
    },
})
const AddForm = useForm({
    tipe: props.diskon.tipe,
    tipe_kamar: props.diskon.tipe_kamar,
    kode: props.diskon.kode,
    kode_kamar: props.diskon.kode_kamar,
    potongan: props.diskon.potongan,
    tgl_mulai: props.diskon.tgl_mulai,
    tgl_akhir: props.diskon.tgl_akhir,
})
function submit() {
    AddForm.put(route('Diskon.update'), {
        // onFinish: () => {
        //     AddForm.reset()
        // },
        onError:(err)=>console.log(err)
    });
}
const count = ref(1);
function back() {
    window.history.back()
}
</script>

<template>
    <AuthenticatedLayout>

        <template #header>

            <Head title="Form Diskon" />
            Form Tambah Diskon
        </template>
        <template #content>
            <section class="py-3 flex justify-center w-full">
                <div class="w-full">
                    <form @submit.prevent="submit"
                        class="w-full grid grid-cols-2 gap-7 bg-white px-4 py-3 rounded-lg shadow-md">
                        <PrimaryButton class="w-1/4 col-span-2 bg-red-500 hover:bg-red-600 focus:bg-red-800" @click="back">Kembali
                        </PrimaryButton>
                        <div class=" col-span-2 flex flex-wrap justify-start gap-5 px-3 mt-4">
                            <div class="w-full h-auto py-1 text-left">
                                <h1 class="text-gray-800 font-medium">Pilih Jenis Diskon</h1>
                                <p class="text-sm text-gray-400">Ket: Jenis Diskon Menentukan Apakah potongan diskon ditentukan untuk setiap kamar atau setiap tipe kamar</p>
                            </div>
                            <div class="flex items-center px-4 border border-gray-200 rounded">
                                <input checked id="bordered-radio-1" type="radio" v-model="AddForm.tipe" value="1" name="bordered-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                <label for="bordered-radio-1"
                                    class="w-full py-4 ml-2 text-sm font-medium text-gray-900">Tipe Diskon</label>
                            </div>
                            <div class="flex items-center px-4 border border-gray-200 rounded">
                                <input  id="bordered-radio-2" type="radio" v-model="AddForm.tipe" value="2" name="bordered-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                <label for="bordered-radio-2"
                                    class="w-full py-4 ml-2 text-sm font-medium text-gray-900">Diskon</label>
                            </div>
                            <InputError class="w-full" :message="AddForm.errors.tipe_kamar" />

                        </div>
                        <div class="block col-span-2" v-if="AddForm.tipe == '1'">
                            <InputLabel value="Tipe Diskon" />

                            <select id="countries" v-model="AddForm.tipe_kamar" :required="AddForm.tipe == '1' ? 'required' : ''"
                                class="bg-white border  text-gray-900 text-sm rounded-lg  block w-full p-2.5 "
                                :class="AddForm.errors.tipe_kamar ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : 'border-blue-500 focus:ring-blue-500 focus:border-blue-500'">
                                <option selected>----</option>
                                <option  v-for="item in tipe_kamar" :value="item.tipe">{{ item.tipe }}</option>
                            </select>
                            <InputError :message="AddForm.errors.tipe_kamar" />

                        </div>
                        <div class="block col-span-2" v-if="AddForm.tipe == '2'">
                            <InputLabel value="pilih kamar berdasarkan kode kamar" />

                            <select id="countries" v-model="AddForm.kode_kamar" :required="AddForm.tipe == '2' ? 'required' : ''"
                                class="bg-white border  text-gray-900 text-sm rounded-lg  block w-full p-2.5 "
                                :class="AddForm.errors.tipe_kamar ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : 'border-blue-500 focus:ring-blue-500 focus:border-blue-500'">
                                <option selected>----</option>
                                <option v-for="item in kamar" :value="item.kode">{{ item.kode }}</option>
                            </select>
                            <InputError :message="AddForm.errors.tipe_kamar" />

                        </div>
                        <div class="block">
                            <InputLabel value="potongan Diskon" />
                            <TextInput type="text" :active="AddForm.errors.potongan" class="w-full"
                                v-model="AddForm.potongan" />
                            <InputError :message="AddForm.errors.potongan" />
                        </div>
                        <div class="block">
                            <InputLabel value="Tanggal Mulai Diskon" />
                            <TextInput type="date" :active="AddForm.errors.tgl_mulai" class="w-full"
                                v-model="AddForm.tgl_mulai" />
                            <InputError :message="AddForm.errors.tgl_mulai" />
                        </div>
                        <div class="block">
                            <InputLabel value="Tanggal berakhir Diskon" />
                            <TextInput type="date" :active="AddForm.errors.tgl_akhir" class="w-full"
                                v-model="AddForm.tgl_akhir" />
                            <InputError :message="AddForm.errors.tgl_akhir" />
                        </div>
                        <progress v-if="AddForm.progress" :value="AddForm.progress.percentage" max="100">
                            {{ AddForm.progress.percentage }}%
                        </progress>
                        <div class="col-span-2">
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
}</style>
