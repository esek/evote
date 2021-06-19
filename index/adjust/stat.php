<?php
$access = array(1, 2);
$priv = $evote->getPrivilege($_SESSION["user"]);
if(in_array($priv, $access)){
    echo "<h3>".pickLanguage("Tidigare valomgångar", "Previous election rounds")."</h3>";
    echo "<hr>";
    $tg->generateResultTable("all");
} else{
    echoLanguageChoice("Du har inte behörighet att visa denna sida.", "You don't have permission to view this page.");
}
?>
