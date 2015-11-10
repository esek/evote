<?php
require 'data/evote.php';
$evote = new Evote();
$election_id = $evote->getElectionId();

if($election_id == NULL){
	echo "<p><h3>DET FINNS INGET PÅGÅENDE VAL</h3></p><br>";
}else{
	$ongoing = $evote->ongoingRound();

	if(!$ongoing){
		echo "<p><h3>DET FINNS INGET ATT RÖSTA PÅ</h3></p><br>";
	}else{
?>
		<div style="max-width: 400px">
		<h3>Röstning pågår:</h3>
		<form action="actions/buttonhandler.php" method="POST" autocomplete="off">
		<?php
			echo "<table class=\"table table\">";	
			echo "<tr style=\"background-color: rgb(232,232,232);\"><th colspan=\"2\">-POST-</th></tr>";
				for($i = 0; $i < 5; $i++){
					echo "<tr><td class=\"col-md-1\"><input type=\"radio\" name=\"person\" value=$i></td>
						<td class=\"col-md-11\"> $i </td></tr>\n";
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
		<button type="submit" class="btn btn-primary" value="vote" name="button">Rösta!</button>
		</form>
		</div>
<?php
		}
	}
?>
