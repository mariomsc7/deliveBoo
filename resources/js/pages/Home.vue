<template>
    <div>
        <Hero />
        <div class="container">
        
            <h1 class="text-center">Scegli il tipo di ristorante!</h1>
            <!-- Types Checkbox -->
            <ul class="type-list d-flex justify-content-around">
                <li v-for="(type, index) in types" :key="`types-${index}`">
                    <input @change="filter" type="checkbox" :value="type" :id="type" v-model="checked">
                    <label for="checkbox">{{type}}</label>
                    <span class="checkmark"></span>
                </li>
            </ul>
        
            <div v-if="types.length">
                <!-- Page Navigation -->
                <section class="navigation text-center mb-5">
                    <button @click="getRestaurants(pagination.current - 1)" :disabled ="!(pagination.current > 1)">Prev</button>
                    <button class="btn-custom" :class="{'active-page' : pagination.current == i}" v-for="i in pagination.last" :key="`page-${i}`" @click="getRestaurants(i)">{{i}}</button>
        
                    <button @click="getRestaurants(pagination.current + 1)" :disabled="!(pagination.current < pagination.last)">Next</button>
                </section>
        
                <!-- Restaurants List -->
                <div class="d-flex">
                    <article class="card" v-for="restaurant in restaurants" :key="`res-${restaurant.id}`">
                        <router-link :to="{name: 'restaurant', params: {slug:restaurant.slug}}">
                        <h2>{{ restaurant.name }}</h2>
                        <div>{{ restaurant.address }}</div>
                        <div>
                            <span v-for="(type, index) in restaurant.type" :key="`type-${index}`">
                                {{ type }}
                            </span>
                        </div>
                        <img class="img-fluid" v-if="restaurant.image" :src="restaurant.image" :alt="restaurant.name"/>
                        </router-link>
                    </article>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Hero from '../components/Hero.vue'

export default {
    name: "Home",
    components:{
        Hero,
    },
    data() {
        return {
            restaurants: [],
            types: [],
            checked:[],
            pagination: {},
        };
    },
    created() {
        this.getRestaurants();
        this.getTypes();
    },
    methods: {
        /**
         * Call API for Types
         */
        getTypes(){
             axios
                .get(`http://127.0.0.1:8000/api/types`)
                .then(res => {
                    this.types = res.data;
                })
                .catch(err => {
                    console.log(err);
                });
        },

        /**
         * Call API for All Restaurants
         */
        getRestaurants(page = 1) {
            if(this.checked.length == 0){
                
                axios
                    .get(`http://127.0.0.1:8000/api/restaurants?page=${page}`)
                    .then(res => {
                        this.restaurants = res.data.data;
                        this.pagination = {
                            current: res.data.current_page,
                            last: res.data.last_page
                        };
                    })
                    .catch(err => {
                        console.log(err);
                    });

            } else {
                // When change page
                this.filter(page);
            }
        },
        
        /**
         * Call API for Filtered Restaurants
         */
        filter(page = 1){
            if(this.checked.length != 0){
                // Create query string from checked array
                let query=[];
                query = this.checked;
                const stringQuery = JSON.stringify(query);

                axios
                    .get(`http://127.0.0.1:8000/api/filter?types=${stringQuery}&page=${page}`)
                    .then(res => {
                        console.log(res.data);
                        this.restaurants = res.data.data;
                        this.pagination = {
                            current: res.data.current_page,
                            last: res.data.last_page
                        };
                    })
                    .catch(err => {
                        console.log(err);
                    });
            } else {
                // When all checkbox are empty
                this.getRestaurants();
            }
        }
    }
};
</script>

<style lang="scss" scoped>
@import '../../sass/app';
    .card{
        width: 400px;
        margin: 10px;
        padding: 20px;
        background-color: $brand-col;
        border-radius: 10px;
    }

    .type-list {
        list-style-type: none;
    }
</style>
