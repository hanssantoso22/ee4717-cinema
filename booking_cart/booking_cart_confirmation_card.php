<!DOCTYPE html>
<html>
   <head>
       <title>
           Max Vision - Thank you!
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
            <?php
                include '../config.php';
                session_start();
                $user_id = 1;
                for ($i=0; $i<count($_SESSION['cart']); $i++) {
                    $array = $_SESSION['cart'][$i];
                    // INSERT DATA INTO ORDERS TABLE
                    $selected_seats_str = implode(",",$array['seats']);
                    $insert_query = "insert into orders (user_id,movsession_id,quantity,selected_seats) VALUES (".$user_id.",".$array['movie_session_id'].",".$array['qty'].",'".$selected_seats_str."');";
                    $insert = $db->query($insert_query);
                    // UPDATE OCCUPIED SEAT IN MOVSESSIONS TABLE
                    $movsess_detail_query = "select * FROM movsessions WHERE id=".$array['movie_session_id'].";";
                    $detail_result = $db->query($movsess_detail_query);
                    $row = $detail_result->fetch_assoc();
                    // COMBINE THE EXISTING OCCUPIED SEATS FROM DATABASE WITH THE NEWLY SELECTED SEATS
                    $current_occupied_seats = explode(",",$row['taken_seats']);
                    if ($current_occupied_seats[0]=="") {
                        $updated_occupied_seats_str = $selected_seats_str;
                    }
                    else {
                        $updated_occupied_seats = array_merge($current_occupied_seats,$array['seats']);
                        $updated_occupied_seats_str = implode(",",$updated_occupied_seats);
                    }
                    
                    // UPDATE TABLE
                    $update_query = "update movsessions SET taken_seats='".$updated_occupied_seats_str."' WHERE id=".$array['movie_session_id'].";";
                    $update = $db->query($update_query);

                    unset($_SESSION['cart']);
                    unset($_SESSION['total']);
                }
            ?>
                <div id="content-box">
                    <div id="textbox">
                        <h1>THANK YOU FOR YOUR PURCHASE</h1>
                        <p class="grey-4" style="margin: 50px auto;">A confirmation e-mail will be sent to your email!</p>
                        <button class="primary-btn" style="font-size: 20px;" onclick="window.location.href='../index.php'">Go to Home</button>
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