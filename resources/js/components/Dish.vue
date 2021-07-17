<template>
  <div class="details">
    <div class="details-box">
      <span class="close" @click="$emit('close')">X</span>
      <h1>{{dishDetails.name}}</h1>
      <h3>{{dishDetails.ingredients}}</h3>
      <h3>{{dishDetails.description}}</h3>
      <h3>€{{dishDetails.price.toFixed(2)}}</h3>
      <img v-if="dishDetails.image" :src="dishDetails.image" :alt="dishDetails.name" width="300"/>
      <div v-if=(dishDetails.visibility)>
        <div>
          <button @click="less(dishDetails.price)"> - </button>
          <span>{{quantity}}</span>
          <button @click="more(dishDetails.price)"> + </button>
    
        </div>
        <button @click="addDish(dishDetails)">Aggiungi al carrello | TOT: {{price.toFixed(2)}} €</button>
      </div>
      <button v-else disabled>Non disponibile</button>
    </div>
  </div>
</template>

<script>
export default {
    name: 'Dish',
    props:{
      dishDetails: Object,
    },
    data(){
      return {
        carrello: [],
        price: 0,
        quantity: 0,
      }
    },
    
    methods:{
      addDish(dishDetails){
        for(let i = 0; i < this.quantity; i++ ){
          this.carrello.push(dishDetails);
          console.log(this.carrello);
        }
          this.quantity = 0;
          this.price = 0;
          this.$emit('addToCart', this.carrello);
      },
      more(price){
        this.quantity++;
        this.price += price;
      },
      less(price){
        if(this.quantity != 0){
          this.quantity --;
          this.price -= price;
        }
      }
    }
}
</script>

<style lang="scss" scoped>
.details{
  position: fixed;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .2);

  .details-box{
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);

    .close{
      cursor: pointer;
    }
  }
}
</style>