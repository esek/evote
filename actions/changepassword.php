<?php
session_start();
require '../data/evote.php';
$evote = new Evote();

if(isset($_POST["button"])){
        if($_POST["button"] == "change"){
            
        }else if ($_POST["button"] == "new"){
            
	    $input_ok = TRUE;
	    $msg = "";
	    $msgType == "";
            if($_POST["psw"] == "" || $_POST["username"] == "" || $_POST["priv"] == ""){
                    $input_ok = FALSE;
                    $msg .= "Något av fälten är tomma.";
                    $msgType = "error";
            }
	    
	    if($input_ok){
                $user = $_POST["username"];
                $psw = $_POST["psw"];
                $priv = $_POST["priv"];
                $evote->createNewUser($user, $psw, $priv)

                $msg .= "En ny användare har skapats ";
                $msgType = "success";
	    }
	    $_SESSION["message"] = array("type" => $msgType, "message" => $msg);
            header("Location: /useradmin");
        }
	
	

}
?>
