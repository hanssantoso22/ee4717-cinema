<!DOCTYPE html>
<html>
   <head>
       <title>
           Cine 23 - Cinema Info
       </title>
       <link rel="stylesheet" href="../css/main.css">
       <link rel="stylesheet" href="cinemas_location.css">
   </head>
   <body>
       <div id="main-header">
           <div class="row">
               <div class="col-2"><a href="../index.php" ><img class="cinema-name" src="../assets/common/logo2.png"></a></div>
               <div class="col-2"><a class="tab" href="../index.php">MOVIES</a></div>
               <div class="col-2"><a class="tab active" href="cinemas.php">CINEMAS</a></div>
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
					include '../constants.php';
                    $cinema_id = $_GET['cinema_id'];
					$query = "SELECT * FROM `cinemas` WHERE `id`=$cinema_id";
                    $cinema = $db->query($query);
                    $row = $cinema->fetch_assoc();
					ini_set('display_errors', 1);
					ini_set('display_startup_errors', 1);
					error_reporting(E_ALL);
				?>
                <div>
                    <?php echo '<p class="page-title">'.$row['cinema_name'].'</p>' ?>
                </div>
				<div class="row">
					<div class="col-3">
						<div id="cin-pic">
							<?php
                            echo '<img src="..'.$row['picture'].'" style="width:auto;" width="400" height="400">';
							?>
						</div>
					</div>
					<div id="cin-txt">
						<?php echo '<p>'.$row['description'].'</p>' ;?>
					</div>
				</div>
				<div class="row">
				</div>
            </div>
			<div class="row">
				<table>
					<?php
					$day=array($today, date('Y-m-d',strtotime("+1 day", strtotime($today))), date('Y-m-d',strtotime("+2 day", strtotime($today))), date('Y-m-d',strtotime("+3 day", strtotime($today))), date('Y-m-d',strtotime("+4 day", strtotime($today))), date('Y-m-d',strtotime("+5 day", strtotime($today))), date('Y-m-d',strtotime("+6 day", strtotime($today))));
					?>
					<tr>
						<th><p>Movies</p></th>
						<?php
						for ($x=0;$x<7;$x++){
							echo'<th>'.date('d M',strtotime($day[$x])).'</th>';										
						}
						?>
					</tr>
					<?php
					$query = "SELECT id, movie_id, CAST(timing AS DATE) date, timing AS time_movie FROM movsessions WHERE `cinema_id`=$cinema_id ORDER BY `movie_id` ASC, `timing` ASC";
					$movie_sess = $db->query($query);					
					$query2= "SELECT id, movie_name FROM movies ORDER BY 'id' ASC";
					$movie_name = $db->query($query2);
					$movie_row=0;
					$row = $movie_sess->fetch_assoc();
					while ($row2 = $movie_name->fetch_assoc()){
						$movie_row=$row2['id'];
						if ($movie_row==$row['movie_id']){
							echo '<tr>
								  <td>'.$row2['movie_name'].'</td>';
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
       <div id="main-footer">
           <p>&#169; Max Vision 2020</p>
       </div>
       <script src="../js/header.js"></script>
   </body> 
</html>