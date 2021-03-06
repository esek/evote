<?php

session_start();
require '../data/evote.php';
require '../data/Dialogue.php';
require '../localization/getLocalizedText.php';

$evote = new Evote();

$access = array(0);
$priv = $evote->getPrivilege($_SESSION["user"]);
if(in_array($priv, $access)){
    if (isset($_POST['button'])) {
        if ($_POST['button'] == 'change') {
            $dialogue = new dialogue();
            $input_ok = true;
            if ($_POST['psw'] == '' || $_POST['username'] == '') {
                $input_ok = false;
                $dialogue->appendMessage(getLocalizedText('One or more of the fields were empty'), 'error');
            }
            if (!$evote->usernameExists($_POST['username'])) {
                $input_ok = false;
                $dialogue->appendMessage(getLocalizedText('The username you entered already exists'), 'error');
            }

            if ($input_ok) {
                $user = $_POST['username'];
                $psw = $_POST['psw'];
                $evote->newPassword($user, $psw);

                $dialogue->appendMessage(getLocalizedText('The password has been changed'), 'success');
            }
            $_SESSION['message'] = serialize($dialogue);
            header('Location: /useradmin/changepassword');
        } elseif ($_POST['button'] == 'new') {
            $dialogue = new dialogue();
            $input_ok = true;
            if ($_POST['psw'] == '' || $_POST['username'] == '' || $_POST['priv'] == '') {
                $input_ok = false;
                $dialogue->appendMessage(getLocalizedText('One or more of the fields were empty'), 'error');
            }
            if ($evote->usernameExists($_POST['username'])) {
                $input_ok = false;
                $dialogue->appendMessage(getLocalizedText('The username you entered already exists'), 'error');
            }

            if ($input_ok) {
                $user = $_POST['username'];
                $psw = $_POST['psw'];
                $priv = $_POST['priv'];
                $evote->createNewUser($user, $psw, $priv);
                $dialogue->appendMessage(getLocalizedText('A new user has been created'), 'success');
            }
            $_SESSION['message'] = serialize($dialogue);
            header('Location: /useradmin/newuser');


        } elseif ($_POST['button'] == 'delete_users') {
            $dialogue = new dialogue();
            $selected_users = $_POST['marked_users'];
            if (count($selected_users) > 0) {
                $evote->deleteUsers($selected_users);
                $dialogue->appendMessage(getLocalizedText('User deleted'), 'success');
                $msg = getLocalizedText('User deleted').'. ';
                $msgType = 'success';
            } else {
                $dialogue->appendMessage(getLocalizedText('You have not chosen any users to delete'), 'error');
            }

            $_SESSION['message'] = serialize($dialogue);
            header('Location: /useradmin');
        }
    }
}
