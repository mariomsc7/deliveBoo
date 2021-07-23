<template>
    <div class="restaurant">
        <h1 class="text-center" v-if="dishes.length">{{dishes[0].restaurant.name}} Menù</h1>

            <div class="cont">
                <div>
                    <!-- Page Navigation    -->
                    <section class="navigation">
                        <button class="page-btn" @click="getDishes(pagination.current - 1)" :disabled ="!(pagination.current > 1)">Prev</button>
                        <button class="page-btn" :class="{'active-page' : pagination.current == i}" v-for="i in pagination.last" :key="`page-${i}`" @click="getDishes(i)">{{i}}</button>
                        <button class="page-btn" @click="getDishes(pagination.current + 1)" :disabled="!(pagination.current < pagination.last)">Next</button>
                    </section>

                    <!-- Dish -->
                        <div class="dish d-flex justify-content-between"  v-for="(dish, index) in dishes" :key="`dishes-${index}`">
                            <div class="d-flex flex-column justify-content-center">
                                <i class="fas fa-info-circle info" @click="showDish(dish)" ></i>
                                {{dish.name}}
                                <div v-if="dish.visibility" class="d-flex">
                                    <div>€ {{dish.price.toFixed(2)}}</div>
                                    <i class="fas fa-plus-circle add" @click="addToCart(dish)"></i>
                                </div>
                                <div v-else>Non Disponibile</div>
                            </div>
                            <div class="img"><img class="img-fluid" v-if="dish.image" :src="dish.image" :alt="dish.name"/></div>
                        </div>
                </div>

                <!-- Cart -->
                <div class="cart">
                    <h2>Il tuo Carrello</h2>

                    <!-- Products -->
                    <div v-if="Object.keys(cart).length" >
                        <div v-for="(item, index) in cart" :key="index">
                            <button class="page-btn" @click="remove(item.name, item.unit)"><i class="fas fa-minus"></i></button>
                            <input class="inputNum" type="number" min="1" v-model="item.quantità" @change="updateQuantity($event, item.name, item.unit)">
                            <button class="page-btn" @click="add(item.name, item.unit)"><i class="fas fa-plus"></i></button>
                            <span class="name">{{item.name}}</span>
                            <span>€ {{item.prezzo.toFixed(2)}}</span> 
                            <span class="remove" @click="removeAll(item.name, item.prezzo)"><i class="fas fa-times"></i></span>
                        </div>
                    </div>

                    <div v-else>Il carrello è vuoto</div>

                    <!-- Tot -->
                    <h3>Tot: €{{tot.toFixed(2)}}</h3>
                    
                    <!-- CheckOut Button -->
                    <router-link :to="{name: 'checkout'}">Cassa</router-link>
                    
                    <!-- Delete Button -->
                    <button class="page-btn" v-if="Object.keys(cart).length" @click="deleteCart()">Elimina</button>
                </div>
                
            </div>

        <!-- Dish Detail -->
        <Dish :dishDetails="dishDetail" v-if="visibility" @close="closeDetail"/>
    </div>
        
</template>

