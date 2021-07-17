<template>
    <header>
        <router-link :to="{name: 'home'}">Home</router-link>
        <a href="http://127.0.0.1:8000/admin" target="_blank">Admin</a>
        
    </header>
</template>

<script>
export default {
    name: 'Header',
}
</script>

<style>

</style>