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
	$email = $userRow['userEmail'];
    $programming_languages = $userRow['programming_languages'];
	$languages = $userRow['languages'];
	 $programming_languages_arr = array();
	if($programming_languages!=""){
		$programming_languages_arr = explode(',',$programming_languages);
	}
	
    $languages_arr = array();
	if($languages!=""){
		$languages_arr = explode(',',$languages);
	}
	
	
    $sql = "SELECT * FROM `tasks` WHERE responsible IS NULL";
    $result = $conn->query($sql);

	if($_GET['para']=='accept'){
		$id = $_GET['id'];
		$sql = "SELECT id FROM `tasks` WHERE  id = '$id' ";
        $find = $conn->query($sql);
		
		
		
		if ($find->num_rows > 0) {
		
			$sql = "UPDATE `tasks` SET responsible = '$email' WHERE id='$id'";
			$conn->query($sql);
			header("Location: home.php"); 
		}
		
		
	}
    $sql = "SELECT * FROM `tasks` WHERE responsible = '$email' AND task_finished = 0";
    $accepted = $conn->query($sql);
	$sql = "SELECT * FROM `tasks` WHERE responsible = '$email' AND task_finished = 1";
    $completed = $conn->query($sql);
		$sql = "SELECT sum(point) as total FROM `tasks` WHERE responsible= '$email' AND task_finished = 1";
    $total = $conn->query($sql);
	
	
	
	if($_GET['para']=='cancel'){
		$id = $_GET['id'];
		$sql = "SELECT id FROM `tasks` WHERE responsible = '$email' AND id = '$id' ";
        $find = $conn->query($sql);
		
		
		if ($find->num_rows > 0) {
		
			$sql = "UPDATE `tasks` SET responsible=NULL,task_finished=0 WHERE id='$id'";
			$conn->query($sql);
			header("Location: about.php"); 
		}
		
		
	}
	if($_GET['para']=='complete'){
		$id = $_GET['id'];
		$sql = "SELECT id FROM `tasks` WHERE responsible = '$email' AND id = '$id' ";
        $find = $conn->query($sql);
		
		
		
		if ($find->num_rows > 0) {
		
			$sql = "UPDATE `tasks` SET task_finished=1 WHERE id='$id'";
			$conn->query($sql);
			header("Location: about.php"); 
		}
		
		
	}	