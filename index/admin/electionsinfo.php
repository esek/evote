<?php

$access = array(0);
$priv = $evote->getPrivilege($_SESSION["user"]);
if(in_array($priv, $access)){

    echo "<h3>Användningshistorik</h3>";
    echo "<hr>";
    $tg->generateOverview();

} else {
    echo "Du har inte behörighet att visa denna sida";
}

 ?>
