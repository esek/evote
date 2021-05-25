<?php
$access = array(1, 2);
$priv = $evote->getPrivilege($_SESSION["user"]);
if(in_array($priv, $access)){
    echo "<h3>Tidigare valomgångar</h3>";
    echo "<hr>";
    $tg->generateResultTable("all");
} else{
    echo "Du har inte behörighet att visa denna sida.";
}
?>
