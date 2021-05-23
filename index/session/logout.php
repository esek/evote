<?php
echo "<h3>".pickLanguage("Logga ut", "Log out")."</h3>";
echo "<hr>";
echo "<div class=\"well\" style=\"max-width: 400px\">";
echo "<div>";
echoLanguageChoice("Är du säker på att du vill logga ut?", "Are you sure you want to log out?");
echo "</div>";
echo "<br>";
echo "<div>";
echo "<form action=actions/usersessionhandler.php method=\"POST\">";
echo "<button type=\"submit\" name=\"button\" value=\"logout\" class=\"btn btn-primary\" style=\"margin-bottom: 5px\">".pickLanguage("Logga ut", "Log out")."</button>";
echo "</form>";
echo "</div>";
echo "</div>";
?>
