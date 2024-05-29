<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
    textSize: {
        type: String,
        default: 'text-sm',
    },
});
</script>

<template>
    <button
        :type="type"
        :class="['inline-flex justify-center items-center h-12 px-4 py-2 bg-gray-200 rounded-md font-semibold',
        textSize, 'tracking-widest shadow-sm disabled:opacity-25 overflow-hidden leading-trim text-edge text-ellipsis']"
    >
        <slot/>
    </button>
</template>
