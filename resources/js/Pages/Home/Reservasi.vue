<script setup>
import { ref, watch, defineProps } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
const props = defineProps({
    kamar: {
        type: Object,
        default: () => ({}),
    }
})

const form = useForm({
    kode_kamar: '',
    diskon: '',
    sub_total: '',
    status: 'PENDING',
    tgl_masuk: '',
    tgl_keluar: '',
    jumlah_tamu: '',
})
const count = ref(1);

function plusGuest(){
    count.value++;
    form.jumlah_tamu = count;
}
function minusGuest(){
    if(count.value >= 1){
        count.value--;
    }
    form.jumlah_tamu = count.value;
}
</script>

<template>
    <div class="container mx-auto flex flex-col sm:flex-col md:flex-row md:items-center px-2 py-3 sm:py-5 md:py-10 bg-primary rounded-2xl">
        <h1 class="font-bold md:w-1/5 xl:w-1/4 text-white leading-6 tracking-wide">Isi Form Reservasi Kamar Wisma Malaqbi</h1>

        <form class="flex flex-col sm:flex-col lg:flex-row md:space-x-4 py-2 px-4 w-4/5" action="#">
            <div class="block w-1/5">
                <InputLabel class="text-white" for="tipe_kamar" value="Tipe Kamar" />
                <select id="countries" v-model="form.tipe_kamar"
                    class="bg-white border  text-gray-900 text-sm rounded-lg  block w-full p-2.5 "
                    :class="form.errors.tipe_kamar ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : 'border-blue-500 focus:ring-blue-500 focus:border-blue-500'">
                    <option selected>----</option>
                    <option value="Luxury">Luxury</option>
                    <option value="Ekonomis">Ekonomis</option>
                </select>
                <InputError :message="form.errors.tipe_kamar" />
            </div>
            <div class="block">
                <InputLabel class="text-white" for="Tanggal Check In" value="Tanggal Check In" />
                <TextInput class="w-full" type="date" v-model="form.tgl_masuk" />
                <InputError :message="form.errors.tgl_masuk" />
            </div>
            <div class="block">
                <InputLabel class="text-white" for="Tanggal Check Out" value="Tanggal Check Out" />
                <TextInput class="w-full" type="date" v-model="form.tgl_keluar" />
                <InputError :message="form.errors.tgl_keluar" />
            </div>
            <div class="block">
                <InputLabel class="text-white" for="Jumlah_Tamu" value="Jumlah Tamu" />
                <div class="flex flex-row">
                    <PrimaryButton type="button" @click="minusGuest" class="bg-transparent hover:bg-transparent focus:bg-transparent active:bg-transparent !border-none !ring-0 focus:!ring-0 focus:!border-none active:!ring-0 focus:outline-none outline-none active:border-none !px-3">
                        <font-awesome-icon :icon="['fas', 'minus']" />
                    </PrimaryButton>
                    <kbd class="p-2 text-white font-bold">{{count}}</kbd>
                    <PrimaryButton type="button" @click="plusGuest" class="bg-transparent hover:bg-transparent focus:bg-transparent active:bg-transparent !border-none !ring-0 focus:!ring-0 focus:!border-none active:!ring-0 focus:outline-none outline-none active:border-none !px-3">
                        <font-awesome-icon :icon="['fas', 'plus']" />
                    </PrimaryButton>
                </div>
                <InputError :message="form.errors.jumlah_tamu" />
            </div>
            <div class="flex border-t border-white pt-3">
                <PrimaryButton class="bg-white text-primary hover:text-red-600 font-bold hover:!bg-gray-200 active:bg-gray-100 focus:bg-gray-200">Cari</PrimaryButton>
            </div>
        </form>
    </div>
</template>
