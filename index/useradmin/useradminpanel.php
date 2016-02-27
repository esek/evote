<?php
$access = array(0);
$priv = $evote->getPrivilege($_SESSION["user"]);
if(in_array($priv, $access)){
//$mg->printUserhandlerPanelMenu($page);

?>

<h3>Hantera användare</h3>
<hr>
<div style="max-width: 400px">
    <form action="/actions/useradminpagehandler.php" method="POST">
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
                        $priv = "";
                        switch($row["privilege"]){
                            case "0": $priv = "Administratör";
                                break;
                            case "1": $priv = "Valansvarig";
                                break;
                            case "2": $priv = "Justerare";
                                break;
                        }

                        echo "<tr>";
                        if($row["username"] == "macapar"){
                            echo "<td>-</td>";
                        }else{
                            echo "<td><input type=\"checkbox\" name=\"marked_users[]\" value=\"".$row["id"]."\"</td>";
                        }
                        echo "<td>".$row["username"]." </td>";
                        echo "<td>".$priv."</td>";
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
} else {
    echo "Du har inte behörighet att visa denna sida.";
}
?>
