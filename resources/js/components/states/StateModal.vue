<template>
    <modal name="state-modal" height="auto" @before-open="beforeOpen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{form.method === "post" ? "Crear" : "Editar"}} estado
                </h5>
                <button type="button" class="close" @click="$modal.hide('state-modal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <alv-form :action="form.action" id="state-create" :method="form.method" :spinner="true"
                          :data-object="state" @after-done="afterDone" ref="form">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Nombre:</label>
                                <input type="text" class="form-control" name="name" v-model="state.name">
                            </div>
                        </div>
                    </div>
                    <div class="form-group" >
                        <label>Pais</label>
                        <v-select name="country_id" id="country_id"
                                  v-model="countries"
                                  :options="countryOptions.map(b=>({label: b.name, code: b.id}))"
                                  :disabled="modalShow"
                        >
                            <div slot="no-options">No se encontraron opciones</div>
                        </v-select>
                    </div>
                    <div class="row" v-if="modalShow">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="formatted_created_at">Fecha de Creación:</label>
                                <input type="text" class="form-control" id="formatted_created_at" v-model="state.formatted_created_at" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="formatted_updated_at">Ultima actualización:</label>
                                <input type="text" class="form-control" id="formatted_updated_at" v-model="state.formatted_updated_at" readonly>
                            </div>
                        </div>
                    </div>
                </alv-form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark" @click="$modal.hide('state-modal')">
                    Cerrar
                </button>
                <button type="submit" class="btn btn-outline-success" form="state-create">Guardar</button>
            </div>
        </div>
    </modal>
</template>

<script>
    const default_fields = {
        name: "",
        country_id: "",
        country_name: "",
        formatted_created_at: "",
        formatted_updated_at: "",
    };

    export default {
        name: "StateModal",
        data() {
            return {
                form: {
                    action: null,
                    method: null
                },
                state: Object.assign({}, default_fields),
                modalShow: false,
                countries: 0,
                countryOptions: []
            }
        },
        methods: {
            afterDone() {
                Object.assign(this.state, this.$options.data().state);
                this.$modal.hide("state-modal");
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
                    this.form.action = this.route("states.update", event.params);
                    this.form.method = "put";
                    axios.get(this.route("states.show", event.params)).then(response => {
                        this.state = response.data;
                        this.countries = this.state.country_name;
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
                    this.countries = "";
                    this.state = Object.assign({}, default_fields);
                    this.form.action = this.route("states.store");
                    this.form.method = "post";
                }
            }
        },
        created(){
            axios.get(this.route('countries.index', {columns:JSON.stringify(["name"])})).then(response => {
                this.countryOptions = response.data.data;
            })
        },
        watch:{
            countries(){
                this.state.country_id = this.countries.code
            },
        }
    }
</script>

<style scoped>

</style>
