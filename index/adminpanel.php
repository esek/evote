<?php
if(!($_SESSION["user"] == "admin")){
	echo "Du har inte behörighet att visa denna sida.";
}else{
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
	echo "<div class=\"btn-group\">";
	echo "<button type=\"submit\" name=\"button\" value=\"stat\" class=\"$btns1\" style=\"margin-bottom: 5px\" $buttonstate>Se tidigare omgångar</button>";
	echo "<button type=\"submit\" name=\"button\" value=\"print\" class=\"$btns1\" style=\"margin-bottom: 5px\" $buttonstate>Skriv ut personliga koder</button>";
	echo "<button type=\"submit\" name=\"button\" value=\"clear\" class=\"$btns2\" style=\"margin-bottom: 5px\" $buttonstate>Radera nuvarande val</button>";
	echo "<button type=\"submit\" name=\"button\" value=\"logout\" class=\"btn btn-primary\" style=\"margin-bottom: 5px\">Logga ut</button>";
	echo "</div>";
	echo "</form>";
?></p>

<?php #-------------NYTT VAL--------------
if($election_id == NULL){ ?>

	<div style="max-width: 400px">
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
		<div style="max-width: 400px">
	        <h3>Skapa ny valomgång</h3>
	        <form action="actions/buttonhandler.php" method="POST">
	        <div class="form-group">
	                <label>Vad som ska väljas:</label>
	                <input type="text" class="form-control" name="round_name" autocomplete="off">
			</div>
	        <div class="form-group">
	                <label>Tillfällig kod:</label>
	                <input type="text" class="form-control" name="code" autocomplete="off">
	        </div>
<!-- 		<?php
		for($i = 0; $i < 5; $i++){
			$p = $i + 1;
			echo "<div class=\"form-group\">";
			echo "<label>Kandidat $p:</label>";
			echo "<input type=\"text\" class=\"form-control\" name=\"candidates[]\" autocomplete=\"off\">";
	        	echo "</div>";
		}
?> -->
                <br>
                <div><h4><b>Alternativ:</b></h4></div>
                <div class="form-group">Öka/minska antalet fält: 
                    <div class="btn-group">
                    <button type="button" class="btn btn-default" id="remove_button" onclick="removeField()">-</button>
                    <button type="button" class="btn btn-default" id="add_button" onclick="addField()">+</button>
                    </div>
                </div>

                <div class="input_fields_wrap form-group" id="input_wrapper">
                    <div><input type="text" class="form-control" name="candidates[]"/><br></div>
                    <div><input type="text" class="form-control" name="candidates[]"/><br></div>
                </div>                        
                <script >
                   function addField(){
        		var container = document.getElementById("input_wrapper");
                        var cdiv = document.createElement("div");
                        var input = document.createElement("input");
                        var t = document.createTextNode("Alt " + (container.childElementCount+1));
                        input.type = "text";
                        input.className = "form-control";
                        input.name = "candidates[]";
                        //cdiv.appendChild(t);
                        cdiv.appendChild(input);
                        cdiv.appendChild(document.createElement("br"));
                        if(container.childElementCount < 20){
                            container.appendChild(cdiv);
                        }
                    }
                   function removeField(){
        		var container = document.getElementById("input_wrapper");
                        if(container.childElementCount > 2){
                            container.removeChild(container.lastChild);
                        }
                    }
                </script>

	        <button type="submit" class="btn btn-primary" value="begin_round" name="button">Starta ny valomgång</button>
	        </form>
	        </div>
		<br><br>
		
		<?php
		include "actions/genlastresult.php";
                
                $res = $evote->getOptions();
                if ($res->num_rows > 0) {
                        // output data of each row
                     while($row = $res->fetch_assoc()) {
                        echo "id: " . $row["id"]. " - Name: " . $row["name"]. "<br>";
                     }
                } else {
                    echo "0 results";
                }
	# ------------- VALOMGÅNG PÅGÅR ----------------
	}else{	
		echo "<div style=\"max-width: 400px\">";
		echo "<h3>Valomgång pågår</h3>";
	        echo "<table class=\"table table\" style=\"max-width: 400px;\" id=\"res\">";
		echo "<tr style=\"background-color: rgb(232,232,232);\"><th colspan=\"2\">-POST-</th></tr>";
			$p = 1;
	                for($i = 0; $i < 5; $i++){
	                        echo "<tr><td> $i </td></tr>\n";
				$p++;
	                }
	        echo "</table>";
		echo "<form action=actions/buttonhandler.php method=\"POST\">";
		echo "<button type=\"submit\" class=\"btn btn-primary\" name=\"button\" value=\"end_round\">Avsluta valomgång</button>";
		echo "</form>";
		echo "</div>";
	}

}
}
?>

