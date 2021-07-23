<template>
    <div>
        <Hero />
        <div class="container">
            
            <h1 class="text-center">Scegli il tipo di ristorante!</h1>
            <!-- Types Checkbox -->
            <div class="type-list d-flex justify-content-around">
                <div class="chek-wrap" v-for="(type, index) in types" :key="`types-${index}`">
                    <input @change="filter" type="checkbox" :value="type" :id="type" v-model="checked">
                    <label class="box-card" :for="type">
                    {{type}}</label>
                </div>
            </div>
        
            <div v-if="types.length">
                <!-- Page Navigation -->
                <section class="navigation text-center mb-5">
                    <button class="page-btn" @click="getRestaurants(pagination.current - 1)" :disabled ="!(pagination.current > 1)"><i class="fas fa-caret-left"></i></button>
                    <button class="page-btn" :class="{'active-page' : pagination.current == i}" v-for="i in pagination.last" :key="`page-${i}`" @click="getRestaurants(i)">{{i}}</button>
        
                    <button class="page-btn" @click="getRestaurants(pagination.current + 1)" :disabled="!(pagination.current < pagination.last)"><i class="fas fa-caret-right"></i></button>
                </section>
                <!-- <div> -->
                        <!-- Restaurants List -->
                    <div class="row">
                        <div class="cards col-md-4" v-for="restaurant in restaurants" :key="`res-${restaurant.id}`">
                            <!-- <div class="test"> -->
                                <router-link class="test text-decoration-none" :to="{name: 'restaurant', params: {slug:restaurant.slug}}">
                                    <img class="img-fluid" v-if="restaurant.image" :src="restaurant.image" :alt="restaurant.name"/>
                                    <div class="res-data">
                                        <h2>{{ restaurant.name }}</h2>
                                        <div>{{ restaurant.address }}</div>
                                        <div>
                                            <span v-for="(type, index) in restaurant.type" :key="`type-${index}`">
                                                {{ type }}
                                            </span>
                                        </div>
                                    </div>
                                </router-link>
                            <!-- </div> -->

                        </div>
                    </div>
                <!-- </div> -->

            </div>
        </div>
    </div>
</template>

<script>
import Hero from '../components/Hero.vue'

export default {
    name: "Home",
    components:{
        Hero,
    },
    data() {
        return {
            restaurants: [],
            types: [],
            checked:[],
            pagination: {},
        };
    },
    created() {
        this.popCheck();
        this.getTypes();
        this.getRestaurants();
    },
    methods: {
        /**
         * Call API for Types
         */
        getTypes(){
             axios
                .get(`http://127.0.0.1:8000/api/types`)
                .then(res => {
                    this.types = res.data;
                })
                .catch(err => {
                    console.log(err);
                });
        },

        /**
         * Call API for All Restaurants
         */
        getRestaurants(page = 1) {
            if(this.checked.length == 0){
                
                axios
                    .get(`http://127.0.0.1:8000/api/restaurants?page=${page}`)
                    .then(res => {
                        this.restaurants = res.data.data;
                        this.pagination = {
                            current: res.data.current_page,
                            last: res.data.last_page
                        };
                    })
                    .catch(err => {
                        console.log(err);
                    });

            } else {
                // When change page
                this.filter(page);
            }
        },
        
        /***
         * Call API for Filtered Restaurants
         */
        filter(page = 1){
            if(this.checked.length != 0){
                window.localStorage.setItem('check', JSON.stringify(this.checked));
                // Create query string from checked array
                let query=[];
                query = this.checked;
                const stringQuery = JSON.stringify(query);

                axios
                    .get(`http://127.0.0.1:8000/api/filter?types=${stringQuery}&page=${page}`)
                    .then(res => {
                        console.log(res.data);
                        this.restaurants = res.data.data;
                        this.pagination = {
                            current: res.data.current_page,
                            last: res.data.last_page
                        };
                    })
                    .catch(err => {
                        console.log(err);
                    });
            } else {
                window.localStorage.removeItem('check');
                // When all checkbox are empty
                this.getRestaurants();
            }
        },

        popCheck(){
            if(window.localStorage.getItem('check')){
                this.checked = JSON.parse(window.localStorage.getItem('check'));
            }
        },
    }
};
</script>

<style lang="scss" scoped>
@import '../../sass/app';
    .cards {

        border-radius: 10px;
        color: #fff;
    }

    .type-list {
        list-style-type: none;
        flex-wrap: wrap;
    }
    .chek-wrap{
        position: relative;

        input{
            opacity: 0;
            position: absolute;

            &:checked + .box-card{
                background-color:#fd4800;
            }

        }
    }
    .box-card{
        position: relative;
        width:250px;
        height:50px;
        border-radius: 50px;
        background-color:#92d913;
        margin:20px ;
        display:flex;
        justify-content:center;
        align-items: center;
        font-size: 1.5em;
        box-shadow: 5px 10px #888888;
        cursor: pointer;
    }

    .page-btn{
        width: 100px;
        height:50px;
        border-radius: 50px;
        background-color:#92d913;
        margin:20px ;
        box-shadow: 5px 5px #888888;
    }

    .active-page{
            background-color:#13d9c9;
    }

    .res-data{
        padding: 10px;
    }
    .test {
        //border: 1px solid #000;
        display: inline-block;
        // --card-gradient: rgba(0, 0, 0, 0.65);
        background-color: #fff;
        border-radius: 0.5rem;
        box-shadow: 0.05rem 0.1rem 0.3rem -0.03rem rgba(0, 0, 0, 0.45);
        padding-bottom: 1rem;
        background-image: linear-gradient(
            rgba(0, 0, 0, 0.65),
            white max(9.5rem, 27vh)
        );
        color: #273036;
        overflow: hidden;
        

        img {
            border-radius: 0.5rem 0.5rem 0 0;
            width: 100%;
            object-fit: cover;
            // height: max(10rem, 25vh);
            max-height: max(10rem, 30vh);
            aspect-ratio: 4/3;
            mix-blend-mode: overlay;
            transition: opacity .5s;
            opacity: .5;
            
            // filter: grayscale(100);

            // ~ * {
            // margin-left: 1rem;
            // margin-right: 1rem;
        }
 
        &:hover img{
            mix-blend-mode: normal;
            opacity: 1;
        }
    }


    // .card {
        // --card-gradient: rgba(0, 0, 0, 0.8);
        // --card-blend-mode: overlay;
        // background-color: #fff;
        // border-radius: 0.5rem;
        // box-shadow: 0.05rem 0.1rem 0.3rem -0.03rem rgba(0, 0, 0, 0.45);
        // padding-bottom: 1rem;
        // background-image: linear-gradient(
        //     var(--card-gradient),
        //     white max(9.5rem, 27vh)
        // );
        // overflow: hidden;

        // img {
        //         border-radius: 0.5rem 0.5rem 0 0;
        //         width: 100%;
        //         object-fit: cover;
        //         // height: max(10rem, 25vh);
        //         max-height: max(10rem, 30vh);
        //         aspect-ratio: 4/3;
        //         mix-blend-mode: var(--card-blend-mode);
        //         // filter: grayscale(100);

        //         ~ * {
        //         margin-left: 1rem;
        //         margin-right: 1rem;
        //     }
    // }

    // > :last-child {
    //     margin-bottom: 0;
    // }

    //     &:hover,
    //     &:focus-within {
    //         --card-gradient: #e5eef1 max(8.5rem, 20vh);
    //     }
    
    // }
</style>
