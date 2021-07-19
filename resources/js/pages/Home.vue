<template>
    <div>
        
        <h1>RESTAURANTS</h1>

        <ul>
            
                <li v-for="(type, index) in types" :key="`types-${index}`">
                    <!-- <router-link :to="{name: 'list', params: {type:type}}">
                        {{type}}
                    </router-link> -->
                    <input @change="getRestaurants" type="checkbox" :value="type" :id="type" v-model="checked">
                    <label for="checkbox">{{type}}</label>
                </li>
            
        </ul>
        
        <article class="card" v-for="restaurant in restaurants" :key="`res-${restaurant.id}`">
            <router-link :to="{name: 'restaurant', params: {id:restaurant.id}}">
            <h2>{{ restaurant.name }}</h2>
            <div>{{ restaurant.address }}</div>
            <div>
                <span v-for="(type, index) in restaurant.type" :key="`type-${index}`">
                    {{ type }} 
                </span>
            </div>

            <img v-if="restaurant.image" :src="restaurant.image" :alt="restaurant.name" width="300"/>
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
            checked:[]
        };
    },
    created() {
        this.getRestaurants();
    },
    methods: {
        getRestaurants() {
            // Get posts from API
            let query=[];                
            if(this.checked.length == 0){
                query.push('all');
            } else {
                query = this.checked;
            }
                
            const stringQuery = JSON.stringify(query);
        
            axios
                .get(`http://127.0.0.1:8000/api/restaurants/${stringQuery}`)
                .then(res => {
                    this.restaurants = res.data;

                    this.restaurants.forEach(restaurant => {
                        restaurant.types.forEach(type => {
                            if(!this.types.includes(type.name)){
                                this.types.push(type.name);
                            }
                        });
                    });
                })
                .catch(err => {
                    console.log(err);
                });
        },
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
