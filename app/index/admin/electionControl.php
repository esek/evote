<?php

$access = array(0);
$priv = $evote->getPrivilege($_SESSION["user"]);
if(in_array($priv, $access)){

    $ongoingSession = $evote->ongoingSession();

    if(!$ongoingSession){ 
?>

    	<h3><?php echo getLocalizedText("Create new election")?></h3>
    	<hr>
    	<div class="well" style="max-width: 400px">
			<div id="new-election-form">
				<form action="/actions/adminpagehandler.php" method="POST">
					<div class="form-group">
							<label for="vn"><?php echo getLocalizedText("Name of election:")?></label>
							<input type="text" name="valnamn" class="form-control" id="vn" autocomplete="off">
					</div>
					<div class="form-group" style="max-width: 150px">
							<label for="ap"><?php echo getLocalizedText("Max number of people:")?></label>
							<input type="number" name="antal_personer" class="form-control" id="ap" min="1" autocomplete="off">
					</div>
					<input type="checkbox" id="csv_checkbox" name="csv_checkbox">
					<label for="csv_checkbox"><?php echo getLocalizedText("Receive codes in CSV-format (for distance voting)")?></label>
					<button type="submit" onclick="placeholder()" class="btn btn-primary" value="create" name="button"><?php echo getLocalizedText("Create")?></button>
				</form>
			</div>
			<div id="submit-placeholder" style="display: none">
				<h4><?php echo getLocalizedText("A new election has been created!")?></h4>
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
        <h3><?php echo getLocalizedText("Close current election")?></h3>
    	<hr>
    	<div class="well" style="max-width: 400px">
    		<form action="/actions/adminpagehandler.php" method="POST">
    			<div class="form-group">
            		<label for="psw1"><?php echo getLocalizedText("Your password:")?></label>
            		<input type="password" name="pswuser" class="form-control" id="psw1">
    			</div>
    			<button type="submit" class="btn btn-primary" value="delete_election" name="button"><?php echo getLocalizedText("Close election")?></button>
    		</form>
    	</div>
        <?php
    }

} else {
    echo getLocalizedText("You don't have permission to view this page.");
}
?>
