
<script setup>
import { onMounted, ref, computed } from 'vue';


</script>
<template>
    <div class="relative">
        <slot name="input" />
        <!-- <input class="w-full rounded-md border  px-4 py-3 pl-11 text-sm uppercase shadow-sm " :class="classes"
            :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input" /> -->
        <div class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3 ">
            <slot name="icon" />
        </div>
    </div>
</template>
