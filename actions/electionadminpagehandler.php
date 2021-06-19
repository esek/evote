<?php

session_start();
require '../data/evote.php';
require '../data/Dialogue.php';
require '../localization/getLocalizedText.php';

$evote = new Evote();

$access = array(1);
$priv = $evote->getPrivilege($_SESSION["user"]);
if(in_array($priv, $access)){
    if (isset($_POST['button'])) {
         if ($_POST['button'] == 'begin_round') { # STARTA NYTT VAL
            $dialogue = new Dialogue();
            $input_ok = true;
            if ($_POST['round_name'] == '') {
                $input_ok = false;
                $dialogue->appendMessage(getLocalizedText('You have not entered what to be elected'), 'error');
            }
            if ($_POST['code'] == '') {
                $input_ok = false;
                $dialogue->appendMessage(getLocalizedText('You have not entered any temporary code'), 'error');
            }
            if ($_POST['max_num'] == '') {
                $input_ok = false;
                $dialogue->appendMessage(getLocalizedText('You have not entered how many one can vote on'), 'error');
            }
            if ($evote->ongoingRound()) {
                $input_ok = false;
                $dialogue->appendMessage(getLocalizedText('An election is already in progress'), 'error');
            }

            $cands[0] = '';
            $n = 0;
            foreach ($_POST['candidates'] as $name) {
                if ($name != '') {
                    $cands[$n] = $name;
                    ++$n;
                }
            }
            if ($n < 2) {
                $input_ok = false;
                $dialogue->appendMessage(getLocalizedText('You must enter at least two candidates'), 'error');
            }

            if ($input_ok) {
                $round_name = $_POST['round_name'];
                $code = $_POST['code'];
                $max = $_POST['max_num'];

                $insert_ok = $evote->newRound($round_name, $code, $max, $cands);

                if ($insert_ok) {
                    $dialogue->appendMessage(getLocalizedText('A new election round has begun'), 'success');
                } else {
                    $dialogue->appendMessage(getLocalizedText('Error'), 'error');
                }
            }
            $_SESSION['message'] = serialize($dialogue);
                    //header("HTTP/1.1 301 Moved Permanently");
            header('Location: /electionadmin');
        } elseif ($_POST['button'] == 'end_round') { # END ELECTION BUTTON
                    $evote->endRound();
            header('Location: /electionadmin');
        } 
    }
}