<?php
// Include config file
require_once "../config.php";
 
// Define variables and initialize with empty values
<<<<<<< Updated upstream
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
=======
$username = $password = $confirm_password = $fname = $email = "";
$username_err = $password_err = $confirm_password_err = $fname_err = $email_err = "";
>>>>>>> Stashed changes
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = $db->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
<<<<<<< Updated upstream
    
=======

    // Validate email
    if(empty(trim($_POST["e_mail"]))){
        $email_err = "Please enter an email.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE email = ?";
        
        if($stmt = $db->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["e_mail"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $email_err = "This email is already taken.";
                } else{
                    $email = trim($_POST["e_mail"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
	
	// Validate fname
    if(empty(trim($_POST["fname"]))){
        $fname_err = "Please enter your name.";     
    } else{
        $fname = trim($_POST["fname"]);
    }
     
>>>>>>> Stashed changes
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
<<<<<<< Updated upstream
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = $db->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ss", $param_username, $param_password);
=======
        $sql = "INSERT INTO users (username, password, email, fname) VALUES (?, ?, ?, ?)";
         
        if($stmt = $db->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssss", $param_username, $param_password, $param_email, $param_fname);
>>>>>>> Stashed changes
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
<<<<<<< Updated upstream
=======
			$param_email = $email;
			$param_fname = $fname;
>>>>>>> Stashed changes
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
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
       <div id="main-body">
           <div id="content-box">
				<div class="wrapper">
					<h2>Sign Up</h2>
					<p>Please fill this form to create an account.</p>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
<<<<<<< Updated upstream
						<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
							<label>Username</label>
							<input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
							<span class="help-block"><?php echo $username_err; ?></span>
						</div>    
						<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
							<label>Password</label>
							<input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
							<span class="help-block"><?php echo $password_err; ?></span>
						</div>
						<div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
							<label>Confirm Password</label>
							<input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
							<span class="help-block"><?php echo $confirm_password_err; ?></span>
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-primary" value="Submit">
							<input type="reset" class="btn btn-default" value="Reset">
=======
                        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <div class="row">
                                <div class="col-1"><label>Email</label></div>
                                <div class="col-8"><input type="email" name="e_mail" class="form-control" value="<?php echo $email; ?>">
							<span class="help-block"><?php echo $email_err; ?></span></div>
                            </div>
							
							
						</div> 
                        <div class="form-group <?php echo (!empty($fname_err)) ? 'has-error' : ''; ?>">
                            <div class="row">
                                <div class="col-1"><label>Full Name</label></div>
                                <div class="col-8"><input type="text" name="fname" class="form-control" value="<?php echo $fname; ?>">
							<span class="help-block"><?php echo $fname_err; ?></span></div>
                            </div>
							
							
						</div> 
                        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                            <div class="row">
                                <div class="col-1"><label>Username</label></div>
                                <div class="col-8"><input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
							<span class="help-block"><?php echo $username_err; ?></span></div>
                            </div>
							
							
						</div>    
                        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                            <div class="row">
                                <div class="col-1"><label>Password</label></div>
                                <div class="col-8"><input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
							<span class="help-block"><?php echo $password_err; ?></span></div>
                            </div>
							
							
						</div>
                        <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                            <div class="row">
                                <div class="col-1"><label>Confirm Password</label></div>
                                <div class="col-8"><input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
							<span class="help-block"><?php echo $confirm_password_err; ?></span></div>
                            </div>
							
							
						</div>
						<div class="form-group">
							<input type="submit" class="btn primary-btn" value="Submit" style="margin-right: 15px;">
							<input type="reset" class="btn secondary-btn" value="Reset">
>>>>>>> Stashed changes
						</div>
						<p>Already have an account? <a href="login.php">Login here</a>.</p>
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