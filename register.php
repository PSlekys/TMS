<?php
	ob_start();
	session_start();
	if( isset($_SESSION['user'])!="" ){
		header("Location: home.php");
	}
	include_once 'dbconnect.php';

	$error = false;

	if ( isset($_POST['register']) ) {
		
		// clean user inputs to prevent sql injections
		$name = trim($_POST['name']);
		$name = strip_tags($name);
		$name = htmlspecialchars($name);
		
		$email = trim($_POST['email']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);
		
		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);
		
		// basic name validation
		if (empty($name)) {
			$error = true;
			$nameError = "Please enter your full name.";
		} else if (strlen($name) < 3) {
			$error = true;
			$nameError = "Name must have atleat 3 characters.";
		} else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
			$error = true;
			$nameError = "Name must contain alphabets and space.";
		}
		
		//basic email validation
		if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			$error = true;
			$emailError = "Please enter valid email address.";
		} else {
			// check email exist or not
			$query = "SELECT userEmail FROM users WHERE userEmail='$email'";
			$result = mysql_query($query);
			$count = mysql_num_rows($result);
			if($count!=0){
				$error = true;
				$emailError = "Provided Email is already in use.";
			}
		}
		// password validation
		if (empty($pass)){
			$error = true;
			$passError = "Please enter password.";
		} else if(strlen($pass) < 6) {
			$error = true;
			$passError = "Password must have atleast 6 characters.";
		}
		
		// password encrypt using SHA256();
		$password = hash('sha256', $pass);
		
		// if there's no error, continue to signup
		if( !$error ) {
			
			$query = "INSERT INTO users(userName,userEmail,userPass) VALUES('$name','$email','$password')";
			$res = mysql_query($query);
				
			if ($res) {
				$errTyp = "success";
				$errMSG = "Successfully registered, you may login now";
				unset($name);
				unset($email);
				unset($pass);
			} else {
				$errTyp = "danger";
				$errMSG = "Something went wrong, try again later...";	
			}	
				
		}
		
		
	}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Mozilla Task Management System</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>

		<!-- Header -->
			<header id="header-wrapper">
				<div id="header">
					<h1 class="title">Mozilla Task Management System</h1>
					<div class="profile">
						<div class="picture">
							<img src="assets/images/profile.svg" alt="profile-picture" />
						</div>
						<span class="name">Profile Name</span>
						<div class="clear"></div>
					</div>
					<div class="clear"></div>
				</div>
			</header>

		<!-- Main Content -->
			<div id="content-wrapper">
				<div class="content">
					<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
						<h2 class="content-title">Sign Up.</h2>

						<?php
						if ( isset($errMSG) ) {
							
							?>
							<h3 class="content-main-message <?php echo ($errTyp=="success") ? "message-success" : $errTyp; ?>">
							<?php echo $errMSG; ?>
							</h3>
							<?php
						}
						?>

						<div class="form-content form-name">
							<input type="text" name="name" class="form-input" placeholder="Enter Name" maxlength="50" value="<?php echo $name ?>" />
							<span class="form-error"><?php echo $nameError; ?></span>
						</div>
						
						<div class="form-content form-email">						
							<input type="email" name="email" class="form-input" placeholder="Enter Your Email" maxlength="40" value="<?php echo $email ?>" />
							<span class="form-error"><?php echo $emailError; ?></span>
						</div>
						
						<div class="form-content form-password">
							<input type="password" name="pass" class="form-input" placeholder="Enter Password" maxlength="15" />
							<span class="form-error"><?php echo $passError; ?></span>
						</div>
						
						<button type="submit" class="form-button" name="register">Register</button>

						<a href="index.php">Login here.</a>
					</form>
				</div>
			</div>

		<!-- Footer -->
			<footer id="footer">
				<span class="copyright">
					&copy; Mozilla. All rights reserved.
				</span>
			</footer>
	</body>
</html>
<?php ob_end_flush(); ?>