export default {
    options: {
        requestFunction(data) {
            Object.assign(this.url.queryParams, data);
            const equalsRoute = JSON.stringify(this.url) != JSON.stringify(this.currentURL);
            if (this.options.loaded && (typeof this.currentURL == 'undefined' || equalsRoute)) {
                this.currentURL = this.url.url();
                return axios.get(this.url).catch(function (e) {
                    this.dispatch('error', e);
                }.bind(this));
            } else return new Promise(resolve => {
                resolve({
                    data: {
                        data: this.data,
                        count: this.count
                    }
                });
            });
        },
        texts: {
            count: "Mostrando {from} a {to} de {count} resgistros|{count} registros|Un registro",
            first: 'First',
            last: 'Last',
            filter: "Filter:",
            filterPlaceholder: "Search query",
            limit: "Mostrar:",
            page: "Pagina:",
            noResults: "No hay registros",
            filterBy: "Filtrado por {column}",
            loading: 'Cargando...',
            defaultOption: 'Select {column}',
            columns: 'Columnas',
            loaded: false
        },
        filterByColumn: true,
        filterable: [],
        perPageValues: [10, 25, 50, 100, 100],
    },
    init: {
        created() {
            const vm = this;
            if (vm.$parent && vm.$parent.$options.name === 'VtServerTable') {

                const columns = vm.options.columns;
                const parentName = vm.$parent.$parent.$options.name;
                const default_headings = Object.keys(columns).map(column => ({
                    column: column,
                    text: columns[column]['head']
                }));
                const default_columns = Object.fromEntries(Object.keys(columns).map(column => [column, columns[column]['default']]))
                const default_filters = Object.fromEntries(Object.keys(columns).map(column => [column, columns[column]['filter']]));

                vm.$set(vm.$parent.$parent, 'filterable', Object.keys(columns).filter(column => columns[column].filterable));
                vm.$set(vm.$parent.$parent, 'headings', default_headings);
                vm.$parent.$parent.$watch('tableInterface.visibleColumns', function (newColumns) {
                    vm.$set(vm.tableInterface, 'visibleColumns', newColumns);
                    vm.$set(vm.$parent.$parent, 'columns', Object.keys(columns).filter(column => newColumns[column]));
                    vm.emitColumns();
                }, {deep: true});

                vm.$parent.$parent.$watch('tableInterface.filters', function (filters) {
                    vm.$set(vm.tableInterface, 'filters', Object.assign(vm.tableInterface.filters, filters));
                    vm.debouncedEmitFilters();
                }, {deep: true});

                vm.emitColumns = () => {
                    localStorage[`columns_${parentName}_table`] = JSON.stringify(vm.tableInterface.visibleColumns);
                };
                vm.emitFilters = () => {
                    vm.$set(vm.tableInterface, 'debouncedFilters', vm.tableInterface.filters);
                    vm.$set(vm.$parent.$parent.tableInterface, 'debouncedFilters', Object.assign({}, vm.tableInterface.filters));
                    localStorage[`filters_${parentName}_table`] = JSON.stringify(vm.tableInterface.filters);
                    vm.$set(vm.options, 'loaded', true);
                };
                vm.debouncedEmitFilters = vm.debounce(vm.emitFilters, 500);

                if (typeof localStorage[`columns_${parentName}_table`] === "undefined") {
                    vm.$set(vm.$parent.$parent.tableInterface, 'visibleColumns', default_columns);
                    vm.$set(vm.tableInterface, 'visibleColumns', default_columns);
                    vm.emitColumns()
                } else {
                    vm.$set(vm.$parent.$parent.tableInterface, 'visibleColumns', JSON.parse(localStorage[`columns_${parentName}_table`]));
                    vm.$set(vm.tableInterface, 'visibleColumns', JSON.parse(localStorage[`columns_${parentName}_table`]));
                }

                if (typeof localStorage[`filters_${parentName}_table`] === "undefined") {
                    vm.$parent.$parent.$set(vm.tableInterface, 'filters', vm.debouncedFilters = default_filters);
                    vm.emitFilters();
                } else {
                    vm.$set(vm.$parent.$parent.tableInterface, 'filters', JSON.parse(localStorage[`filters_${parentName}_table`]));
                    vm.$set(vm.$parent.$parent.tableInterface, 'debouncedFilters', vm.tableInterface.filters);
                }

                document.querySelector('body').addEventListener('click', function (evt) {

                    if (evt.target.id == 'restore-filters') {
                        vm.$set(vm.$parent.$parent.tableInterface, 'visibleColumns', Object.assign({}, default_columns));
                        vm.$set(vm.$parent.$parent.tableInterface, 'filters', Object.assign({}, default_filters));
                        vm.$set(vm.$parent.$parent, 'headings', []);
                        setTimeout(() => {
                            vm.$set(vm.$parent.$parent, 'headings', default_headings);
                        }, 500);
                        vm.emitFilters();
                        vm.emitColumns();
                    }
                }, true);

            }

        },
        methods: {
            debounce: require('debounce'),
        },
        data() {
            return {
                tableInterface: {filters: {}, debouncedFilters: {}, columns: {}, visibleColumns: {}}
            }
        }
    }
}
