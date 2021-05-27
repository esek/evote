<?php

session_start();
require '../data/evote.php';
require '../data/Dialogue.php';
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
                $dialogue->appendMessage('Du har inte angett vad som ska väljas', 'error');
            }
            if ($_POST['code'] == '') {
                $input_ok = false;
                $dialogue->appendMessage('Du har inte angett någon tillfällig kod', 'error');
            }
            if ($_POST['max_num'] == '') {
                $input_ok = false;
                $dialogue->appendMessage('Du har inte angett hur många man får rösta på', 'error');
            }
            if ($evote->ongoingRound()) {
                $input_ok = false;
                $dialogue->appendMessage('En valomgång är redan igång', 'error');
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
                $dialogue->appendMessage('Du måste ange minst två kandidater', 'error');
            }

            if ($input_ok) {
                $round_name = $_POST['round_name'];
                $code = $_POST['code'];
                $max = $_POST['max_num'];

                $insert_ok = $evote->newRound($round_name, $code, $max, $cands);

                if ($insert_ok) {
                    $dialogue->appendMessage('En ny valomgång har börjat', 'success');
                } else {
                    $dialogue->appendMessage('Fel', 'error');
                }
            }
            $_SESSION['message'] = serialize($dialogue);
                    //header("HTTP/1.1 301 Moved Permanently");
            header('Location: /electionadmin');
        } elseif ($_POST['button'] == 'end_round') { # AVSLUTA VALOMGÅNG KNAPPEN
                    $evote->endRound();
            header('Location: /electionadmin');
        } 
    }
}