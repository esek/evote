<?php

session_start();
require '../data/evote.php';
require '../data/Dialogue.php';
require '../localization/getLocalizedText.php';

$evote = new Evote();

if (isset($_POST['button'])) {
    if ($_POST['button'] == 'vote') {
        $dialogue = new dialogue();
        $ok = true;
        $ongoingR = $evote->ongoingRound();
        if (!isset($_POST['person'])) {
            $ok = false;
            $dialogue->appendMessage(getLocalizedText('You have not selected anything to vote on'), 'error');
        } elseif (!$evote->checkRightElection($_POST['person'])) {
            // If someone has an old page up and tries to vote
            $ok = false;
            $dialogue->appendMessage(getLocalizedText('The election round you are trying to vote on has already ended. The page has been refreshed so you can try again'), 'error');
        } elseif ($evote->getMaxAlternatives() < count($_POST['person'])) {
            // If someone disables the JS
            $ok = false;
            $dialogue->appendMessage(getLocalizedText('You are not allowed to pick too many candidates'), 'error');
        }

        if ($_POST['code1'] == '') {
            $ok = false;
            $dialogue->appendMessage(getLocalizedText('You have not entered any personal code'), 'error');
        }
        if ($_POST['code2'] == '') {
            $ok = false;
            $dialogue->appendMessage(getLocalizedText('You have not entered any temporary code'), 'error');
        }
        if (!$ongoingR) {
            $ok = false;
            $dialogue->appendMessage(getLocalizedText('The election round has already been terminated'), 'error');
        }

        if ($ok) {
            $person_id = $_POST['person'];
            $personal_code = $_POST['code1'];
            $current_code = $_POST['code2'];
            if ($evote->vote($person_id, $personal_code, $current_code)) {
                $dialogue->appendMessage(getLocalizedText('Your vote has been registered'), 'success');
            } else {
                $dialogue->appendMessage(getLocalizedText("Your vote was not registered. This can depend on you entering one of the codes wrong, or because you already have voted"), 'error');
            }
        }

        $_SESSION['message'] = serialize($dialogue);
        header('Location: /vote');
    }
}
