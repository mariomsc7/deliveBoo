<template>
    <div>
        <h1>DISHES</h1>

            <div class="cont">
                <div>
                    <div class="dish" @click="showDish(dish)" :class="{unavailable: !dish.visibility}" v-for="(dish, index) in dishes" :key="`dishes-${index}`">
                        {{dish.name}}
                        <img v-if="dish.image" :src="dish.image" :alt="dish.name" width="300"/>
                    </div>
                </div>
                <Cart />
            </div>
        <Dish @addToCart="addCart" :dishDetails="dishDetail" v-if="visibility" @close="closeDetail"/>
    </div>
        
</template>

<script>
import Dish from "../components/Dish.vue";
import Cart from "../components/Cart.vue";
export default {
    name: 'Restaurant',
    components:{
        Dish,
        Cart,
    },
    data() {
        return {
            dishes: [],
            dishDetail: {},
            visibility: false,
            cart: {},
        };
    },
    created() {
        this.getDishes();
        if(window.localStorage.getItem('cart')){
            this.cart = JSON.parse(window.localStorage.getItem('cart'));
        }
    },
    methods: {
        addCart(order, name) {
            if(this.cart[name]){
                this.cart[name].quantità += order.quantità;
                this.cart[name].prezzo += order.prezzo;
            } else {
                this.cart[name] = order;
            }
            // this.cart.push(order);
            // console.log(order);
        },
        getDishes() {
            // Get posts from API
            axios
                .get(`http://127.0.0.1:8000/api/restaurant/${this.$route.params.id}`)
                .then(res => {
                    this.dishes = res.data;
                    console.log(res)
                })
                .catch(err => {
                    console.log(err);
                });
        },
        showDish(dish){
            this.dishDetail= dish;
            this.visibility=true;
        },
        closeDetail(){
            this.visibility=false;
            window.localStorage.setItem('cart', JSON.stringify(this.cart));
        }
    }
}
</script>

<style language="scss">
    .unavailable {
        color: red;
    }
    .dish{
        width: 300px;
        margin: 10px;
        padding: 20px;
        background-color: rgb(134, 236, 202);
        border-radius: 10px;
        cursor: pointer;
    }
    .cont{
        display: flex;
    }
</style>