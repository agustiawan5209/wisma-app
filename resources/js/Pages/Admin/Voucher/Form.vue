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
    // tipe: 1,
    // tipe_kamar: '',
    kode: '',
    // kode_kamar: '',
    potongan: '',
    tgl_mulai: '',
    tgl_akhir: '',
    max_user: '',
})
function submit() {
    AddForm.post(route('Voucher.store'), {
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

            <Head title="Form Voucher" />
            Form Tambah Voucher
        </template>
        <template #content>
            <section class="py-3 flex justify-center w-full">
                <div class="w-full">
                    <form @submit.prevent="submit"
                        class="w-full grid grid-cols-2 gap-7 bg-white px-4 py-3 rounded-lg shadow-md">
                        <PrimaryButton class="w-1/4 col-span-2 bg-red-500 hover:bg-red-600 focus:bg-red-800" @click="back">Kembali
                        </PrimaryButton>
                        <div class="block">
                            <InputLabel value="Kode Voucher" />
                            <TextInput type="text" :active="AddForm.errors.kode" class="w-full"
                                v-model="AddForm.kode" />
                            <InputError :message="AddForm.errors.kode" />
                        </div>
                        <div class="block">
                            <InputLabel value="potongan Voucher" />
                            <TextInput type="text" :active="AddForm.errors.potongan" class="w-full"
                                v-model="AddForm.potongan" />
                            <InputError :message="AddForm.errors.potongan" />
                        </div>
                        <div class="block">
                            <InputLabel value="Tanggal Mulai Voucher" />
                            <TextInput type="date" :active="AddForm.errors.tgl_mulai" class="w-full"
                                v-model="AddForm.tgl_mulai" />
                            <InputError :message="AddForm.errors.tgl_mulai" />
                        </div>
                        <div class="block">
                            <InputLabel value="Tanggal berakhir Voucher" />
                            <TextInput type="date" :active="AddForm.errors.tgl_akhir" class="w-full"
                                v-model="AddForm.tgl_akhir" />
                            <InputError :message="AddForm.errors.tgl_akhir" />
                        </div>
                        <div class="block">
                            <InputLabel value="Batas Pengguna Voucher" />
                            <TextInput type="text" :active="AddForm.errors.max_user" class="w-full"
                                v-model="AddForm.max_user" />
                            <InputError :message="AddForm.errors.max_user" />
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
