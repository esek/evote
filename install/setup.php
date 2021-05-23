<?php
require '../data/RandomInfo.php';
require '../data/Dialogue.php';
include '../languagePicker.php';

$dialogue = new dialogue();

$startup = true;
$filename = '../data/config.php';
if (file_exists($filename)) {
    $startup = false;
}

if (isset($_POST['db_host']) &&
    isset($_POST['db_name']) &&
    isset($_POST['db_user']) &&
    isset($_POST['db_pass']) &&
    isset($_POST['su_name']) &&
    isset($_POST['su_pass1']) &&
    isset($_POST['su_pass2']) &&
    $startup) {
    $db_host = $_POST['db_host'];
    $db_name = $_POST['db_name'];
    $db_user = $_POST['db_user'];
    $db_pass = $_POST['db_pass'];
    $su_name = $_POST['su_name'];
    $su_pass1 = $_POST['su_pass1'];
    $su_pass2 = $_POST['su_pass2'];

    if ($db_host != '' && $db_name != '' && $db_user != '' && $db_pass != '' && $su_name != '' && $su_pass1 != '' && $su_pass2 != '') {
        if ($su_pass1 == $su_pass2) {

            // Generate strong constant salt, taken from PHP forums
            function generateRandomToken($length = 32){
                if(!isset($length) || intval($length) <= 8 ){
                  $length = 32;
                }
                if (function_exists("random_bytes")) {
                    return bin2hex(random_bytes($length));
                }
                if (function_exists("mcrypt_create_iv")) {
                    return bin2hex(mcrypt_create_iv($length, MCRYPT_DEV_URANDOM));
                }
                if (function_exists("openssl_random_pseudo_bytes")) {
                    return bin2hex(openssl_random_pseudo_bytes($length));
                }
            }
            
            function generatePepper(){
                // $6$ denotes SHA-512
                return substr(strtr(base64_encode(hex2bin(generateRandomToken(32))), "+", "."), 0, 44);
            }

            $local_const_hash_pepper = generatePepper();

            // Content of config.php
            $content = "<?php\n";
            $content .= "define(\"MYSQL_PASS\", \"$db_pass\");\n";
            $content .= "define(\"MYSQL_USER\", \"$db_user\");\n";
            $content .= "define(\"MYSQL_DB\", \"$db_name\");\n";
            $content .= "define(\"MYSQL_HOST\", \"$db_host\");\n";
            $content .= "define(\"SUPERUSER\", \"$su_name\");\n";
            $content .= "define(\"LOCAL_CONST_HASH_PEPPER\", \"$6$\".\"$local_const_hash_pepper\".\"$\");\n"; // Used for personal codes, needs to be constant
            $content .= '?>';

            $file = fopen($filename, 'w') or die('Unable to open file!');
            fwrite($file, $content);
            fclose($file);
            $dialogue->appendMessage(pickLanguage('Konfigurationen lyckades!', 'Configuration successfull!'), 'success');

            include '../data/evote.php';
            $evote = new Evote();
            if(!$evote->usernameExists($su_name)){
                $evote->createNewUser($su_name, $su_pass1, 0);
            }else{
                $dialogue->appendMessage(pickLanguage('En avändare med det namnet fanns redan i databasen.', 'An user with that name already exists in the database.'), 'info');
            }
            $startup = false;


        }else{
            $dialogue->appendMessage(pickLanguage('Lösenorden för superuser stämmer inte överens. Försök igen.', 'The passwords for superuser does not match. Try again.'), 'error');
        }
    }else{
        $dialogue->appendMessage(pickLanguage('Alla fällt är inte ifyllda.', 'All fields not filled in'), 'error');
    }
}

$_SESSION['message'] = serialize($dialogue);

?>
<!DOCTYPE HTML>

<html>
<head>
    <title>E-vote Setup</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/evote.css" rel="stylesheet">
