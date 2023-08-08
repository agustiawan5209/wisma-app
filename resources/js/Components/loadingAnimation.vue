<script setup>
import { ref, defineProps } from 'vue';

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
})
</script>

<template>
   <section v-show="show" class="fixed left-0 top-0 w-full h-full bg-gray-700 z-[999] flex justify-center items-center">
    <div class="reach bg-primary w-2 h-2 relative">
        <div class="w-10 h-10"></div>
        <div class="w-10 h-10"></div>
        <div class="w-10 h-10"></div>
        <div class="w-10 h-10"></div>
        <div class="w-10 h-10"></div>
        <div class="w-10 h-10"></div>
        <div class="w-10 h-10"></div>
        <div class="w-10 h-10"></div>
        <div class="w-10 h-10"></div>
        <div class="w-10 h-10"></div>
    </div>
   </section>
</template>

<style>
/**
  * reach
  *
  * @author jh3y
*/
@-webkit-keyframes reach {

    0%,
    10%,
    20%,
    30%,
    50%,
    60%,
    70%,
    80%,
    90%,
    100% {
        -webkit-transform: rotate(calc(var(--rotation) * 1deg)) translate(0, calc(var(--translation) * 1%));
        transform: rotate(calc(var(--rotation) * 1deg)) translate(0, calc(var(--translation) * 1%));
    }

    50% {
        -webkit-transform: rotate(calc(var(--rotation) * 1deg)) translate(0, calc(var(--translation) * 1.5%));
        transform: rotate(calc(var(--rotation) * 1deg)) translate(0, calc(var(--translation) * 1.5%));
    }
}

@keyframes reach {

    0%,
    10%,
    20%,
    30%,
    50%,
    60%,
    70%,
    80%,
    90%,
    100% {
        -webkit-transform: rotate(calc(var(--rotation) * 1deg)) translate(0, calc(var(--translation) * 1%));
        transform: rotate(calc(var(--rotation) * 1deg)) translate(0, calc(var(--translation) * 1%));
    }

    50% {
        -webkit-transform: rotate(calc(var(--rotation) * 1deg)) translate(0, calc(var(--translation) * 1.5%));
        transform: rotate(calc(var(--rotation) * 1deg)) translate(0, calc(var(--translation) * 1.5%));
    }
}

.reach {
    --size: 10;
    position: absolute;
}

.reach div {
    -webkit-animation: reach 1s calc(var(--delay) * 1s) infinite ease;
    animation: reach 1s calc(var(--delay) * 1s) infinite ease;
    width: 50%;
    height: 150%;
    background: #ffff;
    position: absolute;
    -webkit-transform: rotate(calc(var(--rotation) * 1deg)) translate(0, calc(var(--translation) * 1%));
    transform: rotate(calc(var(--rotation) * 1deg)) translate(0, calc(var(--translation) * 1%));
}

.reach div:nth-child(1) {
    --delay: 0.1;
    --rotation: 36;
    --translation: 150;
}

.reach div:nth-child(2) {
    --delay: 0.2;
    --rotation: 72;
    --translation: 150;
}

.reach div:nth-child(3) {
    --delay: 0.3;
    --rotation: 108;
    --translation: 150;
}

.reach div:nth-child(4) {
    --delay: 0.4;
    --rotation: 144;
    --translation: 150;
}

.reach div:nth-child(5) {
    --delay: 0.5;
    --rotation: 180;
    --translation: 150;
}

.reach div:nth-child(6) {
    --delay: 0.6;
    --rotation: 216;
    --translation: 150;
}

.reach div:nth-child(7) {
    --delay: 0.7;
    --rotation: 252;
    --translation: 150;
}

.reach div:nth-child(8) {
    --delay: 0.8;
    --rotation: 288;
    --translation: 150;
}

.reach div:nth-child(9) {
    --delay: 0.9;
    --rotation: 324;
    --translation: 150;
}

.reach div:nth-child(10) {
    --delay: 1;
    --rotation: 360;
    --translation: 150;
}</style>
