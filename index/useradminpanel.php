<?php
if(!($evote->verifyUser($_SESSION["user"], 0))){
        echo "Du har inte behörighet att visa denna sida.";
}else{

echo "<form action=actions/buttonhandler.php method=\"POST\">";
echo "<div class=\"btn-group\">";
echo "<button type=\"submit\" name=\"button\" value=\"logout\" class=\"btn btn-primary\" style=\"margin-bottom: 5px\">Logga ut</button>";
echo "</div>";
echo "</form>";
?>

<h3>Ändra lösenord</h3>
<div style="max-width: 400px">

</div>
<br>
<div style="max-width: 400px">
<form action="actions/changepassword.php" method="POST">
<div class="form-group">
        <label>Nytt lösenord för valadmin:</label>
        <input type="password" name="psw1" class="form-control" style="margin-bottom: 3px">
<button type="submit" class="btn btn-warning" value="change_admin" name="button">Byt Lösenord</button>
</div>
</form>
<br>
<form action="actions/changepassword.php" method="POST">
<div class="form-group">
        <label>Nytt lösenord för justerare:</label>
        <input type="password" name="psw1" class="form-control" style="margin-bottom: 3px">
<button type="submit" class="btn btn-warning" value="change_adjust" name="button">Byt Lösenord</button>
</div>
</form>
</div>

<?php
}
?>

