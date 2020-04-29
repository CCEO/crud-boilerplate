<template>
    <div class="table">
        <v-server-table :options="options" ref="table" :columns="columns" class=" table-borderless"
                        :url="route('countries.index',{ filters: JSON.stringify(tableInterface.debouncedFilters),
                        columns:JSON.stringify(Object.keys(tableInterface.debouncedFilters))})" name="countries">

            <div ref="loading" slot="afterBody">
                <div class="overlay-loader"></div>
                <clip-loader size="50px" class="clip-loader"></clip-loader>
            </div>

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
                <button class="btn btn-outline-dark" @click="$modal.show('country-modal', {reset: true})">
                    Nuevo pais
                </button>
            </div>
            <div :slot="`h__${heading.column}`" v-for="heading in headings">
                {{heading.text}}
            </div>

            <div slot="filter__formatted_created_at">
                <fieldset>
                    <div class="input-group">
                        <flat-pickr v-model="tableInterface.filters['formatted_created_at']"
                                    class="form-control search-input"
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
                <button class="btn p-0 mx-1" @click="showCountry(props.row.id)"><i class="fa fa-eye"></i></button>
                <button class="btn p-0 mx-1" @click="editCountry(props.row.id)"><i class="fa fa-edit"></i></button>
                <button class="btn p-0 mx-1" @click="deleteCountry(props.row.id)"><i class="fa fa-trash"></i></button>
            </div>

        </v-server-table>
        <country-modal @created="reloadTable"></country-modal>
        <v-dialog/>
        <br>
    </div>
</template>

<script>
    import CountriesTableColumns from "./CountriesTableColumns";
    import CountryModal from "./CountryModal";
    import {Spanish} from "flatpickr/dist/l10n/es.js";
    import ClipLoader from "vue-spinner/src/ClipLoader.vue"
    import {Event} from "vue-tables-2";

    export default {
        name: "countriesTable",
        components: {
            CountryModal,
            "clip-loader": ClipLoader
        },
        data() {
            return {
                columns: [],
                filterable: [],
                headings: [],
                options: {
                    columns: CountriesTableColumns,
                },
                dateConfig: {
                    mode: "range",
                    dateFormat: "Y-m-d",
                    altFormat: "M j, Y",
                    locale: Spanish,
                    wrap: true,
                    altInput: true,
                },
                loading: false,
            }
        },
        mounted() {
            Event.$on("vue-tables.countries.loading", () => {
                this.$refs.loading.style.display = "block"

            });

            Event.$on("vue-tables.countries.loaded", () => {
                this.$refs.loading.style.display = "none"

            });
        },
        methods: {
            reloadTable() {
                const debouncedFilters = Object.assign({}, this.tableInterface.debouncedFilters, {reload: Math.random()});
                this.$set(this.tableInterface, "debouncedFilters", debouncedFilters);
                this.$modal.hide("dialog");
            },
            editCountry(id) {
                this.$modal.show("country-modal", {id: id});
            },
            showCountry(id) {
                this.$modal.show("country-modal", {id: id, show: true});
            },
            deleteCountry(id) {
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
                                axios.delete(this.route("countries.destroy", id)).then(this.reloadTable);
                                Vue.$toast.open({duration: 5000, message: "Elemento eliminado exitosamente."});
                            }
                        }
                    ]
                })
            }
        }
    }
</script>

<style>
    table {
        width: 100%;
        position: relative;
    }

    .overlay-loader {
        position: absolute;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: white;
        opacity: 0.8;
        filter: blur(5px);
    }

    .clip-loader {
        position: absolute;
        left: 50%;
        right: 50%;
        bottom: 60%;
        top: 40%;
    }
</style>
