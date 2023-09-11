<?php
$access = array(2);
if(in_array($evote->getPrivilege($_SESSION["user"]), $access)){

$ongoingSession = $evote->ongoingSession();

echo "<h3>".getLocalizedText("Previous election round")."</h3>";
echo "<hr>";

if($ongoingSession){
	$tg->generateResultTable("last");
}else{
	echo "<h4>".getLocalizedText("There is no ongoing election session.")."</h4>";
}

} else {
    echo getLocalizedText("You don't have permission to view this page.");
}
?>
