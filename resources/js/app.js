import './bootstrap';
import Vue from 'vue';

window.Vue = Vue;

import App from './App.vue';
import VueRouter from 'vue-router';
import VueAxios  from 'vue-axios';
import axios from 'axios';
import Vuesax from 'vuesax'
import 'vuesax/dist/vuesax.css'
import {routes} from './routes';


console.log('hello world');
Vue.use(VueRouter);
Vue.use(Vuesax, {
    // options here
  });
Vue.use(VueAxios, axios);

const router = new VueRouter({
    mode: 'history',
    routes: routes
});
const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App),
})
