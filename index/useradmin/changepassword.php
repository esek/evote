<?php
$access = array(0);
$priv = $evote->getPrivilege($_SESSION["user"]);
if(in_array($priv, $access)){
?>
<h3><?php echoLanguageChoice("Ändra lösenord", "Change password")?></h3>
<hr>
<div class="well" style="max-width: 400px">
    <form action="/actions/useradminpagehandler.php" method="POST">
    <div class="form-group">
            <label><?php echoLanguageChoice("Änvändarnamn:", "Username:")?></label>
            <input type="text" name="username" class="form-control" style="margin-bottom: 3px" autocomplete="off">
            <label><?php echoLanguageChoice("Nytt lösenord:", "New password")?></label>
            <input type="password" name="psw" class="form-control" style="margin-bottom: 3px" autocomplete="off">
    </div>
    <button type="submit" class="btn btn-primary" value="change" name="button"><?php echoLanguageChoice("Ändra lösenord", "Change password")?></button>
    </form>
</div>
<?php
} else {
    echoLanguageChoice("Du har inte behörighet att visa denna sida.", "You don't have permission to view this page.");
}
?>
