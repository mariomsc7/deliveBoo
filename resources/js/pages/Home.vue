<template>
    <div>
        <Hero />
        <div class="container">
            
            <h1 class="text-center">Cosa vorresti mangiare oggi?</h1>
            <!-- Types Checkbox -->
            <div class="type-list d-flex justify-content-around">
                <div class="chek-wrap" v-for="(type, index) in types" :key="`types-${index}`">
                    <input @change="filter" type="checkbox" :value="type" :id="type" v-model="checked">
                    <label class="box-card" :for="type">
                    {{type}}</label>
                </div>
            </div>

            <hr>

            <div v-if="types.length">
                <!-- Page Navigation -->
                <div class="navigation text-center mb-5">
                    <button class="custom-btn btn-9 arrow" @click="getRestaurants(pagination.current - 1)" :disabled ="!(pagination.current > 1)"><i class="fas fa-caret-left"></i></button>
                    <span v-if="pagination.last != 1">
                        <button class="custom-btn btn-9 d-none d-md-inline" :class="{'active-page' : pagination.current == i}" v-for="i in pagination.last" :key="`page-${i}`" @click="getRestaurants(i)">{{i}}</button>
                    </span>
        
                    <button class="custom-btn btn-9 arrow" @click="getRestaurants(pagination.current + 1)" :disabled="!(pagination.current < pagination.last)"><i class="fas fa-caret-right"></i></button>
                </div>

                <!-- Restaurants List -->
                <div class="row">
                    <div class="cards col-md-4" v-for="restaurant in restaurants" :key="`res-${restaurant.id}`">
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
                    </div>
                </div>
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
    hr{
        width: 40%;
        border: 1px solid #273036;
    }
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
                background-color:#fff;
                color: #273036;
                        box-shadow: inset 2px 2px 2px 0px rgba(255,255,255,.5),
                    inset -7px -7px 10px 0px rgba(0,0,0,.1),0px 0px 15px 5px $brand-col,
                    4px 4px 5px 0px $brand-col;
            }

        }
    }
    .box-card{
        color: #fff;
        position: relative;
        width:250px;
        height:50px;
        border-radius: 50px;
        background-color:#273036;
        margin:20px ;
        display:flex;
        justify-content:center;
        align-items: center;
        font-size: 1.5em;
        cursor: pointer;
        box-shadow: inset 2px 2px 2px 0px rgba(255,255,255,.5),
                    inset -7px -7px 10px 0px rgba(0,0,0,.1),7px 7px 20px 0px rgba(0,0,0,.1),
                    4px 4px 5px 0px rgba(0,0,0,.1);
        text-shadow:  2px 2px 3px rgba(255,255,255,.5),
                      -4px -4px 6px rgba(116, 125, 136, .2);
        outline: none;
        -webkit-user-select: none; /* Safari */        
        -moz-user-select: none; /* Firefox */
        -ms-user-select: none; /* IE10+/Edge */
        user-select: none; /* Standard */
    }

    // Custom buttons
    button {
        margin: 20px;
    }

    .custom-btn {
        width: 90px;
        height: 40px;
        color: #fff;
        border-radius: 50px;
        padding: 0 25px;
        font-family: 'Lato', sans-serif;
        font-weight: 500;
        font-size: 20px;
        background: #273036;
        // background: transparent;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        display: inline-block;
        box-shadow: inset 2px 2px 2px 0px rgba(255,255,255,.5),
                    inset -7px -7px 10px 0px rgba(0,0,0,.1),7px 7px 20px 0px rgba(0,0,0,.1),
                    4px 4px 5px 0px rgba(0,0,0,.1);
        text-shadow: 2px 2px 3px rgba(255,255,255,.5),
                     -4px -4px 6px rgba(116, 125, 136, .2);
        outline: none;

        &.arrow{
            width: 40px;
            border-radius: 50%;
            padding: 0;

            &:disabled{
                background-color: #797b7c;
                &:hover{
                           box-shadow: inset 2px 2px 2px 0px rgba(255,255,255,.5),
                    inset -7px -7px 10px 0px rgba(0,0,0,.1),7px 7px 20px 0px rgba(0,0,0,.1),
                    4px 4px 5px 0px rgba(0,0,0,.1);
                }
            }
        }
    }



    .btn-9 {
        border: none;
        transition: all 0.3s ease;
        overflow: hidden;
        color: white;
        }
    // .btn-9:after {
    //     position: absolute;
    //     content: " ";
    //     z-index: -1;
    //     top: 0;
    //     left: 0;
    //     width: 100%;
    //     height: 100%;
    //     background: #273036;
    //     transition: all 0.3s ease;
    //     }
    .btn-9:hover {
        background: #273036;
        // background: transparent;
        // background: #13d97742;
        box-shadow:  4px 4px 6px 0 rgba(255,255,255,.5),
                    -4px -4px 6px 0 rgba(116, 125, 136, .2), 
            inset -4px -4px 6px 0 rgba(255,255,255,.5),
            inset 4px 4px 6px 0 rgba(116, 125, 136, .3);
        color: #fff;
        }
    // .btn-9:hover:after {
    //     -webkit-transform: scale(2) rotate(180deg);
    //     transform: scale(2) rotate(180deg);
    //     box-shadow:  4px 4px 6px 0 rgba(255,255,255,.5),
    //                 -4px -4px 6px 0 rgba(116, 125, 136, .2), 
    //         inset -4px -4px 6px 0 rgba(255,255,255,.5),
    //         inset 4px 4px 6px 0 rgba(116, 125, 136, .3);
    //     }

    .active-page{
        background-color:#fff;
        color: #4e5357 ;
        box-shadow: inset 2px 2px 2px 0px rgba(255,255,255,.5),
                    inset -7px -7px 10px 0px rgba(0,0,0,.1),0px 0px 15px 5px $brand-col,
                    4px 4px 5px 0px $brand-col;

    }

    .res-data{
        padding: 10px;
    }
    .test {
        display: inline-block;
        // background-color: #fff;
        border-radius: 0.5rem;
        box-shadow: 0.05rem 0.1rem 0.3rem -0.03rem rgba(0, 0, 0, 0.45);
        padding-bottom: 1rem;
        background-image: linear-gradient(
            rgba(0, 0, 0, 0.65),
            rgba(255,255,255,.7) max(9.5rem, 27vh)
        );
        color: #273036;
        overflow: hidden;
        

        img {
            border-radius: 0.5rem 0.5rem 0 0;
            width: 100%;
            object-fit: cover;
            max-height: max(10rem, 30vh);
            aspect-ratio: 4/3;
            mix-blend-mode: overlay;
            transition: opacity .5s;
            opacity: .5;
        }
 
        &:hover img{
            mix-blend-mode: normal;
            opacity: 1;
        }
    }
</style>
