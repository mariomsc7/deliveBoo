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

        </div>
            <div class="dedica">
                <h2 >
                    Siamo un gruppo di ragazzi che è voluto andare oltre le proprie conoscenze ed intraprendere un corso come Boolean per approfondire la nostra passione nell'informatica .
                </h2>
                <h2>Con semplicità abbiamo creato questo sito, frutto di dedizione, organizzazione e caparbietà.</h2>
                <h2>Con la speranza che sia il primo di tanti, ci presentiamo così.</h2> 
                <h2>Marco, Fabrizio, Mario, Robert e Giulia!</h2>
                <h3>By DeliveBoo Team <i class="fas fa-ghost"></i></h3>
            </div>
    </div>
</template>

<script>
export default {};
</script>

<style lang="scss">

.about {
    margin-top: 25px;
}

h1 {
    font-weight: bold;
    font-size: 3rem;
}

.description {
    // display: inline-block;
    // margin-right: 88px;
    img {
        margin-top: 40px;
        border-radius: 20px;
    }
}
    .dedica {
        padding-top: 70px;
        text-align: center;
        h2 {
            margin-top: 20px;
        }
        h3 {
            margin-top: 40px;
        }

    }
</style>
