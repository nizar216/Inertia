<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
    textSize: {
        type: String,
        default: 'text-base',
    },
});
</script>

<template>
    <button
        :type="type"
        :class="[
            'flex justify-center items-center h-12 border-none bg-red-900 p-4 text-white focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-center',
            textSize
        ]">
        <slot/>
    </button>
</template>
<style lang="scss" scoped>
button {
    background-color: var(--app-color-primary);
}
</style>
