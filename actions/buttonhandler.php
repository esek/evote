<?php
session_start();
require '../data/evote.php';
$evote = new Evote();

if(isset($_POST["button"])){
# ------------- NAV-BUTTONS ------------------------------------	
	if($_POST["button"]=="login"){ 
		$input_ok = TRUE;
		$msg = "";	
		$msgType = "";
		if($_POST["usr"] == ""){
			$input_ok = FALSE;
			$msg .= "Du har inte skrivit in något användarnamn. ";
			$msgType = "error";
		}
		if($_POST["psw"] == ""){
			$input_ok = FALSE;
			$msg .= "Du har inte angett något lösenord ";
			$msgType = "error";
		}
		
		if($input_ok){
			$usr = $_POST["usr"];
			$psw = $_POST["psw"];
			$correct = $evote->usercheck($usr, $psw);

			if($correct){
				$_SESSION["user"] = $usr;
				
			}else{
				$msg .= "Användarnamet och/eller lösenordet är fel. ";
				$msgType = "error";
			}	
		}
		$_SESSION["message"] = array("type" => $msgType, "message" => $msg);
		header("Location: /admin");

	}else if($_POST["button"]=="stat"){
		header("Location: /stat");

	}else if($_POST["button"]=="print"){ 
		header("Location: /actions/codeprint.php");

	}else if($_POST["button"]=="clear"){ 
		header("Location: /clear");

	}else if($_POST["button"]=="logout"){ 
		session_unset();	
		header("Location: /admin");
# ------------ ACTION BUTTONS ---------------------------------
	}else if($_POST["button"]=="vote"){ 
		$input_ok = TRUE;
		$msg = "";	
		$msgType = "";
		if(!isset($_POST["person"])){
			$input_ok = FALSE;
			$msg .= "Du har inte valt någon att rösta på. ";
			$msgType = "error";
		}
		if($_POST["code"] == ""){
			$input_ok = FALSE;
			$msg .= "Du har inte angett någon personlig kod. ";
			$msgType = "error";
		}
		if($input_ok){
			$person_id = $_POST["person"];
			$code = $_POST["code"];
			/*
			TODO
			Kolla om den personliga koden är brukbar och lägg sedan till rösten i databasen
			*/
			$msg .= "Din röst har blivit registrerad.";
			$msgType = "success";
		}
		$_SESSION["message"] = array("type" => $msgType, "message" => $msg);
		header("Location: /front");

	}else if($_POST["button"]=="create"){ 
		$input_ok = TRUE;
		$msg = "";
		$msgType = "";
		if($_POST["valnamn"] == ""){
			$input_ok = FALSE;
			$msg .= "Du har inte angett något namn på valet. ";
			$msgType = "error";
		}
		if($_POST["antal_personer"] == ""){
			$input_ok = FALSE;
			$msg .= "Du har inte angett det maximala antalet personer. ";
			$msgType = "error";
		}
		if($input_ok){
			$name = $_POST["valnamn"];
			$nop = $_POST["antal_personer"];
			/*
			TODO
			Skapa ett nytt val
			*/
		}
		$_SESSION["message"] = array("type" => $msgType, "message" => $msg);
		header("Location: /admin");

	}else if($_POST["button"]=="begin_round"){ 
		$input_ok = TRUE;
		$msg = "";
		$msgType = "";
		if($_POST["round_name"] == ""){
			$input_ok = FALSE;
			$msg .= "Du har inte angett vad som ska väljas. ";
			$msgType = "error";
		}
		$cands[0] = "";
		$n = 0;
		foreach($_POST["candidates"] as $name){
			if($name != ""){
				$cands[$n] = $name;
				$n++;
			}
		}
		if($n < 2){
			$input_ok = FALSE;
			$msg .= "Du måste ange minst två kandidater. ";
			$msgType = "error";
			
		}
		if($input_ok){
			$round_name = $_POST["round_name"];
			/*
			TODO
			Starta en ny valomgång.
			*/	
		}
		$_SESSION["message"] = array("type" => $msgType, "message" => $msg);
		header("Location: /admin");

	}else if($_POST["button"]=="end_round"){ 
		header("Location: /admin");

	}else if($_POST["button"]=="delete_election"){ 
		$input_ok = TRUE;
		$msg = "";
		$msgType = "";
		if($_POST["pswuser"] == ""){
			$input_ok = FALSE;
			$msg .= "Du har inte angett något lösenord. ";
			$msgType = "error";
		}
		if($_POST["pswmacapar"] == ""){
			$input_ok = FALSE;
			$msg .= "Hemsideansvaring har inte angett sitt lösenord. ";
			$msgType = "error";
		}
		$redirect = "clear";
		if($input_ok){
			$psw1 = $_POST["psw1"];
			$psw2 = $_POST["psw2"];
			$current_usr = $_SESSION["user"];
			if($evote->usercheck($current_usr, $psw1) && $evote->usercheck("macapar", $psw2)){
				/*
				TODO
				Ta bort val
				*/
				$msg .= "Valet har blivit raderat. ";
				$msgType = "success";
				$redirect = "admin";
			}else{
				$msg .= "Någon skrev in fel lösenord. ";
				$msgType = "error";
			}
		}
		$_SESSION["message"] = array("type" => $msgType, "message" => $msg);
		header("Location: /".$redirect);

	}
}
?>

