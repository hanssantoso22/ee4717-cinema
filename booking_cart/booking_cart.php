<!DOCTYPE html>
<html>
   <head>
       <title>
           Cine 23 - Booking Cart
       </title>
       <link rel="stylesheet" href="../css/main.css">
       <link rel="stylesheet" href="booking_cart.css">
   </head>
   <body>
       <div id="main-header">
           <div class="row">
               <div class="col-2"><a href="../index.php" ><img class="cinema-name" src="../assets/common/logo2.png"></a></div>
               <div class="col-2"><a class="tab" href="../index.php">MOVIES</a></div>
               <div class="col-2"><a class="tab" href="../cinemas/cinemas.php">CINEMAS</a></div>
               <div class="col-2"><a class="tab" href="../bookings/bookings.php">BOOKINGS</a></div>
               <div class="col-2"></div>
               <div class="col-2"><a class="cart" href="booking_cart.php">shopping_cart</a></div>
           </div>
       </div>
       <div id="main-body">
            <div id="content-box">
                <div>
                    <p class="page-title">Tickets</p>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="row">
                            
                        </div>
                    </div>
                    <div class="col-4">
                        <div id="payment-summary-card">
                            <h2>Payment</h2>
                            <table class="font-16 grey-5" style="width: 100%;">
                                <tr>
                                    <td>TOTAL</td>
                                    <td class="right bold blue-7 font-24">$30.00</td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        NAME <br><br>
                                        <input type="text" placeholder="Full Name" name="fname" style="width: 95%;">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        PAYMENT METHOD<br><br>
                                        <input type="radio" name="payment" value="On Site"><span class="blue-7"> On Site</span><br><br>
                                        <input type="radio" name="payment" value="Credit Card"><span class="blue-7"> Credit Card</span>
                                    </td>
                                </tr>                           
                            </table>
                            <div id="credit-card" style="visibility: hidden;">
                                <table class="font-16 grey-5" style="width: 100%;">
                                    <tr>
                                        <td colspan="2">
                                            Name on card <br><br>
                                            <input type="text" placeholder="Name" name="cardname" style="width: 95%;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            Card number <br><br>
                                            <input type="text" placeholder="XXXX-XXXX-XXXX-XXXX" name="cardnumber" style="width: 95%;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Expiry date <br><br>
                                            <input type="date" name="expirydate">
                                        </td>
                                        <td >
                                            CVV <br><br>
                                            <input type="password" name="cvv" style="width: 40px;">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <input type="submit" value="CHECK OUT" style="height:50px; font-size: 20px; width: 100%">
                        </div>
                        
                    </div>

                </div>
            </div>
       </div>
       <div id="main-footer">
           <p>&#169; Max Vision 2020</p>
       </div>
       <script src="../js/header.js"></script>
       <script src="booking_cart.js"></script>
   </body> 
</html>