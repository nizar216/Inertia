<template>
    <fwb-sidebar>
        <fwb-sidebar-logo name="Flowbite" logo="https://flowbite.com/docs/images/logo.svg" tag="router-link"/>
        <fwb-sidebar-item v-for="(item, itemIndex) in sidebarItems" :key="itemIndex">
            <template v-if="!item.separator" #icon>
                <base-icon :icon-name="item.icon">
                    <component :is="item.icon"/>
                </base-icon>
            </template>
            <template v-if="!item.separator" #default>{{ item.text }}</template>
            <template v-if="item.separator" #default>
                <hr/>
            </template>
        </fwb-sidebar-item>
    </fwb-sidebar>
</template>

<script>
import {FwbSidebar, FwbSidebarItem, FwbSidebarLogo} from "flowbite-vue";
import BaseIcon from "@/Components/Shared/BaseIcon.vue";
import IconDashboard from "@/Components/Icons/IconDashboard.vue";
import IconMedia from "@/Components/Icons/IconMedia.vue";
import IconMediaType from "@/Components/Icons/IconMediaType.vue";
import IconPage from "@/Components/Icons/IconPage.vue";
import IconSupplier from "@/Components/Icons/IconSupplier.vue";
import IconCategory from "@/Components/Icons/IconCategory.vue";
import IconTag from "@/Components/Icons/IconTag.vue";
import IconOrder from "@/Components/Icons/IconOrder.vue";
import IconClient from "@/Components/Icons/IconClient.vue";
import IconGroup from "@/Components/Icons/IconGroup.vue";
import IconBackendUser from "@/Components/Icons/IconBackendUser.vue";
import IconBackendGroup from "@/Components/Icons/IconBackendGroup.vue";

export default {
    components: {
        FwbSidebarLogo,
        IconDashboard,
        BaseIcon,
        FwbSidebar,
        FwbSidebarItem
    },
    data() {
        return {
            sidebarItems: [
                {text: 'Dashboard', icon: IconDashboard},
                {separator: true},
                {text: 'Medien', icon: IconMedia},
                {text: 'Medien-typen', icon: IconMediaType},
                {text: 'Seiten', icon: IconMedia},
                {text: 'Lieferanten', icon: IconSupplier},
                {text: 'Kategorien', icon: IconCategory},
                {text: 'Tags', icon: IconTag},
                {separator: true},
                {text: 'Bestellungen', icon: IconOrder},
                {separator: true},
                {text: 'Frontend-Kunden', icon: IconClient},
                {text: 'Kundengruppen', icon: IconGroup},
                {separator: true},
                {text: 'Backend-Nutzer', icon: IconBackendUser},
                {text: 'Backend-Rollen', icon: IconBackendGroup}
            ]
        };
    },
    methods: {}
};
</script>

<style scoped>
hr {
    border: 0;
    height: 1px;
    background: #ccc;
    margin: 0.5rem 0;
}
</style>
