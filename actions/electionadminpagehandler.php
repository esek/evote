<?php

session_start();
require '../data/evote.php';
$evote = new Evote();

if (isset($_POST['button'])) {
    if ($_POST['button'] == 'create') { # SKAPA NYTT VAL
        $input_ok = true;
        $msg = '';
        $msgType = '';
        if ($_POST['valnamn'] == '') {
            $input_ok = false;
            $msg .= 'Du har inte angett något namn på valet. ';
            $msgType = 'error';
        }
        if ($_POST['antal_personer'] == '') {
            $input_ok = false;
            $msg .= 'Du har inte angett det maximala antalet personer. ';
            $msgType = 'error';
        }
        if ($evote->ongoingSession()) {
            $input_ok = false;
            $msg .= 'Det pågår redan ett val. ';
            $msgType = 'error';
        }

        if ($input_ok) {
            $name = $_POST['valnamn'];
            $nop = $_POST['antal_personer'];

            require '../ecrypt.php';
            $ecrypt = new ECrypt();
            $codes = $ecrypt->generate_otp($nop);
            $evote->newCodes($codes);
            $evote->newSession($name);
            include 'codeprint.php';
        } else {
            $_SESSION['message'] = array('type' => $msgType, 'message' => $msg);
            header('Location: /electionadmin');
        }
    } elseif ($_POST['button'] == 'begin_round') { # STARTA NYTT VAL
        $input_ok = true;
        $msg = '';
        $msgType = '';
        if ($_POST['round_name'] == '') {
            $input_ok = false;
            $msg .= 'Du har inte angett vad som ska väljas. ';
            $msgType = 'error';
        }
        if ($_POST['code'] == '') {
            $input_ok = false;
            $msg .= 'Du har inte angett någon tillfällig kod. ';
            $msgType = 'error';
        }
        if ($_POST['max_num'] == '') {
            $input_ok = false;
            $msg .= 'Du har inte angett hur många man får rösta på. ';
            $msgType = 'error';
        }
        if ($evote->ongoingRound()) {
            $input_ok = false;
            $msg .= 'En valomgång är redan igång. ';
            $msgType = 'error';
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
            $msg .= 'Du måste ange minst två kandidater. ';
            $msgType = 'error';
        }

        if ($input_ok) {
            $round_name = $_POST['round_name'];
            $code = $_POST['code'];
            $max = $_POST['max_num'];

            $insert_ok = $evote->newRound($round_name, $code, $max, $cands);

            if ($insert_ok) {
                $msg .= 'En ny valomgång har börjat. ';
                $msgType = 'success';
            } else {
                $msg .= 'Fel. ';
                $msgType = 'error';
            }
        }
        $_SESSION['message'] = array('type' => $msgType, 'message' => $msg);
                //header("HTTP/1.1 301 Moved Permanently");
        header('Location: /electionadmin');
    } elseif ($_POST['button'] == 'end_round') { # AVSLUTA VALOMGÅNG KNAPPEN
                $evote->endRound();
        header('Location: /electionadmin');
    } elseif ($_POST['button'] == 'delete_election') { # TA BORT VAL KNAPPEN
        $input_ok = true;
        $msg = '';
        $msgType = '';
        if ($_POST['pswuser'] == '') {
            $input_ok = false;
            $msg .= 'Alla fält är inte ifyllda. ';
            $msgType = 'error';
        }
        $redirect = 'clear';
        if ($input_ok) {
            $psw1 = $_POST['pswuser'];
            $current_usr = $_SESSION['user'];
            if ($evote->login($current_usr, $psw1)) {
                if ($evote->verifyUser($name_pageadmin, 0)) {
                    $evote->endSession();
                    $msg .= 'Valet är nu stängt. ';
                    $msgType = 'success';
                    $redirect = 'admin';
                } else {
                    $msg .= 'Rättighetsfel. ';
                    $msgType = 'error';
                }
            } else {
                $msg .= 'Fel lösenord och/eller användarnamn någonstans. ';
                $msgType = 'error';
            }
        }
        $_SESSION['message'] = array('type' => $msgType, 'message' => $msg);
        header('Location: /'.$redirect);
    }
}
