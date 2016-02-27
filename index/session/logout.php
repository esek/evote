<?php
/*
$priv = $evote->getPrivilege($_SESSION["user"]);
if(isset($_SESSION["sideMenu"])){
switch($_SESSION["sideMenu"]){
    case 'useradmin':
        $mg->printUserhandlerPanelMenu(3);
        break;
    case 'adminmain':
        $mg->printAdminMenu(3);
        break;
    case 'electionadmin':
        $mg->printElectionadminPanelMenu(3);
        break;
    case 'adjust':
        $mg->printAdjustPanelMenu(2);
        break;
}
}
if($_SESSION["sideMenu"] == "adminaccount"){

}
*/
echo "<h3>Logga ut</h3>";
echo "<hr>";
echo "<div class=\"well\" style=\"max-width: 400px\">";
echo "<div>";
echo "Är du säker på att du vill logga ut?";
echo "</div>";
echo "<br>";
echo "<div>";
echo "<form action=actions/usersessionhandler.php method=\"POST\">";
echo "<button type=\"submit\" name=\"button\" value=\"logout\" class=\"btn btn-primary\" style=\"margin-bottom: 5px\">Logga ut</button>";
echo "</form>";
echo "</div>";
echo "</div>";


?>
