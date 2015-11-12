<?php
if(!($evote->verifyUser($_SESSION["user"], 1) || $evote->verifyUser($_SESSION["user"], 2))){

        echo "Du har inte behörighet att visa denna sida.";
}else{
    
    
    echo "<h3>Tidigare valomgångar</h3>";
    $res = $evote->getResult();
    if ($res->num_rows > 0) {
?>
    	<div style="max-width: 400px">
		<?php
		echo "<table class=\"table table\">";
		$e_id = -1;
		$p = 1;
        	while($row = $res->fetch_assoc()) {
                        $tot = $row["tot"];
                        $precent = "- ";
                        if($tot != 0){
                            $precent = number_format(($row["votes"]/$tot)*100,1 ) . ' %';
                        }
        		if($e_id != $row["e_id"]){
        			echo "<tr style=\"background-color: rgb(232,232,232);\"><th colspan=\"2\">".$row["e_name"]." ($tot röster)</th></tr>";
        			$e_id = $row["e_id"];
        			$p = 1;
                        }
        		echo "<tr><td class=\"col-md-4\"><b>$p</b> (".$row["votes"].", $precent) </td>
                        	<td class=\"col-md-8\">".$row["name"]."</td></tr>\n";
                        $p++;
         	}
         	echo "</table>";
		?>
		</div>
    
<?php
    }else{
        echo "Ingenting har valts ännu";
    }
}
?>
