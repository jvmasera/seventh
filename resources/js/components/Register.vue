<template>
    <div class="login row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Cadastro</h3>
                </div>
                <div class="card-body">
                    <div class="alert alert-danger" role="alert" v-if="regError">
                        {{regError}}
                    </div>
                    <div class="container-fluid">
                        <form @submit.prevent="register">
                            <div class="form-group row">
                                <label for="name">Nome</label>
                                <input id="name" type="text" name="name" class="form-control" v-validate="'required'" v-model="formRegister.name">
                                <span v-if="errors.has('name')" class="invalid-feedback" role="alert">{{ errors.first('name') }}</span>
                            </div>
                            <div class="form-group row">
                                <label for="email">Email</label>
                                <input id="email" type="email" name="email" v-validate="'required|email'" class="form-control" v-model="formRegister.email">
                                <span v-if="errors.has('email')" class="invalid-feedback" role="alert">{{ errors.first('email') }}</span>
                            </div>
                            <div class="form-group row">
                                <label for="password">Senha</label>
                                <input id="password" type="password" name="password" class="form-control" v-validate="'required|min:6'" v-model="formRegister.password">
                                <span v-if="errors.has('password')" class="invalid-feedback" role="alert">{{ errors.first('password') }}</span>
                            </div>
                            <div class="form-group row">
                                <label for="password_confirm">Confirme a Senha</label>
                                <input id="password_confirm" type="password" name="password_confirm" class="form-control" v-validate="'required|min:6'" v-model="formRegister.password_confirmation">
                                <span v-if="errors.has('password_confirmation')" class="invalid-feedback" role="alert">{{ errors.first('password_confirmation') }}</span>
                            </div>
                            <div class="form-group row">
                                <input type="submit" value="Cadastrar" class="btn btn-outline-primary ml-auto">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {registerUser} from '../partials/auth';
    export default {
        data(){
            return {
                formRegister: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: ''
                },
                error: null
            }
        },
        methods:{
            register(){
                registerUser(this.$data.formRegister)
                    .then(res => {
                        console.log(res);
                        this.$store.commit("registerSuccess", res);
                        this.$router.push({path: '/login'});
                    })
                    .catch(error => {
                        this.$store.commit("registerFailed", {error});
                    })
            }
        },
        computed:{
            regError(){
                return this.$store.getters.regError
            }
        }
    }
</script>

<style scoped>
    .error{
        text-align: center;
        color: red;
    }
</style>
