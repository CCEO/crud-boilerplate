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

<style scoped>

</style>
