<template>
  <div>
      <h1>Cassa</h1>
      <div class="cart">
        <h2>Il tuo Carrello</h2>
        <div v-if="Object.keys(cart).length" >
            <div v-for="(item, index) in cart" :key="index">
                
                <span >{{item.quantità}}</span>
                
                <span class="name">{{item.name}}</span>
                <span>€ {{item.prezzo.toFixed(2)}}</span> 
            </div>
        </div>
        <div v-else>Il carrello è vuoto</div>
            <h3>Tot: €{{tot.toFixed(2)}}</h3>
    </div>
      <div class="container">
        <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
            integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
            crossorigin="anonymous"
        />
        <div class="col-6 offset-3">
            <div class="card bg-light">
                <div class="card-header">Payment Information</div>
                <div class="card-body">
                    <div class="alert alert-success" v-if="nonce">
                        Successfully generated nonce.
                    </div>
                    <form>
                        <div class="form-group">
                            <label>Credit Card Number</label>
                            <div
                                id="creditCardNumber"
                                class="form-control"
                            ></div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label>Expire Date</label>
                                    <div
                                        id="expireDate"
                                        class="form-control"
                                    ></div>
                                </div>
                                <div class="col-6">
                                    <label>CVV</label>
                                    <div id="cvv" class="form-control"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <button
                class="btn btn-primary btn-block"
                @click.prevent="payWithCreditCard"
            >
                Pay with Credit Card
            </button>
            <div class="alert alert-danger" v-if="error">
                {{ error }}
            </div>
        </div>
    </div>

  </div>
</template>

<script>
import braintree from "braintree-web";

export default {
    name: 'CheckOut',
    data() {
        return {
          tot: 0,
          cart: [],
            hostedFieldInstance: false,
            nonce: "",
            error: ""
        }
    },
    created(){
        this.getBill();
    },
     mounted() {
        braintree.client
            .create({
                authorization: "sandbox_w3mbmmkd_mgtff9zhgfck2nfm"
            })
            .then(clientInstance => {
                let options = {
                    client: clientInstance,
                    styles: {
                        input: {
                            "font-size": "14px",
                            "font-family": "Open Sans"
                        }
                    },
                    fields: {
                        number: {
                            selector: "#creditCardNumber",
                            placeholder: "Enter Credit Card"
                        },
                        cvv: {
                            selector: "#cvv",
                            placeholder: "Enter CVV"
                        },
                        expirationDate: {
                            selector: "#expireDate",
                            placeholder: "00 / 0000"
                        }
                    }
                };
                return braintree.hostedFields.create(options);
            })
            .then(hostedFieldInstance => {
                // Use hostedFieldInstance to send data to Braintree
                this.hostedFieldInstance = hostedFieldInstance;
            })
            .catch(err => {
                console.error(err);
                this.error = err.message;
            });
    },
    methods: {
        getBill(){
            if(window.localStorage.getItem('cart')){
                this.cart = JSON.parse(window.localStorage.getItem('cart'));

                for(let item in this.cart){
                    this.tot+=this.cart[item].prezzo;

                };
            }
        },
         payWithCreditCard() {
            if (this.hostedFieldInstance) {
                this.error = "";
                this.nonce = "";
                this.hostedFieldInstance
                    .tokenize()
                    .then(payload => {
                        console.log(payload);
                        this.nonce = payload.nonce;
                    })
                    .catch(err => {
                        console.error(err);
                        this.error = err.message;
                    });
            }
        }
    }    
}
</script>

<style>
body {
    padding: 5px;
}
</style>