<script setup>
import { Head, Link } from '@inertiajs/vue3';

</script>

<template>
    <div>
        <section class="bg-white dark:bg-gray-900 h-screen grid place-content-center">
            <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
                <div class="mx-auto max-w-screen-sm text-center">
                    <div class="w-full flex justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor"
                            class="mb-4 text-7xl tracking-tight font-extrabold lg:text-9xl text-primary dark:text-primary w-40">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                    </div>
                    <p class="mb-4 text-3xl tracking-tight font-bold text-gray-900 md:text-4xl dark:text-white">Pemesanan
                        Kamar Berhasil</p>
                    <p class="mb-4 text-lg font-light text-gray-500 dark:text-gray-400">Mohon Tunggu Konfirmasi Dari Admin
                        Untuk Pengiriman</p>
                    <Link href="/"
                        class="inline-flex text-white bg-primary hover:bg-primary focus:ring-4 focus:outline-none focus:ring-primary font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-primary my-4">Kembali</Link>
                </div>
            </div>
        </section>
    </div>
</template>
