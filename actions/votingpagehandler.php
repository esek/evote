<?php


require '../data/evote.php';
require '../data/Dialogue.php';
include '../languagePicker.php';

$evote = new Evote();

session_start();
if (isset($_POST['button'])) {
    if ($_POST['button'] == 'vote') {
        $dialogue = new dialogue();
        $ok = true;
        $ongoingR = $evote->ongoingRound();
        if (!isset($_POST['person'])) {
            $ok = false;
            $dialogue->appendMessage(pickLanguage('Du har inte valt någon att rösta på', 'You have not selected anything to vote on'), 'error');
        } elseif (!$evote->checkRightElection($_POST['person'])) {
            // om någon har en gammal sida uppe och försöker rösta
            $ok = false;
            $dialogue->appendMessage(pickLanguage('Den valomgång du försöker rösta på har redan avslutats. Sidan har nu uppdaterats så du kan försöka igen', 
            'The election round you are trying to vote on has already ended. The page has been refreshed so you can try again'), 'error');
        } elseif ($evote->getMaxAlternatives() < count($_POST['person'])) {
            // om någon stänger av javascriptet.
            $ok = false;
            $dialogue->appendMessage(pickLanguage('Du får inte välja för många kandidater', 'You are not allowed to pick too many candidates'), 'error');
        }

        if ($_POST['code1'] == '') {
            $ok = false;
            $dialogue->appendMessage(pickLanguage('Du har inte angett någon personlig valkod', 'You have not entered any personal code'), 'error');
        }
        if ($_POST['code2'] == '') {
            $ok = false;
            $dialogue->appendMessage(pickLanguage('Du har inte angett någon tillfällig valkod', 'You have not entered any temporary code'), 'error');
        }
        if (!$ongoingR) {
            $ok = false;
            $dialogue->appendMessage(pickLanguage('Valomgången har redan avslutats', 'The election round has already been terminated'), 'error');
        }

        if ($ok) {
            $person_id = $_POST['person'];
            $personal_code = $_POST['code1'];
            $current_code = $_POST['code2'];
            if ($evote->vote($person_id, $personal_code, $current_code)) {
                $dialogue->appendMessage(pickLanguage('Din röst har blivit registrerad' , 'Your vote has been registered'), 'success');
            } else {
                $dialogue->appendMessage(pickLanguage('Din röst blev inte registrerad. Detta kan bero på att du skrev in någon av koderna fel eller att du redan röstat',
            "Your vote was not registered. This can depend on you entering one of the codes wrong, or because you already have voted"), 'error');
            }
        }

        $_SESSION['message'] = serialize($dialogue);
        header('Location: /vote');
    }
}
