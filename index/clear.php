<?php
if(!($evote->verifyUser($_SESSION["user"], 1))){
        echo "Du har inte behörighet att visa denna sida.";
}else{
?>
<h3>Stäng nuvarande val</h3>
<hr>
<div style="max-width: 400px">
	För att det inte ska vara möjligt att stänga ett val vid fel tillfälle (typ när valet pågår och alla sitter i vallokalen) måste du som är inloggad och hemsideansvarig slå in er användarinformation nedan för att stänga valet.
</div>
<br>
<div style="max-width: 400px">
<form action="actions/buttonhandler.php" method="POST">
<div class="form-group">
        <label for="psw1">Ditt lösenord:</label>
        <input type="password" name="pswuser" class="form-control" id="psw1">
</div>
<div class="form-group">
        <label for="pwd">Hemsideansvarigs användarnamn och lösenord:</label>
        <input type="text" name="namepageadmin" class="form-control" autocomplete="off">
        <br>
        <input type="password" name="pswpageadmin" class="form-control" id="psw2">
</div>
<button type="submit" class="btn btn-primary" value="delete_election" name="button">Radera val</button>
</form>
</div>

<?php
}
?>
