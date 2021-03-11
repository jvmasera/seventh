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
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="perfil-tab" data-toggle="tab" href="#perfil" role="tab" aria-controls="perfil" aria-selected="true">Perfil</a>
                                </li>
                                <li class="nav-item" v-if="role.includes('admin')">
                                    <a class="nav-link" id="usuarios-tab" data-toggle="tab" href="#usuarios" role="tab" aria-controls="usuarios" aria-selected="true">Usuários</a>
                                </li>
                                <li class="nav-item" v-if="role.includes('admin')">
                                    <a class="nav-link" id="logs-tab" data-toggle="tab" href="#logs" role="tab" aria-controls="logs" aria-selected="false">Logs</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="perfil" role="tabpanel" aria-labelledby="perfil-tab">
                                    <Perfil />
                                </div>
                                <div class="tab-pane fade" id="usuarios" role="tabpanel" aria-labelledby="usuarios-tab" v-if="role.includes('admin')">
                                    <Usuarios />
                                </div>
                                <div class="tab-pane fade" id="logs" role="tabpanel" aria-labelledby="logs-tab" v-if="role.includes('admin')">
                                    <Logs />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Perfil from './Perfil.vue';
    import Usuarios from './Usuarios.vue';
    import Logs from './Logs.vue';
    import { mapState } from 'vuex';

    export default {
        name: 'Dashboard',
        components: { Perfil, Usuarios, Logs },
        data(){
            return {
                role: this.$store.state.user.role
            }
        },
        computed: mapState(['user']),
        watch:{
            user(newValue) {
                this.role = newValue.role;
            },
        }
    }
</script>
