<?php
$access = array(1, 2);
$priv = $evote->getPrivilege($_SESSION["user"]);
if(in_array($priv, $access)){
    echo "<h3>".getLocalizedText("Previous election rounds")."</h3>";
    echo "<hr>";
    $tg->generateResultTable("all");
} else{
    echo getLocalizedText("You don't have permission to view this page.");
}
?>
