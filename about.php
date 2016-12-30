<?php
include('system.php');
     
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
					<h1 class="title float-left">Mozilla Task Management System</h1>
					<div class="profile float-right">
						<div class="picture float-left">
							<img src="assets/images/profile.svg" alt="profile-picture" />
						</div>
						<div class="name foat-right">
							<span class="name-dropdown-button"><?php echo $userRow['userName']; ?> (Settings)</span>
							<ul class="name-dropdown">
								<a href="#">
									<li class="dropdown preferences">
										About
									</li>
								</a>
								<a href="preferences.php">
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
				<div class="filters">
				</div>
				
				<div class="content">
					<h2 class="content-title">
						Tasks you have accepted:
					</h2>
					
<?php	if ($accepted->num_rows > 0) {
	
    // output data of each row
    while($row = $accepted->fetch_assoc()) {
	if($row['keywords']!=""){
		$keywords_arr = explode(',',$row['keywords']);
	}


	?>
					<div class="task">
						<h3 class="title">
							<?php echo $row['name'] ?>
						</h3>
						
						<p class="description">
							<?php echo $row['description'] ?>
						</p>
						
						<span class="keywords">
						<?php foreach($keywords_arr as $key) { ?>
							<span class="keyword">
								<?php echo $key ?>
							</span>

						<?php } ?>
						</span>
						
						<span class="points">
							You will gain: <span class="number-points"><?php echo $row['point'] ?> points!</span>
						</span>
						<div class="clear"></div>
						
						<div class="task-buttons"><span class="keyword">
							<a href="/about.php?para=complete&id=<?php echo $row['id'] ?>" class="completed-button" name="Completed">I have finished the task!</a>
							</span>
							<span class="keyword">
							<a href="/about.php?para=cancel&id=<?php echo $row['id'] ?>" class="cancel-button" name="Cancel">Unfortunately, I have to cancel this task</a>
							</span>
						</div>
					</div>
<?php }}else{
	echo 'You have not accpeted any task Yet';
} ?>

					
					<div class="completed-tasks">
						<h2 class="content-title">
							Tasks you have completed (total points: [number]):
						</h2>
						
<?php	if ($completed->num_rows > 0) {
	
    // output data of each row
    while($row = $completed->fetch_assoc()) {
	if($row['keywords']!=""){
		$keywords_arr = explode(',',$row['keywords']);
	}


	?>
					<div class="task">
						<h3 class="title">
							<?php echo $row['name'] ?>
						</h3>
						
						<p class="description">
							<?php echo $row['description'] ?>
						</p>
						
						<span class="keywords">
						<?php foreach($keywords_arr as $key) { ?>
							<span class="keyword">
								<?php echo $key ?>
							</span>

						<?php } ?>
						</span>
						
						<span class="points">
							You will gained: <span class="number-points"><?php echo $row['point'] ?> points!</span>
						</span>
						<div class="clear"></div>
						

					</div>
<?php }}else{
	echo 'You have not completed any task Yet';
} ?>

					</div>
						<span class="points">
							Total gained: <span class="number-points"><?php $row = $total->fetch_assoc();echo ($row['total']); ?> points!</span>
						</span>
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