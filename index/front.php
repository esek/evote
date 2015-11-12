<?php

if(!$evote->ongoingSession()){
	echo "<p><h3>DET FINNS INGET PÅGÅENDE VAL</h3></p><br>";
}else{
	$ongoing = $evote->ongoingRound();

	if(!$ongoing){
		echo "<p><h3>DET FINNS INGET ATT RÖSTA PÅ</h3></p><br>";
	}else{
            $res = $evote->getOptions();
            if($res->num_rows > 0){
?>
		<div style="max-width: 400px">
		<h3>Röstning pågår:</h3>
		<form action="actions/buttonhandler.php" method="POST" autocomplete="off">
		<?php
                        $head = "";
			echo "<table class=\"table table\">";	
                                while($row = $res->fetch_assoc()){
                                    if($head != $row["e_name"]){
			                echo "<tr style=\"background-color: rgb(232,232,232);\"><th colspan=\"2\">".$row["e_name"]."</th></tr>";
                                        $head = $row["e_name"];
                                    }
					echo "<tr><td class=\"col-md-1 col-xs-1\"><input type=\"radio\" name=\"person\" value=".$row["id"]."></td>
						<td class=\"col-md-11 col-xs-11\">".$row["name"]." </td></tr>\n";
				}
			echo "</table>";
		?>
		<div class="form-group">
		<label >Personlig valkod:</label>
		<input type="text" class="form-control" name="code1">	
		</div>
		<div class="form-group">
		<label >Tillfällig valkod:</label>
		<input type="text" class="form-control" name="code2">	
		</div>
		<br>
		<button type="submit" class="btn-lg btn-primary" value="vote" name="button">Rösta!</button>
		</form>
		</div>
<?php
            }
		}
	}
?>
