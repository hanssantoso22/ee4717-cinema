<!DOCTYPE html>
<html>
   <head>
       <title>
           Cine 23 - Home
       </title>
       <link rel="stylesheet" href="../css/main.css">
       <link rel="stylesheet" href="movie_details.css">
   </head>
   <body>
       <div id="main-header">
           <div class="row">
               <div class="col-2"><a href="index.php" ><img class="cinema-name" src="../assets/common/logo2.png"></a></div>
               <div class="col-2"><a class="tab active" href="../index.php">MOVIES</a></div>
               <div class="col-2"><a class="tab" href="../cinemas/cinemas.php">CINEMAS</a></div>
               <div class="col-2"><a class="tab" href="../bookings/bookings.php">BOOKINGS</a></div>
               <div class="col-2"></div>
               <div class="col-2"><a class="cart" href="../booking_cart/booking_cart.php">shopping_cart</a></div>
           </div>
       </div>
       <div id="main-body">
           <div id="content-box">
                <a href="../index.php">< Back to home</a><br><br>
                <?php
                    session_start();
                    include '../config.php';
                    $movie_id = $_GET['movie_id'];
                    $date = $_GET['date'];
                    $timing = $_GET['time'];
                    $cinema = $_GET['cinema'];
                    $qty = $_GET['qty'];
                    $query = 'select * from movies where id='.$movie_id.';';
                    $movie_details = $db->query($query);
                    $row = $movie_details->fetch_assoc();
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
                    <div class="col-6">
                        <?php
                            echo '
                                <p class="grey-5" >Genre:</p><p class="grey-7 description" >'.$row['genre'].'</p><br>
                                <p class="grey-5" >Description: </p>
                                <p class="grey-7 description" >Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'.$row['description'].'</p>
                            '
                        ?>
                        <br>
                        <p class="grey-5" >Buy ticket(s): </p>
                        <form action="movie_seat_selection.php" method="GET">
                            <?php //to pass movie_id to the next page via GET method
                                echo '
                                    <input name="movie_id" value="'.$movie_id.'" style="display: none;">
                                ';
                                if ($_GET['edit']!=NULL) {
                                    echo '
                                        <input name="edit" value="'.$_GET['edit'].'" style="display: none;">
                                    ';
                                }
                            ?>
                            <div class="row">
                                <div class="col-3 input-item">
                                    <?php
                                        echo '
                                            <input name="date" type="date" value="'.$date.'">
                                        '
                                    ?>
                                </div>
                                <div class="col-3 input-item">
                                    <select name="time">
                                        <?php
                                            $timings = ["12:00","15:00","16:00"];
                                            foreach ($timings as $item) { //create dropdown options from an array
                                                if ($item==$time) {
                                                    echo '<option selected value="'.$item.'">'.$item.'</option>';
                                                }
                                                else {
                                                    echo '<option value="'.$item.'">'.$item.'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-3 input-item">
                                    <select name="cinema_id">
                                        <?php
                                            include '../constants.php';
                                            foreach ($CINEMAS as $key=>$item) { //create dropdown options from an array
                                                if ($item==$cinema) {
                                                    echo '<option selected value="'.$key.'">'.$item.'</option>';
                                                }
                                                else {
                                                    echo '<option value="'.$key.'">'.$item.'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-3 input-item">
                                    <?php
                                        echo '
                                            <input name="qty" type="number" min="1" max="10" value="'.$qty.'">
                                        '
                                    ?>
                                </div>
                            </div>
                            <br>
                            <input type="submit" value="Seat Selection">
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
