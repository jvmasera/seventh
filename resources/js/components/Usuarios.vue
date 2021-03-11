<template>
    <div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <vuetable ref="vuetable"
                          :api-url="'http://localhost/seventh/public/api/auth/user/all/' + user_Id"
                          :fields="fields"
                          :sort-order="sortOrder"
                          :css="css.table"
                          pagination-path=""
                          :per-page="3"
                          @vuetable:pagination-data="onPaginationData"
                >

                    <template slot="actions" slot-scope="props">
                        <div class="table-button-container">
                            <button class="btn btn-primary" @click="editRow(props.rowData)" data-toggle="modal" data-target="#modalEditar">
                                Editar
                            </button>
                        </div>
                    </template>

                </vuetable>
                <vuetable-pagination ref="pagination" :css="css.pagination" @vuetable-pagination:change-page="onChangePage"></vuetable-pagination>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditarLabel">Editar Usuário: <b>{{ modal.name }}</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="fecharForm">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <input id="name" class="form-control" type="text" placeholder="Nome" v-model="modal.name" required>
                            </div>
                            <div class="col-md-4">
                                <input id="email" class="form-control" type="text" placeholder="Nome" v-model="modal.email" required>
                            </div>
                            <div class="col-md-4">
                                <select id="role" class="form-control" v-model="modal.slug" required>
                                    <option value="">Grupo</option>
                                    <option value="admin">Admin</option>
                                    <option value="cliente">Cliente</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click="fecharForm">Fechar</button>
                        <button type="button" class="btn btn-primary" v-on:click="salvarForm">Salvar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import Vuetable from 'vuetable-2';
    import {editUser, getUserAll} from "../partials/auth";
    import VuetablePagination from 'vuetable-2/src/components/VuetablePagination';

    export default {
        name: "Usuarios",
        components: {
            Vuetable,
            VuetablePagination
        },
        data(){
            return {
                user_Id: this.$store.state.user.id,
                fields: ['name', 'email', 'slug', 'actions'],
                sortOrder: [
                    { field: 'name', direction: 'desc' }
                ],
                css: {
                    table: {
                        tableClass: 'table table-striped table-bordered table-hovered',
                        loadingClass: 'loading',
                        ascendingIcon: 'glyphicon glyphicon-chevron-up',
                        descendingIcon: 'glyphicon glyphicon-chevron-down',
                        handleIcon: 'glyphicon glyphicon-menu-hamburger',
                    },
                    pagination: {
                        infoClass: 'pull-left',
                        wrapperClass: 'vuetable-pagination pull-right',
                        activeClass: 'btn-primary',
                        disabledClass: 'disabled',
                        pageClass: 'btn btn-border',
                        linkClass: 'btn btn-border',
                        icons: {
                            first: '',
                            prev: '',
                            next: '',
                            last: '',
                        },
                    }
                },
                modal: {}
            }
        },
        methods: {
            onPaginationData (paginationData) {
                this.$refs.pagination.setPaginationData(paginationData)
            },
            onChangePage (page) {
                this.$refs.vuetable.changePage(page)
            },
            editRow(rowData){
                this.modal = rowData;
            },
            salvarForm(){
                var vr = this;
                editUser(localStorage.getItem('token'), {
                    name: vr.modal.name,
                    email: vr.modal.email,
                    role: vr.modal.slug
                }, vr.modal.id).then(res => {
                    $('#modalEditar').modal('hide');
                }).catch(error => {
                    console.log(error);
                })
            },
            fecharForm(){
                this.modal = {};
            }
        }
    }
</script>

<style scoped>

</style>
