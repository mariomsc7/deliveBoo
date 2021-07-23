<template>
    <header>
        <!-- <div class="container d-flex justify-content-between">
            <div class="logo">
                <router-link class="text-decoration-none" :to="{ name: 'home' }">
                    <h1 class="title">DeliveBoo <i class="fas fa-ghost"></i></h1>
                </router-link>
            </div>

            <div class="top-menu">
                <router-link class="color icons nav-link" :to="{ name: 'home' }"><i class="fas fa-home"></i></router-link>
                <router-link class="color icons" :to="{ name: 'checkout' }"><i class="fas fa-cart-plus"></i></router-link>
                <router-link class="color icons" :to="{ name: 'aboutus' }"><i class="fas fa-users"></i></router-link>
                <a class="admin icons" href="http://127.0.0.1:8000/admin" target="_blank"><i class="fas fa-user-shield">Area Riservata</i></a>
            </div>
        </div> -->



<nav class="navbar navbar-expand-lg navbar-light back">
  <a class="navbar-brand" href="#">
      <router-link class="text-decoration-none" :to="{ name: 'home' }">
        <h1 class="title">DeliveBoo <i class="fas fa-ghost"></i></h1>
      </router-link>
  </a>
  <button @click="showHamburger = !showHamburger" :class="{ 'collapsed' : showHamburger}" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" :class="{ 'show' : showHamburger}" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto ">
      <li class="nav-item active">
          <router-link class="color icons nav-link" :to="{ name: 'home' }"><i class="fas fa-home icons"> <span class="sr-only">(current)</span></i></router-link>
        
      </li>
      <li class="nav-item active">
          <router-link class="color icons nav-link" :to="{ name: 'checkout' }"><i class="fas fa-cart-plus icons"> <span class="sr-only">(current)</span></i></router-link>
        
      </li>
      <li class="nav-item active">
          <router-link class="color icons nav-link" :to="{ name: 'aboutus' }"><i class="fas fa-users icons"> <span class="sr-only">(current)</span></i></router-link>
        
      </li>
      <li class="nav-item active">
        <a class="admin icons nav-link" href="http://127.0.0.1:8000/admin" target="_blank"><i class="fas fa-user-shield icons">Area Riservata</i></a>        
      </li>
      
    </ul>
    
  </div>
</nav>



    </header>
</template>

<script>
export default {
    name: "Header",
    data(){
        return{
            showHamburger:false,
        }
    },
};
</script>

<style lang="scss" scoped>
@import '../../sass/app';
    header {
        padding: 20px !important;
        height: auto;
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
        font-size: 25px;
        margin: 0 20px;
        color: #fff;
        &:hover {
            color: #273936;
        }
    }

    .back{
        background-color: $brand-col;
    }

</style>
