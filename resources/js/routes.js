import Product from './components/product/view'
import Inventory from './components/inventory/view'

// import Login from './components/auth/Login.vue'
// import Register from './components/auth/Register.vue'
export default {
    mode: 'history',
    // fallback: true,
    routes: [
        {
            path: '/',
            component: Product,
            name: 'Product',
           // meta: {requiresAuth: true}
        },
        {
            path: '/inventory',
            component: Inventory,
            name: 'Inventory',
           // meta: {requiresAuth: true}
        },
         // {
        //     path: '/login',
        //     component: Login,
        //     name: 'login',
        //     meta: {guest: true}
        // },
        // {
        //     path: '/register',
        //     component: Register,
        //     name: 'register',
        //     meta: {guest: true}
        // }
        {
            path:'*',
            redirect: '/'  
        }
       
    ]
}