<?php


require '../data/evote.php';
require '../data/Dialogue.php';
$evote = new Evote();

session_start();
if (isset($_POST['button'])) {
    if ($_POST['button'] == 'vote') {
        $dialogue = new dialogue();
        $ok = true;
        $ongoingR = $evote->ongoingRound();
        if (!isset($_POST['person'])) {
            $ok = false;
            $dialogue->appendMessage('Du har inte valt någon att rösta på', 'error');
        } elseif (!$evote->checkRightElection($_POST['person'])) {
            // om någon har en gammal sida uppe och försöker rösta
            $ok = false;
            $dialogue->appendMessage('Den valomgång du försöker rösta på har redan avslutats. Sidan har nu uppdaterats så du kan försöka igen', 'error');
        } elseif ($evote->getMaxAlternatives() < count($_POST['person'])) {
            // om någon stänger av javascriptet.
            $ok = false;
            $dialogue->appendMessage('Du får inte välja för många kandidater', 'error');
        }

        if ($_POST['code1'] == '') {
            $ok = false;
            $dialogue->appendMessage('Du har inte angett någon personlig valkod', 'error');
        }
        if ($_POST['code2'] == '') {
            $ok = false;
            $dialogue->appendMessage('Du har inte angett någon tillfällig valkod', 'error');
        }
        if (!$ongoingR) {
            $ok = false;
            $dialogue->appendMessage('Valomgången har redan avslutats', 'error');
        }

        if ($ok) {
            $person_id = $_POST['person'];
            $personal_code = $_POST['code1'];
            $current_code = $_POST['code2'];
            if ($evote->vote($person_id, $personal_code, $current_code)) {
                $dialogue->appendMessage('Din röst har blivit registrerad', 'success');
            } else {
                $dialogue->appendMessage('Din röst blev inte registrerad. Detta kan bero på att du skrev in någon av koderna fel eller att du redan röstat', 'error');
            }
        }

        $_SESSION['message'] = serialize($dialogue);
        header('Location: /vote');
    }
}
