<template>
    <div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <vuetable ref="vuetable"
                          api-url="http://localhost/seventh/public/api/auth/user/logs"
                          :fields="fields"
                          :sort-order="sortOrder"
                          :css="css.table"
                          pagination-path=""
                          :per-page="3"
                          @vuetable:pagination-data="onPaginationData"
                          @vuetable:loading="onLoading"
                          @vuetable:loaded="onLoaded"
                ></vuetable>
                <vuetable-pagination ref="pagination" :css="css.pagination" @vuetable-pagination:change-page="onChangePage"></vuetable-pagination>
            </div>
        </div>
    </div>
</template>

<script>
    import Vuetable from 'vuetable-2';
    import {logs} from "../partials/auth";
    import VuetablePagination from 'vuetable-2/src/components/VuetablePagination';

    export default {
        name: "Logs",
        components: {
            Vuetable,
            VuetablePagination
        },
        data(){
            return {
                user_Id: this.$store.state.user.id,
                fields: ['name', 'ip_address', 'login_at'],
                sortOrder: [
                    { field: 'login_at', direction: 'desc' }
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
                }
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
                alert("You clicked edit on"+ JSON.stringify(rowData))
            },
            deleteRow(rowData){
                alert("You clicked delete on"+ JSON.stringify(rowData))
            },
            onLoading() {
                console.log('loading... show your spinner here')
            },
            onLoaded() {
                console.log('loaded! .. hide your spinner here')
            }
        }
    }
</script>

<style scoped>

</style>
