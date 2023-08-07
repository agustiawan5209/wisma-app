<script setup>
import { Link, Head } from '@inertiajs/vue3';
import { ref, defineProps } from 'vue'
import Carousel from '@/Components/Carousel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
</script>


<template>
    <header class="h-max bg-primary flex flex-col justify-center">
        <div class="w-full bg-white pl-0 sm:pl-10 md:pl-20 flex flex-col md:flex-row items-center justify-around">
            <div class="logo w-full md:w-max h-full py-2">
                <img src="vite.svg" class="w-14 h-14 rounded-full shadow-lg " alt="logo wisma malaqbi">
            </div>
            <ul class=" w-full inline-block md:inline-flex items-center  md:space-x-2 pl-3 py-2">
                <li class=" border-l  px-2 border-base">
                    <dl>
                        <dd> <font-awesome-icon :icon="['fas', 'phone']" /> <span
                                class="capitalize text-xs md:text-sm">telpon</span>
                        </dd>
                        <dt class="text-xs md:text-sm text-gray-500"> 0823-4970-6696</dt>
                    </dl>
                </li>
                <li class=" border-l  px-2 border-base">
                    <dl>
                        <dd><font-awesome-icon :icon="['fas', 'home']" /> <span
                                class="capitalize text-xs md:text-sm">Alamat</span>
                        </dd>
                        <dt class="text-xs md:text-sm text-gray-500"> Jl. Pababari, Karema, Kec. Mamuju, Kabupaten Mamuju,
                            Sulawesi Barat 91512</dt>
                    </dl>
                </li>
                <li class=" border-l px-2 border-black ">
                    <Link :href="route('login')">
                    <PrimaryButton>Masuk</PrimaryButton>
                    </Link>
                </li>
            </ul>
        </div>
        <nav class="w-full h-1/3 bg-transparent flex justify-center items-center">
            <ul class=" inline-flex space-x-4 h-full w-max">
                <li
                    class="nav-home flex flex-col justify-center items-center  hover:bg-white text-white font-bold hover:text-gray-900 transition">
                    <Link :href="route('welcome')"
                        class="px-1 md:px-8 py-1 md:py-1.5 font-sans text-xs sm:text-sm md:text-lg">Home</Link>
                </li>
                <li
                    class="nav-home flex flex-col justify-center items-center  hover:bg-white text-white font-bold hover:text-gray-900 transition">
                    <Link :href="route('Home.room')"
                        class="px-1 md:px-8 py-1 md:py-1.5 font-sans text-xs sm:text-sm md:text-lg">Kamar</Link>
                </li>
                <li
                    class="nav-home flex flex-col justify-center items-center  hover:bg-white text-white font-bold hover:text-gray-900 transition">
                    <Link :href="route('Home.about')"
                        class="px-1 md:px-8 py-1 md:py-1.5 font-sans text-xs sm:text-sm md:text-lg">Tentang Kami
                    </Link>
                </li>
                <li
                    class="nav-home flex flex-col justify-center items-center  hover:bg-white text-white font-bold hover:text-gray-900 transition">
                    <Link :href="route('Home.contact')"
                        class="px-1 md:px-8 py-1 md:py-1.5 font-sans text-xs sm:text-sm md:text-lg">Kontak</Link>
                </li>

            </ul>
        </nav>
    </header>
    <main class="coontainer mx-auto">
        <slot />
    </main>



    <footer class="bg-primary ">
        <div class="container mx-auto py-3">
            <div class="grid grid-cols-3 gap-10">
                <div class="block text-white font-medium">
                    <h1 class=" border-b-4 border-spacing-9 text-left">Waktu Kerja</h1>
                    <ul class=" list-item font-light">
                        <li>Senin-Jum'at : 08:00-19:00 WITA</li>
                        <li>Sabtu-Minggu : 08:00-19:00 WITA</li>
                    </ul>
                </div>
                <div class="col-start-3 block text-white font-medium">
                    <h1 class=" border-b-4 border-spacing-9 text-left">Sosial Media</h1>
                    <ul class=" list-item font-light">
                        <li>Senin-Jum'at : 08:00-19:00 WITA</li>
                        <li>Sabtu-Minggu : 08:00-19:00 WITA</li>
                    </ul>
                </div>
                <div class="block text-white font-medium">
                    <h1 class=" border-b-4 border-spacing-9 text-left">Tentang Wisma Malaqbi</h1>
                    <p class="text-sm text-gray-100 text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat rem, voluptate impedit nisi, provident deleniti adipisci alias illo iste minus aliquid omnis modi magnam repudiandae harum, voluptates laborum maiores voluptatem!</p>
                </div>
                <div class="block text-white font-medium">
                    <h1 class=" border-b-4 border-spacing-9 text-left">Informasi</h1>
                    <ul class=" list-item font-light pl-5">
                        <li class="list-disc">
                            <Link :href="route('Home.about')">Tentang Kami</Link>
                        </li>
                        <li class="list-disc">
                            <Link :href="route('Home.contact')">Kirim Saran</Link>
                        </li>
                    </ul>
                </div>
                <div class="block text-white font-medium">
                    <h1 class=" border-b-4 border-spacing-9 text-left">Informasi</h1>
                    <ul class=" list-item font-light pl-0">
                        <li class="">
                            <font-awesome-icon :icon="['fas', 'location-dot']" />
                        </li>
                        <li class="">
                            <font-awesome-icon :icon="['fas', 'phone']" />

                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="mt-5">
            <div class="flex md:px-20 py-6 bg-red-500 text-white justify-center font-bold">
                All Rights Reserved. &copy; 2023 Design By : Wisma Malaqbi
            </div>
        </div>
    </footer>
</template>
