<template>
    <div>
        <h1>DISHES</h1>

        <router-link :to="{name: 'home'}">Home</router-link>
        
            <div class="dish" @click="showDish(dish)" :class="{unavailable: !dish.visibility}" v-for="(dish, index) in dishes" :key="`dishes-${index}`">
                {{dish.name}}
                <img v-if="dish.image" :src="dish.image" :alt="dish.name" width="300"/>
            </div>
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
        };
    },
    created() {
        this.getDishes();
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
</style>