<template>
    <div>
        <h1>RESTAURANTS</h1>

        <article v-for="restaurant in restaurants" :key="restaurant.id">
            <h2>{{ restaurant.name }}</h2>
            <p>{{ restaurant.address }}</p>

            <img
                v-if="restaurant.image"
                :src="restaurant.image"
                :alt="restaurant.name"
            />
        </article>
    </div>
</template>

<script>
export default {
    name: "Home",
    data() {
        return {
            restaurants: []
        };
    },
    created() {
        // console.log(axios);
        this.getRestaurants();
    },
    methods: {
        getRestaurants() {
            // Get posts from API
            axios
                .get(`http://127.0.0.1:8000/api/restaurants`)
                .then(res => {
                    // console.log(res.data);
                    this.restaurants = res.data;
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
};
</script>

<style></style>
