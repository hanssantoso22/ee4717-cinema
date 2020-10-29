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
                                <p class="grey-7 description" >'.$row['description'].'</p>
                            '
                        ?>
                        <br>
                        <p class="grey-5" >Buy ticket(s): </p>
                        <form action="movie_seat_selection.php" method="GET">
<<<<<<< Updated upstream
                            <?php //to pass movie_id to the next page via GET method
                                echo '
                                    <input name="movie_id" value="'.$movie_id.'" style="display: none;">
                                ';
                                if ($_GET['edit']!=NULL) {
                                    echo '
                                        <input name="edit" value="'.$_GET['edit'].'" style="display: none;">
                                    ';
=======
                        <?php
                            echo '<p class="grey-5" style="display: inline;">Qty: </p><input type="number" min="1" max="10" name="qty" value="'.$qty.'">&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Select Seats">'
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
                                            echo '<input type="radio" name="movie_session_id" value="'.$row['id'].'">'.date('G:i',strtotime($row['time_movie'])).'</input><br>';
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
>>>>>>> Stashed changes
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
                                            $query = 'select * from movsessions where movie_id='.$movie_id.';';
                                            $movie_sessions = $db->query($query);
                                            
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
			<div class="row">
				<table>
					<?php
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
					while ($row2 = $movie_name->fetch_assoc()){
						$movie_row=$row2['id'];
						if ($movie_row==$row['cinema_id']){
							echo '<tr>
								  <td>'.$row2['cinema_name'].'</td>';
							for ($x=0;$x<7;$x++){
								echo'<td>';										
								while ($day[$x]==$row['date']){	
									echo '<a href="../movies/seat_selection.php?movie_session_id='.$row['id'].'">'.date('G:i',strtotime($row['time_movie'])).'</a><br>';
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
			</div>
           </div>
       </div>
       <div id="main-footer">
           <p>&#169; Max Vision 2020</p>
       </div>
       <script src="../js/header.js"></script>
   </body> 
</html>
