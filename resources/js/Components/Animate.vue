<template>
    <div>
        <Transition @before-enter="onBeforeEnter" @enter="onEnter" @after-enter="onAfterEnter">
            <div class="w-20 h-20 bg-white rounded-full" v-if="acv"></div>
        </Transition>

        <PrimaryButton @click="active">Ative</PrimaryButton>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import gsap from 'gsap';
import PrimaryButton from './PrimaryButton.vue';

const acv = ref(true);
function active(){
    acv.value = ! acv.value;
}
function onBeforeEnter(el){
    console.log("before Enter")
    el.style.transform = 'translateY(-30px)'
    el.style.opacity = 0;
}
function onEnter(el,done){
    console.log(" Enter")

    gsap.to(el, {
        duration: 2,
        delay:2,
        y: 0,
        opacity: 1,
        ease: 'bounce.out',
        onComplete: done
    })
}
function onAfterEnter(el){
    console.log("After Enter")

}
</script>

<style>
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
