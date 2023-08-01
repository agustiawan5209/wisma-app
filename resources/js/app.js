import './bootstrap';
import '../css/app.css';
import '../css/style.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';

import {
    library
} from '@fortawesome/fontawesome-svg-core'

/* import font awesome icon component */
import {
    FontAwesomeIcon
} from '@fortawesome/vue-fontawesome'

import {
    fas
} from '@fortawesome/free-solid-svg-icons'
import {
    far
} from '@fortawesome/free-regular-svg-icons'
import {
    fab
} from '@fortawesome/free-brands-svg-icons'
/* add icons to the library */
library.add(fas, far, fab)


const appName = import.meta.env.VITE_APP_NAME || 'Malaqbi';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .component('font-awesome-icon', FontAwesomeIcon)
            .mixin({components:{QuillEditor}})
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
