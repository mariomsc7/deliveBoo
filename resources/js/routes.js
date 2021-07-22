import Vue from "vue";
import VueRouter from "vue-router";
import Home from "./pages/Home.vue";
import Restaurant from "./pages/Restaurant.vue";
import CheckOut from "./pages/CheckOut.vue";
import NotFound from "./pages/NotFound.vue";
import AboutUs from "./pages/AboutUs.vue";

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
            path: "/restaurant/:id",
            name: "restaurant",
            component: Restaurant
        },
        {
            path: "/checkout/",
            name: "checkout",
            component: CheckOut
        },
        {
            path: "/aboutus/",
            name: "aboutus",
            component: AboutUs
        },
        {
            path: "*",
            component: NotFound
        }
    ]
});

export default router;
