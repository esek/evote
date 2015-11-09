<?php
session_start();
require '../data/evote.php';
$evote = new Evote();

if(isset($_POST["button"])){
	$input_ok = TRUE;
	$msg = "";
	$msgType == "";
        if($_POST["psw1"] == ""){
                $input_ok = FALSE;
                $msg .= "Du har inte angett något lösenord";
                $msgType = "error";
        }
	
	if($input_ok){
		$psw1 = $_POST["psw1"];
		if($_POST["button"] == "change_admin"){
				
		}elseif($_POST["button"] == "change_adjust"){
			
		}
                $msg .= "Lösenordet är nu bytt";
                $msgType = "success";
	}
	$_SESSION["message"] = array("type" => $msgType, "message" => $msg);
        header("Location: /useradmin");
	
	

}
?>
