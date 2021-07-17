<template>
  <div>
      {{}}
  </div>
</template>

<script>
export default {
name: 'Cart',

data(){
    return{
        cart: {},
    }
},
created(){
    this.getCart();
},
methods:{
    getCart(){
        // this.cart = JSON.parse(window.localStorage.);
        // console.log(this.cart);
    }
},
}
</script>

<style>

</style>