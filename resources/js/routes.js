import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from './pages/Home.vue';
import Restaurant from './pages/Restaurant.vue';
import List from './pages/List.vue';
// import CheckOut from './pages/CheckOut.vue';

Vue.use(VueRouter);

 // Routes definition

const router = new VueRouter({ 
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
        },
        {
            path: '/restaurant/:id',
            name: 'restaurant',
            component: Restaurant,
        },
        {
            path: '/restaurants/:type',
            name: 'list',
            component: List,
        },
    //     {
    //         path: '/carts/:order',
    //         name: 'checkout',
    //         component: CheckOut,
    //     },
     ]
}); 

export default router;
