<?php
#if(!($_SESSION["user"] == "adjust")){
#        echo "Du har inte behörighet att visa denna sida.";
#}else{

require "data/evote.php";
$evote = new Evote();

$election_id = $evote->getElectionId();

$buttonstate = "disabled";
if($election_id != NULL){
        $buttonstate = "active";
}
?>
<p><?php #------------KNAPPRAD-------------
        $btns1 = "btn btn-success ".$buttonstate;
        $btns2 = "btn btn-danger ".$buttonstate;
        echo "<form action=actions/buttonhandler.php method=\"POST\">";
	echo "<div class=\"btn-group\">";
        echo "<button type=\"submit\" name=\"button\" value=\"stat\" class=\"$btns1\" style=\"margin-bottom: 5px;\" $buttonstate>Se tidigare omgångar</button>";
        echo "<button type=\"submit\" name=\"button\" value=\"logout\" class=\"btn btn-primary\" style=\"margin-bottom: 5px\">Logga ut</button>";
	echo "</div>";
        echo "</form>";
?></p>

<?php
if($election_id !=  NULL){
	include "actions/genlastresult.php";
}else{
	echo "<h3>Det pågår inget val</h3>";
}

#}
?>
