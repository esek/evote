<?php
echo "nej";
if(isset($_POST["button"]))	
	echo "ja";
	if($_POST["button"]=="login"){ 
		
	#	session_start();
#		$_SESSION["user"]="admin";	
#		echo $_SESSION["user"];
		header("Location: /index.php?newpage=admin");
	}else if($_POST["button"]=="stat"){

		header("Location: /index.php?newpage=front");
	}else if($_POST["button"]=="print"){ 
		
		header("Location: /index.php?newpage=front");
	}else if($_POST["button"]=="erase"){ 
	
		header("Location: /index.php?newpage=admin");
	}else if($_POST["button"]=="logout"){ 
		session_start();	
		session_unset();	
		header("Location: /index.php?newpage=admin");
	}else if($_POST["button"]=="end_round"){ 
	
		header("Location: /index.php?newpage=admin");
	}
?>

