<template>
    <div class="table">
        <v-server-table :options="options" ref="table" :columns="columns" class=" table-borderless"
                        :url="route('marital.states.index',{ filters: JSON.stringify(tableInterface.debouncedFilters),
                        columns:JSON.stringify(Object.keys(tableInterface.debouncedFilters))})">
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
                <button class="btn btn-outline-dark" @click="$modal.show('marital-status-modal', {reset: true})">
                    Nuevo estado civil
                </button>
            </div>
            <div :slot="`h__${heading.column}`" v-for="heading in headings">
                {{heading.text}}
            </div>

            <div slot="filter__formatted_created_at">
                <fieldset>
                    <div class="input-group">
                        <flat-pickr v-model="tableInterface.filters['formatted_created_at']" class="form-control search-input"
                                    :config="dateConfig">
                        </flat-pickr>
                        <div class="input-group-append">
                            <button class="btn btn-light glow" type="button" data-clear><i class="fa fa-times"><span
                                aria-hidden="true" class="sr-only">Limpiar</span></i>
                            </button>
                        </div>
                    </div>
                </fieldset>
            </div>

            <div slot="actions" slot-scope="props" class="text-center">
                <button class="btn p-0 mx-1" @click="showMaritalStatus(props.row.id)"><i class="fa fa-eye"></i></button>
                <button class="btn p-0 mx-1" @click="editMaritalStatus(props.row.id)"><i class="fa fa-edit"></i></button>
                <button class="btn p-0 mx-1" @click="deleteMaritalStatus(props.row.id)"><i class="fa fa-trash"></i></button>
            </div>

        </v-server-table>
        <marital-status-modal @created="reloadTable"></marital-status-modal>
        <v-dialog/>
        <br>
    </div>
</template>

<script>
    import MaritalStatesTableColumns from "./MaritalStatesTableColumns";
    import MaritalStatusModal from "./MaritalStatusModal";
    import {Spanish} from 'flatpickr/dist/l10n/es.js';

    export default {
        name: "MaritalStateTable",
        components: {
            MaritalStatusModal
        },
        data() {
            return {
                columns: [],
                filterable: [],
                headings: [],
                options: {
                    columns: MaritalStatesTableColumns,
                },
                dateConfig: {
                    mode: "range",
                    dateFormat: 'Y-m-d',
                    altFormat: 'M j, Y',
                    locale: Spanish,
                    wrap: true,
                    altInput: true,
                },
            }
        },
        methods: {
            reloadTable() {
                const debouncedFilters = Object.assign({}, this.tableInterface.debouncedFilters, {reload: Math.random()});
                this.$set(this.tableInterface, "debouncedFilters", debouncedFilters);
                this.$modal.hide("dialog");
            },
            editMaritalStatus(id) {
                this.$modal.show("marital-status-modal", {id: id});
            },
            showMaritalStatus(id) {
                this.$modal.show("marital-status-modal", {id: id, show: true});
            },
            deleteMaritalStatus(id) {
                this.$modal.show("dialog", {
                    title: "Eliminar registro",
                    text: "¿Desea eliminar el registro?",
                    buttons: [
                        {
                            title: "Cancelar"
                        },
                        {
                            title: "Eliminar",
                            handler: () => {
                                axios.delete(this.route("marital.states.destroy", id)).then(this.reloadTable);
                                Vue.$toast.open({duration: 5000, message: "Elemento eliminado exitosamente."});
                            }
                        }
                    ]
                })
            }
        }
    }
</script>

