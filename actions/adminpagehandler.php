<?php

session_start();
require '../data/evote.php';
require '../localization/getLocalizedText.php';
require '../data/Dialogue.php';
$evote = new Evote();

$access = array(0);
$priv = $evote->getPrivilege($_SESSION["user"]);
if(in_array($priv, $access)){
    if (isset($_POST['button'])) {
        if ($_POST['button'] == 'create') { # CREATE NEW ELECTION
            $dialogue = new Dialogue();
            $input_ok = true;
            if ($_POST['valnamn'] == '') {
                $input_ok = false;
                $dialogue->appendMessage(getLocalizedText('You have not entered a name for the election'), 'error');
            }
            if ($_POST['antal_personer'] == '') {
                $input_ok = false;
                $dialogue->appendMessage(getLocalizedText('You have not entered the max number of people'), 'error');
            }
            if ($evote->ongoingSession()) {
                $input_ok = false;
                $dialogue->appendMessage(getLocalizedText('There is already an election in progress'), 'error');
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
                // If you are holding election from home and want codes as CSV instead
                if (isset($_POST['csv_checkbox'])) {
                    include 'csvcodesend.php';
                } else {
                    include 'codeprint.php';
                }
            } else {
                $_SESSION['message'] = serialize($dialogue);
                header('Location: /adminmain/electioncontrol');
            }
        } elseif ($_POST['button'] == 'delete_election') { # Remove-election button
            $dialogue = new Dialogue();
            $input_ok = true;
            if ($_POST['pswuser'] == '') {
                $input_ok = false;
                $dialogue->appendMessage(getLocalizedText('All fields are not filled in'), 'error');
            }

            $redirect = '';
            if ($input_ok) {
                $psw1 = $_POST['pswuser'];
                $current_usr = $_SESSION['user'];
                if ($evote->login($current_usr, $psw1)) {
                    $evote->endSession();
                    $dialogue->appendMessage(getLocalizedText('The election is now closed'), 'success');
                    $redirect = 'admin';
                } else {
                    $dialogue->appendMessage(getLocalizedText('Wrong username and/or password somewhere'), 'error');
                }
            }
            $_SESSION['message'] = serialize($dialogue);
            header('Location: /adminmain');
        }
    }
}
