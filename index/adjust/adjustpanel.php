<?php
$access = array(2);
if(in_array($evote->getPrivilege($_SESSION["user"]), $access)){

$ongoingSession = $evote->ongoingSession();

echo "<h3>".getLocalizedText("Previous election round")."</h3>";
echo "<hr>";

if($ongoingSession){
	$tg->generateResultTable("last");
}else{
<<<<<<< HEAD
	echo "<h4>".getLocalizedText("There is no ongoing election session.")."</h4>";
=======
	echo "<h4>".getLocalizedText("There is no ongoing election.")."</h4>";
>>>>>>> 89bd7935d21132f01f898f3d772019a1639efab6
}

} else {
    echo getLocalizedText("You don't have permission to view this page.");
}
?>
