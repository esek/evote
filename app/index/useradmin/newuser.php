<?php
$access = array(0);
$priv = $evote->getPrivilege($_SESSION["user"]);
if(in_array($priv, $access)){?>
<h3><?php echo getLocalizedText("Create new user")?></h3>
<hr>
<div class="well" style="max-width: 400px">
    <form action="/actions/useradminpagehandler.php" method="POST">
    <div>
            <label><?php echo getLocalizedText("Username:")?></label>
            <input type="text" name="username" class="form-control" style="margin-bottom: 3px" autocomplete="off">
            <label><?php echo getLocalizedText("Password:")?></label>
            <input type="password" name="psw" class="form-control" style="margin-bottom: 3px" autocomplete="off">
    </div>
    <div class="form-group row">
    <label class="col-sm-3 radio"><?php echo getLocalizedText("Privileges:")?></label>
    <div class="col-sm-9">
      <div class="radio">
        <label>
          <input type="radio" name="priv" value="1" checked>
          <?php echo getLocalizedText("Election admin")?>
        </label>
      </div>
      <div class="radio">
        <label>
          <input type="radio" name="priv" value="2">
          <?php echo getLocalizedText("Adjuster")?>
        </label>
      </div>
      <div class="radio">
        <label>
          <input type="radio" name="priv" value="0">
          <?php echo getLocalizedText("Administrator")?>
        </label>
      </div>
    </div>
    </div>

    <button type="submit" class="btn btn-primary" value="new" name="button"><?php echo getLocalizedText("Create new user")?></button>
    </form>
</div>
<?php
} else {
  echo getLocalizedText("You don't have permission to view this page.");
}
?>
