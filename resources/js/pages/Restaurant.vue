<template>
    <div>
        <h1 class="text-center" v-if="dishes.length">{{dishes[0].restaurant.name}} Menù</h1>

            <div class="cont">
                <div>
                    <!-- Page Navigation    -->
                    <section class="navigation">
                        <button class="custom-btn btn-9" @click="getDishes(pagination.current - 1)" :disabled ="!(pagination.current > 1)">Prev</button>
                        <button class="custom-btn btn-9" :class="{'active-page' : pagination.current == i}" v-for="i in pagination.last" :key="`page-${i}`" @click="getDishes(i)">{{i}}</button>
                        <button class="custom-btn btn-9" @click="getDishes(pagination.current + 1)" :disabled="!(pagination.current < pagination.last)">Next</button>
                    </section>

                    <!-- Dish -->
                    <div>
                        <div class="dish" @click="showDish(dish)" :class="{unavailable: !dish.visibility}" v-for="(dish, index) in dishes" :key="`dishes-${index}`">
                            {{dish.name}}
                            <img class="img-fluid" v-if="dish.image" :src="dish.image" :alt="dish.name"/>
                        </div>
                    </div>
                </div>

                <!-- Cart -->
                <div class="cart">
                    <h2>Il tuo Carrello</h2>

                    <!-- Products -->
                    <div v-if="Object.keys(cart).length" >
                        <div v-for="(item, index) in cart" :key="index">
                            <button class="custom-btn btn-9" @click="remove(item.name, item.unitPrice)"><i class="fas fa-minus"></i></button>
                            <input class="inputNum" type="number" min="1" v-model="item.quantità" @change="updateQuantity($event, item.name, item.unitPrice)">
                            <button class="custom-btn btn-9" @click="add(item.name, item.unitPrice)"><i class="fas fa-plus"></i></button>
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
                    <button class="custom-btn btn-9" v-if="Object.keys(cart).length" @click="deleteCart()">Elimina</button>
                </div>
                
            </div>

        <!-- Dish Detail -->
        <Dish @addToCart="addCart" :dishDetails="dishDetail" v-if="visibility" @close="closeDetail"/>
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
        addCart(order, name, unitPrice) {
            if(this.checkId()) {
                if(this.cart[name]){
                    this.cart[name].quantità += order.quantità;
                    this.cart[name].prezzo += order.prezzo;
                } else {
                    this.cart[name] = {...order, unitPrice};
                }
                this.tot += order.prezzo;
                this.store();
                this.closeDetail();
            }  
        },

        /**
         * Check for 
         */
        checkId(){
            if(Object.keys(this.cart).length != 0){
                if(this.cart[Object.keys(this.cart)[0]].restaurant_id == this.dishDetail.restaurant_id) {
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
        width: 300px;
        margin: 10px;
        padding: 20px;
        background-color: rgb(134, 236, 202);
        border-radius: 10px;
        cursor: pointer;
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

    //Buttons
    button {
        margin: 20px;
    }

    .custom-btn {
        width: 130px;
        height: 40px;
        color: #fff;
        border-radius: 50px;
        padding: 10px 25px;
        font-family: 'Lato', sans-serif;
        font-weight: 500;
        font-size: 16px;
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
        }

    .btn-9 {
        border: none;
        transition: all 0.3s ease;
        overflow: hidden;
        color: #1fd1f9;
        color: #0cbcff;
        }
    .btn-9:after {
        position: absolute;
        content: " ";
        z-index: -1;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #5fe0fd;
        transition: all 0.3s ease;
        }
    .btn-9:hover {
        background: transparent;
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
            background-color:#13d9c9;
    }
     .active-page{
            background-color:#13d9c9;
    }
</style>