<?php

$access = array(0);
$priv = $evote->getPrivilege($_SESSION["user"]);
if(in_array($priv, $access)){

    echo "<h3>".pickLanguage("Användningshistorik", "Usage history")."</h3>";
    echo "<hr>";
    $tg->generateOverview();

} else {
    echoLanguageChoice("Du har inte behörighet att visa denna sida.", "You don't have permission to view this page");
}
 ?>
