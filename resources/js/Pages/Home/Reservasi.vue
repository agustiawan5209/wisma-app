<script setup>
import { ref, watch, defineProps } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import TextInputIcon from '@/Components/TextInputIcon.vue';
import loadingAnimation from '@/Components/loadingAnimation.vue';
const props = defineProps({
    kamar: {
        type: Object,
        default: () => ({}),
    },
    tipe_kamar:{
        type: Object,
        default: () => ({}),
    }
})
const count = ref(1);

const form = useForm({
    tipe: '',
    kode_kamar: '',
    diskon: '',
    sub_total: '',
    status: 'PENDING',
    tgl_masuk: '',
    tgl_keluar: '',
    jumlah_tamu: count.value,
})

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

const loadingPage = ref(false);
function submit(){
    form.get(route('Home.room'),{
        onBefore: ()=>{
            loadingPage.value = true;
        },
        onFinish: ()=>{
            loadingPage.value = false;
        },
        preserveState:true,
        preserveScroll:true,
    });
}


</script>

<template>
    <div class="container mx-auto flex flex-col sm:flex-col md:flex-row md:items-center px-2 py-3 sm:py-5 md:py-10 bg-primary rounded-2xl">
        <loadingAnimation :show="loadingPage" />
        <h1 class="font-bold md:w-1/5 xl:w-1/4 text-white leading-6 tracking-wide">Isi Form Reservasi Kamar Wisma Malaqbi</h1>

        <form class="flex flex-col sm:flex-col lg:flex-row md:space-x-4 py-2 px-4 w-4/5" @submit.prevent="submit">
            <div class="block w-1/5">
                <InputLabel class="text-white" for="tipe_kamar" value="Tipe Kamar" />
                <TextInputIcon>
                    <template #input>
                        <select id="countries" v-model="form.tipe"
                            class="bg-white border pl-11 text-gray-900 text-sm rounded-lg  block w-full p-2.5 "
                            :class="form.errors.tipe ? 'border-red-300 focus:ring-red-500 focus:border-red-500' : 'border-blue-500 focus:ring-blue-500 focus:border-blue-500'"
                            :required="false">
                            <option value="">----</option>
                            <option v-for="col in tipe_kamar" :value="col.tipe">{{ col.tipe }}</option>
                        </select>
                    </template>
                    <template #icon>
                        <font-awesome-icon :icon="['fas', 'list']" class="h-4 w-4 text-red-400" />
                    </template>
                </TextInputIcon>

                <InputError :message="form.errors.tipe" />
            </div>
            <div class="block">
                <InputLabel class="text-white" for="Tanggal Check In" value="Tanggal Check In" />
                <TextInputIcon>
                    <template #input>
                        <TextInput class="w-full pl-11" type="date" v-model="form.tgl_masuk" required />
                    </template>
                    <template #icon>
                        <font-awesome-icon :icon="['fas', 'calendar-days']" class="h-4 w-4 text-red-400" />
                    </template>
                </TextInputIcon>
                <InputError :message="form.errors.tgl_masuk" />
            </div>
            <div class="block">
                <InputLabel class="text-white" for="Tanggal Check Out" value="Tanggal Check Out" />
                <TextInputIcon>
                    <template #input>
                        <TextInput class="w-full pl-11" type="date" v-model="form.tgl_keluar" required />
                    </template>
                    <template #icon>
                        <font-awesome-icon :icon="['fas', 'calendar-days']" class="h-4 w-4 text-red-400" />
                    </template>
                </TextInputIcon>
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
            <div class="flex border-t border-white pt-3 md:border-none">
                <PrimaryButton class="bg-white !text-primary hover:text-red-600 font-bold hover:!bg-gray-200 active:bg-gray-100 focus:bg-gray-200">Cari</PrimaryButton>
            </div>
        </form>
    </div>
</template>
