<?php

session_start();
require '../data/evote.php';
$evote = new Evote();
if (isset($_POST['button'])) {
    if ($_POST['button'] == 'vote') {
        $ok = true;
        $msg = '';
        $msgType = '';
        $ongoingR = $evote->ongoingRound();
        if (!isset($_POST['person'])) {
            $ok = false;
            $msg .= 'Du har inte valt någon att rösta på. ';
            $msgType = 'error';
        } elseif (!$evote->checkRightElection($_POST['person'])) {
            // om någon har en gammal sida uppe och försöker rösta
            $ok = false;
            $msg .= 'Den valomgång du försöker rösta på har redan avslutats. Sidan har nu uppdaterats så du kan försöka igen. ';
            $msgType = 'error';
        } elseif ($evote->getMaxAlternatives() < count($_POST['person'])) {
            // om någon stänger av javascriptet.
            $ok = false;
            $msg .= 'Du får inte välja för många kandidater. ';
            $msgType = 'error';
        }

        if ($_POST['code1'] == '') {
            $ok = false;
            $msg .= 'Du har inte angett någon personlig valkod. ';
            $msgType = 'error';
        }
        if ($_POST['code2'] == '') {
            $ok = false;
            $msg .= 'Du har inte angett någon tillfällig valkod. ';
            $msgType = 'error';
        }
        if (!$ongoingR) {
            $ok = false;
            $msg .= 'Valomgången har redan avslutats. ';
            $msgType = 'error';
        }

        if ($ok) {
            $person_id = $_POST['person'];
            $personal_code = $_POST['code1'];
            $current_code = $_POST['code2'];
            if ($evote->vote($person_id, $personal_code, $current_code)) {
                $msg .= 'Din röst har blivit registrerad.';
                $msgType = 'success';
            } else {
                $msg .= 'Din röst blev inte registrerad. Detta kan bero på att du skrev in någon av koderna fel eller att du redan röstat.';
                $msgType = 'error';
            }
        }
        $_SESSION['message'] = array('type' => $msgType, 'message' => $msg);
        header('Location: /front');
    }
}
