<script setup>
import { Head, Link } from '@inertiajs/vue3';
import UserLayout from '@/Layouts/UserLayout.vue';
import { defineProps } from 'vue';
import Invoice from '../Invoice.vue';

const props = defineProps({
    reservasi: {
        type: Object,
        default: () => ({})
    }
})

const rupiah = (num) => {
    return new Intl.NumberFormat("id-ID", {
        style: 'currency',
        currency: 'IDR',
    }).format(num)
}
function printSelectedHTML() {
    var printContent = document.getElementById("printable-content").innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContent;
    window.print();
    document.body.innerHTML = originalContents;

}
</script>

<template>
    <UserLayout>

        <Head title="Dashboard User" />
        <section class="w-full">
            <div class="w-3/4 ml-4">
               <Invoice :reservasi="reservasi" />
            </div>
        </section>
    </UserLayout>
</template>
