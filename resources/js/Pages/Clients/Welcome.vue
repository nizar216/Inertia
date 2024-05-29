<script setup>
import {Head} from '@inertiajs/vue3';
import ClientsLayout from "@/Layouts/ClientsLayout.vue";
import { FwbDropdown, FwbListGroup, FwbListGroupItem } from 'flowbite-vue'
</script>

<template>
    <Head title="Client Dashboard"/>

    <ClientsLayout>
        <div class="py-12">
            <div class="w-full">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">You're logged in!</div>
                </div>
            </div>
        </div>
    </ClientsLayout>
</template>
