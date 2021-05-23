<?php

session_start();
require '../data/evote.php';
require '../data/Dialogue.php';
include '../languagePicker.php';

$evote = new Evote();

if (isset($_POST['button'])) {
    if ($_POST['button'] == 'create') { # SKAPA NYTT VAL
        $dialogue = new Dialogue();
        $input_ok = true;
        $msg = '';
        $msgType = '';
        if ($_POST['valnamn'] == '') {
            $input_ok = false;
            $dialogue->appendMessage(pickLanguage('Du har inte angett något namn på valet', 'You have not entered a name for the election'), 'error');
        }
        if ($_POST['antal_personer'] == '') {
            $input_ok = false;
            $dialogue->appendMessage(pickLanguage('Du har inte angett det maximala antalet personer', 'You have not entered the max number of people'), 'error');
        }
        if ($evote->ongoingSession()) {
            $input_ok = false;
            $dialogue->appendMessage(pickLanguage('Det pågår redan ett val', 'There is already an election in progress'), 'error');
        }

        if ($input_ok) {
            $dialogue->setMessageType('success');
            $name = $_POST['valnamn'];
            $nop = $_POST['antal_personer'];

            require '../ecrypt.php';
            $ecrypt = new ECrypt();
            $codes = $ecrypt->generate_otp($nop);
            $evote->newCodes($codes);
            $evote->newSession($name);
            // Om man har distansval vill man ha CSV-fil istället
            if (isset($_POST['csv_checkbox'])) {
                include 'csvcodesend.php';
            } else {
                include 'codeprint.php';
            }
        } else {
            $_SESSION['message'] = serialize($dialogue);
            header('Location: /electionadmin');
        }
    } elseif ($_POST['button'] == 'begin_round') { # STARTA NYTT VAL
        $dialogue = new Dialogue();
        $input_ok = true;
        if ($_POST['round_name'] == '') {
            $input_ok = false;
            $dialogue->appendMessage(pickLanguage('Du har inte angett vad som ska väljas', 'You have not entered what to be elected'), 'error');
        }
        if ($_POST['code'] == '') {
            $input_ok = false;
            $dialogue->appendMessage(pickLanguage('Du har inte angett någon tillfällig kod', 'You have not entered any temporary code'), 'error');
        }
        if ($_POST['max_num'] == '') {
            $input_ok = false;
            $dialogue->appendMessage(pickLanguage('Du har inte angett hur många man får rösta på', 'You have not entered how many one can vote on'), 'error');
        }
        if ($evote->ongoingRound()) {
            $input_ok = false;
            $dialogue->appendMessage(pickLanguage('En valomgång är redan igång', 'An election is already in progress'), 'error');
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
            $dialogue->appendMessage(pickLanguage('Du måste ange minst två kandidater', 'You have alreadt entered two candidates'), 'error');
        }

        if ($input_ok) {
            $round_name = $_POST['round_name'];
            $code = $_POST['code'];
            $max = $_POST['max_num'];

            $insert_ok = $evote->newRound($round_name, $code, $max, $cands);

            if ($insert_ok) {
                $dialogue->appendMessage(pickLanguage('En ny valomgång har börjat', 'A new election round has begun'), 'success');
            } else {
                $dialogue->appendMessage(pickLanguage('Fel', 'Error'), 'error');
            }
        }
        $_SESSION['message'] = serialize($dialogue);
                //header("HTTP/1.1 301 Moved Permanently");
        header('Location: /electionadmin');
    } elseif ($_POST['button'] == 'end_round') { # AVSLUTA VALOMGÅNG KNAPPEN
                $evote->endRound();
        header('Location: /electionadmin');


    } elseif ($_POST['button'] == 'delete_election') { # TA BORT VAL KNAPPEN
        $dialogue = new Dialogue();
        $input_ok = true;
        if ($_POST['pswuser'] == '') {
            $input_ok = false;
            $dialogue->appendMessage(pickLanguage('Alla fält är inte ifyllda', 'All fields are not filled'), 'error');
        }

        $redirect = '';
        if ($input_ok) {
            $psw1 = $_POST['pswuser'];
            $current_usr = $_SESSION['user'];
            if ($evote->login($current_usr, $psw1)) {
                $evote->endSession();
                $dialogue->appendMessage(pickLanguage('Valet är nu stängt', 'The election is now closed'), 'success');
                $redirect = 'admin';
            } else {
                $dialogue->appendMessage(pickLanguage('Fel lösenord och/eller användarnamn någonstans', 'Wrong username and/or password somewhere'), 'error');
            }
        }
        $_SESSION['message'] = serialize($dialogue);
        header('Location: /adminmain');
    }
}
