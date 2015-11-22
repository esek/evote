<?php
if(!($evote->verifyUser($_SESSION["user"], 1) || $evote->verifyUser($_SESSION["user"], 2))){

        echo "Du har inte behörighet att visa denna sida.";
}else{


    echo "<h3>Tidigare valomgångar</h3>";
    echo "<hr>";
    $res = $evote->getResult();
    if ($res->num_rows > 0) {
?>
    	<div style="max-width: 400px">
		<?php
		echo "<table class=\"table table\">";
		$e_id = -1;
		$p = 1;
        $last_votes = "";
        $limit = "";
        while($row = $res->fetch_assoc()) {
            $tot = $row["tot"];
            $precent = "- ";
            $max = $evote->getMaxAltByAltId($row["id"]);
            if($tot != 0){
                $precent = number_format(($row["votes"]/$tot)*100,1 ) . ' %';
            }
            if($e_id != $row["e_id"]){
                echo "<tr class=\"rowheader\">
                    <th colspan=\"2\">".$row["e_name"]." <wbr>($tot röster, $max alt.)</th>
                    </tr>";
        		$e_id = $row["e_id"];
        		$p = 1;
                $limit = $max;
            }
            $style = "" ;
            if($p<=$max){
                $style = "rowwin";
            }else if($row["votes"] == $last_votes && $p - 1 <= $limit){
                $style = "rowtie";
                $limit++;
            }
            echo "<tr class=$style><td class=\"col-md-4 col-xs-4\" ><b>$p</b> (".$row["votes"].", $precent) </td>
                <td class=\"col-md-8 col-xs-8\">".$row["name"]."</td></tr>\n";
            $p++;
            $last_votes = $row["votes"];
         }
         echo "</table>";
		?>
		</div>

<?php
    }else{
        echo "Ingenting har valts ännu";
    }
}
?>