</head>
<body>
    <?php
    if(isset($_SESSION['message']) && is_string($_SESSION['message']) && $_SESSION['message'] != ''){
        $d = unserialize($_SESSION['message']);
        $d->printAlerts();
        unset($_SESSION['message']);
    }
    ?>
    <div class="center">
        <h3>E-vote setup</h3>
        <?php
        if ($startup) {
        ?>
        <div class="well">
            <?php
            echoLanguageChoice("Hej! Vad kul att just ni vill börja använda E-vote.\n
            <br>\n
            <br> Fyll i datan som gäller för ditt system nedan för att konfigurera.\n
            <br> Se till att skriva in rätt värden för att inte behöva ändra dessa manuelt efteråt.",
            "Hi! How fun that you want to start using E-vote.\n
            <br>\n
            <br> Fill out the form according to your setup to configure.\n
            <br> Make sure to put in the correct values so they don't have to be changed manually afterwards.")
            ?>
        </div>

        <form action="" method="POST">
            <div class="well">
                <h4><strong><?php echoLanguageChoice("Databaskonfiguration", "Database configuration")?></strong></h4>
                <hr>
                <div class="form-group">
                    <label for="usr">Host:</label>
                    <input type="text" class="form-control" name="db_host" <?php echo isset($db_host) ? 'value="'.$db_host.'"' : '';
            ?>autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="pwd"><?php echoLanguageChoice("Databasnamn:", "Database name:")?></label>
                    <input type="text" class="form-control" name="db_name" <?php echo isset($db_host) ? 'value="'.$db_name.'"' : '';
            ?>autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="pwd"><?php echoLanguageChoice("Användare:", "User:")?></label>
                    <input type="text" class="form-control" name="db_user" <?php echo isset($db_host) ? 'value="'.$db_user.'"' : '';
            ?>autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="pwd"><?php echoLanguageChoice("Lösenord:", "Password:")?></label>
                    <input type="password" class="form-control" name="db_pass" <?php echo isset($db_host) ? 'value="'.$db_pass.'"' : '';
            ?>autocomplete="off">
                </div>
            </div>
            <div class="well">
                <h4><strong>Superuser</strong></h4>
                <?php echoLanguageChoice("Detta är användaren som har full kontrol på systemet. Denna användare kan inte raderas från databasen.", 
                "This is the user that has full control of the system. This user can't be deleted from the database.")?>
                <hr>
                <div class="form-group">
                    <label for="usr"><?php echoLanguageChoice("Namn:", "Name:")?></label>
                    <input type="text" class="form-control" name="su_name" <?php echo isset($db_host) ? 'value="'.$su_name.'"' : '';
            ?>autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="pwd"><?php echoLanguageChoice("Lösenord:", "Password:")?></label>
                    <input type="password" class="form-control" name="su_pass1">
                </div>
                <div class="form-group">
                    <label for="pwd"><?php echoLanguageChoice("Upprepa lösenord:", "Repeat password:")?></label>
                    <input type="password" class="form-control" name="su_pass2">
                </div>
            </div>
            <div class="span7 text-center" style="margin-bottom:50px;">
            <button type="submit" class="btn btn-primary" name="button" value="login" name="login"><?php echoLanguageChoice("Spara", "Save")?></button>
            </div>

        </form>

        <?php

        } else {
            ?>

        <div class="well">
            <?php echoLanguageChoice("E-vote är konfigurerat!", "E-vote is configured!")?>
        </div>

        <?php

        }
        ?>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/js/bootstrap.min.js"></script>

    <footer class="text-center col-sm-offset-3">
        <div class="text-center p-3">
            <h5>Language: <a href="#" onclick="addURLParameter('lang', 'sv')">🇸🇪 Svenska</a> | <a href="#" onclick="addURLParameter('lang', 'en')">🇬🇧 English</a></h5>
            <p><?php echoLanguageChoice("Skapad av Informationsutskottet inom E-sektionen inom TLTH", "Created by Informationsutskottet at E-sektionen at TLTH")?><p>
            <p><?php echoLanguageChoice("E-vote är öppen och fri mjukvara licenserad under MPL-2.0. Källkod hittas på",
            "E-vote is open and free software licensed under MPL-2.0. Source code can be found at")?> <a href="https://github.com/esek/evote" target="_blank">github.com/esek/evote</a></p>
        </div>
    </footer>
    <!-- Add language URL parameter -->
    <script>
    function addURLParameter(name, value) {
        var searchParams = new URLSearchParams(window.location.search)
        searchParams.set(name, value)
        window.location.search = searchParams.toString()
    }
    </script>

</body>
</html>
