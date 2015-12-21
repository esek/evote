<?php

$priv = $evote->getPrivilege($_SESSION["user"]);
switch($priv){
    case 0:
        $mg->printUserhandlerPanelMenu(3);
        break;
    case 1:
        $mg->printAdminPanelMenu(3);
        break;
    case 2:
        $mg->printAdjustPanelMenu(2);
        break;
}

echo "<h3>Logga ut</h3>";
echo "<hr>";
echo "<div style=\"max-width: 400px\">";
echo "Är du säker på att du vill logga ut?";
echo "</div>";
echo "<br>";
echo "<div style=\"max-width: 400px\">";
echo "<form action=actions/usersessionhandler.php method=\"POST\">";
echo "<button type=\"submit\" name=\"button\" value=\"logout\" class=\"btn btn-primary\" style=\"margin-bottom: 5px\">Logga ut</button>";
echo "</form>";
echo "</div>";


?>
