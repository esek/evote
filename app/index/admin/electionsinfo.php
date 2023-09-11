<?php

$access = array(0);
$priv = $evote->getPrivilege($_SESSION["user"]);
if(in_array($priv, $access)){

    echo "<h3>".getLocalizedText("Usage history")."</h3>";
    echo "<hr>";
    $tg->generateOverview();

} else {
    echo getLocalizedText("You don't have permission to view this page.");
}
 ?>
