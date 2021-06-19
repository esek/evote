<?php
echo "<h3>".getLocalizedText("Log out")."</h3>";
echo "<hr>";
echo "<div class=\"well\" style=\"max-width: 400px\">";
echo "<div>";
echo getLocalizedText("Are you sure you want to log out?");
echo "</div>";
echo "<br>";
echo "<div>";
echo "<form action=/actions/usersessionhandler.php method=\"POST\">";
echo "<button type=\"submit\" name=\"button\" value=\"logout\" class=\"btn btn-primary\" style=\"margin-bottom: 5px\">".getLocalizedText("Log out")."</button>";
echo "</form>";
echo "</div>";
echo "</div>";
?>
