<h3>Radera nuvarnade val</h3>
<div style="width: 500px">
	För att det inte ska vara möjligt att radera ett val vid fel tillfälle (typ när valet pågår) måste du som är inloggad och hemsideansvarig båda slå in era lösenord nedan för att det ska gå igenom.
</div>
<br>
<div style="width: 300px">
<form action="actions/buttonhandler.php" method="POST">
<div class="form-group">
        <label for="psw1">Ditt lösenord:</label>
        <input type="password" name="pswuser" class="form-control" id="psw1">
</div>
<div class="form-group">
        <label for="pwd">Hemsideansvarigs lösenord:</label>
        <input type="password" name="pswmacapar" class="form-control" id="psw2">
</div>
<button type="submit" class="btn btn-primary" value="delete_election" name="button">Radera val</button>
</form>
</div>

<?php
	
?>
