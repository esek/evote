<?php
require "data/evote.php";
$evote = new Evote();

$election_id = $evote->getElectionId();

$buttonstate = "disabled";
if($election_id != NULL){
	$buttonstate = "active";
}
?>
<p><?php #------------KNAPPRAD-------------
	$btns1 = "btn btn-success ".$buttonstate;
	$btns2 = "btn btn-danger ".$buttonstate;
	echo "<form action=actions/buttonhandler.php method=\"POST\">";
	echo "<button type=\"submit\" name=\"button\" value=\"stat\" class=\"$btns1\" style=\"margin-right: 5px; margin-bottom: 5px\" $buttonstate>Se tidigare omgångar</button>";
	echo "<button type=\"submit\" name=\"button\" value=\"print\" class=\"$btns1\" style=\"margin-right: 5px; margin-bottom: 5px\" $buttonstate>Skriv ut personliga koder</button>";
	echo "<button type=\"submit\" name=\"button\" value=\"clear\" class=\"$btns2\" style=\"margin-right: 5px; margin-bottom: 5px\" $buttonstate>Radera nuvarande val</button>";
	echo "<button type=\"submit\" name=\"button\" value=\"logout\" class=\"btn btn-primary\" style=\"margin-right: 5px\">Logga ut</button>";
	echo "</form>";
?></p>

<?php #-------------NYTT VAL--------------
if($election_id == NULL){ ?>

<div style="max-width: 300px">
<h3>Skapa nytt val</h3>
<form action="actions/buttonhandler.php" method="POST">
<div class="form-group">
        <label for="vn">Namn på val:</label>
        <input type="text" name="valnamn" class="form-control" id="vn">
</div>
<div class="form-group" style="max-width: 150px">
        <label for="ap">Max antal personer:</label>
        <input type="number" name="antal_personer" class="form-control" id="ap" min="1">
</div>
<button type="submit" class="btn btn-primary" value="create" name="button">Skapa</button>
</form>
</div>

<?php }else{
	$ongoing = $evote->ongoingRound();
	# ---------------NY VALOMGÅNG OCH VISA FÖRRA VALOMGÅNGEN --------------
	if(!$ongoing){?>
	 <div style="max-width: 300px">
        <h3>Skapa ny valomgång</h3>
        <form action="actions/buttonhandler.php" method="POST">
        <div class="form-group">
                <label for="usr">Vad som ska väljas:</label>
                <input type="text" class="form-control" name="round_name">
        </div>
	<p>Minst två av kandidatfälten måste vara ifyllda</p>
	<?php
	for($i = 0; $i < 5; $i++){
		$p = $i + 1;
		echo "<div class=\"form-group\">";
		echo "<label>Kandidat $p:</label>";
		echo "<input type=\"text\" class=\"form-control\" name=\"candidates[]\">";
        	echo "</div>";
	}
	?>
        <button type="submit" class="btn btn-primary" value="begin_round" name="button">Starta ny valomgång</button>
        </form>
        </div>
	<br><br>


	<h3>Förrgående valomgång</h3>
	<?php
		echo "<label for=\"res\">-POST-</label>";
	        echo "<table class=\"table table-striped\" style=\"max-width: 300px;\" id=\"res\">";
			$p = 1;
	                for($i = 0; $i < 5; $i++){
	                        echo "<tr><td class=\"col-md-2\">$p.</td>
	                                <td class=\"col-md-10\"> $i </td></tr>\n";
				$p++;
	                }
	        echo "</table>";
	?>

	
<?php
	
	# ------------- VALOMGÅNG PÅGÅR ----------------
	}else{	
		echo "<h3>Val pågår</h3>";
		echo "<label for=\"res\">-POST-</label>";
	        echo "<table class=\"table table-striped\" style=\"max-width: 300px;\" id=\"res\">";
			$p = 1;
	                for($i = 0; $i < 5; $i++){
	                        echo "<tr><td class=\"col-md-10\"> $i </td></tr>\n";
				$p++;
	                }
	        echo "</table>";
		echo "<form action=actions/buttonhandler.php method=\"POST\">";
		echo "<button type=\"submit\" class=\"btn btn-primary\" name=\"button\" value=\"end_round\">Avsluta valomgång</button>";
		echo "</form>";
	}

}
?>

