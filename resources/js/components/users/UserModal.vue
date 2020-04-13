<template>
    <modal name="user-modal" height="auto">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear usuario</h5>
                <button type="button" class="close" @click="$modal.hide('user-modal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <alv-form :action="route('users.store')" id="user-create" method="post"
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" form="user-create">Guardar</button>
            </div>
        </div>
    </modal>
</template>

<script>
    export default {
        name: "UserModal",
        data(){
            return {
                user: {
                    name: '',
                    email: '',
                    password: ''
                }
            }
        },
        methods:{
            afterDone(){
                Object.assign(this.user, this.$options.data().user);
                this.$modal.hide('user-modal');
                this.$refs.form.unsetButtonLoading();
                this.$emit('created')
            }
        }
    }
</script>

<style scoped>

</style>
