<?php
$access = array(0);
$priv = $evote->getPrivilege($_SESSION["user"]);
if(in_array($priv, $access)){
?>
<h3><?php echo getLocalizedText("Change password")?></h3>
<hr>
<div class="well" style="max-width: 400px">
    <form action="/actions/useradminpagehandler.php" method="POST">
    <div class="form-group">
            <label><?php echo getLocalizedText("Username:")?></label>
            <input type="text" name="username" class="form-control" style="margin-bottom: 3px" autocomplete="off">
            <label><?php echo getLocalizedText("New password:")?></label>
            <input type="password" name="psw" class="form-control" style="margin-bottom: 3px" autocomplete="off">
    </div>
    <button type="submit" class="btn btn-primary" value="change" name="button"><?php echo getLocalizedText("Change password")?></button>
    </form>
</div>
<?php
} else {
    echo getLocalizedText("You don't have permission to view this page.");
}
?>
