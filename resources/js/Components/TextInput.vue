<script setup>
import { onMounted, ref,computed } from 'vue';

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
        ? 'border-error focus:border-error focus:ring-error'
        : 'border-indigo-500 focus:border-indigo-500 focus:ring-indigo-500'
);
</script>

<template>
    <input
        class="rounded-md shadow-sm"
        :class="classes"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="input"
    />
</template>
