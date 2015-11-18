<?php
#	I denna fil bestäms vad som händer när en knapp trycks på sidan
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
			$correct = $evote->login($usr, $psw); # Kolla lösenordet mot databases. Detta sker i data/evote.php

			if($correct){
				$_SESSION["user"] = $usr;

			}else{
				$msg .= "Användarnamet och/eller lösenordet är fel. ";
				$msgType = "error";
			}
		}
		$_SESSION["message"] = array("type" => $msgType, "message" => $msg);
		$redirect = $_SESSION["redirect"];
		header("Location: /".$redirect);

	}else if($_POST["button"]=="stat"){
		header("Location: /stat");

	}else if($_POST["button"]=="print"){
                //require "../ecrypt.php";
                //$ecrypt = new ECrypt();
                //$codes = $ecrypt->generate_otp(50);
                //include "codeprint.php";
                $evote->endRound();

	}else if($_POST["button"]=="clear"){
		header("Location: /clear");

	}else if($_POST["button"]=="logout"){
		session_unset();
		header("Location: /front");
# ------------ ACTION BUTTONS ---------------------------------
	}else if($_POST["button"]=="vote"){ # RÖSTA KNAPPEN I FRONT-PANELEN
		$ok = TRUE;
		$msg = "";
		$msgType = "";
		if(!isset($_POST["person"])){
			$ok = FALSE;
			$msg .= "Du har inte valt någon att rösta på. ";
			$msgType = "error";
		}else if($evote->getMaxAlternatives() < count($_POST["person"])){
			// om någon stänger av javascriptet.
			echo count($_POST["person"]);
			$ok = FALSE;
		    $msg .= "FYY! Du får inte hacka sidan. ";
		    $msgType = "error";
		}

		if($_POST["code1"] == ""){
			$ok = FALSE;
			$msg .= "Du har inte angett någon personlig valkod. ";
			$msgType = "error";
		}
		if($_POST["code2"] == ""){
			$ok = FALSE;
			$msg .= "Du har inte angett någon tillfällig valkod. ";
			$msgType = "error";
		}
        if(!$evote->ongoingRound()){
            $ok = FALSE;
		    $msg .= "Valomgången har redan avslutats. ";
		    $msgType = "error";
        }

		if($ok){
			$person_id = $_POST["person"];
			$personal_code = $_POST["code1"];
			$current_code = $_POST["code2"];
            if($evote->vote($person_id, $personal_code, $current_code)){
			    $msg .= "Din röst har blivit registrerad.";
                $msgType = "success";
            }else{
			    $msg .= "Din röst blev inte registrerad. Detta kan bero på att du skrev in någon av koderna fel eller att du redan röstat.";
                $msgType = "error";
            }
		}
		$_SESSION["message"] = array("type" => $msgType, "message" => $msg);
		header("Location: /front");

	}else if($_POST["button"]=="create"){ # SKAPA NYTT VAL KNAPPEN
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

                        require "../ecrypt.php";
                        $ecrypt = new ECrypt();
                        $codes = $ecrypt->generate_otp($nop);
                        $evote->newCodes($codes);
                        $evote->newSession($name);
                        include "codeprint.php";
		}else{
		        $_SESSION["message"] = array("type" => $msgType, "message" => $msg);
		        header("Location: /admin");
                }

	}else if($_POST["button"]=="begin_round"){ # STARTA NYTT VAL KNAPPEN
		$input_ok = TRUE;
		$msg = "";
		$msgType = "";
		if($_POST["round_name"] == "" ){
			$input_ok = FALSE;
			$msg .= "Du har inte angett vad som ska väljas. ";
			$msgType = "error";
		}
		if($_POST["code"] == ""){
			$input_ok = FALSE;
			$msg .= "Du har inte angett någon tillfällig kod. ";
			$msgType = "error";
		}
		if($_POST["max_num"] == ""){
			$input_ok = FALSE;
			$msg .= "Du har inte angett hur många man får rösta på. ";
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
            $code = $_POST["code"];
			$max = $_POST["max_num"];

            $insert_ok = $evote->newRound($round_name, $code, $max, $cands);

            if($insert_ok){
			    $msg .= "En ny valomgång har börjat. ";
			    $msgType = "success";
                        }else{
			    $msg .= "Fel. ";
			    $msgType = "error";

            }

		}
		$_SESSION["message"] = array("type" => $msgType, "message" => $msg);
                //header("HTTP/1.1 301 Moved Permanently");
		header("Location: /admin");

	}else if($_POST["button"]=="end_round"){ # AVSLUTA VALOMGÅNG KNAPPEN
                $evote->endRound();
		header("Location: /admin");

	}else if($_POST["button"]=="delete_election"){ # TA BORT VAL KNAPPEN
		$input_ok = TRUE;
		$msg = "";
		$msgType = "";
		if($_POST["pswpageadmin"] == "" || $_POST["namepageadmin"] == "" || $_POST["pswuser"] == ""){
			$input_ok = FALSE;
			$msg .= "Alla fält är inte ifyllda. ";
			$msgType = "error";
		}
		$redirect = "clear";
		if($input_ok){
			$psw1 = $_POST["pswuser"];
                        $name_pageadmin = $_POST["namepageadmin"];
			$psw2 = $_POST["pswpageadmin"];
			$current_usr = $_SESSION["user"];
			if($evote->login($current_usr, $psw1) && $evote->login($name_pageadmin, $psw2)){

                                if($evote->verifyUser($name_pageadmin, 0)){
                                    $evote->endSession();
				    $msg .= "Valet är nu stängt. ";
				    $msgType = "success";
				    $redirect = "admin";
                                }else{
				    $msg .= "Rättighetsfel. ";
				    $msgType = "error";

                                }
			}else{
				$msg .= "Fel lösenord och/eller användarnamn någonstans. ";
				$msgType = "error";
			}
		}
		$_SESSION["message"] = array("type" => $msgType, "message" => $msg);
		header("Location: /".$redirect);

	}
}
?>
