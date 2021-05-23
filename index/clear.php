<?php
$access = array(1);
if(in_array($evote->getPrivilege($_SESSION["user"]), $access)){
	//$mg->printElectionadminPanelMenu(2);
?>
	<h3><?php echoLanguageChoice("Stäng nuvarande val", "Close current election")?></h3>
	<hr>
	<div style="max-width: 400px">

	</div>
	<br>
	<div style="max-width: 400px">
		<form action="/actions/electionadminpagehandler.php" method="POST">
			<div class="form-group">
        <label for="psw1"><?php echoLanguageChoice("Ditt lösenord:", "Your password:")?></label>
        <input type="password" name="pswuser" class="form-control" id="psw1">
	</div>
	<button type="submit" class="btn btn-primary" value="delete_election" name="button"><?php echoLanguageChoice("Radera val", "Delete election")?></button>
	</form>
	</div>

<?php
} else {
    echoLanguageChoice("Du har inte behörighet att visa denna sida.", "You don't have permission to view this page");
}
?>
