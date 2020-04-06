require('./bootstrap');

window.Vue = require('vue');

import {ServerTable} from 'vue-tables-2';

Vue.use(ServerTable);

import UsersTable from "./components/users/UsersTable";

const app = new Vue({
    el: '#app',
    components: {
        UsersTable,
    }
});
