<template>
  <div>
      <h1>Carrello</h1>

  </div>
</template>

<script>
export default {
    name: 'Cart',
    data() {
        return {
            cartData: []
        }
    },
    created() {
        console.log(this.$route);
    },
    methods: {
        getCartData() {
            
        }
    }
}
</script>

<style>

</style>