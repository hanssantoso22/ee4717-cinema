var seatWarning = document.getElementById('seat-warning');
var submitWarning = document.getElementById('submit-warning');
var qty = document.getElementById('qty').value;
var seats = []; //all seat nodes, not the values
var uniqueSeatValNoNone = new Set();

for (i=1;i<=qty;i++) {
    var seatName = `seat${i}`;
    var seatVal = document.getElementById(seatName);
    seats.push(seatVal);
}
function validateSeat() {
    var seatsVal = [];
    var notNoneValue = 0;
    for (i=1;i<=qty;i++) {
        var seatName = `seat${i}`;
        var seatVal = document.getElementById(seatName);
        if (seatVal!=null) {
            seatsVal.push(seatVal.value);
            if (seatVal.val!="none") {
                notNoneValue+=1;
            }
        }
    }
    var uniqueSeatsVal = new Set(seatsVal);
    var seatValNoNone = seatsVal.filter ((item)=>item!="none");
    uniqueSeatValNoNone = new Set(seatValNoNone);
    if (uniqueSeatsVal.size == notNoneValue) {
        seatWarning.style.display = 'none';
    }
    else {
        seatWarning.style.display = 'block';
        console.log(uniqueSeatsVal.size,notNoneValue, seatsVal, uniqueSeatsVal);
    }
    if (uniqueSeatValNoNone.size == parseInt(qty)) {
        submitWarning.style.display = "none";
    }
}
function validateForm () {
    if (uniqueSeatValNoNone.size != parseInt(qty)) {
        submitWarning.style.display = "inline";
        return false;
    }
    else {
        submitWarning.style.display = "none";
        return true;
    }
}
function init () {
    if (document && document.getElementById) {
        var seatSelectionForm = document.getElementById('seatSelectionForm');
        seats.forEach((item)=> {
            item.addEventListener('change', function() {
                validateSeat();
            })
        })
        seatSelectionForm.onsubmit = validateForm;
    }
}
window.onload = init;