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
					<a href="/"><h1 class="title float-left">Mozilla Task Management System</h1></a>
					<div class="profile float-right">
						<div class="picture float-left">
							<img src="assets/images/profile.svg" alt="profile-picture" />
						</div>
						<div class="name foat-right">
							<span class="name-dropdown-button"><?php echo $userRow['userName']; ?> (Settings)</span>
							<ul class="name-dropdown">
								<a href="#">
									<li class="dropdown preferences">
										Preferences
									</li>
								</a>
								<a href="logout.php?logout">
									<li class="dropdown logout">
										Logout
									</li>
								</a>
							</ul>
						</div>
						<div class="clear"></div>
					</div>
					<div class="clear"></div>
				</div>
			</header>

		<!-- Main Content -->
			<div id="content-wrapper">
				<div class="content">
					<h2 class="content-title">
						Preferences
					</h2>
					<div class="preference-block">
						<h3 class="preference-title">
							Basic Information
						</h3>
						<h4 class="preference-explanation">
							Change your basic information here
						</h4>
						<div class="preference-fields">
							<div class="preference-form-content form-name">
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
						</div>
					</div>
					<div class="preference-block">
						<h3 class="preference-title">
							Experience
						</h3>
						<h4 class="preference-explanation">
							Tell us what you already know!
						</h4>
						<div class="preference-fields">
							<div class="preference-form-content form-name">
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
						</div>
					</div>
					<div class="preference-block">
						<h3 class="preference-title">
							Interests
						</h3>
						<h4 class="preference-explanation">
							Tell us what you would prefer!
						</h4>
						<div class="preference-fields">
							<div class="preference-form-content form-name">
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
						</div>
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