<template>
    <div class="container">
        <div class="dashboard row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Dashboard</h3>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <p>Seja bem vindo {{ user.name }}.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {getUser} from '../partials/auth';
    export default {
        data(){
            return {
                user: ''
            }
        },
        created() {
            this.currentUser();
        },
        methods:{
            currentUser(){
                var vr = this;
                getUser(localStorage.getItem('token'))
                    .then(res => {
                        vr.user = res.user;
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }
        }
    }
</script>
