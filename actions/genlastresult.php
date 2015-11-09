<?php
if(isset($_SESSION["user"]) && ($_SESSION["user"] == "adjust" || ($_SESSION["user"] == "admin"))){
?>

<div style="max-width: 400px">
<h3>Förrgående valomgång</h3>
<?php
	echo "<table class=\"table table\">";
        echo "<tr style=\"background-color: rgb(232,232,232);\"><th colspan=\"2\">-POST-</th></tr>";
        	$p = 1;
                for($i = 0; $i < 5; $i++){
                	echo "<tr><td class=\"col-md-1\">$p.</td>
                        	<td class=\"col-md-11\"> $i </td></tr>\n";
                        $p++;
                }
	echo "</table>";
?>
</div>
<?php
}
?>
