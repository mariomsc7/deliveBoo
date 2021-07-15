<template>
    <div>
        <h1>RESTAURANTS</h1>

        <article v-for="restaurant in restaurants" :key="restaurant.id">
            <h2>{{ restaurant.name }}</h2>
            <p>{{ restaurant.address }}</p>
            <p v-for="type in restaurant.types" :key="type.id">
                {{ type.name }}
            </p>

            <img
                v-if="restaurant.image"
                :src="restaurant.image"
                :alt="restaurant.name"
            />
        </article>
        <article v-for="type in types" :key="type.id">
            <h2>{{ type.name }}</h2>
        </article>
    </div>
</template>

<script>
export default {
    name: "Home",
    data() {
        return {
            restaurants: [],
            types: []
        };
    },
    created() {
        // console.log(axios);
        this.getRestaurants();
    },
    computed: {
        getMarta() {
            this.restaurants.forEach(restaurant => {
                this.types.push(restaurant.types);
                console.log(this.types);
            });
        }
    },
    methods: {
        getRestaurants() {
            // Get posts from API
            axios
                .get(`http://127.0.0.1:8000/api/restaurants`)
                .then(res => {
                    console.log(res.data);
                    this.restaurants = res.data.restaurants;
                    this.types = res.data.types;
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
};
</script>

<style></style>
