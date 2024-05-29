<template>
    <fwb-sidebar :class="['w-60', 'bg-white', { 'is-expanded': isExpanded }, {'collapsed': !isExpanded}]"
                 :style="{ width: isExpanded ? '240px' : '84px' }">
        <div class="flex flex-col gap-10 w-full">
            <div @click="toggleMenu" class="pt-7 pl-5 pr-6 pb-0">
                <img v-if="isExpanded" class="h-[50px]" :src="tenant.logo" alt="logo">
                <img v-else class="w-10 h-[50px]" src="/storage/logos/bauvista-sidebar-logo.png" alt="logo">
            </div>
            <div class="overflow-y-auto flex flex-col gap-10 m-sidebar-menu-items">
                <div v-for="(group, index) in groupedSidebarItems" :key="index" class="flex flex-col gap-2">
                    <SidebarItem v-for="(item, itemIndex) in group.items" :key="itemIndex"
                                 :class="['m-sidebar-item', { 'm-active': route().current('clients.dashboard') }]"
                                 :href="item.link">
                        <template #svg>
                            <base-icon :is-expanded="isExpanded" :height="isExpanded ? '20px' : '24px'" :width="isExpanded ? '20px' : '24px'">
                                <component :is="item.icon"/>
                            </base-icon>
                        </template>
                        <template #default v-if="isExpanded">{{ item.text }}</template>
                    </SidebarItem>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-2 w-full pb-6">
            <SidebarItem class="m-sidebar-item" href="">
                <template #svg>
                    <base-icon :is-expanded="isExpanded" :height="isExpanded ? '20px' : '24px'" :width="isExpanded ? '20px' : '24px'">
                        <IconSettings color="black"></IconSettings>
                    </base-icon>
                </template>
                <template #default v-if="isExpanded">Einstellungen</template>
            </SidebarItem>
            <SidebarItem class="m-sidebar-item" :href="route('tenant.logout')" method="post" as="button">
                <template #svg>
                    <base-icon :is-expanded="isExpanded" :height="isExpanded ? '20px' : '24px'" :width="isExpanded ? '20px' : '24px'">
                        <IconLogout color="#D90B0B"></IconLogout>
                    </base-icon>
                </template>
                <template #default v-if="isExpanded"><span class="text-red-500">Ausloggen</span></template>
            </SidebarItem>
        </div>
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
                {text: 'Dashboard', icon: markRaw(IconDashboard), link: route('clients.dashboard')},
                {separator: true},
                {text: 'Medien', icon: markRaw(IconMedia), link: '/tenant'},
                {text: 'Medien-typen', icon: markRaw(IconMediaType), link: '/tenant'},
                {text: 'Seiten', icon: markRaw(IconMedia), link: '/tenant'},
                {text: 'Lieferanten', icon: markRaw(IconSupplier), link: '/tenant'},
                {text: 'Kategorien', icon: markRaw(IconCategory), link: '/tenant'},
                {text: 'Tags', icon: markRaw(IconTag), link: '/tenant'},
                {separator: true},
                {text: 'Bestellungen', icon: markRaw(IconOrder), link: '/tenant'},
                {separator: true},
                {text: 'Frontend-Kunden', icon: markRaw(IconClient), link: '/tenant'},
                {text: 'Kundengruppen', icon: markRaw(IconGroup), link: '/tenant'},
                {separator: true},
                {text: 'Backend-Nutzer', icon: markRaw(IconBackendUser), link: '/tenant'},
                {text: 'Backend-Rollen', icon: markRaw(IconBackendGroup), link: '/tenant'}
            ],
            page: usePage(),
            color: "#0080C9",
            isExpanded: localStorage.getItem("is_expanded") === "true",
        }
    },
    watch: {
        isExpanded(newVal) {
            this.$emit('update:isExpanded', newVal);
        }
    },
    computed: {
        tenant() {
            return this.page.props.tenant
        },
        groupedSidebarItems() {
            let groupedItems = [];
            let currentGroup = {items: []};

            this.sidebarItems.forEach(item => {
                if (item.separator) {
                    if (currentGroup.items.length > 0) {
                        groupedItems.push(currentGroup);
                        currentGroup = {items: []};
                    }
                } else {
                    currentGroup.items.push(item);
                }
            });

            if (currentGroup.items.length > 0) {
                groupedItems.push(currentGroup);
            }

            return groupedItems;
        }
    },
    methods: {
        toggleMenu() {
            this.isExpanded = !this.isExpanded;
            localStorage.setItem("is_expanded", this.isExpanded);
        },
    },
};

</script>
<style>
aside {
    width: 240px;


    > div.h-full {
        @apply bg-white;
        width: 100%;
        padding: 0;
        overflow-y: hidden;


        > div {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
    }
}

.m-sidebar-item {
    @apply cursor-pointer m-0 pt-0 pl-6 pr-0 pb-0 ml-1;
}
.m-sidebar-menu-items{
    max-height: calc(100vh - 250px);
    /* width */
    &::-webkit-scrollbar {
        width: 5px;
    }

    /* Track */
    &::-webkit-scrollbar-track {
        background: rgba(128, 128, 128, 0.25);
    }

    /* Handle */
    &::-webkit-scrollbar-thumb {
        background: rgba(128, 128, 128, 0.75);
    }

    /* Handle on hover */
    &::-webkit-scrollbar-thumb:hover {
        background: rgba(128, 128, 128, 0.8);
    }
}
.m-active {
    color: #0080C9
}
</style>
