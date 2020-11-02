<!DOCTYPE html>
<html>
   <head>
       <title>
           Max Vision - Booking Cart
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
                    {	
                        echo'<div class="col-3 login-container"><a href="../login/logout.php"><span class="username">'.$_SESSION["fname"].'</span><span class="logout">exit_to_app</span></a></div>
                            '
                        ;
                    }
                    else
                    {	
                        echo'<div class="col-3 login-container"><a class="login" href="../login/login.php">account_circle</a></div>
                            '
                        ;
                    }
                ?>
                <div class="col-1 cart-container"><a class="cart" href="./booking_cart/booking_cart.php">shopping_cart</a></div>
           </div>
       </div>
       <div id="main-body">
            <div id="content-box">
                <div>
                    <p class="page-title">Bookings</p>
                    <?php
                        include '../config.php';
                        $id = $_SESSION["SESS_MEMBER_ID"];
                        $query = "select * from orders where user_id='".$id."';";
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