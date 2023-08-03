<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            Dashboard
        </template>

        <template #content>
            <div class=" w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-5 mx-auto ">
                <div v-for="item in 4" class="col-span-1 h-32 bg-second"></div>
            </div>
        </template>
    </AuthenticatedLayout>
</template>
