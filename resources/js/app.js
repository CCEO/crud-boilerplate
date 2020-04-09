require('./bootstrap');

window.Vue = require('vue');

import {ServerTable} from 'vue-tables-2';
import components from "./components";
import tablesConfig from './tables_config';

Vue.use(ServerTable, tablesConfig.options);
Vue.mixin(tablesConfig.init);

Vue.mixin({
    methods: {
        route: route
    }
});
const app = new Vue({
    el: '#app',
    components: components
});
