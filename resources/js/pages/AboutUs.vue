<template>
    <div class="container">
        <div class="about">
            <h1 class="text-center">Chi ha creato DeliveBoo???</h1>
        </div>
        <div class="row justify-content-around">
            <div class="description col-md-3 col-sm-6 col-6">
                <img
                    class="link-img img-fluid rounded-circle"
                    src="../../../public/image/sfondo.jpg"
                    alt="About"
                />
                
            </div>
            <div class="w-100 d-sm-block d-md-none "></div>
            <div class="description col-md-3 col-sm-6 col-6">
                <img
                    class="link-img img-fluid"
                    src="../../../public/image/sfondo.jpg"
                    alt="About"
                />
                
            </div>
            <div class="w-100 d-sm-block d-md-none "></div>
            <div class="description col-md-3 col-sm-6 col-6">
                <img
                    class="link-img img-fluid"
                    src="../../../public/image/sfondo.jpg"
                    alt="About"
                />
                
            </div>
        </div>
        <div class="row justify-content-around">
            <div class="description col-md-3 col-sm-6 col-6">
                <img
                    class="link-img img-fluid"
                    src="../../../public/image/sfondo.jpg"
                    alt="About"
                />
                
            </div>
            <div class="w-100 d-sm-block d-md-none "></div>
            <div class="description col-md-3 col-sm-6 col-6">
                <img
                    class="link-img img-fluid"
                    src="../../../public/image/sfondo.jpg"
                    alt="About"
                />
                
            </div>
            <h2 class="text-center mt-3">
                Siamo un gruppo di ragazzi che è voluto andare oltre le proprie conoscenze ed intraprendere un corso come Boolean per approfondire la nostra passione nell'informatica .
                 <h2 class="text-center mt-3">Con semplicità abbiamo creato questo sito, frutto di dedizione, organizzazione e caparbietà.</h2>
                Con la speranza che sia il primo di tanti, ci presentiamo così.
                 <h2 class="text-center mt-3">Marco, Fabrizio, Mario, Robert e Giulia!</h2>
            </h2>
        </div>
    </div>
</template>

<script>
export default {};
</script>

<style lang="scss">
// IMPORT FONT
@import url("https://fonts.googleapis.com/css2?family=Otomanopee+One&display=swap");

@import url("https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap");

.container > .about > h1 {
    font-family: "Otomanopee One", sans-serif;
}

.about {
    margin-top: 25px;
}

.description {
    // display: inline-block;
    // margin-right: 88px;
    img {
        margin-top: 40px;
        border-radius: 20px;
    }
    h2 {
        margin-top: 20px;
        font-family: "Dancing Script", cursive;
    }
}
</style>
