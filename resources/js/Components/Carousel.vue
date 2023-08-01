<template>
    <swiper :modules="modules" :slides-per-view="1" :space-between="50" navigation :pagination="{ clickable: true }"
        :scrollbar="{ draggable: true }" @swiper="onSwiper" @slideChange="onSlideChange" :autoplay='{
            "delay": 2500,
            "disableOnInteraction": false
        }'>
        <swiper-slide v-for="img in image">
            <div class="absolute w-full h-full flex justify-center items-center z-20">
                <div class="max-w-lg text-center">
                    <h1 class="text-xs md:text-5xl text-white font-sans font-bold leading-4 tracking-widest">SELAMAT DATANG
                        DI WEBSITE WISMA MALAQBI</h1>
                        <PrimaryButton class="!bg-primary hover:bg-second active:bg-primary ">Selengkapnya</PrimaryButton>
                </div>
            </div>
            <div class="absolute bg-gray-900 opacity-80 z-0 w-full h-full"></div>
            <img :src="img" alt="" class="-z-10">


        </swiper-slide>
    </swiper>
</template>
<script>
// import Swiper core and required modules
import { Navigation, Pagination, Scrollbar, A11y, Autoplay } from 'swiper/modules';

// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from 'swiper/vue';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/scrollbar';
import 'swiper/css/autoplay';
import PrimaryButton from './PrimaryButton.vue';

// Import Swiper styles
export default {
    components: {
    Swiper,
    SwiperSlide,
    PrimaryButton
},
    data() {
        return {
            image: [
                'img/halaman.jpg',
                'img/1.jpg',
                'img/2.jpg',
                'img/3.jpg',
            ]
        }
    },
    setup() {
        const onSwiper = (swiper) => {
            console.log(swiper);
        };
        const onSlideChange = () => {
            console.log('slide change');
        };
        return {
            onSwiper,
            onSlideChange,
            modules: [Navigation, Pagination, Scrollbar, A11y, Autoplay],
        };
    },
};
</script>

<style>
.swiper {
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.swiper-slide img {
    width: 100%;
    height: 100%;
    position: relative;
    box-sizing: border-box;
}
</style>
