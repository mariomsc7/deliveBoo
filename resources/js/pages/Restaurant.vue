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
                <div class="cart">
                    <h2>Il tuo Carrello</h2>
                    <div v-if="Object.keys(cart).length" >
                        <div v-for="(item, index) in cart" :key="index">
                            <button  @click="remove(item.name, item.unitPrice)">-</button>
                            <span >{{item.quantità}}</span>
                            <button @click="add(item.name, item.unitPrice)">+</button>
                            <span class="name">{{item.name}}</span>
                            <span>€ {{item.prezzo.toFixed(2)}}</span> 
                        </div>
                    </div>
                    <div v-else>Il carrello è vuoto</div>
                        <h3>Tot: €{{tot.toFixed(2)}}</h3>
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

                for(let item in this.cart){
                    if(item !== 'restaurant_id') {
                        this.tot+=this.cart[item].prezzo;
                    }
                    
                };
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
                    // this.cart['restaurant_id'] = this.dishDetail.restaurant_id;
                    return true;
                }else {
                    const resp = confirm('Puoi ordinare da un solo ristorante. Vuoi cancellare il tuo ordine precedente?');
                    if(resp) {
                        this.cart = {};
                        this.tot = 0;
                        //  this.cart['restaurant_id'] = this.dishDetail.restaurant_id;
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
        store(){
            window.localStorage.setItem('cart', JSON.stringify(this.cart));
        }
    }
}
</script>

<style lang="scss">
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