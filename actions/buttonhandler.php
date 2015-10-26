<?php
if(isset($_POST["button"])){
# ------------- NAV-BUTTONS ------------------------------------	
	if($_POST["button"]=="login"){ 
		/*
		TODO
		Kolla med databasen om inlogget är rätt
		*/
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
# ------------ ACTION BUTTONS ---------------------------------
	}else if($_POST["button"]=="vote"){ 
		$input_ok = TRUE;
		if(!isset($_POST["person"])){
			$input_ok = FALSE;
		}
		if($_POST["code"] == ""){
			$input_ok = FALSE;
		}
		if(!$input_ok){
			echo "<script> alert(\"Du har inte valt n\xE5gon person och/eller gl\xF6mt att skriva in din personliga kod\"); window.location = \"/index.php?newpage=front\"; </script>";	
		}else{
			$person_id = $_POST["person"];
			$code = $_POST["code"];
			/*
			TODO
			Kolla om den personliga koden är brukbar och lägg sedan till rösten i databasen
			*/
			header("Location: /index.php?newpage=front");
		}

	}else if($_POST["button"]=="create"){ 
		$input_ok = TRUE;
		if($_POST["valnamn"] == ""){
			$input_ok = FALSE;
		}
		if($_POST["antal_personer"] == ""){
			$input_ok = FALSE;
		}
		if(!$input_ok){
			echo "<script> alert(\"Du m\xE5ste fylla i b\xE5da f\xE4lten\"); window.location = \"/index.php?newpage=admin\"; </script>";	
		}else{
			$name = $_POST["valnamn"];
			$nop = $_POST["antal_personer"];
			/*
			TODO
			Skapa ett nytt val
			*/
			header("Location: /index.php?newpage=admin");
		}

	}else if($_POST["button"]=="begin_round"){ 
		$input_ok = TRUE;
		if($_POST["round_name"] == ""){
			$input_ok = FALSE;
		}
		$cands[0] = "";
		$n = 0;
		foreach($_POST["candidates"] as $name){
			if($name != ""){
				$cands[$n] = $name;
				$n++;
			}
		}
		if(!$input_ok || $n < 2){
			echo "<script> alert(\"Du har gl\xF6mt att fylla i vad som ska v\xE4ljas eller minst tv\xE5 kandidater\"); window.location = \"/index.php?newpage=admin\"; </script>";	
		}else{
			
			header("Location: /index.php?newpage=admin");
		}

	}else if($_POST["button"]=="end_round"){ 
		header("Location: /index.php?newpage=admin");

	}else if($_POST["button"]=="delete_election"){ 
		header("Location: /index.php?newpage=admin");

	}
}
?>

