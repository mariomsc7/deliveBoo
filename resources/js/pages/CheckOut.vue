<template>
  <div>
      <h1>Cassa</h1>
      <div class="cart">
        <h2>Il tuo Carrello</h2>
        <div v-if="Object.keys(cart).length" >
            <div v-for="(item, index) in cart" :key="index">
                
                <span >{{item.quantità}}</span>
                
                <span class="name">{{item.name}}</span>
                <span>€ {{item.prezzo.toFixed(2)}}</span> 
            </div>
        </div>
        <div v-else>Il carrello è vuoto</div>
            <h3>Tot: €{{tot.toFixed(2)}}</h3>
    </div>

  </div>
</template>

<script>
export default {
    name: 'CheckOut',
    data() {
        return {
          tot: 0,
          cart: [],
        }
    },
    created(){
        this.getBill();
    },
    methods: {
        getBill(){
            if(window.localStorage.getItem('cart')){
                this.cart = JSON.parse(window.localStorage.getItem('cart'));

                for(let item in this.cart){
                    this.tot+=this.cart[item].prezzo;

                };
            }
        }
    }    
}
</script>

<style>

</style>