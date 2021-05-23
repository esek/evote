<?php
$access = array(0);
$priv = $evote->getPrivilege($_SESSION["user"]);
if(in_array($priv, $access)){
    //require $_SERVER['DOCUMENT_ROOT'].'/data/config.php'

?>

<h3><?php echoLanguageChoice("Hantera användare", "Manage users")?></h3>
<hr>
<div style="max-width: 400px">
    <form action="/actions/useradminpagehandler.php" method="POST">
    <div class="form-group">
            <?php
            $res = $evote->listUsers();
            if($res->num_rows > 0){
            echo "<div class=\"well\">";
            echo "<div class=\"panel panel-default\">";
    		echo "<table class=\"table\">";
                echo "<tr class=\"rowheader\">
                        <th class=\"col-xs-2 col-md-2\">".pickLanguage("Välj", "Choose")."</th>
                        <th class=\"col-xs-7 col-md-7\">".pickLanguage("Namn", "Name")."</th>
                        <th class=\"col-xs-3 col-md-3\">".pickLanguage("Privilegier", "Privileges")."</th>
                        </tr>";
                    while($row = $res->fetch_assoc()){
                        $priv = "";
                        switch($row["privilege"]){
                            case "0": $priv = pickLanguage("Administratör", "Administrator");
                                break;
                            case "1": $priv = pickLanguage("Valansvarig", "Election admin");
                                break;
                            case "2": $priv = pickLanguage("Justerare", "Adjuster");
                                break;
                        }

                        echo "<tr>";
                        if($row["username"] == SUPERUSER){
                            echo "<td>-</td>";
                        }else{
                            echo "<td><input type=\"checkbox\" name=\"marked_users[]\" value=\"".$row["id"]."\"</td>";
                        }
                        echo "<td>".$row["username"]." </td>";
                        echo "<td>".$priv."</td>";
                        echo "</tr>";
                    }
    		echo "</table>";
            echo "</div>";
    		}
            ?>
            <button type="submit" class="btn btn-primary" value="delete_users" name="button"><?php echoLanguageChoice("Ta bort markerade användare", "Remove selected users")?></button>
            </div>
    </div>
    </form>
</div>

<?php
} else {
    echoLanguageChoice("Du har inte behörighet att visa denna sida.", "You don't have permission to view this page");
}
?>
