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
                <h2>
                    Lorem 
                </h2>
            </div>
            <div class="w-100 d-sm-block d-md-none "></div>
            <div class="description col-md-3 col-sm-6 col-6">
                <img
                    class="link-img img-fluid"
                    src="../../../public/image/sfondo.jpg"
                    alt="About"
                />
                <h2>
                    Lorem, ipsum dolor sit 
                </h2>
            </div>
            <div class="w-100 d-sm-block d-md-none "></div>
            <div class="description col-md-3 col-sm-6 col-6">
                <img
                    class="link-img img-fluid"
                    src="../../../public/image/sfondo.jpg"
                    alt="About"
                />
                <h2>
                    Lorem, ipsum dolor sit 
                </h2>
            </div>
        </div>
        <div class="row justify-content-around">
            <div class="description col-md-3 col-sm-6 col-6">
                <img
                    class="link-img img-fluid"
                    src="../../../public/image/sfondo.jpg"
                    alt="About"
                />
                <h2>
                    Lorem, ipsum dolor sit 
                </h2>
            </div>
            <div class="w-100 d-sm-block d-md-none "></div>
            <div class="description col-md-3 col-sm-6 col-6">
                <img
                    class="link-img img-fluid"
                    src="../../../public/image/sfondo.jpg"
                    alt="About"
                />
                <h2>
                    Lorem, ipsum dolor sit 
                </h2>
            </div>
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
