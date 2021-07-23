<template>
  <div class="details">
    <div class="details-box">
      <span class="close" @click="$emit('close')"><i class="fas fa-times"></i></span>
      <h1>{{dishDetails.name}}</h1>
      <h3>{{dishDetails.ingredients}}</h3>
      <h3>{{dishDetails.description}}</h3>
      <h3>€{{dishDetails.price.toFixed(2)}}</h3>
      <img class="img-fluid" v-if="dishDetails.image" :src="dishDetails.image" :alt="dishDetails.name" width="300"/>
    </div>
  </div>
</template>

<script>
export default {
    name: 'Dish',
    props:{
      dishDetails: Object,
    },
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