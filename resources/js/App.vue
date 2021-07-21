<template>
  <div>
      <Header />
      <Hero />
      <main>
          <router-view></router-view>
      </main>
  </div>
</template>

<script>
import Header from './components/Header.vue'
import Hero from './components/Hero.vue'

export default {
    name: 'App',
    components:{
        Header,
        Hero,
    }
}
</script>

<style lang="scss">
    @import '../sass/app';
body {
    padding: 0 !important;
    margin: 0 !important;
    box-sizing: border-box !important;
}

</style>