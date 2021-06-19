<?php

$access = array(0);
$priv = $evote->getPrivilege($_SESSION["user"]);
if(in_array($priv, $access)){

    $ongoingSession = $evote->ongoingSession();

    if(!$ongoingSession){ 
?>

    	<h3><?php echoLanguageChoice("Skapa nytt val", "Create new election")?></h3>
    	<hr>
    	<div class="well" style="max-width: 400px">
			<div id="new-election-form">
				<form action="/actions/adminpagehandler.php" method="POST">
					<div class="form-group">
							<label for="vn"><?php echoLanguageChoice("Namn på val:", "Name of election:")?></label>
							<input type="text" name="valnamn" class="form-control" id="vn" autocomplete="off">
					</div>
					<div class="form-group" style="max-width: 150px">
							<label for="ap"><?php echoLanguageChoice("Max antal personer:", "Max number of people:")?></label>
							<input type="number" name="antal_personer" class="form-control" id="ap" min="1" autocomplete="off">
					</div>
					<input type="checkbox" id="csv_checkbox" name="csv_checkbox">
					<label for="csv_checkbox"><?php echoLanguageChoice("Få koder i CSV-format (för distanstörstning)", "Receive codes in CSV-format (for distance voting)")?></label>
					<button type="submit" onclick="placeholder()" class="btn btn-primary" value="create" name="button"><?php echoLanguageChoice("Skapa", "Create")?></button>
				</form>
			</div>
			<div id="submit-placeholder" style="display: none">
				<h4><?php echoLanguageChoice("Ett nytt val har skapats!", "A new election has been created!")?></h4>
			</div>
    	</div>
		<script>
		// Give user feedback of new election
		function placeholder() {
			// Small timeout for server to catch up
			setTimeout(() => {
				document.getElementById("new-election-form").style.display = "none";
				document.getElementById("submit-placeholder").style.display = "";
			}, 450);
		}
		</script>

    <?php }else{
        ?>
        <h3><?php echoLanguageChoice("Stäng nuvarande val", "Close current election")?></h3>
    	<hr>
    	<div class="well" style="max-width: 400px">
    		<form action="/actions/adminpagehandler.php" method="POST">
    			<div class="form-group">
<<<<<<< HEAD
            <label for="psw1"><?php echoLanguageChoice("Ditt lösenord:", "Your password:")?></label>
            <input type="password" name="pswuser" class="form-control" id="psw1">
    	</div>
    	<button type="submit" class="btn btn-primary" value="delete_election" name="button"><?php echoLanguageChoice("Stäng val", "Close election")?></button>
    	</form>
=======
            		<label for="psw1">Ditt lösenord:</label>
            		<input type="password" name="pswuser" class="form-control" id="psw1">
    			</div>
    			<button type="submit" class="btn btn-primary" value="delete_election" name="button">Stäng val</button>
    		</form>
>>>>>>> master
    	</div>
        <?php
    }

} else {
    echoLanguageChoice("Du har inte behörighet att visa denna sida.", "You don't have permission to view this page.");
}
?>
