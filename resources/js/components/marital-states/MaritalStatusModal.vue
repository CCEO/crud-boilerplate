<template>
    <modal name="marital-status-modal" height="auto" @before-open="beforeOpen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{form.method === "post" ? "Crear" : "Editar"}} estado civil
                </h5>
                <button type="button" class="close" @click="$modal.hide('marital-status-modal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <alv-form :action="form.action" id="marital-status-create" :method="form.method" :spinner="true"
                          :data-object="maritalStatus" @after-done="afterDone" ref="form">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Nombre:</label>
                                <input type="text" class="form-control" name="name" v-model="maritalStatus.name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="formatted_created_at">Fecha de Creación:</label>
                                <input type="text" class="form-control" id="formatted_created_at" v-model="maritalStatus.formatted_created_at" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="formatted_updated_at">Ultima actualización:</label>
                                <input type="text" class="form-control" id="formatted_updated_at" v-model="maritalStatus.formatted_updated_at" readonly>
                            </div>
                        </div>
                    </div>
                </alv-form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark" @click="$modal.hide('marital-status-modal')">
                    Cerrar
                </button>
                <button type="submit" class="btn btn-outline-success" form="marital-status-create">Guardar</button>
            </div>
        </div>
    </modal>
</template>

<script>
    const default_fields = {
        name: "",
        formatted_created_at: "",
        formatted_updated_at: "",
    };

    export default {
        name: "MaritalStatusModal",
        data() {
            return {
                form: {
                    action: null,
                    method: null
                },
                maritalStatus: Object.assign({}, default_fields)
            }
        },
        methods: {
            afterDone() {
                Object.assign(this.maritalStatus, this.$options.data().maritalStatus);
                this.$modal.hide("marital-status-modal");
                this.$refs.form.unsetButtonLoading();
                if (this.$refs.form.submitButton.style.display !== "none") {
                    Vue.$toast.open({duration: 5000, message: "Información actualizada correctamente"});
                    this.$emit("created")
                }
            },
            beforeOpen(event) {
                if (typeof event.params.id != "undefined") {
                    this.form.action = this.route("marital.states.update", event.params);
                    this.form.method = "put";
                    axios.get(this.route("marital.states.show", event.params)).then(response => {
                        this.maritalStatus = response.data;
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
                    this.maritalStatus = Object.assign({}, default_fields);
                    this.form.action = this.route("marital.states.store");
                    this.form.method = "post";
                }
            }
        }
    }
</script>

<style scoped>

</style>
