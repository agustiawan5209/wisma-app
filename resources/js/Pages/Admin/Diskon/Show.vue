<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { ref, defineProps } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    kamar: {
        type: Object,
        default: () => ({})
    },
});

function back(){
    window.history.back()
}
</script>

<template>
    <AuthenticatedLayout>

        <template #header>

            <Head :title="kamar.ruangan" />
            Detail {{ kamar.ruangan }}
        </template>
        <template #content>
            <section class="p-3 w-full bg-white rounded-md shadow-md">
                <div class="max-w-full">
                    <PrimaryButton @click="back" class="w-1/4 bg-red-500 hover:bg-red-600 focus:bg-red-800">Kembali</PrimaryButton>

                    <table class="w-full table-auto">
                        <caption class="table-caption border-b-2">Detail Kamar {{ kamar.ruangan }}</caption>
                        <tr class="border-b border-black ">
                            <th class="py-2 w-1/4 text-left">Tipe Kamar</th>
                            <td class="py-2 text-left"> : {{ kamar.tipe_kamar }}</td>
                        </tr>
                        <tr class="border-b border-black ">
                            <th class="py-2 w-1/4 text-left">Keterangan Kamar</th>
                            <td class="py-2 text-left flex flex-wrap text-sm"> <span>:</span>
                                <p v-html="kamar.ket"></p>
                            </td>
                        </tr>
                        <tr class="border-b border-black ">
                            <th class="py-2 w-1/4 text-left">Status Kamar</th>
                            <td class="py-2 text-left"> : {{ kamar.status_kamar }}</td>
                        </tr>
                        <tr class="border-b border-black " v-for="col in kamar.details">
                            <th class="py-2 w-1/4 text-left">{{ col.jenis }} Kamar</th>
                            <td class="py-2 text-left" v-if="col.jenis == 'gambar'"><img :src="col.path_foto" :alt="col.jenis"></td>
                            <td class="py-2 text-left" v-else> : {{ col.detail }}</td>
                        </tr>

                    </table>
                    <table>

                    </table>
                </div>
            </section>
        </template>

    </AuthenticatedLayout>
</template>


<style>
.fade-enter-active {
    transition: all 0.3s ease-out;
}

.fade-leave-active {
    transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}

.fade-enter-from,
.fade-leave-to {
    transform: translateX(30%);
    opacity: 0;
}</style>
