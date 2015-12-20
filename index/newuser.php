<?php
$access = array(0);
$priv = $evote->getPrivilege($_SESSION["user"]);
if(in_array($priv, $access)){
$mg->printUserhandlerPanelMenu(1);
?>

<h3>Ny användare</h3>
<hr>
<div style="max-width: 400px">
    <form action="actions/userhandler.php" method="POST">
    <div class="form-group">
            <label>Användarnamn:</label>
            <input type="text" name="username" class="form-control" style="margin-bottom: 3px" autocomplete="off">
            <label>Lösenord:</label>
            <input type="password" name="psw" class="form-control" style="margin-bottom: 3px" autocomplete="off">
            <label>Privilegier: (0 - 2)</label>
            <input type="number" name="priv" class="form-control" min="0" max="2" style="margin-bottom: 3px; max-width: 200px" autocomplete="off">
            <button type="submit" class="btn btn-primary" value="new" name="button">Skapa ny användare</button>
    </div>
    </form>
</div>
<?php
} else {
    echo "Du har inte behörighet att visa denna sida.";
}
?>
