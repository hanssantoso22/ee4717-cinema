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
                <a href="../index.php">< Back to home</a><br><br>
                <?php
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
                    <div class="col-6" style="padding-left: 40px;">
                        <?php
                            echo '
                                <p class="grey-5" >Genre:</p><p class="grey-7 description" >'.$row['genre'].'</p><br>
                                <p class="grey-5" >Description: </p>
                                <p class="grey-7 description" >'.$row['description'].'</p>
                            '
                        ?>
                        <br>
                        <p class="grey-5" >Buy ticket(s) </p>
                        <form action="movie_seat_selection.php" method="GET">
                        <?php
                            echo '<p class="grey-5" style="display: inline;">Qty: </p><input type="number" min="1" max="10" name="qty" required value="'.$qty.'">&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Select Seats">'
                        ?>
                        <p class="grey-5">Choose schedule: </p>
                        <table>
                            <?php
                            include '../constants.php';
                            $day=array($today, date('Y-m-d',strtotime("+1 day", strtotime($today))), date('Y-m-d',strtotime("+2 day", strtotime($today))), date('Y-m-d',strtotime("+3 day", strtotime($today))), date('Y-m-d',strtotime("+4 day", strtotime($today))), date('Y-m-d',strtotime("+5 day", strtotime($today))), date('Y-m-d',strtotime("+6 day", strtotime($today))));
                            ?>
                            <tr>
                                <th><p>Cinemas</p></th>
                                <?php
                                for ($x=0;$x<7;$x++){
                                    echo'<th>'.date('d M',strtotime($day[$x])).'</th>';										
                                }
                                ?>
                            </tr>
                            <?php
                            $query = "SELECT id, cinema_id, CAST(timing AS DATE) date, timing AS time_movie FROM movsessions WHERE `movie_id`=$movie_id ORDER BY `cinema_id` ASC, `timing` ASC";
                            $movie_sess = $db->query($query);					
                            $query2= "SELECT id, cinema_name FROM cinemas ORDER BY 'id' ASC";
                            $movie_name = $db->query($query2);
                            $movie_row=0;
                            $row = $movie_sess->fetch_assoc();
                            if ($_GET['edit']!=NULL) {
                                echo '
                                    <input type="text" name="edit" class="hidden-input" value="'.$_GET['edit'].'">
                                ';
                            }
                            while ($row2 = $movie_name->fetch_assoc()){
                                $movie_row=$row2['id'];
								while (!in_array($row['date'],$day )){
									$row = $movie_sess->fetch_assoc();	
								}
                                if ($movie_row==$row['cinema_id']){
                                    echo '<tr>
                                        <td>'.$row2['cinema_name'].'</td>';
                                    for ($x=0;$x<7;$x++){
                                        echo'<td>';										
                                        while ($day[$x]==$row['date']){	
											if(date('G:i')<date('G:i',strtotime($row['time_movie']))){
												echo '<input type="radio" required name="movie_session_id" value="'.$row['id'].'">'.date('G:i',strtotime($row['time_movie'])).'</input><br>';
                                            }
											global $row;
                                            $row = $movie_sess->fetch_assoc();							
                                        }									
                                        echo'</td>';
                                    }
                                    echo '</tr>';
                                    while (!in_array($row['date'],$day)){
                                        if (!$row = $movie_sess->fetch_assoc())
                                            break;
                                    }
                                }
                            }
                            ?>
                        </table>
                        </form>
                    </div>
                </div>
			<div class="row">
				
			</div>
           </div>
       </div>
       <div id="main-footer">
           <p>&#169; Max Vision 2020</p>
       </div>
       <script src="../js/header.js"></script>
   </body> 
</html>
