	<h3><?php echo getLocalizedText("Log in")?></h3>
	<hr>
	<div class="well" style="max-width: 400px">
	<form action="/actions/usersessionhandler.php" method="POST">
	<div class="form-group">
  		<label for="usr"><?php echo getLocalizedText("Name:")?></label>
 		<input type="text" class="form-control" name="usr" autocomplete="off">
	</div>
	<div class="form-group">
  		<label for="pwd"><?php echo getLocalizedText("Password:")?></label>
  		<input type="password" class="form-control" name="psw">
	</div>
	<button type="submit" class="btn btn-primary" name="button" value="login" name="login"><?php echo getLocalizedText("Log in")?></button>
	</form>
	</div>
