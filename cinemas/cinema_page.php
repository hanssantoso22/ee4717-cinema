<!DOCTYPE html>
<html>
   <head>
       <title>
           Max Vision - Cinema Info
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
                <div class="col-1 cart-container"><a class="cart" href="../booking_cart/booking_cart.php">shopping_cart</a></div>
           </div>
       </div>
       <div id="main-body">
            <div id="content-box">
				<a href="cinemas.php">< Back to Cinemas</a><br><br>
				<?php
                    include '../config.php';
					include '../constants.php';
                    $cinema_id = $_GET['cinema_id'];
					$query = "SELECT * FROM `cinemas` WHERE `id`=$cinema_id";
                    $cinema = $db->query($query);
                    $row = $cinema->fetch_assoc();
					$qty =1;
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
                            echo '<img src="..'.$row['picture'].'" style="width:100%; margin-top:20px;" >';
							?>
						</div>
					</div>
					<div class="col-8" style="padding-left:40px">
						<p class="grey-5" >Information: </p>
						<div class="row">
							<div class="col-10">
								<p class="grey-7 description"><?php echo $row['description'];?></p>
							</div>
						</div>
						<p class="grey-5" >Buy ticket(s) </p>
						<form action="../movies/movie_seat_selection.php" method="GET">
						<?php
							echo '<p class="grey-5" style="display: inline;">Qty: </p><input type="number" min="1" max="10" name="qty" value="'.$qty.'">&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Select Seats">'
						?>
						<p class="grey-5">Choose schedule: </p>
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
								while (!in_array($row['date'],$day )){
									$row = $movie_sess->fetch_assoc();	
								}
								if ($movie_row==$row['movie_id'] && in_array($row['date'],$day)){
									echo '<tr>
											<td>'.$row2['movie_name'].'</td>';
									for ($x=0;$x<7;$x++){
										echo'<td>';										
										while ($day[$x]==$row['date']){	
											if($day[0]==$row['date']&&date('G:i')>date('G:i',strtotime($row['time_movie']))){
											}
											else{
												echo '<input type="radio" name="movie_session_id" value="'.$row['id'].'">'.date('G:i',strtotime($row['time_movie'])).'</input><br>';
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