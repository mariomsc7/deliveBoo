<template>
    <div class="restaurant">
        <div  v-if="dishes.length">
            <h1 class="text-center" v-if="dishes.length">{{restaurant.name}} Menù</h1>
            <img :src="restaurant.image" :alt="restaurant.name">
        </div>
            <div class="container-fluid">
                <div class="cont row">
                    <div class="col-md-6 col-sm-12">
                        <!-- Page Navigation    -->
                        <section class="navigation">
                            <button class="custom-btn btn-9 arrow" @click="getDishes(pagination.current - 1)" :disabled ="!(pagination.current > 1)"><i class="fas fa-caret-left "></i></button>
                            <button class="custom-btn btn-9" :class="{'active-page' : pagination.current == i}" v-for="i in pagination.last" :key="`page-${i}`" @click="getDishes(i)">{{i}}</button>
                            <button class="custom-btn btn-9 arrow" @click="getDishes(pagination.current + 1)" :disabled="!(pagination.current < pagination.last)"><i class="fas fa-caret-right"></i></button>
                        </section>
                        <!-- Dish -->
                            <div class="row">
                                <div class="col-md-5 offset-md-1 col-sm-12 dish d-flex justify-content-between"  v-for="(dish, index) in dishes" :key="`dishes-${index}`">
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
                    </div>
                    <!-- Cart -->
                    <div class="cart col-md-4 offset-md-2 col-sm-12 text-center">
                        <!-- <div class="cart-box"> -->
                            <h2>Il tuo Carrello</h2>
                            <!-- Products -->
                            <div v-if="Object.keys(cart).length" >
                                <div class="product" v-for="(item, index) in cart" :key="index">
                                    <div>
                                        <button class="custom-btn btn-9 quantity minus" @click="remove(item.name, item.unit)"><i class="fas fa-minus"></i></button>
                                        <input class="inputNum" type="number" min="1" v-model="item.quantità" @change="updateQuantity($event, item.name, item.unit)">
                                        <button class="custom-btn btn-9 quantity" @click="add(item.name, item.unit)"><i class="fas fa-plus"></i></button>
                                    </div>
                                    <div>
                                        <span class="name">{{item.name}}</span>
                                        <span>€ {{item.prezzo.toFixed(2)}}</span>
                                        <span class="remove" @click="removeAll(item.name, item.prezzo)"><i class="fas fa-times"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div v-else>Il carrello è vuoto</div>
                            <!-- Tot -->
                            <h3>Tot: €{{tot.toFixed(2)}}</h3>
                            <!-- CheckOut Button -->
                            <router-link class="color" :to="{name: 'checkout'}"><i class="fas fa-cart-plus icons"></i></router-link>
                            <!-- Delete Button -->
                            <div class="text-right"><button class="custom-btn btn-9 delete" v-if="Object.keys(cart).length" @click="deleteCart()">Elimina</button></div>
                        <!-- </div> -->
                    </div>
                
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
            restaurant: {},
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
        this.getRestaurant();
        this.popCart();
    },
    methods: {
        /**
         * Call API for Dishes
         */
        getRestaurant() {
            axios
                .get(`http://127.0.0.1:8000/api/restaurants/${this.$route.params.slug}`)
                .then(res => {
                    this.restaurant = res.data;
                    this.getDishes();
                })
                .catch(err => {
                    console.log(err);
                });
        },
        getDishes(page = 1) {
            axios
                .get(`http://127.0.0.1:8000/api/dishes/${this.restaurant.id}?page=${page}`)
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
        padding: 20px;
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
        margin-left: 10px;
        cursor: pointer;
        &:hover{
            color: #ec4524;
        }
    }
    // .unavailable {
    //     color: red;
    // }
    .dish{
        // width: 350px;
        height: 130px;
        margin-bottom: 10px;
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
        display: flex;
        flex-direction: column;
        padding: 20px 40px;
        background-color: #273036;
        border-radius: 10px;
        color: #fff;
        .name{
            margin: 0 10px;
        }
        .product{
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 1.3em;
        }
        input[type="number"]{
            border-radius: 20px;
            width: 50px;
            text-align: center;
            outline: none;
            border: 0;
        }
    }

    //Buttons
    button {
        margin: 20px;
    }

    .custom-btn {
        width: 90px;
        height: 40px;
        margin: 10px;
        color: #fff;
        border-radius: 50px;
        padding: 0 25px;
        font-family: 'Lato', sans-serif;
        font-weight: 500;
        font-size: 20px;
        background: transparent;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        display: inline-block;
        box-shadow: inset 2px 2px 2px 0px rgba(255,255,255,.5),
            inset -7px -7px 10px 0px rgba(0,0,0,.1),7px 7px 20px 0px rgba(0,0,0,.1),
        4px 4px 5px 0px rgba(0,0,0,.1);
        text-shadow:  2px 2px 3px rgba(255,255,255,.5),
                    -4px -4px 6px rgba(116, 125, 136, .2);
        outline: none;

        &.arrow{
            width: 40px;
            border-radius: 50%;
            padding: 0;
        }

        &.delete{
            width: 120px;
        }
        &.quantity{
            width: 25px;
            height: 25px;
            padding: 0;
            border-radius: 50%;
            background-color: #fdcf7a;
            font-size: 12px;

            &.minus:hover{
                background-color: #ec4524;
            }
        }
    }

    .btn-9 {
        border: none;
        transition: all 0.3s ease;
        overflow: hidden;
        color: #fff;
    }
    .btn-9:after {
        position: absolute;
        content: " ";
        z-index: -1;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: $brand-col;
        transition: all 0.3s ease;
    }
    .btn-9:hover {
        background: $brand-col;
        box-shadow:  4px 4px 6px 0 rgba(255,255,255,.5),
                    -4px -4px 6px 0 rgba(116, 125, 136, .2), 
            inset -4px -4px 6px 0 rgba(255,255,255,.5),
            inset 4px 4px 6px 0 rgba(116, 125, 136, .3);
        color: #fff;
    }
    .btn-9.delete:hover {
        background: #ec4524;
        box-shadow:  4px 4px 6px 0 rgba(255,255,255,.5),
                    -4px -4px 6px 0 rgba(116, 125, 136, .2), 
            inset -4px -4px 6px 0 rgba(255,255,255,.5),
            inset 4px 4px 6px 0 rgba(116, 125, 136, .3);
        color: #fff;
    }
    .btn-9:hover:after {
        -webkit-transform: scale(2) rotate(180deg);
        transform: scale(2) rotate(180deg);
        box-shadow:  4px 4px 6px 0 rgba(255,255,255,.5),
                    -4px -4px 6px 0 rgba(116, 125, 136, .2), 
            inset -4px -4px 6px 0 rgba(255,255,255,.5),
            inset 4px 4px 6px 0 rgba(116, 125, 136, .3);
    }

    .active-page{
            background-color:#f64826;
    }

    .color {
        color: #fff;
        font-size: 2em;

        &:hover {
            color: $brand-col;
        }
    }
</style>