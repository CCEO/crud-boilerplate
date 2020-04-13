require('./bootstrap');
window.Vue = require('vue');

import {ServerTable} from 'vue-tables-2';
import route from 'ziggy';
import {Ziggy} from './routes'
import components from "./components";
import tablesConfig from './tables_config';
import VModal from 'vue-js-modal'
import ALVue from '@myshell/alvue';

Vue.use(VModal);
Vue.use(ALVue);
Vue.use(ServerTable, tablesConfig.options);
Vue.mixin(tablesConfig.init);

Vue.mixin({
    methods: {
        route: (name, params, absolute) => route(name, params, absolute, Ziggy),
    }
});
const app = new Vue({
    el: '#app',
    components: components
});
