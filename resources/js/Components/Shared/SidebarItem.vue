<template>
    <Link
        :href="href"
        class="flex items-center text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group h-10">
            <slot name="svg"/>
        <span class="flex-1 ms-3 whitespace-nowrap text-start"><slot/></span>
    </Link>
</template>
<script setup>
import {Link} from '@inertiajs/vue3';

defineProps({
    href: {
        type: String,
        required: true,
    },
});
</script>
