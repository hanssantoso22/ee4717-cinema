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
                <?php
                    include '../config.php';
                    include '../constants.php';
                    session_start();
                    $_SESSION['history'] = $url.$_SERVER['PHP_SELF'];
                    $total = 0.00;
                    function addTotalPrice (&$total_price,$subtotal) {
                        $total_price+=$subtotal;
                    }
                    function subtractTotalPrice (&$total_price,$subtotal) {
                        $total_price-=$subtotal;
                    }
                    if (!isset($_SESSION['cart'])) {
                        $_SESSION['cart'] = array();
                    }
                    
                    /* Here's to make sure $_SESSION['cart'] is only updated when the cart page is accessed from seat selection page (click add to cart button).
                        As such, the $_SESSION['cart'] variable won't be updated if users access cart page from other pages */
                    if (isset($_POST['movie_id'])) {
                        $seats = array();
                        for ($i=0;$i<$_POST['qty'];$i++) { //put all seat inputs into an array
                            $num = $i+1;
                            $name = 'seat'.$num;
                            push_element($seats,$_POST[$name]);
                        }
                        // to check if it's an edit mode
                        if ($_POST['edit']!="") {
                            $_SESSION['cart'][$_POST['edit']] = ['movie_id'=>$_POST['movie_id'],'date'=>$_POST['date'],'time'=>$_POST['time'],'cinema_id'=>$_POST['cinema_id'],'qty'=>$_POST['qty'],'seats'=>$seats];
                        }
                        else {
                            push_element($_SESSION['cart'],['movie_id'=>$_POST['movie_id'],'date'=>$_POST['date'],'time'=>$_POST['time'],'cinema_id'=>$_POST['cinema_id'],'qty'=>$_POST['qty'],'seats'=>$seats]);
                        }
                    }
                    if (count($_SESSION['cart'])>0) {
                        echo '
                            <div class="row">
                                <div class="col-8">
                        ';
                        
                        
                        for ($i=0; $i<count($_SESSION['cart']); $i++) { //iterating thorugh each order item
                            $array = $_SESSION['cart'][$i];
                            $movie_name = $MOVIES[$array['movie_id']];
                            $cinema_name = $CINEMAS[$array['cinema_id']];
                            $datetime = date("d-m-Y",strtotime($array['date'])).' '.$array['time'];
                            $query = 'select * from movsessions where movie_id='.$array['movie_id'].' and cinema_id='.$array['cinema_id'];
                            echo '
                                <div class="row order-card" >
                                    <div class="col-3 movie-poster">
                                        
                                    </div>
                                    <div class="col-6">
                                        <h3>'.$movie_name.'</h3>
                                        <div class="row">
                                            <div class="col-5">
                                                <p class="grey-3" >Date/time: </p>
                                                <p class="grey-5 description" >'.$datetime.'</p>
                                            </div>
                                            <div class="col-2">
                                                <p class="grey-3" >Qty: </p>
                                                <p class="grey-5 description" >'.$array['qty'].'</p>
                                            </div>
                                            <div class="col-3">
                                                <p class="grey-3" >Cinema: </p>
                                                <p class="grey-5 description" >'.$cinema_name.'</p>
                                            </div>
                                            <div class="col-2">
                                                <p class="grey-3" >Subtotal: </p>
                                                <p class="grey-5 description" >'.$array['qty'].'</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1"></div>
                                    <div class="col-1" >
                                        <div class="icon-container material-icon delete-icon">
                                            <a href="delete_item.php?delete='.$i.'">delete</a>
                                        </div> 
                                    </div>
                                    <div class="col-1" >
                                        <div class="icon-container material-icon edit-icon">
                                            <a href="../movies/movie_details.php?edit='.$i.'&movie_id='.$array['movie_id'].'&date='.$array['date'].'&time='.$array['time'].'&cinema='.$cinema_name.'&qty='.$array['qty'].'">edit</a>
                                        </div> 
                                    </div>
                                </div>
                            ';
                        }
                        echo'
                            </div>
                                <div class="col-4">
                                    <div id="payment-summary-card">
                                        <h2>Payment</h2>
                                        <form action="booking_cart_confirmation_card.php" method="POST">
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
                                                        <input type="radio" name="payment" value="Credit Card" ><span class="blue-7"> Credit Card</span>
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
                                        </form>
                                    </div>
                                    
                                </div>
            
                            </div>
                        
                        ';
                    }
                    else {
                        echo '
                            <h3 class="grey-4"><em>Booking cart is empty!</em></h3>
                        ';
                    }
                    
                ?>
            <!-- closing tag for content-box -->
                <a href="empty_cart.php">Empty Cart</a>
            </div>               
       </div>
       <div id="main-footer">
           <p>&#169; Max Vision 2020</p>
       </div>
       <script src="../js/header.js"></script>
       <script src="booking_cart.js"></script>
   </body> 
</html>