<template>
  <div class="details">
    <div class="details-box">
      <span class="close" @click="$emit('close')">X</span>
      <h1>{{dishDetails.name}}</h1>
      <h3>{{dishDetails.ingredients}}</h3>
      <h3>{{dishDetails.description}}</h3>
      <h3>€{{dishDetails.price.toFixed(2)}}</h3>
      <img class="img-fluid" v-if="dishDetails.image" :src="dishDetails.image" :alt="dishDetails.name" width="300"/>
      <div v-if=(dishDetails.visibility)>
        <div>
          <button @click="less(dishDetails.price)"> - </button>
          <span>{{quantity}}</span>
          <button @click="more(dishDetails.price)"> + </button>
    
        </div>
        <button @click="addDish(dishDetails), $emit('close')" >Aggiungi al carrello | TOT: {{price.toFixed(2)}} €</button>
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
        carrello: {},
        price: this.dishDetails.price,
        quantity: 1,
      }
    },
    
    methods:{
      addDish(dishDetails){

      let order={
        restaurant_id: dishDetails.restaurant_id,
        name: dishDetails.name,
        quantità: this.quantity,
        prezzo: this.price,
      }

        this.$emit('addToCart', order, dishDetails.name, dishDetails.price);
      },
      more(price){
        this.quantity++;
        this.price += price;
      },
      less(price){
        if(this.quantity != 1){
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
  background-color: rgba(0, 0, 0, .4);

  .details-box{
    padding: 10px;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    background-color: rgba(255, 255, 255, .75);
    border-radius: 10px;

    .close{
      cursor: pointer;
    }
  }
}
</style>