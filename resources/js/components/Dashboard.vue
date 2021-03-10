<template>
    <div class="container">
        <h1>Hallo . . . welcome to your work space.</h1>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                user: null
            }
        },
        created() {
            this.getUser();
        },
        methods:{
            getUser: function(){
                const config = {
                    headers: { Authorization: `Bearer ${this.currentUser.token}` }
                };

                axios.get(
                    'http://localhost/seventh/public/api/auth/user',

                    config
                ).then(console.log).catch(console.log);
            }
        },
        computed:{
            currentUser(){
                return this.$store.getters.currentUser
            }
        }
    }
</script>
