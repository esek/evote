<?php
$access = array(1);
if(in_array($evote->getPrivilege($_SESSION["user"]), $access)){
?>
	<h3><?php echo getLocalizedText("Close current election")?></h3>
	<hr>
	<div style="max-width: 400px">

	</div>
	<br>
	<div style="max-width: 400px">
		<form action="/actions/electionadminpagehandler.php" method="POST">
			<div class="form-group">
        <label for="psw1"><?php echo getLocalizedText("Your password:")?></label>
        <input type="password" name="pswuser" class="form-control" id="psw1">
	</div>
	<button type="submit" class="btn btn-primary" value="delete_election" name="button"><?php echo getLocalizedText("Delete election")?></button>
	</form>
	</div>

<?php
} else {
    echo getLocalizedText("You don't have permission to view this page.");
}
?>
