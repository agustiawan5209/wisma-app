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
    <div class="">
        <nav class="bg-base md:fixed top-0 md:h-screen w-0  md:w-1/5 pt-10 border-b border-gray-100">
            <div class=" hidden md:flex justify-between flex-col items-center gap-4 md:gap-10">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <Link :href="route('dashboard')">
                    <ApplicationLogo class="block h-9 w-32 fill-current text-white" />
                    </Link>
                </div>

                <!-- Navigation Links -->
                <ul class="w-full space-y-5 flex flex-col items-center justify-center">
                    <li class="w-5/6  p-2 rounded-lg border" :class="route().current('dashboard') ? 'bg-white border-transparent' :'border-white'">
                        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            <font-awesome-icon :icon="['fas', 'home']" />
                            <span class="nav-home">Dashboard</span>
                        </NavLink>
                    </li>
                    <li class="w-5/6  p-2 rounded-lg border" :class="route().current('Kamar.index') || route().current('Kamar.show') || route().current('Kamar.edit') || route().current('Kamar.create') ?  'bg-white border-transparent' :'border-white'">
                        <NavLink :href="route('Kamar.index')" :active="route().current('Kamar.index') || route().current('Kamar.show') || route().current('Kamar.edit') || route().current('Kamar.create')">
                            <font-awesome-icon :icon="['fas', 'couch']" />
                            <span class="nav-home">Kamar</span>
                        </NavLink>
                    </li>
                    <li class="w-5/6  p-2 rounded-lg border" :class="route().current('Diskon.index') || route().current('Diskon.show') || route().current('Diskon.edit') || route().current('Diskon.create') ?  'bg-white border-transparent' :'border-white'">
                        <NavLink :href="route('Diskon.index')" :active="route().current('Diskon.index') || route().current('Diskon.show') || route().current('Diskon.edit') || route().current('Diskon.create')">
                            <font-awesome-icon :icon="['fas', 'credit-card']" />
                            <span class="nav-home">Diskon</span>
                        </NavLink>
                    </li>
                    <li class="w-5/6  p-2 rounded-lg border" :class="route().current('Voucher.index') || route().current('Voucher.show') || route().current('Voucher.edit') || route().current('Voucher.create') ?  'bg-white border-transparent' :'border-white'">
                        <NavLink :href="route('Voucher.index')" :active="route().current('Voucher.index') || route().current('Voucher.show') || route().current('Voucher.edit') || route().current('Voucher.create')">
                            <font-awesome-icon :icon="['far', 'credit-card']" />
                            <span class="nav-home">Voucher</span>
                        </NavLink>
                    </li>
                </ul>

            </div>
        </nav>
        <!-- Page Content -->
        <main class=" w-full md:left-[20%] md:w-4/5  relative">
            <!-- Page Heading -->
            <header class="bg-base shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h2 class="font-semibold text-xl text-white leading-tight">
                        <slot name="header" />
                    </h2>

                </div>
            </header>
            <div class="py-5 bg-gray-100">
                <div class="max-w-7xl mx-auto px-4">
                    <slot name="content" />
                </div>
            </div>
        </main>
    </div>
</template>
