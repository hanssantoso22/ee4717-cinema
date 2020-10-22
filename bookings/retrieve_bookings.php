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
               <div class="col-2"></div>
               <div class="col-2"><a class="cart" href="../booking_cart/booking_cart.php">shopping_cart</a></div>
           </div>
       </div>
       <div id="main-body">
            <div id="content-box">
                <div>
                    <p class="page-title">Bookings</p>
                    <?php
                        include '../config.php';
                        $email = $_GET('email');
                        $query = "select * from orders where email='".$email."';";
                        $bookings = $db->query($query);
                        $no_records = $booking->num_rows();
                        if (!$bookings) {
                            echo '<p class="grey-4"><em>No bookings found!</em></p>';
                        }
                        else {
                            echo '<table>';
                            echo '<tr><th>Movie Name</th><th>Show date/time</th><th>Cinema</th><th>Qty</th></tr>';
                            for ($i=0; $i<$no_records; $i++) {
                                $rows = $bookings->fetch_assoc();
                                echo '<tr><td>'.$rows['movie_name'].'</td><td>'.$rows['show_time'].'</td><td>'.$rows['cinema'].'</td><td>'.$rows['qty'].'</td></tr>';
                            }

                        }
                    ?>
                </div>
            </div>
       </div>
       <div id="main-footer">
           <p>&#169; Max Vision 2020</p>
       </div>
       <script src="../js/header.js"></script>
   </body> 
</html>