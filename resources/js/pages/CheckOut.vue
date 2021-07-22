<template>
    <div>
        <h1>Cassa</h1>
        <div class="cart">
            <h2>Il tuo Carrello</h2>
            <div v-if="Object.keys(cart).length" >
                <div v-for="(item, index) in cart" :key="index">                
                    <button  @click="remove(item.name, item.unitPrice)">-</button>
                    <input class="inputNum" type="number" min="1" v-model="item.quantità" @change="updateQuantity($event, item.name, item.unitPrice)">
                    <button @click="add(item.name, item.unitPrice)">+</button>
                    <span class="name">{{item.name}}</span>
                    <span>€ {{item.prezzo.toFixed(2)}}</span> 
                    <span class="remove" @click="removeAll(item.name, item.prezzo)">X</span>
                </div>
            </div>
            <div v-else>Il carrello è vuoto</div>
            <h3>Tot: €{{tot.toFixed(2)}}</h3>
            <button v-if="Object.keys(cart).length" @click="deleteCart()">Elimina Carrello</button>
        </div>
        <div v-if="Object.keys(cart).length" class="container">

            <div class="col-6 offset-3">
                <div class="success-message" v-show="success">Il tuo ordine è stato inviato</div>
                <form @submit.prevent="payWithCreditCard">

                    <div class="mb-3">
                        <label for="customer_name" class="control-label">Nome*</label>
                        <input type="text" class="form-control" id="customer_name" v-model="customer_name" required maxlength="50">
                        <div class="error-message" v-for="(error,index) in errors.customer_name" :key="`err-name-${index}`">{{error}}</div>
                    </div>
                    <div class="mb-3">
                        <label for="customer_lastname" class="control-label">Cognome*</label>
                        <input type="text" class="form-control" id="customer_lastname" v-model="customer_lastname" required maxlength="50">
                        <div class="error-message" v-for="(error,index) in errors.customer_lastname" :key="`err-lastname-${index}`">{{error}}</div>
                    </div>
                    <div class="mb-3">
                        <label for="customer_address" class="control-label">Indirizzo*</label>
                        <input id="customer_address" type="text" class="form-control" v-model="customer_address" required autocomplete="address" maxlength="50" autofocus>
                        <div class="error-message" v-for="(error,index) in errors.customer_address" :key="`err-address-${index}`">{{error}}</div>
                    </div>
                    <div class="mb-3">
                        <label for="phone_number" class="control-label">Numero di telefono*</label>
                        <input id="phone_number" type="text" class="form-control" v-model="phone_number" required autocomplete="phone_number"  minlength="10" maxlength="10" autofocus>
                        <div class="error-message" v-for="(error,index) in errors.phone_number" :key="`err-phone-${index}`">{{error}}</div>
                    </div>
                    <div class="card bg-light">
                        <div class="card-header">Informazioni di Pagamneto</div>
                        <div class="card-body">
                            <div class="alert alert-success" v-if="nonce">
                                Successfully generated nonce.
                            </div>
                            <form>
                                <div class="form-group">
                                    <label>Numero Carta</label>
                                    <div
                                        id="creditCardNumber"
                                        class="form-control"
                                    ></div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <label>Data Scadenza</label>
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
                    <button type="submit" class="btn btn-primary btn-block">Procedi all'ordine</button>
                    <div class="alert alert-danger" v-if="error">{{ error }}</div>
                </form>
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
        // restaurant_id: this.cart[0].restaurant_id,
        customer_name: '',
        customer_lastname: '',
        customer_address: '',
        phone_number: null,
        errors:{},
        success: false,
        sending: false,
        tot: 0,
        cart: {},
        hostedFieldInstance: false,
        nonce: "",
        error: "",
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
        sendOrder(){
            this.sendig = true;
            axios.post("http://127.0.0.1:8000/api/orders", {
                customer_name: this.customer_name,
                customer_lastname: this.customer_lastname,
                customer_address: this.customer_address,
                phone_number: this.phone_number,
                tot_paid: this.tot,
                restaurant_id: this.cart[Object.keys(this.cart)[0]].restaurant_id,
            })
            .then(res => {
                this.sendig = false;
                if(res.data.error){
                    this.errors = res.data.error;
                    this.success = false;
                } else {
                    this.customer_name = '';
                    this.customer_lastname = '';
                    this.customer_address = '';
                    this.phone_number = null;

                    this.errors = {};
                    this.success = true;

                    this.cart = {};
                    this.tot = 0; 
                    window.localStorage.clear();
                }
            })
            .catch(err => {
                console.log(err);
            })
        },
        getBill(){
            if(window.localStorage.getItem('cart')){
                this.cart = JSON.parse(window.localStorage.getItem('cart'));

                for(let item in this.cart){
                    this.tot+=this.cart[item].prezzo;

                };
            }
        },
        add(name, unit){
            this.cart[name].quantità ++;
            this.cart[name].prezzo += unit;
            this.tot += unit;
            this.store();
        },
        remove(name, unit){
            if(this.cart[name].quantità == 1){
                delete this.cart[name];
            } else {
                this.cart[name].quantità --;
                this.cart[name].prezzo -= unit;
            }
            this.tot -= unit;
            this.store();
        },
        removeAll(item, price){
            delete this.cart[item];
            this.tot -= price;
            this.store();
        },
        updateQuantity(e,name, unit){
            const value = parseFloat(e.target.value);
            if(value>0){
                console.log(value);
                this.cart[name].quantità = value;
                this.cart[name].prezzo = (value * unit);
                this.tot = 0;
                this.setTotal();
                this.store();
            } else {
                this.cart[name].quantità = 1;
                this.cart[name].prezzo = unit;
                this.tot = 0;
                this.setTotal();
                this.store();
            }
        },
        setTotal(){
            for(let item in this.cart){
                this.tot+=this.cart[item].prezzo;
            }; 
        },
        store(){
            window.localStorage.setItem('cart', JSON.stringify(this.cart));
        },
        deleteCart(){
            const resp = confirm('Vuoi cancellare il tuo ordine?');
            if(resp){
                this.cart = {};
                this.tot = 0; 
                window.localStorage.clear();
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
                        this.sendOrder();
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
.error-message {
    color: red;
}
.success-message {
    color: green;
}
</style>