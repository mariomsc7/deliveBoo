<template>
  <div>
      <div v-for="(item, index) in cart" :key="index">
          <span>{{item.name}}</span>
          X<span>{{item.quantità}}</span>
          €<span>{{item.prezzo}}</span>
      </div>
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
    // created(){
    //     this.getCart();
    // },
    watch:{
        // getCart();
        getCart(){
            this.cart = JSON.parse(window.localStorage.getItem('cart'));
            // console.log(this.cart);
        }
    },
    methods:{
    },
}
</script>

<style>

</style>