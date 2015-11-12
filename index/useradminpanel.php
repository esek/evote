<?php
if(!(/*$evote->verifyUser($_SESSION["user"], 0) ||*/ TRUE)){
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
    <form action="actions/userhandler.php" method="POST">
    <div class="form-group">
            <label>Användarnamn:</label>
            <input type="text" name="username" class="form-control" style="margin-bottom: 3px" autocomplete="off">
            <label>Nytt lösenord:</label>
            <input type="password" name="psw" class="form-control" style="margin-bottom: 3px" autocomplete="off">
            <button type="submit" class="btn btn-primary" value="change" name="button">Byt Lösenord</button>
    </div>
    </form>
    <br>
    <h3>Ny användare</h3>
    <form action="actions/userhandler.php" method="POST">
    <div class="form-group">
            <label>Användarnamn:</label>
            <input type="text" name="username" class="form-control" style="margin-bottom: 3px" autocomplete="off">
            <label>Lösenord:</label>
            <input type="password" name="psw" class="form-control" style="margin-bottom: 3px" autocomplete="off">
            <label>Privilegier: (0 - 2)</label>
            <input type="number" name="priv" class="form-control" min="0" max="2" style="margin-bottom: 3px; max-width: 200px">
            <button type="submit" class="btn btn-primary" value="new" name="button">Skapa ny användare</button>
    </div>
    </form>
    <br>
    <h3>Hantera användare</h3>
    <form action="actions/userhandler.php" method="POST">
    <div class="form-group">
            <?php
            $res = $evote->listUsers();
            if($res->num_rows > 0){	
    		echo "<table class=\"table\">";	
                echo "<tr style=\"background-color: rgb(232,232,232);\">
                        <th class=\"col-xs-2 col-md-2\">Välj</th>
                        <th class=\"col-xs-7 col-md-7\">Namn</th>
                        <th class=\"col-xs-3 col-md-3\">Privilegier</th>
                        </tr>";
                    while($row = $res->fetch_assoc()){

                        echo "<tr>";
                        if($row["username"] == "macapar"){
                            echo "<td>-</td>";
                        }else{
                            echo "<td><input type=\"checkbox\" name=\"marked_users[]\" value=\"".$row["id"]."\"</td>";
                        }
                        echo "<td>".$row["username"]." </td>";
                        echo "<td>".$row["privilege"]."</td>";
                        echo "</tr>";
                    }
    		echo "</table>";
    			
    		}
            ?>
            <button type="submit" class="btn btn-primary" value="delete_users" name="button">Ta bort markerade användare</button>
    </div>
    </form>
</div>

<?php
}
?>

