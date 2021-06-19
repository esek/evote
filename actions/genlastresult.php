<?php
if($evote->verifyUser($_SESSION["user"], 1) || $evote->verifyUser($_SESSION["user"], 2)){

    $evote = new Evote();
    $res = $evote->getLastResult();
    if ($res->num_rows > 0) {
?>

    <h3><?php echo getLocalizedText("Previous election round")?></h3>
    <div style="max-width: 400px">
		<?php
		echo "<table class=\"table\">";
		$e_id = -1;
		$p = 1;
        $last_votes = "";
        $limit = "";
        while($row = $res->fetch_assoc()) {
            $tot = $row["tot"];
            $percent = "- ";
            $max = $evote->getMaxAltByAltId($row["id"]);
            if($tot != 0){
                $percent = number_format(($row["votes"]/$tot)*100,1 ) . ' %';
            }
            if($e_id != $row["e_id"]){
                echo "<tr class=\"rowheader\">
                    <th colspan=\"2\">".$row["e_name"]." <wbr>($tot". getLocalizedText("votes").", $max ".getLocalizedText("alt.").".)</th>
                    </tr>";
        		$e_id = $row["e_id"];
        		$p = 1;
                $limit = $max;
            }

            $style = "";
            $style2 = "";
            if($row["votes"] != 0 && $p<=$max){
                $style = "rowwin";
                $style2 = "background-color: rgb(204, 255, 204);";
            }else if($row["votes"] != 0 && $row["votes"] == $last_votes && $p - 1 <= $limit){
                $style = "rowtie";
                $style2 = "background-color: rgb(204, 255, 204);";
                $limit++;
            }
            echo "<tr class=$style><td class=\"col-md-4 col-xs-4\" ><b>$p</b> (".$row["votes"].", $percent) </td>
                <td class=\"col-md-8 col-xs-8\">".$row["name"]."</td></tr>\n";
            $p++;
            $last_votes = $row["votes"];
         }
         echo "</table>";
		?>
		</div>
<?php
    }else if($evote->countRounds() == 0){
        echo getLocalizedText("Nothing has been elected yet");
    }else{
        echo getLocalizedText("Please wait. Voting in progress.");
    }
}
?>
