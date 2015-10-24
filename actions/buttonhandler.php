<?php
if(isset($_POST["button"]))	
	if($_POST["button"]=="login"){ 
		
		session_start();
		$_SESSION["user"]="admin";	
		header("Location: /index.php?newpage=admin");
	}else if($_POST["button"]=="stat"){

		header("Location: /index.php?newpage=stat");
	}else if($_POST["button"]=="print"){ 
				
		header("Location: /actions/codeprint.php");
	}else if($_POST["button"]=="clear"){ 
		header("Location: /index.php?newpage=clear");
	}else if($_POST["button"]=="logout"){ 
		session_start();	
		session_unset();	
		header("Location: /index.php?newpage=admin");
	}else if($_POST["button"]=="end_round"){ 
	
		header("Location: /index.php?newpage=admin");
	}
?>

