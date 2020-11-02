<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION['SESS_MEMBER_ID']) && $_SESSION['SESS_MEMBER_ID'] === true){
    header("location: ../index.php");
    exit;
}
 
// Include config file
require_once "../config.php";
 
// Define variables and initialize with empty values
<<<<<<< Updated upstream
$username = $password = "";
=======
$username = $password = $id = $fname = $email = "";
>>>>>>> Stashed changes
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
<<<<<<< Updated upstream
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
=======
        $sql = "SELECT id, username, password, fname, email FROM users WHERE username = ?";
>>>>>>> Stashed changes
        
        if($stmt = $db->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Store result
                $stmt->store_result();
                
                // Check if username exists, if yes then verify password
                if($stmt->num_rows == 1){                    
                    // Bind result variables
<<<<<<< Updated upstream
                    $stmt->bind_result($id, $username, $hashed_password);
=======
                    $stmt->bind_result($id, $username, $hashed_password, $fname, $email);
>>>>>>> Stashed changes
                    if($stmt->fetch()){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["SESS_MEMBER_ID"] = $id;
<<<<<<< Updated upstream
                            $_SESSION["username"] = $username;                            
=======
                            $_SESSION["username"] = $username; 
							$_SESSION["fname"] = $fname;
							$_SESSION["email"] = $email;
>>>>>>> Stashed changes
                            
                            // Redirect user to welcome page
                            header("location: ../index.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Close connection
    $db->close();
}
?>
<!DOCTYPE html>
<html>
   <head>
       <title>
           Max Vision - Home
       </title>
       <link rel="stylesheet" href="../css/main.css">
<<<<<<< Updated upstream
=======
       <link rel="stylesheet" href="login.css">
>>>>>>> Stashed changes
   </head>
   <body>
       <div id="main-header">
           <div class="row">
               <div class="col-2"><a href="../index.php" ><img class="cinema-name" src="../assets/common/logo2.png"></a></div>
               <div class="col-2"><a class="tab" href="../index.php">MOVIES</a></div>
               <div class="col-2"><a class="tab" href="../cinemas/cinemas.php">CINEMAS</a></div>
               <div class="col-2"><a class="tab" href="../bookings/bookings.php">BOOKINGS</a></div>
               <div class="col-2"></div>
               <div class="col-2"><a class="cart" href="../booking_cart/booking_cart.php">shopping_cart</a></div>
           </div>
       </div>
<<<<<<< Updated upstream
       <div id="main-body">
=======
       <div id="main-body"">
>>>>>>> Stashed changes
           <div id="content-box">
				<div class="wrapper">
					<h2>Login</h2>
					<p>Please fill in your credentials to login.</p>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
<<<<<<< Updated upstream
						<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
							<label>Username</label>
							<input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
							<span class="help-block"><?php echo $username_err; ?></span>
						</div>    
						<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
							<label>Password</label>
							<input type="password" name="password" class="form-control">
							<span class="help-block"><?php echo $password_err; ?></span>
=======
                        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                            <div class="row">
                                <div class="col-1">
                                    <label>Username</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
							        <span class="help-block"><?php echo $username_err; ?></span>
                                </div>
                            </div>
						</div>    
                        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                            <div class="row">
                                <div class="col-1">
                                    <label>Password</label>
                                </div>
                                <div class="col-8">
                                    <input type="password" name="password" class="form-control">
							        <span class="help-block"><?php echo $password_err; ?></span>
                                </div>
                            </div>
>>>>>>> Stashed changes
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-primary" value="Login">
						</div>
						<p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
					</form>
				</div>
           </div>
       </div>
       <div id="main-footer">
           <p>&#169; Max Vision 2020</p>
       </div>
       <script src="./js/header.js"></script>
   </body> 
</html>