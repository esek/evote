<?php

session_start();
require '../data/evote.php';
require '../data/Dialogue.php';
include '../languagePicker.php';

$evote = new Evote();

if (isset($_POST['button'])) {
    if ($_POST['button'] == 'change') {
        $dialogue = new dialogue();
        $input_ok = true;
        $msg = '';
        $msgType = '';
        if ($_POST['psw'] == '' || $_POST['username'] == '') {
            $input_ok = false;
            $dialogue->appendMessage(pickLanguage('Något av fälten var tomma', 'One or more of the fields were empty'), 'error');
            $msg .= pickLanguage('Något av fälten var tomma. ', 'One or more of the fields were empty. ');
            $msgType = 'error';
        }
        if (!$evote->usernameExists($_POST['username'])) {
            $input_ok = false;
            $dialogue->appendMessage(pickLanguage('Användarnamnet du angav finns redan', 'The username you entered already exists'), 'error');
            $msg .= pickLanguage('Användarnamnet du angav finns redan. ', 'The username you entered already exists. ');
            $msgType = 'error';
        }

        if ($input_ok) {
            $user = $_POST['username'];
            $psw = $_POST['psw'];
            $evote->newPassword($user, $psw);

            $dialogue->appendMessage(pickLanguage('Lösenordet är bytt', 'The password has been changed'), 'success');
            $msg .= pickLanguage('Lösenordet är bytt. ', 'The password has been changed. ');
            $msgType = 'success';
        }
        $_SESSION['message'] = array('type' => $msgType, 'message' => $msg);
        $_SESSION['message'] = serialize($dialogue);
        header('Location: /useradmin/changepassword');
    } elseif ($_POST['button'] == 'new') {
        $dialogue = new dialogue();
        $input_ok = true;
        $msg = '';
        $msgType = '';
        if ($_POST['psw'] == '' || $_POST['username'] == '' || $_POST['priv'] == '') {
            $input_ok = false;
            $dialogue->appendMessage(pickLanguage('Något av fälten var tomma', 'One or more of the fields were empty'), 'error');
            $msg .= pickLanguage('Något av fälten var tomma. ', 'One or more of the fields were empty. ');
            $msgType = 'error';
        }
        if ($evote->usernameExists($_POST['username'])) {
            $input_ok = false;
            $dialogue->appendMessage(pickLanguage('Användarnamnet du angav finns redan', 'The username you entered already exists'), 'error');
            $msg .= pickLanguage('Användarnamnet du angav finns redan. ', 'The username you entered already exists. ');
            $msgType = 'error';
        }

        if ($input_ok) {
            $user = $_POST['username'];
            $psw = $_POST['psw'];
            $priv = $_POST['priv'];
            $evote->createNewUser($user, $psw, $priv);
            $dialogue->appendMessage(pickLanguage('En ny användare har skapats', 'A new user has been created'), 'success');
            $msg .= pickLanguage('En ny användare har skapats. ', 'A new user has been created. ');
            $msgType = 'success';
        }
        $_SESSION['message'] = array('type' => $msgType, 'message' => $msg);
        $_SESSION['message'] = serialize($dialogue);
        header('Location: /useradmin/newuser');


    } elseif ($_POST['button'] == 'delete_users') {
        $dialogue = new dialogue();
        $selected_users = $_POST['marked_users'];
        if (count($selected_users) > 0) {
            $evote->deleteUsers($selected_users);
            $dialogue->appendMessage(pickLanguage('Användare raderades', 'User deleted'), 'success');
            $msg = pickLanguage('Användare raderades. ', 'User deleted. ');
            $msgType = 'success';
        } else {
            $dialogue->appendMessage(pickLanguage('Du har inte valt några användare att radera', 'You have not chosen any users to delete'), 'error');
            $msg = pickLanguage('Du har inte valt några användare att radera. ', 'You have not chosen any users to delete. ');
            $msgType = 'error';
        }

        $_SESSION['message'] = array('type' => $msgType, 'message' => $msg);
        $_SESSION['message'] = serialize($dialogue);
        header('Location: /useradmin');
    }
}
