<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div class="flex flex-row">
        <nav class="bg-base md:h-screen w-0  md:w-1/5 pt-10 border-b border-gray-100">
            <div class=" hidden md:flex justify-between flex-col items-center gap-4 md:gap-10">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <Link :href="route('dashboard')">
                    <ApplicationLogo class="block h-9 w-auto fill-current text-gray-800" />
                    </Link>
                </div>

                <!-- Navigation Links -->
                <ul class="w-full space-y-5 flex flex-col items-center justify-center">
                    <li class="w-5/6 bg-gray-200 p-2 rounded-lg">
                        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            <font-awesome-icon :icon="['fas', 'home']" />
                            <span class="nav-home">Dashboard</span>
                        </NavLink>
                    </li>
                    <li class="w-5/6 bg-gray-200 p-2 rounded-lg">
                        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            <font-awesome-icon :icon="['fas', 'home']" />
                            <span class="nav-home">Dashboard</span>
                        </NavLink>
                    </li>
                    <li class="w-5/6 bg-gray-200 p-2 rounded-lg">
                        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            <font-awesome-icon :icon="['fas', 'home']" />
                            <span class="nav-home">Dashboard</span>
                        </NavLink>
                    </li>
                </ul>

            </div>
        </nav>
        <!-- Page Content -->
        <main class=" w-full md:w-4/5  relative">
            <!-- Page Heading -->
            <header class="bg-base shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h2 class="font-semibold text-xl text-white leading-tight">
                        <slot name="header" />
                    </h2>

                </div>
            </header>
            <div class="py-12">
                <div class="max-w-7xl mx-auto px-4">
                    <slot name="content" />
                </div>
            </div>
        </main>
    </div>
</template>
