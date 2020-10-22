var credit_card = document.getElementById("credit-card")
var radio = document.getElementsByName("payment")
radio[0].addEventListener ("click", function () {
    credit_card.style.visibility = "visible";
})