<?php
	$election_exists = TRUE;
	if(!$election_exists){
		echo "<p><h3>DET FINNS INGET PÅGÅENDE VAL</h3></p><br>";
	}else{

		$ongoing = TRUE;
		
		if(!$ongoing){
			echo "<p><h3>DET FINNS INGET ATT RÖSTA PÅ</h3></p><br>";
		}else{
?>

			<div>
			<h3>Röstning pågår:<br><small>-POST-</small></h3>
			<form method="POST">
			<fieldset>
			<?php
				echo "<table class=\"table table-striped\" style=\"width: 300px;\">";	
					for($i = 0; $i < 5; $i++){
						echo "<tr><td class=\"col-md-2\"><input type=\"radio\" name=\"person\" value=$i>
							<td class=\"col-md-10\"> $i </td></tr>\n";
					}
				echo "</table>";
			?>
			<div class="form-group">
			<label >Personlig valkod:</label>
			<input type="text" class="form-control" id="code" name="code" style="width: 300px";>	
			</div>
			<br>
			<input type="submit" class="btn btn-primary" value="Rösta!" name="votesubmit">
			</fieldset>
			</form>
			</div>
<?php
		}
	}
?>
