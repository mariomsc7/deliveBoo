<template>
    <div>
        
        <h1>RESTAURANTS</h1>

        <ul>
            
                <li v-for="(type, index) in types" :key="`types-${index}`">
                    <input @change="filter" type="checkbox" :value="type" :id="type" v-model="checked">
                    <label for="checkbox">{{type}}</label>
                </li>
            
        </ul>
            <section class="navigation">
                <button @click="getRestaurants(pagination.current - 1)" :disabled ="!(pagination.current > 1)">Prev</button>
                <button :class="{'active-page' : pagination.current == i}" v-for="i in pagination.last" :key="`page-${i}`" @click="getRestaurants(i)">{{i}}</button>
            
                <button @click="getRestaurants(pagination.current + 1)" :disabled="!(pagination.current < pagination.last)">Next</button>
            </section>
        
        <article class="card" v-for="restaurant in restaurants" :key="`res-${restaurant.id}`">
            <router-link :to="{name: 'restaurant', params: {id:restaurant.id}}">
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
</template>

<script>
export default {
    name: "Home",
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
                this.filter(page);
            }
        },
        
        filter(page = 1){
            console.log('ciaoooooooooooooo');
            if(this.checked.length != 0){
                let query=[];
                query = this.checked;
                const stringQuery = JSON.stringify(query);
                axios
                    .get(`http://127.0.0.1:8000/api/filter?types=${stringQuery}&page=${page}`)
                    .then(res => {
                        console.log(res.data);
                        this.restaurants = res.data.data;
                        this.pagination = {};
                        this.pagination = {
                            current: res.data.current_page,
                            last: res.data.last_page
                        };
                    })
                    .catch(err => {
                        console.log(err);
                    });
            } else {
                this.getRestaurants();
            }
        }
    }
};
</script>

<style lang="scss" scoped>
    .card{
        width: 400px;
        margin: 10px;
        padding: 20px;
        background-color: rgb(134, 236, 202);
        border-radius: 10px;
    }
</style>
