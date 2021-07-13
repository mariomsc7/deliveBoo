const { Alert } = require('bootstrap');


require('./bootstrap');


// CONFIG PASSWORD VALIDATION
const btn = document.getElementById("register-button");

btn.addEventListener('click', function(e){
    const password = document.getElementById("password").value;
    const pswConfirm = document.getElementById("password-confirm").value;

    if(password != pswConfirm){
        alert('Password doesn\'t match');
        e.preventDefault();
    }
});