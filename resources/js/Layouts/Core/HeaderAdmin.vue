<template>
    <header class="pt-5 left-0 right-0 top-0 z-50 h-auto">
        <div class="flex flex-wrap justify-between items-baseline">
            <div class="flex flex-col justify-start items-start">
                <h1 class="text-32 font-bold custom-font">{{ $t("main.hello") }}{{ user.name }}!</h1>
                <fwb-breadcrumb>
                    <fwb-breadcrumb-item>
                        <template #arrow-icon>&nbsp;</template>
                        Dashboard
                    </fwb-breadcrumb-item>
                </fwb-breadcrumb>
            </div>
            <div class="flex items-center lg:order-2 gap-2" v-if="tenant">
                <p class="text-20 font-bold leading-tight">
                    {{ tenant.id }}
                </p>

                <fwb-avatar img="/storage/users/placeholder.jpg" rounded />
            </div>
        </div>
    </header>
</template>
<script>
import {usePage} from "@inertiajs/vue3";
import {FwbAvatar, FwbBreadcrumb, FwbBreadcrumbItem} from "flowbite-vue";

export default {
    components: {FwbBreadcrumbItem, FwbBreadcrumb, FwbAvatar},
    data() {
        return {
            page: usePage()
        }
    },
    computed: {
        user() {
            return this.page.props.auth.user
        },
        tenant() {
            return this.page.props.tenant
        }
    },
};
</script>

<style>

</style>
