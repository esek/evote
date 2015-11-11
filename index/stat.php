<?php
if(!($evote->verifyUser($_SESSION["user"], 0) || $evote->verifyUser($_SESSION["user"], 1))){

        echo "Du har inte behörighet att visa denna sida.";
}else{
    
    
    $res = $evote->getResult();
    if ($res->num_rows > 0) {
?>
    	<div style="max-width: 400px">
		<h3>Tidigare valomgångar</h3>
		<?php
		echo "<table class=\"table table\">";
		$e_id = -1;
		$p = 1;
        	while($row = $res->fetch_assoc()) {
        		if($e_id != $row["e_id"]){
        			echo "<tr style=\"background-color: rgb(232,232,232);\"><th colspan=\"2\">".$row["e_name"]."</th></tr>";
        			$e_id = $row["e_id"];
        			$p = 1;
        		}
        		echo "<tr><td class=\"col-md-3\">$p (".$row["votes"].") </td>
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