<script>
import Dish from "../components/Dish.vue";
export default {
    name: 'Restaurant',
    components:{
        Dish,
    },
    data() {
        return {
            dishes: [],
            dishDetail: {},
            visibility: false,
            order:{},
            cart: {},
            tot: 0,
            pagination: {},
        };
    },
    created() {
        this.getDishes();
        this.popCart();
    },
    methods: {
        /**
         * Call API for Dishes
         */
        getDishes(page = 1) {
            axios
                .get(`http://127.0.0.1:8000/api/restaurant/${this.$route.params.slug}?page=${page}`)
                .then(res => {
                    this.dishes = res.data.data;
                    this.pagination = {
                        current: res.data.current_page,
                        last: res.data.last_page
                    };
                })
                .catch(err => {
                    console.log(err);
                });
        },

        /**
         * Show Dish Details
         */
        showDish(dish){
            this.dishDetail= dish;
            this.visibility=true;
        },

        /**
         * Close Dish Details
         */
        closeDetail(){
            this.visibility=false;
        },

        /**
         * Populate Cart with localStorage
         */
        popCart(){
            if(window.localStorage.getItem('cart')){
                this.cart = JSON.parse(window.localStorage.getItem('cart'));
                this.setTotal();
            }
        },

        /**
         * Add Dish to Cart
         */
        addToCart(dish) {
            if(this.checkId(dish)) {
                if(this.cart[dish.name]){
                    this.cart[dish.name].quantità++;
                    this.cart[dish.name].prezzo += dish.price;
                } else {
                    this.cart[dish.name] = {
                        restaurant_id: dish.restaurant_id,
                        name: dish.name,
                        quantità: 1,
                        prezzo: dish.price,
                        unit: dish.price
                    };
                }
                this.tot += dish.price;
                this.store();
            }  
        },

        /**
         * Check for 
         */
        checkId(dish){
            if(Object.keys(this.cart).length != 0){
                if(this.cart[Object.keys(this.cart)[0]].restaurant_id == dish.restaurant_id) {
                    return true;
                }else {
                    const resp = confirm('Puoi ordinare da un solo ristorante. Vuoi cancellare il tuo ordine precedente?');
                    if(resp) {
                        this.cart = {};
                        this.tot = 0;
                        return true;
                    } else {
                        return false;
                    }
                }
            }else{
                return true;
            }
        },

        /**
         * Add Button in Cart
         */
        add(name, unit){
            this.cart[name].quantità ++;
            this.cart[name].prezzo += unit;
            this.tot += unit;
            this.store();
        },

        /**
         * Remove Button in Cart
         */
        remove(name, unit){
            if(this.cart[name].quantità == 1){
                delete this.cart[name];
            } else {
                this.cart[name].quantità --;
                this.cart[name].prezzo -= unit;
            }
            this.tot -= unit;
            this.store();
        },

        /**
         * Remove one record in Cart
         */
        removeAll(item, price){
            console.log(item);
            console.log(price);
            delete this.cart[item];
            this.tot -= price;
            this.store();
        },

        /**
         * Set Quantity from Input in Cart
         */
        updateQuantity(e,name, unit){
            const value = parseFloat(e.target.value);
            if(value>0){
                console.log(value);
                this.cart[name].quantità = value;
                this.cart[name].prezzo = (value * unit);
                this.tot = 0;
                this.setTotal();
                this.store();
            } else {
                this.cart[name].quantità = 1;
                this.cart[name].prezzo = unit;
                this.tot = 0;
                this.setTotal();
                this.store();
            }
        },

        /**
         * Set Total Amount
         */
        setTotal(){
            for(let item in this.cart){
                this.tot+=this.cart[item].prezzo;
            }; 
        },

        /**
         * Save Cart in localStorage
         */
        store(){
            window.localStorage.setItem('cart', JSON.stringify(this.cart));
        },

        /**
         * Eliminate Entire Cart
         */
        deleteCart(){
            const resp = confirm('Vuoi cancellare il tuo ordine?');
            if(resp){
                this.cart = {};
                this.tot = 0; 
                window.localStorage.clear();
            } 
        },
    }
}
</script>

<style lang="scss">

@import '../../sass/app';

    .restaurant{
        color: #273036;
    }
    .inputNum{
        width: 35px;
        -moz-appearance: textfield;

        &::-webkit-outer-spin-button,
        &::-webkit-inner-spin-button{
            -webkit-appearance: none;
        }
    }
    
    .remove{
        cursor: pointer;
        &:hover{
            color: red;
        }
    }
    .unavailable {
        color: red;
    }
    .dish{
        width: 350px;
        height: 130px;
        margin: 10px;
        padding: 20px;
        font-size: 1.4em;
        background-color: rgb(134, 236, 202);
        border-radius: 10px;

        i.info{
            cursor: pointer;
        }

        i.add{
            margin-left: 15px;
            color: $brand-col;
            font-size: 1.1em;
            cursor: pointer;
        }
    }
    .img{
        width: 150px;
        overflow: hidden;
    }
    .cont{
        display: flex;
        justify-content: space-around;
        align-items: flex-start;
    }
    .cart{
        padding: 20px;
        background-color: #ccc;

        .name{
            margin: 0 10px;
        }
    }
    .page-btn{
        width: 70px;
        height:30px;
        border-radius: 50px;
        background-color:#92d913;
        margin:20px ;
        box-shadow: 5px 5px #888888;
    }
     .active-page{
        background-color:#13d9c9;
    }
</style>