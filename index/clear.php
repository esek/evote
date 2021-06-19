<?php
$access = array(1);
if(in_array($evote->getPrivilege($_SESSION["user"]), $access)){
?>
	<h3>Stäng nuvarande val</h3>
	<hr>
	<div style="max-width: 400px">

	</div>
	<br>
	<div style="max-width: 400px">
		<form action="/actions/electionadminpagehandler.php" method="POST">
			<div class="form-group">
        <label for="psw1">Ditt lösenord:</label>
        <input type="password" name="pswuser" class="form-control" id="psw1">
	</div>
	<button type="submit" class="btn btn-primary" value="delete_election" name="button">Radera val</button>
	</form>
	</div>

<?php
} else {
    echo "Du har inte behörighet att visa denna sida.";
}
?>
