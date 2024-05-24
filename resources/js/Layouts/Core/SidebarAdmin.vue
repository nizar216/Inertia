<template>
    <aside id="sidebar"
           class="fixed top-0 left-0 z-20 flex flex-col flex-shrink-0 hidden w-64 h-full pt-16 font-normal duration-75 lg:flex transition-width bg-white"
           aria-label="Sidebar">
        <fwb-sidebar>
            <img class="h-12" :src="tenant.logo" alt="logo">
            <template v-for="(item, itemIndex) in sidebarItems" :key="itemIndex">
                <SidebarItem v-if="!item.separator"  :class="['m-sidebar-item', { 'm-active': route().current('clients.dashboard') }]" :href="item.link">
                    <template #svg>
                        <base-icon :icon-color="route().current('clients.dashboard') ? '#0080C9' : '#000000'">
                            <component :is="item.icon"/>
                        </base-icon>
                    </template>
                    <template #default >{{ item.text }}</template>
                </SidebarItem>
                <template v-if="item.separator">
                    <div class="h-8"></div>
                </template>
            </template>
            <fwb-sidebar-item class="m-sidebar-item">
                <template #icon>
                    <base-icon>
                       <IconSettings color="black"></IconSettings>
                    </base-icon>
                </template>
                <template #default>Einstellungen</template>
            </fwb-sidebar-item>
            <SidebarItem class="m-sidebar-item" :href="route('tenant.logout')" method="post" as="button">
                <template #svg>
                    <base-icon>
                     <IconLogout color="#D90B0B"></IconLogout>
                    </base-icon>
                </template>
                <template #default><span class="text-red-500">Ausloggen</span></template>
            </SidebarItem>
        </fwb-sidebar>
    </aside>
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
import {usePage} from "@inertiajs/vue3";
import {computed, markRaw} from "vue";
import IconSettings from "@/Components/Icons/IconSettings.vue";
import IconLogout from "@/Components/Icons/IconLogout.vue";
import SidebarItem from "@/Components/Shared/SidebarItem.vue";
import DropdownLink from "@/Components/DropdownLink.vue";

export default {
    components: {
        DropdownLink,
        SidebarItem,
        IconLogout,
        IconSettings,
        FwbSidebarLogo,
        IconDashboard,
        BaseIcon,
        FwbSidebar,
        FwbSidebarItem
    },
    data() {
        return {
            sidebarItems: [
                {text: 'Dashboard', icon: markRaw(IconDashboard),link:route('clients.dashboard')},
                {separator: true},
                {text: 'Medien', icon: markRaw(IconMedia),link:'/tenant'},
                {text: 'Medien-typen', icon:markRaw( IconMediaType),link:'/tenant'},
                {text: 'Seiten', icon: markRaw(IconMedia),link:'/tenant'},
                {text: 'Lieferanten', icon: markRaw(IconSupplier),link:'/tenant'},
                {text: 'Kategorien', icon: markRaw(IconCategory),link:'/tenant'},
                {text: 'Tags', icon: markRaw(IconTag),link:'/tenant'},
                {separator: true},
                {text: 'Bestellungen', icon: markRaw(IconOrder),link:'/tenant'},
                {separator: true},
                {text: 'Frontend-Kunden', icon: markRaw(IconClient),link:'/tenant'},
                {text: 'Kundengruppen', icon: markRaw(IconGroup),link:'/tenant'},
                {separator: true},
                {text: 'Backend-Nutzer', icon: markRaw(IconBackendUser),link:'/tenant'},
                {text: 'Backend-Rollen', icon: markRaw(IconBackendGroup),link:'/tenant'}
            ],
            page: usePage(),
            color:"#0080C9"
        }
    },
    computed: {
        tenant() {
            return this.page.props.tenant
        }
    },
};
</script>
<style>
aside > div.h-full {
    @apply bg-white;
}
.m-sidebar-item{
    @apply cursor-pointer
}
.m-active{
    color:#0080C9
}
</style>
