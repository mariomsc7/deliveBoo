<template>
    <div>

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
    name: 'List',
     data() {
        return {
            restaurants: [],
        };
    },
    created() {
        this.getRestaurants();
    },
    methods: {
        getRestaurants() {
            // Get posts from API
            axios
                .get(`http://127.0.0.1:8000/api/restaurants/${this.$route.params.type}`)
                .then(res => {
                    this.restaurants = res.data;

                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
}
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