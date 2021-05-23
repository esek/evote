<?php
$access = array(2);
if(in_array($evote->getPrivilege($_SESSION["user"]), $access)){

$ongoingSession = $evote->ongoingSession();

$buttonstate = "disabled";
if($ongoingSession){
        $buttonstate = "active";
}
//$mg->printAdjustPanelMenu(0);

echo "<h3>".pickLanguage("Föregående valomgång", "Previous election round")."</h3>";
echo "<hr>";

if($ongoingSession){
	$tg->generateResultTable("last");
}else{
	echo "<h4>".pickLanguage("Det pågår inget val", "There is no ongoing election")."</h4>";
}

} else {
    echoLanguageChoice("Du har inte behörighet att visa denna sida.", "You don't have permission to view this page.");
}
?>
