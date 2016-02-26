<?php

$access = array(0);
$priv = $evote->getPrivilege($_SESSION["user"]);
if(in_array($priv, $access)){
    //$mg->printAdminMenu(2);


} else {
    echo "Du har inte behörighet att visa denna sida";
}

 ?>
