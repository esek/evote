<?php
$access = array(2);
if(in_array($evote->getPrivilege($_SESSION["user"]), $access)){

$ongoingSession = $evote->ongoingSession();

echo "<h3>Föregående valomgång</h3>";
echo "<hr>";

if($ongoingSession){
	$tg->generateResultTable("last");
}else{
	echo "<h4>Det pågår inget val</h4>";
}

} else {
    echo "Du har inte behörighet att visa denna sida.";
}
?>
