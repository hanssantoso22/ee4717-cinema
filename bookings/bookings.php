<!DOCTYPE html>
<html>
   <head>
       <title>
           Cine 23 - Booking Cart
       </title>
       <link rel="stylesheet" href="../css/main.css">
       <link rel="stylesheet" href="bookings.css">
   </head>
   <body>
       <div id="main-header">
           <div class="row">
               <div class="col-2"><a href="../index.php" ><img class="cinema-name" src="../assets/common/logo2.png"></a></div>
               <div class="col-2"><a class="tab" href="../index.php">MOVIES</a></div>
               <div class="col-2"><a class="tab" href="../cinemas/cinemas.php">CINEMAS</a></div>
               <div class="col-2"><a class="tab active" href="bookings.php">BOOKINGS</a></div>
               <?php
				session_start();
				if(isset( $_SESSION['SESS_MEMBER_ID']) && !empty($_SESSION['SESS_MEMBER_ID']))
				{	echo'<div class="col-2"><a class="tab" href="../login/logout.php">LOGOUT</a></div>
						 ';
				}
				else
				{	echo'<div class="col-2"><a class="tab" href="../login/login.php">LOGIN</a></div>
						 ';
				}?>
               <div class="col-2"><a class="cart" href="../booking_cart/booking_cart.php">shopping_cart</a></div>
           </div>
       </div>
       <div id="main-body">
            <div id="content-box">
                <div>
                    <p class="page-title">Bookings</p>
                    <p class="grey-4"><em>Search your bookings</em></p>
                    <form action="retrieve_bookings.php" method="GET">
                        <input type="email" name="email" style="width: 100%;" placeholder="Enter your email"/>
                        <p><input type="submit" value="Search"></p>
                    </form>
                </div>
            </div>
       </div>
       <div id="main-footer">
           <p>&#169; Max Vision 2020</p>
       </div>
       <script src="../js/header.js"></script>
   </body> 
</html>