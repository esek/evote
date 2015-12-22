<?php

session_start();
require '../data/evote.php';
$evote = new Evote();

if(isset($_POST["button"])){

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
			$correct = $evote->login($usr, $psw); # Kolla lösenordet mot databases. Detta sker i data/evote.php

			if($correct){
				$_SESSION["user"] = $usr;

			}else{
				$msg .= "Användarnamet och/eller lösenordet är fel. ";
				$msgType = "error";
			}
		}
		$_SESSION["message"] = array("type" => $msgType, "message" => $msg);

		$priv = $evote->getPrivilege($_SESSION["user"]);
		switch ($priv) {
			case 0:
				$redirect = "adminaccount";
				break;
			case 1:
				$redirect = "electionadmin";
				break;
			case 2:
				$redirect = "adjust";
				break;
			default:
				$redirect = "login";
				break;
		}
		header("Location: /".$redirect);

    }else if($_POST["button"]=="logout"){
		unset($_SESSION['user']);
		header("Location: /front");
    }
}

?>
