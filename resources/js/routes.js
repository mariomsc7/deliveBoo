import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from './pages/Home.vue';
import Restaurant from './pages/Restaurant.vue';
import List from './pages/List.vue';

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
    ]
}); 

export default router;
