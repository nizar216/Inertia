import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import {initFlowbite} from "flowbite";
import { createI18n } from 'vue-i18n'
import de from "./locales/de.json";
import en from "./locales/en.json";
import {createMemoryHistory, createRouter} from "vue-router";
const appName = import.meta.env.VITE_APP_NAME || 'Laravel';
const i18n = createI18n({
    locale: "de",
    fallbackLocale: "en",
    messages: { de, en },
});

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({el, App, props, plugin}) {
        return createApp({render: () => h(App, props)})
            .use(plugin)
            .use(ZiggyVue)
            .use(i18n)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
}).then(r =>{
    initFlowbite();
});
