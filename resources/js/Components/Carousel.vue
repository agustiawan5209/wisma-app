<template>
    <swiper :modules="modules" :slides-per-view="1" :space-between="50" navigation :pagination="{ clickable: true }"
        :scrollbar="{ draggable: true }" @swiper="onSwiper" @slideChange="onSlideChange" :autoplay='{
            "delay": 5000,
            "disableOnInteraction": true
        }'>
        <swiper-slide v-for="img in image">
            <div class="absolute w-full h-full flex justify-center rounded-full items-center z-20">
                <div class="max-w-lg text-center">
                    <h1 class="text-xs md:text-5xl text-white font-sans font-bold leading-4 tracking-widest uppercase">
                        {{ img.title }}</h1>
                    <PrimaryButton  id="close-button" class="!bg-primary hover:bg-second active:bg-primary ">Selengkapnya</PrimaryButton>

                </div>
            </div>
            <div class="absolute bg-gray-900 opacity-80 z-0 w-full h-full"></div>
            <img :src="img.img" alt="" class="-z-10 w-full h-full object-contain">


        </swiper-slide>
    </swiper>
</template>
<script>
// import Swiper core and required modules
import { Navigation, Scrollbar, A11y, Autoplay } from 'swiper/modules';

// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from 'swiper/vue';

import gsap from 'gsap';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/navigation';
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
                {
                    img: 'img/halaman.jpg',
                    'title': 'SELAMAT DATANG DI WEBSITE WISMA MALAQBI'
                },
                {
                    img: 'img/1.jpg',
                    'title': 'Ruangan Yang Nyaman Dan Santai'
                },
                {
                    img: 'img/2.jpg',
                    'title': 'Fasilitas Terbaik Untuk Tamu'
                },
                {
                    img: 'img/3.jpg',
                    'title': 'Harga Terjangkau'
                },
            ]
        }
    },
    setup() {
        const onSwiper = (swiper) => {
            console.log(swiper);
        };
        const onSlideChange = () => {
            const boutonClose = document.querySelector('#close-button');
            console.log('slide change');
            gsap.to(boutonClose, {
                duration: 2,
                delay: 2,
                y: 0,
                opacity: 1,
                ease: 'bounce.out',
            })
        };

        return {
            onSwiper,
            onSlideChange,
            modules: [Navigation, Scrollbar, A11y, Autoplay],
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

.slide-fade-enter-active {
    transition: all 0.3s ease-out;
}

.slide-fade-leave-active {
    transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
    transform: translateX(20px);
    opacity: 0;
}

@media (max-width:768px) {

    .swiper-button-prev::after,
    .swiper-button-next::after {
        font-size: 10px;
    }
}
.bounce-enter-active {
    animation: bounce-in 0.5s;
  }
  .bounce-leave-active {
    animation: bounce-in 0.5s reverse;
  }
  @keyframes bounce-in {
    0% {
      transform: scale(0);
    }
    50% {
      transform: scale(1.25);
    }
    100% {
      transform: scale(1);
    }
  }
</style>
