<template>
    <header>
        <router-link :to="{ name: 'home' }">Home</router-link>
        <router-link :to="{ name: 'checkout' }">Cassa</router-link>
        <router-link :to="{ name: 'payment' }">Pagamenti</router-link>
        <a href="http://127.0.0.1:8000/admin" target="_blank">Admin</a>
    </header>
</template>

<script>
export default {
    name: "Header"
};
</script>

<style lang="scss" scoped>
    .active{
        color: red;
    }
</style>
