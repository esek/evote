<?php

$access = array(0);
$priv = $evote->getPrivilege($_SESSION["user"]);
if(in_array($priv, $access)){
    //$mg->printAdminMenu(2);

    $ongoingSession = $evote->ongoingSession();

    $buttonstate = "disabled";
    if($ongoingSession){
	   $buttonstate = "active";
    }

    if(!$ongoingSession){ ?>


    	<h3>Skapa nytt val</h3>
    	<hr>
    	<div class="well" style="max-width: 400px">
    	<form action="/actions/adminpagehandler.php" method="POST">
    	<div class="form-group">
    	        <label for="vn">Namn på val:</label>
    	        <input type="text" name="valnamn" class="form-control" id="vn" autocomplete="off">
    	</div>
    	<div class="form-group" style="max-width: 150px">
    	        <label for="ap">Max antal personer:</label>
    	        <input type="number" name="antal_personer" class="form-control" id="ap" min="1" autocomplete="off">
    	</div>
		<input type="checkbox" id="csv_checkbox" name="csv_checkbox">
		<label for="csv_checkbox">Få koder i CSV-format (för distansröstning)</label>
    	<button type="submit" class="btn btn-primary" value="create" name="button">Skapa</button>
    	</form>
    	</div>

    <?php }else{
        ?>
        <h3>Stäng nuvarande val</h3>
    	<hr>
    	<div class="well" style="max-width: 400px">
    		<form action="/actions/adminpagehandler.php" method="POST">
    			<div class="form-group">
            <label for="psw1">Ditt lösenord:</label>
            <input type="password" name="pswuser" class="form-control" id="psw1">
    	</div>
    	<button type="submit" class="btn btn-primary" value="delete_election" name="button">Stäng val</button>
    	</form>
    	</div>
        <?php
    }

} else {
    echo "Du har inte behörighet att visa denna sida";
}
?>
