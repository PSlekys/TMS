<?php
ob_start();
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
			
<?php

if ($_POST['Save'] == "1") {
    //echo '<pre>';
    include('dbconnect.php');
    unset($_POST['Save']);
    //print_r($_POST);exit;
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $pass  = $_POST['pass'];
    if ($_POST['programming-languages'] != "") {
        $programming_languages = implode(',', $_POST['programming-languages']);
    } else {
        $programming_languages = $_POST['programming-languages'];
    }
    $programming_languages = implode(',', $_POST['programming-languages']);
    $leadership            = $_POST['leadership'];
    $pass                  = $_POST['pass'];
    $speaking              = $_POST['speaking'];
    $teaching_child        = $_POST['teaching'];
    $code                  = $_POST['code'];
    $talk                  = $_POST['talk'];
    $teach                 = $_POST['teach'];
    $translating           = $_POST['translating'];
    $organize              = $_POST['organize'];
    $support               = $_POST['support'];
    $testing               = $_POST['testing'];
    $org                   = $_POST['org'];
    $id                    = $_POST['id'];
    if ($pass == "") {
        $sql = "UPDATE `users` SET `userName`='$name',`userEmail`='$email',`programming_languages`='$programming_languages',`code`='$code',`speaking`='$speaking',`leadership`='$leadership',`teaching_child`='$teaching_child',`translating`='$translating',`organize`='$organize',`testing`='$testing',`talk`='$talk',`teach`='$teach',`support`='$support',`org`='$org' WHERE userId = '$id'";
        
    } else {
        $pass = hash('sha256', $pass);
        $sql  = "UPDATE `users` SET `userName`='$name',`userEmail`='$email',`userPass`='$pass',`programming_languages`='$programming_languages',`code`='$code',`speaking`='$speaking',`leadership`='$leadership',`teaching_child`='$teaching_child',`translating`='$translating',`organize`='$organize',`testing`='$testing',`talk`='$talk',`teach`='$teach',`support`='$support',`org`='$org' WHERE userId = '$id'";
        
    }
    
    if ($conn->query($sql) === TRUE) {
        echo "Record Update successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
    $newURL = 'preferences.php';
    //header('Location: '.$newURL);   
}

?>
<?php

session_start();
require_once 'dbconnect.php';

// if session is not set this will redirect to login page
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
// select loggedin users detail
$res     = mysql_query("SELECT * FROM users WHERE userId=" . $_SESSION['user']);
$userRow = mysql_fetch_array($res);
?>

		<!-- Main Content -->
		<form action="" method="post" >
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
							<input type="hidden" name="id" class="form-input"  value="<?php echo $userRow['userId']; ?>" />
								<input type="text" name="name" class="form-input" placeholder="Enter Name" maxlength="50" value="<?php echo $userRow['userName']; ?>" />
								<span class="form-error"><?php echo $nameError; ?></span>
							</div>
							
							<div class="form-content form-email">						
								<input type="email" name="email" class="form-input" placeholder="Enter Your Email" maxlength="40" value="<?php echo $userRow['userEmail']; ?>" />
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
							<div class="preference-form-content form-languages">
							<?php
							if ($userRow['programming_languages'] != "") {
								
								$lng = array();
								$sd  = $userRow['programming_languages'];
								//echo $sd;
								$lng = explode(',', $sd);
								
							} else {
								$lng = array(
									'no'
								);
								
							}
							?>   
								<label class="preference-form-about" for="programming-languages">What programming languages do you know?</label>
								<div class="checkbox">
									<label for="programming-languages-0">
										<input <?php if (in_array("HTML", $lng)){ echo "checked";} ?> name="programming-languages[]" id="programming-languages-0" value="HTML" type="checkbox">
										HTML
									</label>
								</div>
								<div class="checkbox">
									<label for="programming-languages-1">
										<input <?php if (in_array("CSS", $lng)){ echo "checked";} ?> name="programming-languages[]" id="programming-languages-1" value="CSS" type="checkbox">
										CSS
									</label>
								</div>
								<div class="checkbox">
									<label for="programming-languages-2">
										<input <?php if (in_array("JS", $lng)){ echo "checked";} ?> name="programming-languages[]" id="programming-languages-2" value="JS" type="checkbox">
										JavaScript
									</label>
								</div>
								<div class="checkbox">
									<label for="programming-languages-3">
										<input <?php if (in_array("PHP", $lng)){ echo "checked";} ?> name="programming-languages[]" id="programming-languages-3" value="PHP" type="checkbox">
										PHP
									</label>
								</div>
								<div class="checkbox">
									<label for="programming-languages-4">
										<input  <?php if (in_array("Ruby", $lng)){ echo "checked";} ?> name="programming-languages[]" id="programming-languages-4" value="Ruby" type="checkbox">
										Ruby
									</label>
								</div>
								<div class="checkbox">
									<label for="programming-languages-5">
										<input  <?php if (in_array("Java", $lng)){ echo "checked";} ?> name="programming-languages[]" id="programming-languages-5" value="Java" type="checkbox">
										Java
									</label>
								</div>
								<div class="checkbox">
									<label for="programming-languages-6">
										<input <?php if (in_array("C", $lng)){ echo "checked";} ?> name="programming-languages[]" id="programming-languages-6" value="C" type="checkbox">
										C
									</label>
								</div>
								<div class="checkbox">
									<label for="programming-languages-0">
										<input <?php if (in_array("C++", $lng)){ echo "checked";} ?> name="programming-languages[]" id="programming-languages-0" value="C++" type="checkbox">
										C++
									</label>
								</div>
								<div class="checkbox">
									<label for="programming-languages-0">
										<input <?php if (in_array("C#", $lng)){ echo "checked";} ?> name="programming-languages[]" id="programming-languages-0" value="C#" type="checkbox">
										C#
									</label>
								</div>
							</div>
							<div class="preference-form-content form-leadership">
								<label class="preference-form-about" for="leadership">Do you have good leadership skills?</label>
								<label class="radio-inline" for="leadership-0">
									<input <?php if($userRow['leadership']==1){ echo 'checked="checked"';} ?> name="leadership" id="leadership-0" value="1" type="radio">
									Yes
								</label> 
								<label class="radio-inline" for="leadership-1">
									<input <?php if($userRow['leadership']==0){ echo 'checked="checked"';} ?> name="leadership" id="leadership-1" value="0"  type="radio">
									No
								</label>
							</div>
							
							<div class="preference-form-content form-speaking">
								<label class="preference-form-about" for="speaking">Do you feel good talking in front of an audience?</label>
								<label class="radio-inline" for="speaking-0">
									<input <?php if($userRow['speaking']==1){ echo 'checked="checked"';} ?> name="speaking" id="speaking-0" value="1" type="radio">
									Yes
								</label> 
								<label class="radio-inline" for="speaking-1">
									<input <?php if($userRow['speaking']==0){ echo 'checked="checked"';} ?> name="speaking" id="speaking-1" value="0"  type="radio">
									No
								</label>
							</div>
							
							<div class="preference-form-content form-teaching">
								<label class="preference-form-about" for="teaching">Do you think you can explain what the Internet is to a child?</label>
								<label class="radio-inline" for="teaching-0">
									<input <?php if($userRow['teaching']==1){ echo 'checked="checked"';} ?> name="teaching" id="teaching-0" value="1" type="radio">
									Yes
								</label> 
								<label class="radio-inline" for="teaching-1">
									<input <?php if($userRow['teaching']==0){ echo 'checked="checked"';} ?> name="teaching" id="teaching-1" value="0" type="radio">
									No
								</label>
							</div>
							
							[Languages]
							
						</div>
					</div>
					<div class="preference-block">
						<h3 class="preference-title">
							Interests
						</h3>
						<h4 class="preference-explanation">
							Tell us what projects you would prefer to work on!
						</h4>
						<div class="preference-fields">
							<div class="preference-form-content form-code">
								<label class="preference-form-about" for="code">Would you like to code?</label>
								<label class="radio-inline" for="code-0">
									<input <?php if($userRow['code']==1){ echo 'checked="checked"';} ?> name="code" id="code-0" value="1" type="radio">
									Yes
								</label> 
								<label class="radio-inline" for="code-1">
									<input <?php if($userRow['code']==0){ echo 'checked="checked"';} ?> name="code" id="code-1" value="0"  type="radio">
									No
								</label>
							</div>
							
							<div class="preference-form-content form-talk">
								<label class="preference-form-about" for="talk">Would you like to do public speaking?</label>
								<label class="radio-inline" for="talk-0">
									<input <?php if($userRow['talk']==1){ echo 'checked="checked"';} ?> name="talk" id="talk-0" value="1" type="radio">
									Yes
								</label> 
								<label class="radio-inline" for="talk-1">
									<input <?php if($userRow['talk']==0){ echo 'checked="checked"';} ?> name="talk" id="talk-1" value="0"  type="radio">
									No
								</label>
							</div>
							
							<div class="preference-form-content form-teach">
								<label class="preference-form-about" for="teach">Are you interested in teaching?</label>
								<label class="radio-inline" for="teach-0">
									<input <?php if($userRow['teach']==1){ echo 'checked="checked"';} ?> name="teach" id="teach-0" value="1" type="radio">
									Yes
								</label> 
								<label class="radio-inline" for="teach-1">
									<input <?php if($userRow['teach']==0){ echo 'checked="checked"';} ?> name="teach" id="teach-1" value="0"  type="radio">
									No
								</label>
							</div>
							
							<div class="preference-form-content form-l10n">
								<label class="preference-form-about" for="l10n">Are you interested in translating?</label>
								<label class="radio-inline" for="l10n-0">
									<input <?php if($userRow['translating']==1){ echo 'checked="checked"';} ?> name="translating" id="l10n-0" value="1" type="radio">
									Yes
								</label> 
								<label class="radio-inline" for="l10n-1">
									<input <?php if($userRow['translating']==0){ echo 'checked="checked"';} ?> name="translating" id="l10n-1" value="0"  type="radio">
									No
								</label>
							</div>
							
							<div class="preference-form-content form-organize">
								<label class="preference-form-about" for="organize">Are you interested in organizing events or meetups?</label>
								<label class="radio-inline" for="organize-0">
									<input <?php if($userRow['organize']==1){ echo 'checked="checked"';} ?> name="organize" id="organize-0" value="1" type="radio">
									Yes
								</label> 
								<label class="radio-inline" for="organize-1">
									<input <?php if($userRow['organize']==0){ echo 'checked="checked"';} ?> name="organize" id="organize-1" value="0"  type="radio">
									No
								</label>
							</div>
							
							<div class="preference-form-content form-support">
								<label class="preference-form-about" for="support">Are you interested in helping users?</label>
								<label class="radio-inline" for="support-0">
									<input <?php if($userRow['support']==1){ echo 'checked="checked"';} ?> name="support" id="support-0" value="1" type="radio">
									Yes
								</label> 
								<label class="radio-inline" for="support-1">
									<input <?php if($userRow['support']==0){ echo 'checked="checked"';} ?> name="support" id="support-1" value="0"  type="radio">
									No
								</label>
							</div>
							
							<div class="preference-form-content form-testing">
								<label class="preference-form-about" for="testing">Are you interested in testing software?</label>
								<label class="radio-inline" for="testing-0">
									<input <?php if($userRow['testing']==1){ echo 'checked="checked"';} ?> name="testing" id="testing-0" value="1" type="radio">
									Yes
								</label> 
								<label class="radio-inline" for="testing-1">
									<input  <?php if($userRow['testing']==0){ echo 'checked="checked"';} ?> name="testing" id="testing-1" value="0"  type="radio">
									No
								</label>
							</div>
							
							<br />
							
							<div class="preference-form-content form-org">
								<label class="preference-form-about" for="org">What organisations would you like to help out?</label>
								<label class="radio-inline" for="org-0">
									<input <?php if($userRow['org']==0){ echo 'checked="checked"';} ?> name="org" id="org-0" value="0" type="radio">
									Mozilla
								</label> 
								<label class="radio-inline" for="org-1">
									<input <?php if($userRow['org']==1){ echo 'checked="checked"';} ?> name="org" id="org-1" value="1"  type="radio">
									All Open-Source
								</label>
								<label class="radio-inline" for="org-2">
									<input <?php if($userRow['org']==2){ echo 'checked="checked"';} ?> name="org" id="org-2" value="2"  type="radio">
									All
								</label>
							</div>
							
						</div>
					</div>
					
					<button type="submit" class="form-button" value="1" name="Save">Save all information!</button>
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