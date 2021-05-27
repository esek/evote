<?php

session_start();
require '../data/evote.php';
require '../data/Dialogue.php';
$evote = new Evote();

$access = array(0);
$priv = $evote->getPrivilege($_SESSION["user"]);
if(in_array($priv, $access)){
    if (isset($_POST['button'])) {
        if ($_POST['button'] == 'change') {
            $dialogue = new dialogue();
            $input_ok = true;
            $msg = '';
            $msgType = '';
            if ($_POST['psw'] == '' || $_POST['username'] == '') {
                $input_ok = false;
                $dialogue->appendMessage('Något av fälten var tomma', 'error');
                $msg .= 'Något av fälten är tomma.';
                $msgType = 'error';
            }
            if (!$evote->usernameExists($_POST['username'])) {
                $input_ok = false;
                $dialogue->appendMessage('Användaren du angav finns inte', 'error');
                $msg .= 'Användarnamnet du angav finns redan. ';
                $msgType = 'error';
            }

            if ($input_ok) {
                $user = $_POST['username'];
                $psw = $_POST['psw'];
                $evote->newPassword($user, $psw);

                $dialogue->appendMessage('Lösenordet är bytt', 'success');
                $msg .= 'Lösenordet är bytt ';
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
                $dialogue->appendMessage('Något av fälten var tomma', 'error');
                $msg .= 'Något av fälten är tomma.';
                $msgType = 'error';
            }
            if ($evote->usernameExists($_POST['username'])) {
                $input_ok = false;
                $dialogue->appendMessage('Användarnamnet du angav finns redan', 'error');
                $msg .= 'Användarnamnet du angav finns redan. ';
                $msgType = 'error';
            }

            if ($input_ok) {
                $user = $_POST['username'];
                $psw = $_POST['psw'];
                $priv = $_POST['priv'];
                $evote->createNewUser($user, $psw, $priv);
                $dialogue->appendMessage('En ny användare har skapats', 'success');
                $msg .= 'En ny användare har skapats ';
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
                $dialogue->appendMessage('Användare raderades', 'success');
                $msg = 'Användare raderades. ';
                $msgType = 'success';
            } else {
                $dialogue->appendMessage('Du har inte valt några användare att radera', 'error');
                $msg = 'Du har inte valt några användare att radera. ';
                $msgType = 'error';
            }

            $_SESSION['message'] = array('type' => $msgType, 'message' => $msg);
            $_SESSION['message'] = serialize($dialogue);
            header('Location: /useradmin');
        }
    }
}
