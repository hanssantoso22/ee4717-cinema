var credit_card = document.getElementById("credit-card")
var radio = document.getElementsByName("payment")
var email = document.getElementById('email');
var cardname = document.getElementById('cardname');
var cardnumber = document.getElementById('cardnumber');
var expirydate = document.getElementById('expirydate');
var cvv = document.getElementById('cvv');
var check = [false,false,false,false,false];
radio[0].addEventListener ("click", function () {
    credit_card.style.visibility = "visible";
})
function validateEmail (element) {
    var regExp = /[\w-.]+@([\w-]+\.){1,3}\w{2,3}$/
    var testResult = regExp.test(element.value)
    if(!testResult) {
        document.getElementById('email-warning').style.display = 'block';
    }
    else {
        document.getElementById('email-warning').style.display = 'none';
        check[0] = true
    }
}
function validateCardName (element) {
    var regExp = /^[A-Za-z\s]+$/
    var testResult = regExp.test(element.value)
    if(!testResult) {
        document.getElementById('cardname-warning').style.display = 'block';
    }
    else {
        document.getElementById('cardname-warning').style.display = 'none';
        check[1] = true
    }
}
function validateCardNumber (element) {
    var regExp = /^[0-9]{12}$/
    var testResult = regExp.test(element.value)
    if(!testResult) {
        document.getElementById('cardnumber-warning').style.display = 'block';
    }
    else {
        document.getElementById('cardnumber-warning').style.display = 'none';
        check[2] = true
    }
}
function validateExpiryDate (element) {
    var startDate = new Date (element.value)
    var today = Date.now()
    var testResult = startDate<=today
    if (testResult){
        document.getElementById('expirydate-warning').style.visibility = 'visible'
    }
    else {
        document.getElementById('expirydate-warning').style.visibility = 'hidden'
        check[3] = true
    }
}
function validateCVV (element) {
    var regExp = /^[0-9]{3}$/
    var testResult = regExp.test(element.value)
    if(!testResult) {
        document.getElementById('cvv-warning').style.visibility = 'visible';
    }
    else {
        document.getElementById('cvv-warning').style.visibility = 'hidden';
        check[4] = true
    }
}
function validateForm () {
    if (check[0]==true && check[1]==true && check[2]==true && check[3]==true && check[4]==true){
        return true
    }
    else {
        alert ('Edit the invalid fields!')
        return false
    }
}
function init() {
    if (document && document.getElementById) {
        var paymentForm = document.getElementById('payment-form');
        email.addEventListener ('change', function() {
            validateEmail(email);
        })
        cardname.addEventListener('change',function() {
            validateCardName(cardname);
        })
        cardnumber.addEventListener('change', function(){
            validateCardNumber(cardnumber);
        })
        expirydate.addEventListener('change',function(){
            validateExpiryDate(expirydate);
        })
        cvv.addEventListener('change',function(){
            validateCVV(cvv);
        })
        paymentForm.onsubmit = validateForm;
    }
}
window.onload = init;