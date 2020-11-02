<!DOCTYPE html>
<html>
   <head>
       <title>
           Cine 23 - Cinema
       </title>
       <link rel="stylesheet" href="../css/main.css">
       <link rel="stylesheet" href="cinemas.css">
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
                <div class="col-1 cart-container"><a class="cart" href="./booking_cart/booking_cart.php">shopping_cart</a></div>
           </div>
       </div>
       <div id="main-body">
            <div id="content-box">
                <div>
                    <p class="page-title">Cinemas</p>
                </div>
				<div class="row">
					<div class="col-3">
						<div id="cin-pic">
						<img src="downtown-theatre.png" alt="Downtown Theatre" style="width:auto;" width="200" height="200" usemap="#dwt">
						<map name="dwt">
							<area shape="rect" coords="0,0,200,200" href="cinema_page.php?cinema_id=2" alt="Link">
						</map>
						</div>
						<div style="height:50px;">
						</div>
					</div>
					<div class="col-3">
						<h3>Downtown</h3>
						<p class="cin-text">12 Alme Street<br>
											New Carolina NC 27665-8868<br>
											NSA<br>
											Tel:189-777-236</p>
					</div>
					<div class="col-3">
						<div id="cin-pic">
						<img src="marina-theatre.jpg" alt="Marina Theatre" style="width:auto;" width="200" height="200" usemap="#mar">
						<map name="mar">
							<area shape="rect" coords="0,0,200,200" href="cinema_page.php?cinema_id=1" alt="Link">
						</map>
						</div>
						<div style="height:50px;">
						</div>
					</div>
					<div class="col-3">
						<h3>Marina</h3>
						<p class="cin-text">20 Fifth Marina Avenue<br>
											Termasek 978054<br>
											Tel:9984 3636</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<div id="cin-pic">
						<img src="royal-theatre.jpg" alt="Royal Theatre" style="width:auto;" width="200" height="200" usemap="#roy">
						<map name="roy">
							<area shape="rect" coords="0,0,200,200" href="cinema_page.php?cinema_id=3" alt="Link">
						</map>
						</div>
						<div style="height:50px;">
						</div>
					</div>
					<div class="col-3">
						<h3>Royal</h3>
						<p class="cin-text">2-7-6 Nakacho, Nishi-ku<br>
											Umeruzawa 273-8888<br>
											Tel:03-1194-8471</p>
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