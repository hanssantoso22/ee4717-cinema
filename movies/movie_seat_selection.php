<!DOCTYPE html>
<html>
   <head>
       <title>
           Max Vision - Home
       </title>
       <link rel="stylesheet" href="../css/main.css">
       <link rel="stylesheet" href="movie_details.css">
   </head>
   <body>
       <div id="main-header">
           <div class="row">
               <div class="col-2"><a href="../index.php" ><img class="cinema-name" src="../assets/common/logo2.png"></a></div>
               <div class="col-2"><a class="tab active" href="../index.php">MOVIES</a></div>
               <div class="col-2"><a class="tab" href="../cinemas/cinemas.php">CINEMAS</a></div>
               <div class="col-2"><a class="tab" href="../bookings/bookings.php">BOOKINGS</a></div>
               <div class="col-2"></div>
               <div class="col-2"><a class="cart" href="../booking_cart/booking_cart.php">shopping_cart</a></div>
           </div>
       </div>
       <div id="main-body">
           <div id="content-box">
                <?php
                    session_start();
                    include '../config.php';
                    $movie_session_id = $_GET['movie_session_id'];
                    $movie_details_query = 'SELECT * FROM movsessions WHERE id='.$movie_session_id.';';
                    $results = $db->query($movie_details_query);
                    $detail = $results->fetch_assoc();
                    $movie_id = $detail['movie_id'];
                    $date = explode(' ',$detail['timing'])[0];
                    $timing = explode(' ',$detail['timing'])[1];
                    $cinema_id = $detail['cinema_id'];
                    $qty = $_GET['qty'];
                    $query = 'select * from movies where id='.$movie_id.';';
                    $movie_details = $db->query($query);
                    $row = $movie_details->fetch_assoc();
                    //going back to date selection page and keeping all of the data via GET method
                    if ($_GET['edit']) {
                        echo '
                            <a href="movie_details.php?edit='.$_GET['edit'].'&movie_id='.$movie_id.'&date='.$date.'&time='.$timing.'&cinema='.$cinema.'&qty='.$qty.'">< Back to date selection</a><br><br>
                        ';
                    }
                    else {
                        echo '
                            <a href="movie_details.php?movie_id='.$movie_id.'&date='.$date.'&time='.$timing.'&cinema='.$cinema.'&qty='.$qty.'">< Back to date selection</a><br><br>
                        ';
                    }
                    
                    echo '
                        <p class="page-title">'.$row['movie_name'].'</p>
                    '
                ?>
                <div class="row">
                    <div class="col-3">
                        <?php
                            echo '
                                <img class="poster" src="..'.$row['picture_url'].'">
                            '
                        ?>
                    </div>
                    <div class="col-6" style="padding-left: 20px;">
                        <p class="blue-7 font-24">Seat Selection</p>
                        <div class="row">
                            <?php
                                include '../constants.php';
                                $cinema = $CINEMAS[$cinema_id];
                                echo '
                                    <div class="col-4">
                                        <p class="grey-5" >Date: </p>
                                        <p class="grey-7 description" >'.date("d-m-Y",strtotime($date)).'</p>
                                    </div>
                                    <div class="col-4">
                                        <p class="grey-5" >Time: </p>
                                        <p class="grey-7 description" >'.$timing.'</p>
                                    </div>
                                    <div class="col-4">
                                        <p class="grey-5" >Cinema: </p>
                                        <p class="grey-7 description" >'.$cinema.'</p>
                                    </div>
                                '
                            ?>
                        </div>
                        
                        <br>
                        <p class="grey-5" >Seat(s): </p>
                        <img class="seat-plan">
                        <form action="../booking_cart/booking_cart.php" method="POST">
                            <div class="row">
                                <?php
                                    // RETRIEVE TAKEN SEATS FROM DATABASE
                                    $movsess_detail_query = "select * FROM movsessions WHERE id=".$movie_session_id.";";
                                    $detail_result = $db->query($movsess_detail_query);
                                    $row = $detail_result->fetch_assoc();
                                    $occupied_seats = explode(",",$row['taken_seats']);
                                    //passing all input data from the previous page (date selection) to the next page (booking cart) via POST method
                                    echo '
                                        <input type="text" name="movie_id" class="hidden-input" value="'.$movie_id.'">
                                        <input type="text" name="movie_session_id" class="hidden-input" value="'.$movie_session_id.'">
                                        <input type="text" name="date" class="hidden-input" value="'.$date.'">
                                        <input type="text" name="time" class="hidden-input" value="'.$timing.'">
                                        <input type="text" name="cinema_id" class="hidden-input" value="'.$cinema_id.'">
                                        <input type="text" name="qty" class="hidden-input" value="'.$qty.'">
                                    ';
                                    if ($_GET['edit']!=NULL) {
                                        echo '<input type="text" name="edit" class="hidden-input" value="'.$_GET['edit'].'">';
                                    }
                                    for ($i=0;$i<$qty;$i++) { //creating seat dropdown boxes according to qty number
                                        $num=$i+1;
                                        echo '
                                            <div class="col-2">
                                            <p class="grey-5">Seat '.$num.'</p>
                                        ';
                                        echo '
                                            <select name="seat'.$num.'" id="seat'.$num.'">
                                        ';
                                        foreach ($SEATS as $item) {
                                            if (in_array($item,$occupied_seats)) {
                                                echo '
                                                    <option value="'.$item.'" disabled>'.$item.'</option>
                                                ';
                                            }
                                            else {
                                                echo '
                                                    <option value="'.$item.'">'.$item.'</option>
                                                ';
                                            }
                                        }
                                        echo '</select></div>'; 
                                    }
                                ?>
                            </div>
                            <br><br>
                            <input type="submit" value="PROCEED">
                        </form>
                    </div>
                </div>
           </div>
       </div>
       <div id="main-footer">
           <p>&#169; Max Vision 2020</p>
       </div>
       <script src="../js/header.js"></script>
   </body> 
</html>
