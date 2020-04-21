<template>
    <modal name="marital-status-modal" height="auto" @before-open="beforeOpen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{form.method === "post" ? "Crear" : "Editar"}} usuario
                </h5>
                <button type="button" class="close" @click="$modal.hide('marital-status-modal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <alv-form :action="form.action" id="marital-status-create" :method="form.method" :spinner="true"
                          :data-object="maritalStatus" @after-done="afterDone" ref="form">
                    <div class="form-group">
                        <label>Nombre:</label>
                        <input type="text" class="form-control" name="name" v-model="maritalStatus.name">
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
    export default {
        name: "MaritalStatusModal",
        data() {
            return {
                form: {
                    action: null,
                    method: null
                },
                maritalStatus: {
                    name: "",
                }
            }
        },
        methods: {
            afterDone() {
                Object.assign(this.maritalStatus, this.$options.data().maritalStatus);
                this.$modal.hide("marital-status-modal");
                this.$refs.form.unsetButtonLoading();
                this.$emit("created")
            },
            beforeOpen(event) {
                if (typeof event.params != "undefined") {
                    this.form.action = this.route("marital.states.update", event.params);
                    this.form.method = "put";
                    axios.get(this.route("marital.states.show", event.params)).then(response => {
                        this.maritalStatus = response.data;
                    });
                } else {
                    this.form.action = this.route("marital.states.store");
                    this.form.method = "post";
                }
            }
        }
    }
</script>

<style scoped>

</style>
