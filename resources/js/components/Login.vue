<template>
    <div class="login row justify-content-center">
        <div class="col-md-3">
            <div class="alert alert-success" role="alert" v-if="registeredUser">
                Obrigado {{registeredUser.name}}. Agora você pode fazer o login
            </div>
            <div class="card">
                <div class="card-header">
                    <h3>Entrar</h3>
                </div>
                <div class="card-body">
                    <div class="alert alert-danger" role="alert" v-if="authError">
                        {{authError}}
                    </div>
                    <div class="container-fluid">
                        <form @submit.prevent="authenticate">
                            <div class="form-group row">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control" v-model="formLogin.email">
                            </div>
                            <div class="form-group row">
                                <label for="password">Senha</label>
                                <input id="password" type="password" class="form-control" v-model="formLogin.password">
                            </div>
                            <div class="form-group row">
                                <input type="submit" value="Acessar" class="btn btn-outline-primary btn-block">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {login} from '../partials/auth';
    export default {
        data(){
            return {
                formLogin: {
                    email: '',
                    password: ''
                },
                error: null
            }
        },
        methods:{
            authenticate(){
                this.$store.dispatch('login');
                login(this.$data.formLogin)
                    .then(res => {
                        this.$store.commit("loginSuccess", res);
                        this.$router.push({path: '/dashboard'});
                    })
                    .catch(error => {
                        this.$store.commit("loginFailed", {error});
                    })
            }
        },
        computed:{
            authError(){
                return this.$store.getters.authError
            },
            registeredUser(){
                return this.$store.getters.registeredUser
            }
        }
    }
</script>
