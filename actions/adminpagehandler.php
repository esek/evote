<?php

session_start();
require '../data/evote.php';
$evote = new Evote();

$access = array(0);
$priv = $evote->getPrivilege($_SESSION["user"]);
if(in_array($priv, $access)){
    if (isset($_POST['button'])) {
        if ($_POST['button'] == 'login') {
            $input_ok = true;
            $msg = '';
            $msgType = '';
            if ($_POST['usr'] == '') {
                $input_ok = false;
                $msg .= 'Du har inte skrivit in något användarnamn. ';
                $msgType = 'error';
            }
            if ($_POST['psw'] == '') {
                $input_ok = false;
                $msg .= 'Du har inte angett något lösenord ';
                $msgType = 'error';
            }

            if ($input_ok) {
                $usr = $_POST['usr'];
                $psw = $_POST['psw'];
                $correct = $evote->login($usr, $psw); # Kolla lösenordet mot databases. Detta sker i data/evote.php

                if ($correct) {
                    $_SESSION['superuser'] = $usr;
                } else {
                    $msg .= 'Användarnamet och/eller lösenordet är fel. ';
                    $msgType = 'error';
                }
            }

            $_SESSION['superuser'] = $_POST['usr'];
            $_SESSION['message'] = array('type' => $msgType, 'message' => $msg);
            echo $_SESSION['superuser'];
            header('Location: /adminaccount');


        } elseif ($_POST['button'] == 'logout') {
            unset($_SESSION['superuser']);
            header('Location: /adminaccount');
        }
    }
}
