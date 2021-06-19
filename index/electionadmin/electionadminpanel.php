<?php
$access = array(1);
$priv = $evote->getPrivilege($_SESSION["user"]);
if(in_array($priv, $access)){

$ongoingSession = $evote->ongoingSession();

#-------------NEW ELECTION--------------
if($evote->checkCheating()){
    echoLanguageChoice("Någon fuling har mixtrat i databasen.", "Some shady character has done something with the database.");
}

if(!$ongoingSession){ ?>
	<h4><?php echoLanguageChoice("Det pågår inget valtillfälle.", "There is no ongoing election session.")?></h4>
<?php }else{
	$ongoing = $evote->ongoingRound();
	# ---------------NY VALOMGÅNG OCH VISA FÖRRA VALOMGÅNGEN --------------
	if(!$ongoing){?>

	    <h3><?php echoLanguageChoice("Skapa ny valomgång", "Create new election round")?></h3>
		<hr>
		<div class="well" style="max-width: 400px">
		<div class=\"panel panel-default">
	        <form action="/actions/electionadminpagehandler.php" method="POST">
	        <div class="form-group">
	                <label><?php echoLanguageChoice("Vad som ska väljas:", "What to be elected:")?></label>
	                <input type="text" class="form-control" name="round_name" autocomplete="off" maxlength="240">
			</div>
	        <div class="form-group">
	                <label><?php echoLanguageChoice("Tillfällig kod:", "Temporary code:")?></label>
	                <input type="text" class="form-control" name="code" autocomplete="off" maxlength="240"/>
	        </div>
			<div class="form-group" style="max-width: 200px">
	                <label><?php echoLanguageChoice("Antal valbara alternativ:", "Number of selectable options:")?></label>
	                <input type="number" class="form-control" name="max_num" id="max" autocomplete="off" value="1" min="1"/>
	        </div>
                <br>
                <div><h4><b><?php echoLanguageChoice("Alternativ:", "Alternatives:")?></b></h4></div>
                <div class="form-group"><?php echoLanguageChoice("Öka/minska antalet fält:", "Increase/decrease number of fields:")?>
                    <div class="btn-group">
                    <button type="button" class="btn btn-default" id="remove_button" onclick="removeField()">-</button>
                    <button type="button" class="btn btn-default" id="add_button" onclick="addField()">+</button>
                    </div>
                </div>

                <div class="input_fields_wrap form-group" id="input_wrapper">
                    <div><input type="text" class="form-control" name="candidates[]" autocomplete="off" maxlength="240"/><br></div>
                    <div><input type="text" class="form-control" name="candidates[]" autocomplete="off" maxlength="240"/><br></div>
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
                        input.setAttribute( "autocomplete", "off" );
						input.setAttribute( "maxlength", "240" );
                        //cdiv.appendChild(t);
                        cdiv.appendChild(input);
                        cdiv.appendChild(document.createElement("br"));
                        if(container.childElementCount < 100){
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
	        <button type="submit" class="btn btn-primary" value="begin_round" name="button"><?php echoLanguageChoice("Starta ny valomgång", "Start new election round")?></button>
	        </form>
	        </div>
		</div>
		<br><br>

		<?php

		// Generera tabell med förra omgångens resultat.
		echo "<h3>".pickLanguage("Föregående valomgång", "Previous election round")."</h3>";
		echo "<hr>";
		$tg->generateResultTable("last");

	# ------------- VALOMGÅNG PÅGÅR ----------------
	}else{
		echo "<h3>".pickLanguage("Röstning pågår", "Voting in progress")."</h3>";
		echo "<hr>";
		echo "<div class=\"well well-sm\" style=\"max-width: 400px\">";
        echo "<div class=\"panel panel-default\">";

		$tg->generateAvailableOptions();

		echo "</div>";
		echo "<div class=\"span7 text-center\">";
		echo "<form action=/actions/electionadminpagehandler.php method=\"POST\">";
		echo "<button type=\"submit\" class=\"btn btn-primary\" name=\"button\" value=\"end_round\">".pickLanguage("Avsluta valomgång", "End election round")."</button>";
		echo "</form>";
		echo "</div>";
		echo "</div>";
	}

}
} else {
    echoLanguageChoice("Du har inte behörighet att visa denna sida.", "You don't have permission to view this page.");
}
?>
