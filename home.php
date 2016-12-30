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
								<a href="about.php">
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
						We found some tasks for you:
					</h2>
	
	
<?php

$cols = array();	
$cols['code'] = 'code';
$cols['speaking'] = 'speaking';
$cols['leadership'] = 'leadership';
$cols['teaching_child'] ='teaching_child';
$cols['translating'] = 'translating';
$cols['organize'] = 'organize';
$cols['testing']= 'testing';
$cols['talk'] = 'talk';
$cols['teach'] = 'teach';
$cols['support'] = 'support';
//$cols['org'] = 'org';
$rslt = array();

if ($result->num_rows > 0) {
	
    // output data of each row
    while($row = $result->fetch_assoc()) { 
	


	if($row['keywords']!=""){
		$keywords_arr = explode(',',$row['keywords']);
	}

    foreach ($keywords_arr as $k){
		
		
		if (in_array($k , $programming_languages_arr)){
			
			$rslt[$k] = 1;
			
		}elseif(in_array($k , $languages_arr)){
			
			$rslt[$k] = 1;
			
		}elseif(array_search($k , $cols)!=""){
			
			if($userRow[$k]==1){
				
				$rslt[$k] = 1;
			}
			
			
		}elseif($k=='Mozilla'){
			
			if($userRow['org']==0){
				
				$rslt[$k] = 1;
			}
			   
		}elseif($k=='Open-Source'){
			
			if($userRow['org']==1){
				
				$rslt[$k] = 1;
			}
			
			   
		}elseif($k=='All'){
			
			if($userRow['org']==2){
				
				$rslt[$k] = 1;
			}			
			   
		}

		
	}

	
	
	
	

if(count($rslt) == count($keywords_arr)) {
	


	
	
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
						
						<div class="task-buttons">
							<a href="/home.php?para=accept&id=<?php echo $row['id'] ?>" class="completed-button" name="Completed">Accepts this task</a>
							<button type="button" class="ignore-button" name="Ignore">Ignore this task</button>
						</div>
					</div>
	

		
    <?php }
} }else {
    echo "0 results";
}
$conn->close();

 ?>

					
			
					
					
					
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