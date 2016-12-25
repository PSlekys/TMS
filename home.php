<?php
	ob_start();
	session_start();
	require_once 'dbconnect.php';
	
	// if session is not set this will redirect to login page
	if( !isset($_SESSION['user']) ) {
		header("Location: index.php");
		exit;
	}
	// select loggedin users detail
	$res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
	$userRow=mysql_fetch_array($res);
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
						<span class="name"><?php echo $userRow['userName']; ?> (<?php echo $userRow['userEmail']; ?>).</span>
						<a href="logout.php?logout">Logout</a>
						<div class="clear"></div>
					</div>
					<div class="clear"></div>
				</div>
			</header>

		<!-- Main Content -->
			<div id="content-wrapper">
				<div class="filters">
				</div>
				
				<div class="content">
					<h2 class="content-title">
						We found some tasks for you:
					</h2>
					<div class="task">
						<h3 class="title">
							Translation: English to Lithuanian
						</h3>
						
						<p class="description">
							We need someone to translate a wiki page about Mozilla Firefox updates (80 strings) from English to Lithuanian.
						</p>
						
						<span class="keywords">
							<span class="keyword">
								l10n
							</span>
							<span class="keyword">
								English
							</span>
							<span class="keyword">
								Lithuanian
							</span>
						</span>
						
						<span class="points">
							You will gain: <span class="number-points">500 points!</span>
						</span>
						<div class="clear"></div>
					</div>
					
					<div class="task">
						<h3 class="title">
							Translation: English to Lithuanian
						</h3>
						
						<p class="description">
							We need someone to translate a wiki page about Mozilla Firefox updates (80 strings) from English to Lithuanian.
						</p>
						
						<span class="keywords">
							<span class="keyword">
								l10n
							</span>
							<span class="keyword">
								English
							</span>
							<span class="keyword">
								Lithuanian
							</span>
						</span>
						
						<span class="points">
							You will gain: <span class="number-points">500 points!</span>
						</span>
						<div class="clear"></div>
					</div>
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