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
	echo "<button type=\"submit\" name=\"button\" value=\"stat\" class=\"$btns1\" style=\"margin-right: 5px; margin-bottom: 5px\">Se statistik</button>";
	echo "<button type=\"submit\" name=\"button\" value=\"print\" class=\"$btns1\" style=\"margin-right: 5px; margin-bottom: 5px\">Skriv ut personliga koder</button>";
	echo "<button type=\"submit\" name=\"button\" value=\"clear\" class=\"$btns2\" style=\"margin-right: 5px; margin-bottom: 5px\">Radera nuvarande val</button>";
	echo "<button type=\"submit\" name=\"button\" value=\"logout\" class=\"btn btn-primary\" style=\"margin-right: 5px\">Logga ut</button>";
	echo "</form>";
?></p>

<?php #-------------NYTT VAL--------------
if($election_id == NULL){ ?>

<div style="width: 300px">
<h3>Skapa nytt val</h3>
<form method="POST">
<div class="form-group">
        <label for="usr">Namn på val:</label>
        <input type="text" class="form-control" id="usr">
</div>
<div class="form-group" style="width: 150px">
        <label for="pwd">Max antal personer:</label>
        <input type="number" name="antal_personer" class="form-control" id="ap" min="1">
</div>
<input type="submit" class="btn btn-primary" value="Skapa val" name="new_election">
</form>
</div>

<?php }else{
	$ongoing = $evote->ongoingRound();
	# ---------------NY VALOMGÅNG OCH VISA FÖRRA VALOMGÅNGEN --------------
	if(!$ongoing){?>
	 <div style="width: 300px">
        <h3>Skapa ny valomgång</h3>
        <form method="POST">
        <div class="form-group">
                <label for="usr">Vad som ska väljas:</label>
                <input type="text" class="form-control" id="val_session">
        </div>
	<p>Kandidatfälten nedan kan ev. lämnas tomma</p>
        <div class="form-group">
                <label for="kand1">Kandidat 1:</label>
                <input type="text" class="form-control" id="kand1">
        </div>
        <div class="form-group">
                <label for="kand2">Kandidat 2:</label>
                <input type="text" class="form-control" id="kand2">
        </div>
        <div class="form-group">
                <label for="kand3">Kandidat 3:</label>
                <input type="text" class="form-control" id="kand3">
        </div>
        <div class="form-group">
                <label for="kand4">Kandidat 4:</label>
                <input type="text" class="form-control" id="kand4">
        </div>
        <input type="submit" class="btn btn-primary" value="Skapa" name="new_session">
        </form>
        </div>
	<br><br>


	<h3>Förrgående valomgång</h3>
	<?php
		echo "<label for=\"res\">-POST-</label>";
	        echo "<table class=\"table table-striped\" style=\"width: 300px;\" id=\"res\">";
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
	        echo "<table class=\"table table-striped\" style=\"width: 300px;\" id=\"res\">";
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

