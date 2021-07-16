<template>
    <div>
        <h1>DISHES</h1>
        <ul>
            <li :class="{unavailable: !dish.visibility}" v-for="(dish, index) in dishes" :key="`dishes-${index}`">
                {{dish.name}}
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: 'Restaurant',
    data() {
        return {
            dishes: []
        };
    },
    created() {
        this.getDishes();
    },
    methods: {
        getDishes() {
            // Get posts from API
            axios
                .get(`http://127.0.0.1:8000/api/restaurants/${this.$route.params.id}`)
                .then(res => {
                    this.dishes = res.data;
                    console.log(res)
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
}
</script>

<style language="scss">
    .unavailable {
        color: red;
    }
</style>