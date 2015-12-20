<?php
$access = array(2);
if(in_array($evote->getPrivilege($_SESSION["user"]), $access)){

$ongoingSession = $evote->ongoingSession();

$buttonstate = "disabled";
if($ongoingSession){
        $buttonstate = "active";
}
$mg->printAdjustPanelMenu(0);

echo "<h3>Föregående omgång</h3>";
echo "<hr>";

if($ongoingSession){
	$tg->generateResultTable("last");
}else{
	echo "<h3>Det pågår inget val</h3>";
}

} else {
    echo "Du har inte behörighet att visa denna sida.";
}
?>
