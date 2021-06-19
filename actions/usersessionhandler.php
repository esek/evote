<?php

session_start();
require '../data/evote.php';
require '../data/Dialogue.php';
require '../localization/getLocalizedText.php';

$evote = new Evote();

if(isset($_POST["button"])){

	if($_POST["button"]=="login"){
		$dialogue = new Dialogue();
		$input_ok = TRUE;
		$msg = "";
		$msgType = "";
		if($_POST["usr"] == ""){
			$input_ok = FALSE;
			$dialogue->appendMessage(getLocalizedText('You have not entered any username'), 'error');
		}
		if($_POST["psw"] == ""){
			$input_ok = FALSE;
			$dialogue->appendMessage(getLocalizedText('You have not entered any password'), 'error');
		}

		if($input_ok){
			$usr = $_POST["usr"];
			$psw = $_POST["psw"];
			$correct = $evote->login($usr, $psw); # Kolla lösenordet mot databases. Detta sker i data/evote.php

			if($correct){
				$_SESSION["user"] = $usr;

			}else{
				$dialogue->appendMessage(getLocalizedText('The username and/or the password is wrong'), 'error');
			}
		}
		$_SESSION['message'] = serialize($dialogue);

		$priv = $evote->getPrivilege($_SESSION["user"]);
		switch ($priv) {
			case 0:
				$redirect = "adminmain";
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

    }elseif($_POST["button"]=="logout"){
		unset($_SESSION['user']);
		header("Location: /vote");
    }
}

?>
