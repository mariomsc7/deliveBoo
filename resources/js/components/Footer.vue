<template>
    <footer>
       
        
           <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#273036" fill-opacity="1" d="M0,192L80,165.3C160,139,320,85,480,69.3C640,53,800,75,960,122.7C1120,171,1280,245,1360,282.7L1440,320L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path>
           </svg>
           <div class="footer-bottom">
               <div class="container d-flex justify-content-between">
                   <div>
                       <h2>Scopri Deliveroo</h2>
                        <ul>
                           <li> <a href="#">Investitori</a></li>
                           <li> <a href="#">Chi Siamo</a></li>
                           <li> <a href="#">Ristoranti</a></li>
                           <li> <a href="#">Altro</a></li>
                           <li> <a href="#">Pressroom</a></li>
                           <li> <a href="#">Il nostro blog</a></li>
                           <li> <a href="#">Programmazione</a></li>
                           <li> <a href="#">Design</a></li>
                           <li> <a href="#">Lavora con noi</a></li>
                           <li> <a href="#">Diventa nostro partner</a></li>
                        </ul>
                   </div>
                   <div>
                        <h2>Aiuto</h2>
                        <ul>
                            <li><a href="#">Termini e Condizioni</a></li>
                            <li><a href="#">Informativa sulla privacy</a></li>
                            <li><a href="#">Cookies</a></li>
                        </ul>
                   </div>
                   <div>
                        <h2>Porta Deliveroo con te</h2>
                        <ul>
                            <li><a href="#"></a></li>
                            <li><a href="#" > <img class="link-img" src="../../../public/image/app_store.png" alt="App Store"> </a></li>
                            <li><a href="#" ><img class="link-img" src="../../../public/image/gplay.png" alt="Google Play"></a></li>
                        </ul>
                   </div>
                
                </div>
                
                
           </div>

    </footer>
</template>

<script>
export default {
    name: "Footer"
};
</script>

<style lang="scss" scoped>
@import '../../sass/app';
    footer{
        .footer-bottom{
            width: 100%;
            // height:500px;
            padding-bottom: 100px;
            background-color:#273036;
            color:white;
            ul{
                padding:0;
                list-style:none;
                a{
                    color:white;
                }
                .link-img{
                        margin-bottom: 5px;
                        display:block;
                        width:150px;
                }
            }
        }
    }

</style>
