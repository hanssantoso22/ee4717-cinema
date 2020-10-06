var header = document.getElementById("main-header");
var active_tab = header.getElementsByClassName("tab active");
active_tab = active_tab[0];
var btns = header.getElementsByClassName("tab");
console.log(btns);
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
  var current = document.getElementsByClassName("active");
  active_tab.className = active_tab.className.replace(" active","");
  current[0].className = current[0].className.replace(" active", "");
  this.className += " active";
  });
}

var cart_button = header.getElementsByClassName("cart");
cart_button = cart_button[0]

cart_button.addEventListener ("click", function () {
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
})