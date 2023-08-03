<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { ref, defineProps } from 'vue';
import ArtikelVue from '@/Components/Artikel.vue'

const props  = defineProps({
    artikel:{
        type:Object,
        default:()=>({})
    },
    artikel_relate: {
        type: Object,
        default: () => ({}),
    },
});
</script>

<template>
    <AuthenticatedLayout>

        <Head :title="artikel.judul" />

        <section class="container mx-auto grid grid-cols-12 gap-8 py-5 bg-white">

            <div class="col-span-12">
                <div class="w-full">
                   <transition name="fade">
                    <article>
                        <h1 class="text-xl sm:text-2xl md:text-3xl">{{artikel.judul}}</h1>
                        <figure>
                            <img :src="artikel.path_foto" :alt="artikel.judul" class="w-full mb-3">
                            <figcaption>
                                <time datetime="Y-m-d" class="text-white bg-primary rounded-lg font-medium text-base p-2 border mt-7">{{artikel.tanggal}}</time>
                            </figcaption>
                        </figure>
                        <p v-html="artikel.isi" class="leading-8 tracking-wide"></p>
                    </article>
                   </transition>
                </div>

            </div>

        </section>
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
  }
</style>
