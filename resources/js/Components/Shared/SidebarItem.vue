<template>
    <Link
        :href="href"
        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
        <slot name="svg"/>
        <span class="flex-1 ms-3 whitespace-nowrap"><slot /></span>
    </Link>
</template>
<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    href: {
        type: String,
        required: true,
    },
});
</script>
