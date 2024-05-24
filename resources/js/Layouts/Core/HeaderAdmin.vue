<template>
    <header class="p-5 left-0 right-0 top-0 z-50 md:ml-64 h-auto">
        <div class="flex flex-wrap justify-between items-baseline">
            <div class="flex flex-col justify-start items-start">
                <h2>{{ $t("main.hello") }}{{ user.name }}!</h2>
                <fwb-breadcrumb>
                    <fwb-breadcrumb-item>
                        <template #arrow-icon>&nbsp;</template>
                        Dashboard
                    </fwb-breadcrumb-item>
                </fwb-breadcrumb>
            </div>
            <div class="flex items-center lg:order-2 gap-2">
                <p class="text-xl font-semibold">
                    {{ tenant.id }}
                </p>
                <fwb-avatar img="/storage/users/placeholder.jpg"/>
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

