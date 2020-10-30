<!DOCTYPE html>
<html>
   <head>
       <title>
           Max Vision - Home
       </title>
       <link rel="stylesheet" href="./css/main.css">
       <link rel="stylesheet" href="./css/movies.css">
   </head>
   <body>
       <div id="main-header">
           <div class="row">
               <div class="col-2"><a href="index.php" ><img class="cinema-name" src="assets/common/logo2.png"></a></div>
               <div class="col-2"><a class="tab active" href="index.php">MOVIES</a></div>
               <div class="col-2"><a class="tab" href="./cinemas/cinemas.php">CINEMAS</a></div>
               <div class="col-2"><a class="tab" href="./bookings/bookings.php">BOOKINGS</a></div>
               <div class="col-2"></div>
               <div class="col-2"><a class="cart" href="./booking_cart/booking_cart.php">shopping_cart</a></div>
           </div>
       </div>
       <div id="main-body">
           <div id="content-box">
               <div class="row">
                    <div class="col-2" >
                        <div class="filters" style="padding-top: 50px;">
                            <p class="blue-7 font-20">Filters</p>
                            <form action="./movies/apply_filter.php" method="GET">
                                <p class="grey-4">Genre</p>
                                <?php
                                    include 'config.php';
                                    include 'constants.php';
                                    session_start();
                                    foreach ($GENRE as $item) {
                                        if (in_array($item,explode(",",$_GET['genres']))) {
                                            echo '
                                                <input type="checkbox" name="genre[]" value="'.$item.'" checked> <span class="grey-6">'.$item.'</span><br><br>
                                            ';
                                        }
                                        else {
                                            echo '
                                                <input type="checkbox" name="genre[]" value="'.$item.'"> <span class="grey-6">'.$item.'</span><br><br>
                                            ';
                                        }
                                    }
                                ?>
                                <input type="submit" value="Apply">
                            </form>
                        </div>
                    </div>
                    <div class="col-10">
                    <div>
                        <p class="page-title">Now Playing</p>
                    </div>
                        
                        <div class="row">
                            <?php
                                $_SESSION['history'] = $url.$_SERVER['PHP_SELF'];
                                if (isset($_GET['genres'])) {
                                    $genres = explode(",",$_GET['genres']);
                                    $query = 'select * from movies where ';
                                    function concatenateText (&$text,$new_string) {
                                        $text = $text.$new_string;
                                    }
                                    for ($i=0;$i<count($genres);$i++) {
                                        if ($i==0) {
                                            $additional_filter = "genre1='".$genres[$i]."' or genre2='".$genres[$i]."' or genre3='".$genres[$i]."' or genre4='".$genres[$i]."' or genre5='".$genres[$i]."' ";
                                        }
                                        else {
                                            $additional_filter = "or genre1='".$genres[$i]."' or genre2='".$genres[$i]."' or genre3='".$genres[$i]."' or genre4='".$genres[$i]."' or genre5='".$genres[$i]."' ";
                                        }
                                        concatenateText($query,$additional_filter);
                                    }
                                }
                                else {
                                    $query = "select * from movies";
                                }
                                
                                $movies = $db->query($query);
                                $no_records = $movies->num_rows;
                                for ($i=0; $i<$no_records; $i++) {
                                    $row = $movies->fetch_assoc();
                                    echo '
                                        <div class="col-3">
                                            <div class="movie-card">
                                                <div class="movie-poster">
                                                    <img class="poster" src=".'.$row['picture_url'].'">
                                                </div>
                                                <div class="short-details">
                                                    <p class="font-16 bold center"><a href="./movies/movie_details.php?movie_id='.$row['id'].'">'.$row['movie_name'].'</a></p>
                                                    <p class="movie-description">Genre: '.$row['genre'].'</p>
                                                    <p class="movie-description brief-caption">'.$row['description'].'</p>
                                                </div>
                                            </div>
                                        </div>
                                    ';
                                }
                            ?>
                        </div>
                   </div>
               </div>
               
           </div>
       </div>
       <div id="main-footer">
           <p>&#169; Max Vision 2020</p>
       </div>
       <script src="./js/header.js"></script>
   </body> 
</html>