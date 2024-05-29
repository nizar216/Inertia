<script>
import {usePage} from "@inertiajs/vue3";
import SidebarTenant from "@/Layouts/Core/SidebarTenant.vue";
import HeaderAdmin from "@/Layouts/Core/HeaderAdmin.vue";

export default {
    components: {SidebarTenant, HeaderAdmin},
    data() {
        return {
            page: usePage(),
            sidebarExpanded: localStorage.getItem("is_expanded") === "true"
        }
    },
    computed: {
        user() {
            return this.page.props.auth.user
        }
    },
    methods: {
        handleSidebarChange(isExpanded) {
            this.sidebarExpanded = isExpanded;
        }
    }
};
</script>
<template>
    <div class="h-screen overflow-y-hidden bg-gray-50">
        <SidebarTenant @update:isExpanded="handleSidebarChange"></SidebarTenant>
        <div :class="sidebarExpanded ? 'md:ml-[260px]' : 'md:ml-[104px]'">
            <HeaderAdmin></HeaderAdmin>
            <main class="p-4 h-full pt-4">
                <slot/>
            </main>
        </div>
    </div>
</template>
