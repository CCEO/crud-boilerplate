
<p align="center"><img src="http://www.cceo.com.mx/assets/images/logo.png" width="400"></p>  
  
## About Crud Boilerplate  
  
Crud Boilerplate is an example project that includes the structure to display a resource table.  
It has the automatic storage in localStorage of the filters and columns that you want to show  
Furthermore it is possible to create, display, edit and delete elements through pop-up windows.  
  
## Usage  

### Install  npm and composer dependencies
```shell script  
composer require tightenco/ziggy
npm install -s vue babel-helper-vue-jsx-merge-props vue-tables-2 debounce vue-js-modal @myshell/alvue bootstrap jquery popper.js font-awesome vue-toast-notification
```  

### Include all dependencies in the project
##### Configure webpack.mix.js 
  ```javascript 
  mix.webpackConfig({  
    resolve: {  
        alias: {  
            ziggy: path.resolve('vendor/tightenco/ziggy/dist/js/route.js')  
        }  
    }  
  });
  ```
  
##### Configure your package.json scripts to add generation of ziggy route.js file 
  ```javascript 
 {  
    "scripts": {  
        "development": "php artisan ziggy:generate 'resources/js/routes.js' | cross-env NODE_ENV=development node_modules/webpack/bin/webpack.js --progress --hide-modules --config=node_modules/laravel-mix/setup/webpack.config.js",
        "production": "php artisan ziggy:generate 'resources/js/routes.js' | cross-env NODE_ENV=production node_modules/webpack/bin/webpack.js --no-progress --hide-modules --config=node_modules/laravel-mix/setup/webpack.config.js"  
    }  
  }
  ```
  
##### Configure resources/js/bootstrap.js  
```javascript  
/**  
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application. 
 */  
 
try {  
    window.Popper = require('popper.js').default;  
  window.$ = window.jQuery = require('jquery');  
  
  require('bootstrap');  
} catch (e) {}
 
 /**
  * Next we will register the CSRF Token as a common header with Axios so that 
  * all outgoing HTTP requests automatically have it attached. This is just 
  * a simple convenience so we don't have to attach every token manually. 
  */
let token = document.head.querySelector('meta[name="csrf-token"]');  
  
if (token) {  
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;  
} else {  
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');  
}
```

##### Configure resources/js/app.js  
```javascript  
// Import Vue
window.Vue = require("vue");

// Import plugins and settings import {ServerTable} from "vue-tables-2";  
import route from "ziggy";  
import {Ziggy} from "./routes"  
import components from "./components";  
import tablesConfig from "./tables_config";  
import VModal from "vue-js-modal"import ALVue from "@myshell/alvue";  
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';

// Include plugins on Vue  
Vue.use(VueToast);
Vue.use(VModal, {dialog: true});  
Vue.use(ALVue);  
Vue.use(ServerTable, tablesConfig.options);  
Vue.mixin(tablesConfig.init);  
  
// Add ziggy method to global mixin  
Vue.mixin({  
  methods: {  
  route: (name, params, absolute) => route(name, params, absolute, Ziggy),  
 }});  
  
// Include components from components.js  
const app = new Vue({  el: "#app",  
  components: components  
});  
```

##### Include bootstrap, font-awesome and _table.scss into resources/sass/app.scss
```scss
// Bootstrap  
@import '~bootstrap/scss/bootstrap';

//Font Awesome  
@import "~font-awesome/scss/font-awesome";

//Custom tables  
@import "tables";
```

### Create Table 
##### Copy these files to your project in the same path  
```  
resources/js/tables_config.js  
resources/js/components.js  
resources/sass/_tables.scss  
```  

##### Create a columns file like this
```javascript
export default {
    id: {
        head: "ID", // Text of head 
        default: true, // Show column by default
        filterable: true, // Show filter on column
        filter: "", // Default value for filter
        sorteable: "" // Set column as sorteable
    },
    name: {
        head: "Nombre",
        default: true,
        filterable: true,
        filter: ""
    },
}
```

##### Create a component with this template

```html
<template>
	<div class="table p-5">  
		<v-server-table :options="options" ref="table" :columns="columns" class=" table-borderless"  :url="route('users.index',{ filters: JSON.stringify(tableInterface.debouncedFilters), columns:JSON.stringify([])})">  
			<div :slot="`filter__${column}`" v-for="column in filterable" v-if="headings.length">  
				 <input type="text" class="form-control" v-model="tableInterface.filters[column]"  :style="'max-width:'+(column=='id'?'50px':'auto')">  
			</div> 
			<div slot="beforeTable" class="mb-1 d-inline-block" v-if="headings.length">  
				<div class="dropdown d-inline">  
					<button class="btn btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">  
						Modificar Filtros  
					</button>  
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">  
						<template v-for="column in headings.map(c => c.column).filter(c => c != 'actions')">
							<p class="dropdown-item">  
								<input type="checkbox" v-model="tableInterface.visibleColumns[column]"  style="margin-right: 5px;">  
								{{ headings.find(col => col.column == column).text }}  
                            </p>  
						</template>
					</div>
				</div>
				<button class="btn btn-outline-dark" id="restore-filters">Restablecer filtros</button>
			</div>
			<div :slot="`h__${heading.column}`" v-for="heading in headings">  
				<span title="" class="VueTables__heading">{{heading.text}}</span>  
			</div>
		</v-server-table>
	</div>
</template>  
  
<script>  
  import UsersTableColumns from "./UsersTableColumns"  // Import columns file
  
  export default {  
        name: "UsersTable",  
        data() {  
            return {  
                columns: [],  
                filterable: [],  
                headings: [], 
                options: {  
	                columns: UsersTableColumns  
                }  
            }  
        }  
    }  
</script>
```

