<script>
import {usePage} from "@inertiajs/vue3";
import SidebarAdmin from "@/Layouts/Core/SidebarAdmin.vue";
import HeaderAdmin from "@/Layouts/Core/HeaderAdmin.vue";

export default {
    components: {SidebarAdmin, HeaderAdmin},
    data() {
        return {
            page: usePage()
        }
    },
    computed: {
        user() {
            return this.page.props.auth.user
        }
    },
};
</script>
<template>
    <div class="h-screen overflow-y-hidden bg-gray-50">
        <HeaderAdmin></HeaderAdmin>
        <SidebarAdmin></SidebarAdmin>
        <main class="p-4 md:ml-64 h-full pt-4">
            <slot/>
        </main>
    </div>
</template>
