require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import VeeValidate from 'vee-validate'
import {routes} from './routes.js';
import storeData from './store.js';
import MainApp from './components/MainApp.vue';
import VueFormulate from '@braid/vue-formulate';

Vue.use(VeeValidate);
Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(VueFormulate);

const router = new VueRouter({
    routes,
    mode: 'history'
});

const store = new Vuex.Store(storeData);

const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
        MainApp
    }
});
