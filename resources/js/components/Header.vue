<template>
    <header>
        <div class="container d-flex justify-content-between">
            <div class="logo">
                <router-link class="text-decoration-none" :to="{ name: 'home' }">
                    <h1 class="title">DeliveBoo <i class="fas fa-ghost"></i></h1>
                </router-link>
            </div>

            <div class="top-menu">
                <router-link class="color icons" :to="{ name: 'home' }"><i class="fas fa-home"></i></router-link>
                <router-link class="color icons" :to="{ name: 'checkout' }"><i class="fas fa-cart-plus"></i></router-link>
                <router-link class="color icons" :to="{ name: 'aboutus' }"><i class="fas fa-users"></i></router-link>
                <a class="admin icons" href="http://127.0.0.1:8000/admin" target="_blank"><i class="fas fa-user-shield">Area Riservata</i></a>
            </div>
        </div>

    </header>
</template>

<script>
export default {
    name: "Header"
};
</script>

<style lang="scss" scoped>
@import '../../sass/app';
    header {
        padding: 20px !important;
        height: 100px;
        background-color: $brand-col;
    }

    .title{
        font-size: 2.5rem;
        font-weight: bold;
        text-shadow: 2px 2px 3px black;
        
    }
    .top-menu {
        font-size: 1rem;    
    }

    .color {
        color: #fff;
    }

    .color {
        &:hover {
            color: #273936;
        }
    }
    .active{
        color: #273936;
    }
    .admin {
        color: #fff;
        &:hover {
            color: #273936;
        }
    }

    .icons{
        font-size: 30px;
        margin: 0 20px;
    }

</style>
