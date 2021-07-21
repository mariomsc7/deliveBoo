<template>
  <div>
    <section class="hero">
        <div class="container d-flex justify-content-around">
            <div class="animation" data-v-1eea8358="" data-v-06a4e336="" data-v-342286ac=""><div data-test-id="animation-images" class="animation__images" style="display: none;" data-v-1eea8358=""><img src="https://res.cloudinary.com/glovoapp/image/fetch//f_auto,q_auto/https://glovoapp.com/images/landing/address-container-image-burger.png" class="animation__images__img" data-v-1eea8358=""></div> <div class="animation__videos" data-v-1eea8358=""><video data-test-id="animation-video" autoplay="autoplay" loop="loop" muted="muted" class="animation__videos__video" data-v-1eea8358=""><source src="https://res.cloudinary.com/glovoapp//video/upload//website_assets/images/landing/address-container-animation.webm" preload="auto" type="video/webm" data-v-1eea8358=""></video></div></div>
            <h1 class="title">Consegnamo il tuo cibo preferito a casa tua!</h1>
        </div>
    </section>
    <svg class="wave" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#ffc244" fill-opacity="1" d="M0,288L60,272C120,256,240,224,360,218.7C480,213,600,235,720,245.3C840,256,960,256,1080,224C1200,192,1320,128,1380,96L1440,64L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z">
        </path>
    </svg>
    
  </div>
</template>

<script>
export default {
    name: "Hero"
}
</script>

<style lang="scss">
@import '../../sass/app';
    .hero {
        background: $brand-col;
        height: 300px;
    }

    .title {
        font-size: 4rem;
        font-weight: bold;
        max-width: 500px;
        text-align: center;
        align-self: flex-start;
    }

</style>