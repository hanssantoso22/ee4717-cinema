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
					ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
                    session_start();
                    if(isset( $_SESSION['SESS_MEMBER_ID']) && !empty($_SESSION['SESS_MEMBER_ID']))
                    {	
                        echo'<div class="col-3 login-container"><a href="../login/logout.php"><span class="username">'.$_SESSION["fname"].'</span><span class="logout">exit_to_app</span></a></div>
                            '
                        ;
                    }
                    else
                    {	
                        header("location:../login/login.php");
                    }
                ?>
                <div class="col-1 cart-container"><a class="cart" href="./booking_cart/booking_cart.php">shopping_cart</a></div>
           </div>
       </div>
       <div id="main-body">
            <div id="content-box">
                <div class="col-12">
                    <p class="page-title">Bookings</p>
                    <?php
                        include '../config.php';
                        $id = $_SESSION["SESS_MEMBER_ID"];
                        $query = "SELECT `orders`.`id`, `orders`.`quantity`, `orders`.`selected_seats`, `movsessions`.`timing`, `cinemas`.`cinema_name`, `movies`.`movie_name`\n"
								  . "FROM `movsessions`, `orders`, `cinemas`, `movies`\n"
								  . "WHERE ((`orders`.`user_id` =$id) AND (`movies`.`id` =`movsessions`.`movie_id`) AND (`cinemas`.`id` =`movsessions`.`cinema_id`) AND (`movsessions`.`id` =`orders`.`movsession_id`))\n"
								  . "ORDER BY `orders`.`id` ASC";
                        $bookings = $db->query($query);
                        $no_records = $bookings->num_rows;
                        if (!$bookings) {
                            echo '<p class="grey-4"><em>No bookings found!</em></p>';
                        }
                        else {
                            echo '<table>';
                            echo '<tr><th>Movie</th><th>Cinema</th><th>Show date/time</th><th>Seats</th><th>Qty</th></tr>';
                            for ($i=0; $i<$no_records; $i++) {
                                $rows = $bookings->fetch_assoc();
                                echo '<tr><td>'.$rows['movie_name'].'</td><td>'.$rows['cinema_name'].'</td><td>'.$rows['timing'].'</td><td>'.$rows['selected_seats'].'</td><td>'.$rows['quantity'].'</td></tr>';
                            }
							echo '</table>';
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