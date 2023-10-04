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
                    <li class="w-5/6  p-2 rounded-lg border" :class="route().current('Transaksi.index') || route().current('Transaksi.show') ?  'bg-white border-transparent' :'border-white'">
                        <NavLink :href="route('Transaksi.index')" :active="route().current('Transaksi.index') || route().current('Transaksi.show')">
                            <font-awesome-icon :icon="['fas', 'money-bill-1-wave']" />
                            <span class="nav-home">Transaksi</span>
                        </NavLink>
                    </li>
                    <li class="w-5/6  p-2 rounded-lg border" :class="route().current('Laporan.index') ?  'bg-white border-transparent' :'border-white'">
                        <NavLink :href="route('Laporan.index')" :active="route().current('Laporan.index')">
                            <font-awesome-icon :icon="['fas', 'money-bill-1-wave']" />
                            <span class="nav-home">Laporan</span>
                        </NavLink>
                    </li>
                </ul>

            </div>
        </nav>
        <!-- Page Content -->
        <main class=" w-full md:left-[20%] md:w-4/5  relative">
            <!-- Page Heading -->
            <header class="bg-base shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex flex-wrap justify-between">
                    <h2 class="font-semibold text-xl text-white leading-tight">
                        <slot name="header" />
                    </h2>

                    <div class="ml-3 relative">
                        <Dropdown align="right" width="48">
                            <template #trigger>
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        {{ $page.props.auth.user.name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </template>

                            <template #content>
                                <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                                <DropdownLink :href="route('logout')" method="post" as="button">
                                    Log Out
                                </DropdownLink>
                            </template>
                        </Dropdown>
                    </div>
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
