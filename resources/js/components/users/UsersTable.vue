<template>
    <div class="table">
        <v-server-table :options="options" ref="table" :columns="columns" class=" table-borderless"
                        :url="route('users.index',{ filters: JSON.stringify(tableInterface.debouncedFilters), columns:JSON.stringify([])})">
            <div :slot="`filter__${column}`" v-for="column in filterable" v-if="headings.length">
                <input type="text" class="form-control" v-model="tableInterface.filters[column]"
                       :style="'max-width:'+(column=='id'?'50px':'auto')">
            </div>
            <div slot="beforeTable" class="mb-1 d-inline-block" v-if="headings.length">
                <div class="dropdown d-inline">
                    <button class="btn btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Modificar Filtros
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <template v-for="column in headings.map(c => c.column).filter(c => c != 'actions')">
                            <p class="dropdown-item">
                                <input type="checkbox" v-model="tableInterface.visibleColumns[column]"
                                       style="margin-right: 5px;">
                                {{ headings.find(col => col.column == column).text }}
                            </p>
                        </template>
                    </div>
                </div>
                <button class="btn btn-outline-dark" id="restore-filters">Restablecer filtros</button>
                <button class="btn btn-outline-dark" @click="$modal.show('user-modal', {reset: true})">
                    Nuevo usuario
                </button>
            </div>
            <template :slot="`h__${heading.column}`" v-for="heading in headings">
                {{heading.text}}
            </template>

            <div slot="actions" slot-scope="props" class="text-center">
                <button class="btn p-0 mx-1" @click="editUser(props.row.id)"><i class="fa fa-edit"></i></button>
                <button class="btn p-0 mx-1" @click="showUser(props.row.id)"><i class="fa fa-eye"></i></button>
                <button class="btn p-0 mx-1" @click="deleteUser(props.row.id)"><i class="fa fa-trash"></i></button>
            </div>

        </v-server-table>
        <user-modal @created="reloadTable"></user-modal>
        <v-dialog/>
        <br>
    </div>
</template>

<script>
    import UsersTableColumns from "./UsersTableColumns"
    import UserModal from "./UserModal"

    export default {
        name: "UsersTable",
        components: {
            UserModal
        },
        data() {
            return {
                columns: [],
                filterable: [],
                headings: [],
                options: {
                    columns: UsersTableColumns,
                    sortIcon: {
                        base: "fa",
                        up: "fa-sort-asc",
                        down: "fa-sort-desc",
                        is: "fa-sort"
                    }
                }
            }
        },
        methods: {
            reloadTable() {
                const debouncedFilters = Object.assign({}, this.tableInterface.debouncedFilters, {reload: Math.random()});
                this.$set(this.tableInterface, "debouncedFilters", debouncedFilters);
                this.$modal.hide("dialog");
            },
            editUser(id) {
                this.$modal.show("user-modal", {id: id});
            },
            showUser(id) {
                this.$modal.show("user-modal", {id: id, show: true});
            },
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
                })
            }
        }
    }
</script>

