<?php
if(!($evote->verifyUser($_SESSION["user"], 0) || TRUE)){
        echo "Du har inte behörighet att visa denna sida.";
}else{

echo "<form action=actions/buttonhandler.php method=\"POST\">";
echo "<div class=\"btn-group\">";
echo "<button type=\"submit\" name=\"button\" value=\"logout\" class=\"btn btn-primary\" style=\"margin-bottom: 5px\">Logga ut</button>";
echo "</div>";
echo "</form>";
?>

<div style="max-width: 400px">
    <h3>Ändra lösenord</h3>
    <form action="actions/changepassword.php" method="POST">
    <div class="form-group">
            <label>Användarnamn:</label>
            <input type="text" name="username" class="form-control" style="margin-bottom: 3px">
            <label>Nytt lösenord:</label>
            <input type="password" name="psw" class="form-control" style="margin-bottom: 3px">
            <button type="submit" class="btn btn-default" value="change" name="button">Byt Lösenord</button>
    </div>
    </form>
    <br>
    <h3>Ny användare</h3>
    <form action="actions/changepassword.php" method="POST">
    <div class="form-group">
            <label>Användarnamn:</label>
            <input type="text" name="username" class="form-control" style="margin-bottom: 3px">
            <label>Lösenord:</label>
            <input type="password" name="psw" class="form-control" style="margin-bottom: 3px">
            <label>Privilegier:</label>
            <input type="text" name="priv" class="form-control" style="margin-bottom: 3px">
            <button type="submit" class="btn btn-default" value="new" name="button">Skapa ny användare</button>
    </div>
    </form>
</div>

<?php
}
?>

