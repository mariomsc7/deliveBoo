<template>
    <div>
        <h1 v-if="dishes.length">{{dishes[0].restaurant.name}} Menù</h1>
    
            <div class="cont">
                <div>
                    <div class="dish" @click="showDish(dish)" :class="{unavailable: !dish.visibility}" v-for="(dish, index) in dishes" :key="`dishes-${index}`">
                        {{dish.name}}
                        <img class="img-fluid" v-if="dish.image" :src="dish.image" :alt="dish.name"/>
                    </div>
                </div>
                <div class="cart">
                    <h2>Il tuo Carrello</h2>
                    <div v-if="Object.keys(cart).length" >
                        <div v-for="(item, index) in cart" :key="index">
                            <button  @click="remove(item.name, item.unitPrice)">-</button>
                            <input class="inputNum" type="number" min="1" v-model="item.quantità" @change="updateQuantity($event, item.name, item.unitPrice)">
                            <button @click="add(item.name, item.unitPrice)">+</button>
                            <span class="name">{{item.name}}</span>
                            <span>€ {{item.prezzo.toFixed(2)}}</span> 
                            <span class="remove" @click="removeAll(item.name, item.prezzo)">X</span>
                        </div>
                    </div>
                    <div v-else>Il carrello è vuoto</div>
                    <h3>Tot: €{{tot.toFixed(2)}}</h3>
                    <router-link :to="{name: 'checkout'}">Cassa</router-link>
                    <button @click="deleteCart()">Elimina Carrello</button>

                </div>
                
            </div>
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
        };
    },
    created() {
        this.getDishes();
        this.popCart();
    },
    methods: {
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
        },
        popCart(){
            if(window.localStorage.getItem('cart')){
                this.cart = JSON.parse(window.localStorage.getItem('cart'));
                this.setTotal();
            }
        },
        addCart(order, name, unitPrice) {
            // console.log(this.cart[Object.keys(this.cart)[0]].restaurant_id);
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
        add(name, unit){
            this.cart[name].quantità ++;
            this.cart[name].prezzo += unit;
            this.tot += unit;
            this.store();
        },
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
        removeAll(item, price){
            console.log(item);
            console.log(price);
            delete this.cart[item];
            this.tot -= price;
            this.store();
        },
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
        setTotal(){
            for(let item in this.cart){
                this.tot+=this.cart[item].prezzo;
            }; 
        },
        store(){
            window.localStorage.setItem('cart', JSON.stringify(this.cart));
        },
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
</style>