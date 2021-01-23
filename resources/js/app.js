require('./bootstrap');

// Import modules...
import Vue from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue';
import PortalVue from 'portal-vue';
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

let options = {
    position: 'bottom-right'
}

Vue.mixin({ methods: { route } });
Vue.use(InertiaPlugin);
Vue.use(Toast, options);
Vue.use(PortalVue);

const app = document.getElementById('app');

new Vue({
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app);
