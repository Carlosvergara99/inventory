

require('./bootstrap');

window.Vue = require('vue');
import Swal from 'sweetalert2'
 window.Swal = Swal

import VueRouter from 'vue-router'
import routes from './routes'
Vue.use(VueRouter)
const router = new VueRouter(routes)


const app = new Vue({
    el: '#app',
    router,
    linkActiveClass: "active",
    linkExactActiveClass: "exact-active",

});
