<script setup>
defineProps({
    value: {
        type: String,
    },
});
</script>

<template>
    <label class="mod-form-label">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot/></span>
    </label>
</template>
<style lang="scss">
.mod-form-label {
    @apply block text-base font-semibold dark:text-white
}
</style>
