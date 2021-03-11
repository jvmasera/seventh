<template>
    <div>
        <br>
        <div class="row">
            <div class="col-md-4">
                <input id="name" class="form-control" type="text" placeholder="Nome" v-model="form.name" required :disabled="!edit">
            </div>
            <div class="col-md-4">
                <input id="email" class="form-control" type="email" placeholder="Email" v-model="form.email" required :disabled="!edit">
            </div>
            <div class="col-md-4" v-if="user.role.includes('admin')">
                <select id="role" class="form-control" v-model="form.role[0]" required :disabled="!edit">
                    <option value="">Grupo</option>
                    <option value="admin">Admin</option>
                    <option value="cliente">Cliente</option>
                </select>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <button class="btn" :class="{'btn-primary': !edit, 'btn-danger': edit}" v-on:click="editarForm">{{ btnTxt }}</button>
                <button class="btn btn-success" v-on:click="salvarForm" v-if="edit">Salvar</button>
            </div>
        </div>
    </div>
</template>

<script>
    import {getUser, editUser} from "../partials/auth";

    export default {
        name: "Perfil",
        data(){
            return {
                edit: false,
                btnTxt: 'Editar',
                user:{
                    role: this.$store.state.user.role
                },
                form: {
                    id: this.$store.state.user.id,
                    name: this.$store.state.user.name,
                    email: this.$store.state.user.email,
                    role: [this.$store.state.user.role[0]]
                },
            }
        },
        methods:{
            editarForm(){
                this.edit = !this.edit;
                this.btnTxt = this.edit === true ? 'Cancelar' : 'Editar';
            },
            salvarForm(){
                var vr = this;
                editUser(localStorage.getItem('token'), {
                    name: vr.form.name,
                    email: vr.form.email,
                    role: vr.form.role[0]
                }, vr.form.id).then(res => {
                    vr.editarForm();
                    this.$store.commit("setUser", {
                        id: res.id,
                        name: res.name,
                        email: res.email,
                        role: vr.form.role[0]
                    });
                }).catch(error => {
                    console.log(error);
                })
            }
        }
    }
</script>

<style scoped>

</style>
