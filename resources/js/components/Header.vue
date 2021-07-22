<template>
    <header>
        <div class="container d-flex justify-content-between">
            <div class="logo">
                <h1 class="title">Deliveboo <i class="fas fa-ghost"></i></h1>
            </div>

            <div class="top-menu">
                <router-link class="color" :to="{ name: 'home' }"><i class="fas fa-home">Home</i></router-link>
                <router-link class="color" :to="{ name: 'checkout' }"><i class="fas fa-cart-plus">Cassa</i></router-link>
                <a class="admin" href="http://127.0.0.1:8000/admin" target="_blank"><i class="fas fa-user-shield">Area Ristoratore</i></a>
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
        background-color: #13d977;
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
        color: $black;
    }

    .color {
        &:hover {
            color: #fff;
        }
    }
    .active{
        color: #fff;
    }
    .admin {
        color: $black;
        &:hover {
            color: #fff;
        }
    }

</style>
