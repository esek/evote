<h3>Logga in som administratör</h3>
<hr>
<div style="max-width: 400px">
<form action="actions/usersessionhandler.php" method="POST">
<div class="form-group">
    <label for="usr">Namn:</label>
    <input type="text" class="form-control" name="usr" autocomplete="off">
</div>
<div class="form-group">
    <label for="pwd">Lösenord:</label>
    <input type="password" class="form-control" name="psw">
</div>
<button type="submit" class="btn btn-primary" name="button" value="login" name="login">Logga in</button>
</form>
</div>
