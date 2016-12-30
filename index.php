<?php
	ob_start();
	session_start();
	require_once 'dbconnect.php';
	
	// it will never let you open index(login) page if session is set
	if ( isset($_SESSION['user'])!="" ) {
		header("Location: home.php");
		exit;
	}
	
	$error = false;
	
	if( isset($_POST['login']) ) {	
		
		// prevent sql injections/ clear user invalid inputs
		$email = trim($_POST['email']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);
		
		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);
		// prevent sql injections / clear user invalid inputs
		
		if(empty($email)){
			$error = true;
			$emailError = "Please enter your email address.";
		} else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			$error = true;
			$emailError = "Please enter valid email address.";
		}
		
		if(empty($pass)){
			$error = true;
			$passError = "Please enter your password.";
		}
		
		// if there's no error, continue to login
		if (!$error) {
			
			$password = hash('sha256', $pass); // password hashing using SHA256
		
			$res=mysql_query("SELECT userId, userName, userPass FROM users WHERE userEmail='$email'");
			$row=mysql_fetch_array($res);
			$count = mysql_num_rows($res); // if uname/pass correct it returns must be 1 row
			
			if( $count == 1 && $row['userPass']==$password ) {
				$_SESSION['user'] = $row['userId'];
				$_SESSION['email'] = $row['userEmail'];
				header("Location: home.php");
			} else {
				$errMSG = "Incorrect Email or Password. Please try again.";
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
					<h1 class="title center">Mozilla Task Management System</h1>
				</div>
			</header>

		<!-- Main Content -->
			<div id="content-wrapper">
				<div class="content">
					<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
						<h2 class="content-title">Login</h2>
						
						<?php
						if ( isset($errMSG) ) {
							
							?>
							<h3 class="content-main-message"><?php echo $errMSG; ?></h3>
							<?php
						}
						?>
						
						<div class="form-content form-email">
							<input type="email" name="email" class="form-input" placeholder="Your Email" value="<?php echo $email; ?>" maxlength="40" />
							<span class="form-error"><?php echo $emailError; ?></span>
						</div>
						
						<div class="form-content form-password">
							<input type="password" name="pass" class="form-input" placeholder="Your Password" maxlength="15" />
							<span class="form-error"><?php echo $passError; ?></span>
						</div>
						
						<button type="submit" class="form-button" name="login">Login</button>
						
						<a href="register.php">Register Here...</a>
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