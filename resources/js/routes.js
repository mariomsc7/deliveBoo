import Vue from "vue";
import VueRouter from "vue-router";
import Home from "./pages/Home.vue";
import Restaurant from "./pages/Restaurant.vue";
import List from "./pages/List.vue";
import CheckOut from "./pages/CheckOut.vue";
import NotFound from "./pages/NotFound.vue";
import Payment from "./pages/Payment.vue";

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
            path: "/restaurants/:type",
            name: "list",
            component: List
        },
        {
            path: "/checkout",
            name: "checkout",
            component: CheckOut
        },
        {
            path: "/payment/",
            name: "payment",
            component: Payment
        },
        {
            path: "*",
            component: NotFound
        }
    ]
});

export default router;
