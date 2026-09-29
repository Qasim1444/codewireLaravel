import '../css/app.css';
import './bootstrap-vendor.js';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import Layout from './Layouts/AppLayout.vue';
import reveal from './directives/reveal.js';
import { setupMetaPixel } from './meta-pixel.js';

// Registered before createInertiaApp so the initial Inertia navigate event
// (and therefore the first PageView) is captured.
setupMetaPixel();

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true });
        const page = pages[`./Pages/${name}.vue`];
        if (!page) {
            throw new Error(`Page not found: ${name}`);
        }
        if (page.default.layout === undefined) {
            page.default.layout = Layout;
        }
        return page;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .directive('reveal', reveal)
            .mount(el);
    },
});
