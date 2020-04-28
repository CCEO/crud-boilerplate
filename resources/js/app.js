require("./bootstrap");
window.Vue = require("vue");

import {ServerTable } from "vue-tables-2";
import route from "ziggy";
import {Ziggy} from "./routes"
import components from "./components";
import tablesConfig from "./tables_config";
import VModal from "vue-js-modal"
import ALVue from "@myshell/alvue";
import VueToast from 'vue-toast-notification';
import flatPickr from "vue-flatpickr-component";
import vSelect from 'vue-select';

import 'flatpickr/dist/flatpickr.css';
import 'vue-select/dist/vue-select.css';
import 'vue-toast-notification/dist/theme-sugar.css';

import {Spanish} from 'flatpickr/dist/l10n/es.js';

Vue.use(VueToast);
Vue.use(VModal, {dialog: true});
Vue.use(ALVue);
Vue.use(ServerTable, tablesConfig.options);
Vue.mixin(tablesConfig.init);
Vue.use(flatPickr);
Vue.component('v-select', vSelect);

Vue.prototype.spanishFlatpickr = Spanish;

Vue.mixin({
    methods: {
        route: (name, params, absolute) => route(name, params, absolute, Ziggy),
    }
});
const app = new Vue({
    el: "#app",
    components: components
});
