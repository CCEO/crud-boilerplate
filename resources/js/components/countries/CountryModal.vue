<template>
    <modal name="country-modal" height="auto" @before-open="beforeOpen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{form.method === "post" ? "Crear" : modalShow ? "Detalles de" : "Editar" }} pais
                </h5>
                <button type="button" class="close" @click="$modal.hide('country-modal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <alv-form :action="form.action" id="country-create" :method="form.method" :spinner="true"
                          :data-object="country" @after-done="afterDone" ref="form">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Nombre:</label>
                                <input type="text" class="form-control" name="name" v-model="country.name">
                            </div>
                        </div>
                    </div>
                    <div class="form-group" >
                        <label>Continente</label>
                        <v-select name="continent_id" id="continent_id"
                                  v-model="continents"
                                  :options="continentOptions.map(b=>({label: b.name, code: b.id}))"
                                  :disabled="modalShow"
                        >
                            <div slot="no-options">No se encontraron opciones</div>
                        </v-select>
                    </div>
                    <div class="row" v-if="modalShow">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="formatted_created_at">Fecha de Creación:</label>
                                <input type="text" class="form-control" id="formatted_created_at" v-model="country.formatted_created_at" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="formatted_updated_at">Ultima actualización:</label>
                                <input type="text" class="form-control" id="formatted_updated_at" v-model="country.formatted_updated_at" readonly>
                            </div>
                        </div>
                    </div>
                </alv-form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark" @click="$modal.hide('country-modal')">
                    Cerrar
                </button>
                <button type="submit" class="btn btn-outline-success" form="country-create">Guardar</button>
            </div>
        </div>
    </modal>
</template>

<script>
    const default_fields = {
        name: "",
        continent_id: "",
        continent_name: "",
        formatted_created_at: "",
        formatted_updated_at: "",
    };

    export default {
        name: "CountryModal",
        data() {
            return {
                form: {
                    action: null,
                    method: null
                },
                country: Object.assign({}, default_fields),
                modalShow: false,
                continents: 0,
                continentOptions: []
            }
        },
        methods: {
            afterDone() {
                Object.assign(this.country, this.$options.data().country);
                this.$modal.hide("country-modal");
                this.$refs.form.unsetButtonLoading();
                if (this.$refs.form.submitButton.style.display !== "none") {
                    Vue.$toast.open({duration: 5000, message: "Información actualizada correctamente"});
                    this.$emit("created")
                }
            },
            beforeOpen(event) {
                this.modalShow = false;

                if (typeof event.params.id != "undefined") {
                    if (typeof event.params.show != "undefined") {
                        this.modalShow = true;
                    }
                    this.form.action = this.route("countries.update", event.params);
                    this.form.method = "put";
                    axios.get(this.route("countries.show", event.params)).then(response => {
                        this.country = response.data;
                        this.continents = this.country.continent_name;
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
                    this.continents = "";
                    this.country = Object.assign({}, default_fields);
                    this.form.action = this.route("countries.store");
                    this.form.method = "post";
                }
            }
        },
        created(){
            axios.get(this.route('continents.index', {columns:JSON.stringify(["name"])})).then(response => {
                this.continentOptions = response.data.data;
            })
        },
        watch:{
            continents(){
                this.country.continent_id = this.continents.code
            },
        }
    }
</script>

<style scoped>

</style>
