<template>
    <footer>
       
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#273036" fill-opacity="1" d="M0,288L60,288C120,288,240,288,360,266.7C480,245,600,203,720,208C840,213,960,267,1080,266.7C1200,267,1320,213,1380,186.7L1440,160L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path></svg>
      
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
                            <li><a href="#" > <img class="link-img" src="../../../public/image/apple.png" alt="App Store"> </a></li>
                            <li><a href="#" ><img class="link-img" src="../../../public/image/android.png" alt="Google Play"></a></li>
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
            padding: 20px;
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
                        width: 150px;
                }
            }
        }
    }

</style>
