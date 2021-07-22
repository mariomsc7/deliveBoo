import Vue from "vue";
import VueRouter from "vue-router";
import Home from "./pages/Home.vue";
import Restaurant from "./pages/Restaurant.vue";
import CheckOut from "./pages/CheckOut.vue";
import NotFound from "./pages/NotFound.vue";

Vue.use(VueRouter);

// Routes definition

const router = new VueRouter({
    mode: "history",
    linkExactActiveClass: "active",
    routes: [
        {
            path: "/",
            name: "home",
            component: Home
        },
        {
            path: "/restaurant/:slug",
            name: "restaurant",
            component: Restaurant
        },
        {
            path: "/checkout/",
            name: "checkout",
            component: CheckOut
        },
        {
            path: "*",
            component: NotFound
        }
    ]
});

export default router;
