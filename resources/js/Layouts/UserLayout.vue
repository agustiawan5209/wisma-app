<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import HomeLayout from './HomeLayout.vue';
</script>

<template>
    <HomeLayout>
        <div class="h-auto relative overflow-auto">
            <aside class="absolute top-0 left-0 z-40 w-64 h-full transition-transform -translate-x-full sm:translate-x-0 "
                aria-label="Sidenav">
                <div class="overflow-y-auto py-5 px-3 h-max border-r border-gray-200 relative ">

                    <div class="bg-primary py-5 px-3 rounded-xl ">
                        <div class="w-full flex justify-center mb-5">
                            <div class="bg-white w-max h-full rounded-full">
                                <font-awesome-icon class="text-6xl" :icon="['fas', 'user']" />
                            </div>
                        </div>
                        <!-- Navigation Links -->
                        <ul class="w-full space-y-5 flex flex-col items-center justify-center">
                            <li class="w-full  p-2 rounded-lg border"
                                :class="route().current('User.dashboard') ? 'bg-white border-transparent' : 'border-white'">
                                <NavLink :href="route('User.dashboard')" :active="route().current('User.dashboard')">
                                    <font-awesome-icon :icon="['fas', 'home']" />
                                    <span class="nav-home ml-5">Dashboard</span>
                                </NavLink>
                            </li>
                            <li class="w-full  p-2 rounded-lg border"
                                :class="route().current('User.reservasi') ? 'bg-white border-transparent' : 'border-white'">
                                <NavLink :href="route('User.reservasi')" :active="route().current('User.reservasi')">
                                    <font-awesome-icon :icon="['fas', 'briefcase']" />
                                    <span class="nav-home ml-5">Reservasi</span>
                                </NavLink>
                            </li>
                        </ul>

                        <!-- Setting User -->
                        <div
                            class="block bottom-0 left-0 justify-center p-4 space-x-4 w-full lg:flex bg-primary z-20 border-r border-gray-200 ">
                            <a href="#"
                                class="inline-flex justify-center p-2 text-white rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100">
                                <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z">
                                    </path>
                                </svg>
                            </a>
                            <a href="#" data-tooltip-target="tooltip-settings"
                                class="inline-flex justify-center p-2 text-white rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100">
                                <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

            </aside>

            <main class="w-4/5 h-full left-64 p-4 relative overflow-hidden box-border bg-[url('/svg/confetti-doodles.svg')]">
                <div class="w-full h-full shadow-lg rounded-lg ">
                    <slot/>
                </div>
            </main>
        </div>
    </HomeLayout>
</template>
