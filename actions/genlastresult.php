<?php
if($evote->verifyUser($_SESSION["user"], 0) || $evote->verifyUser($_SESSION["user"], 1)){
    $evote = new Evote();
    $res = $evote->getLastResult();
    if ($res->num_rows > 0) {
?>


    <div style="max-width: 400px">
		<h3>Förrgående valomgång</h3>
		<?php
		echo "<table class=\"table table\">";
		$head = "";
		$p = 1;
        	while($row = $res->fetch_assoc()) {
        		if($head != $row["e_name"]){
        			echo "<tr style=\"background-color: rgb(232,232,232);\"><th colspan=\"2\">".$row["e_name"]."</th></tr>";
        			$head = $row["e_name"];
        			$p = 1;
        		}
        		echo "<tr><td class=\"col-md-3\">$p. (".$row["votes"].") </td>
                        	<td class=\"col-md-9\">".$row["name"]."</td></tr>\n";
                        $p++;
         	}
         	echo "</table>";
		?>
		</div>
<?php
    }
}
?>