### Add edit modal
##### Create a component with a modal like this
```html
<template>
    <modal name="user-modal" height="auto" @before-open="beforeOpen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{form.method === "post" ? "Crear" : "Editar"}} usuario
                </h5>
                <button type="button" class="close" @click="$modal.hide('user-modal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <alv-form :action="form.action" id="user-create" :method="form.method" :spinner="true"
                          :data-object="user" @after-done="afterDone" ref="form">
                    <div class="form-group">
                        <label>Nombre:</label>
                        <input type="text" class="form-control" name="name" v-model="user.name">
                    </div>
                    <div class="form-group">
                        <label>Correo electrónico:</label>
                        <input type="text" class="form-control" name="email" v-model="user.email">
                    </div>
                    <div class="form-group">
                        <label>Contraseña:</label>
                        <input type="text" class="form-control" name="password" v-model="user.password">
                    </div>
                </alv-form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark" @click="$modal.hide('user-modal')">
                    Cerrar
                </button>
                <button type="submit" class="btn btn-outline-success" form="user-create">Guardar</button>
            </div>
        </div>
    </modal>
</template>

<script>
    const default_user = {
        name: "",
        email: "",
        password: ""
    };

    export default {
        name: "UserModal",
        data() {
            return {
                form: {
                    action: null,
                    method: null
                },
                user: Object.assign({}, default_user)
            }
        },
        methods: {
            afterDone() {
                Object.assign(this.user, this.$options.data().user);
                this.$modal.hide("user-modal");
                this.$refs.form.unsetButtonLoading();
                if (this.$refs.form.submitButton.style.display !== "none") {
                    Vue.$toast.open({duration: 5000, message: "Información actualizada correctamente"});
                    this.$emit("created")
                }
            },
            beforeOpen(event) {
                if (typeof event.params.id != "undefined") {
                    this.form.action = this.route("users.update", event.params.id);
                    this.form.method = "put";
                    axios.get(this.route("users.show", event.params.id)).then(response => {
                        this.user = response.data;
                        this.$nextTick(function () {
                            if (typeof event.params.show != "undefined") {
                                this.$refs.form.$refs.form.querySelectorAll("[name]").forEach(e => e.disabled = true);
                                this.$refs.form.submitButton.style.display = "none"
                            } else {
                                this.$refs.form.$refs.form.querySelectorAll("[name]").forEach(e => e.disabled = false);
                                this.$refs.form.submitButton.style.display = null
                            }
                        })
                    });

                } else {
                    this.user = Object.assign({}, default_user);
                    this.form.action = this.route("users.store");
                    this.form.method = "post";
                }
            }
        }
    }
</script>
```

##### Add action column table to columns file
```javascript
    actions: {
        head: "Acciones",
        default: true,
        filterable: false,
    }
```
##### Include actions slot on table component
```html
<div slot="actions" slot-scope="props" class="text-center">
	<button class="btn p-0 mx-1" @click="editUser(props.row.id)">
		<i class="fa fa-edit"></i>
	</button>
</div>
```

##### Include modal component
```html
<user-modal @created="reloadTable"></user-modal>
```

##### Import modal component and create reload table  and edit methods

```javascript
import UserModal from "./UserModal"

export default {
	components: {
        UserModal
    },
    methods: {
        reloadTable() {
            const debouncedFilters = Object.assign({}, this.tableInterface.debouncedFilters, {reload: Math.random()});
            this.$set(this.tableInterface, "debouncedFilters", debouncedFilters);
            this.$modal.hide("dialog");
        },
        editUser(id) {
	        this.$modal.show("user-modal", id);
        }
    }
}
```
### Add show modal
##### Add button show to actions slot
```html
<button class="btn p-0 mx-1" @click="showUser(props.row.id)"><i class="fa fa-eye"></i></button>
```

##### Add show method
```javascript
export default {
    methods: {
        showUser(id) {
            this.$modal.show("user-modal", {id: id, show: true});
        },
    }
}
```
### Add delete dialog
##### Include v-dialog component into table component
```html
<v-dialog/>
```
##### Add button delete to actions slot
```html
<button class="btn p-0 mx-1" @click="deleteUser(props.row.id)">
	<i class="fa fa-trash"></i>
</button>
```
##### Add delete method 
```javascript
export default {
    methods: {
        deleteUser(id) {
            this.$modal.show("dialog", {
                title: "Eliminar usuario",
                text: "¿Desea eliminar el usuario?",
                buttons: [
                    {
                        title: "Cancelar"
                    },
                    {
                        title: "Eliminar",
                        handler: () => {
                            axios.delete(this.route("users.destroy", id)).then(this.reloadTable);
                        }
                    }
                ]
            });
        }
    }
}
```
