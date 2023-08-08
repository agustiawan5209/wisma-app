
<script setup>
import { onMounted, ref, computed } from 'vue';

const props = defineProps({
    modelValue: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });

const classes = computed(() =>
    props.active
        ? 'border-red-200 outline-none focus:z-10 focus:border-red-500 focus:ring-red-500'
        : 'border-gray-200 outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500'
);
</script>
<template>
    <div class="relative">
        <input class="w-full rounded-md border  px-4 py-3 pl-11 text-sm uppercase shadow-sm " :class="classes"
            :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input" />
        <div class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
            <slot name="icon" />
        </div>
    </div>
</template>
