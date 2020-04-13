<template>
    <div class="table">
        <v-server-table
            :url="route('users.index',{ filters: JSON.stringify(tableInterface.debouncedFilters), columns:JSON.stringify([])})"
            :options="options" ref="table" :columns="columns">

            <div :slot="`filter__${column}`" v-for="column in filterable" v-if="headings.length">
                <input type="text" class="form-control" v-model="tableInterface.filters[column]"
                       :style="'max-width:'+(column=='id'?'50px':'auto')">
            </div>
            <div slot="beforeTable" class="mb-1" v-if="headings.length">
                <div class="dropdown d-inline">
                    <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton"
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
                <button class="btn btn-outline-dark" @click="$modal.show('user-modal')">
                    Nuevo usuario
                </button>
            </div>
        </v-server-table>
        <user-modal @created="reloadTable"></user-modal>
        <br>
    </div>
</template>

<script>
    import UsersTableColumns from './UsersTableColumns'
    import UserModal from './UserModal'

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
                    columns: UsersTableColumns
                }
            }
        },
        methods: {
            reloadTable() {
                const debouncedFilters = Object.assign({reload: ""}, this.tableInterface.debouncedFilters);
                this.$set(this.tableInterface, 'debouncedFilters', debouncedFilters);
            }
        }
    }
</script>
