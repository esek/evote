<?php
class TableGenerator {

    public function generateResultTable($tableType){
        $evote = new Evote();
        $res = "";
        if($tableType == "all"){
            $res = $evote->getResult();
        } elseif ($tableType == "last"){
            $res = $evote->getLastResult();
        } else{
            return;
        }

        if ($res->num_rows > 0) {
        	echo "<div class=\"well well-sm\" style=\"max-width: 400px\">";
            echo "<div class=\"panel panel-default\">";
    		echo "<table class=\"table table\">";

    		$e_id = -1; // election_id
    		$p = 1; // Current row, 1 is header
            $last_votes = "";
            $limit = "";

            // Loop through results; Each row is an alternatives result
            while($row = $res->fetch_assoc()) {
                $tot = $row["tot"]; // Votes accepted
                $percent = "- ";
                $max = $evote->getMaxAltByAltId($row["id"]);
                $nbr_alternatives = $evote->getTotAltByElectionId($row["e_id"]);
                if($tot != 0){
                    $percent = number_format(($row["votes"]/$tot)*100,1 ) . '%';
                }

                if($e_id != $row["e_id"]){
                    // Table header
                    echo "<tr class=\"rowheader\">
                        <th colspan=\"3\">".$row["e_name"]." <wbr>($tot ".getLocalizedText("votes").", $max ".getLocalizedText("opt.").")</th>
                        </tr>";
            		$e_id = $row["e_id"];
            		$p = 1;
                    $limit = $max;
                }

                $style = "" ;
                if($row["votes"] != 0 && $p<=$max){
                    $style = "rowwin";
                } else if($row["votes"] != 0 && $row["votes"] == $last_votes && $p - 1 <= $limit){
                    $style = "rowtie";
                    $limit++;
                }
                
                echo "<tr class=$style><td class=\"col-md-4 col-xs-4\" ><b>$p</b> (".$row["votes"].", $percent) </td>
                    <td class=\"col-md-8 col-xs-8\">".$row["name"]."</td><td></td></tr>\n";
                $p++;
                $last_votes = $row["votes"];

                // This was the last row, so add failed votes here
                if ($p > $nbr_alternatives) {
                    // Information on number of failed vote attempts,
                    // and how this compares to total number of successfull votes
                    $failed_vote_attempts = $row["failed_vote_attempts"];

                    $percent_failed = "- ";
                    if($tot != 0){
                        $percent_failed = number_format(($failed_vote_attempts / $tot) * 100, 1) . '%';
                    }

                    echo "<tr class=\"rowinfo\">
                        <td colspan=\"2\">
                        <b>".getLocalizedText("Number of failed voting attempts:")."</b>
                        </td>
                        <td>
                        <b>$failed_vote_attempts</b></td>
                        </tr>";
                    echo "<tr class=\"rowinfo\">
                        <td width=\"150\" colspan=\"2\">
                        <b>".getLocalizedText("Relationship between total votes accepted and failed voting attempts (lower is better):")."</b>
                        </td>
                        <td>
                        <b>$percent_failed</b>
                        </td>
                        </tr>";
                }
            }

             echo "</table>";
             echo "</div>";
             echo "</div>";
         }else{
             if($evote->ongoingSession()){
                echo "<h4>".getLocalizedText("Nothing has been elected yet")."<h4>";
            }else{
                echo "<h4>".getLocalizedText("No election opportunity in sight")."<h4>";
            }
         }
    }

    public function generateResultTable2($tableType){
        $evote = new Evote();
        $res = "";
        if($tableType == "all"){
            $res = $evote->getResult();
        } elseif ($tableType == "last"){
            $res = $evote->getLastResult();
        } else{
            return;
        }

        if ($res->num_rows > 0) {
        	echo "<div style=\"max-width: 400px\">";
    		echo "<table class=\"table table\">";
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
                        <th colspan=\"2\">".$row["e_name"]." <wbr>($tot ".getLocalizedText("votes").", $max ".getLocalizedText("opt.").")</th>
                        </tr>";
            		$e_id = $row["e_id"];
            		$p = 1;
                    $limit = $max;
                }
                $style = "" ;
                if($row["votes"] != 0 && $p<=$max){
                    $style = "rowwin";
                }else if($row["votes"] != 0 && $row["votes"] == $last_votes && $p - 1 <= $limit){
                    $style = "rowtie";
                    $limit++;
                }
                echo "<tr class=$style><td class=\"col-md-4 col-xs-4\" ><b>$p</b> (".$row["votes"].", $percent) </td>
                    <td class=\"col-md-8 col-xs-8\">".$row["name"]."</td></tr>\n";
                $p++;
                $last_votes = $row["votes"];
             }
             echo "</table>";
             echo "</div>";
         }else{
             echo "<h4>".getLocalizedText("Nothing has been elected yet")."<h4>";
         }
    }

    public function generateAvailableOptions(){
        $evote = new Evote();
        $res = $evote->getOptions();
        if($res->num_rows > 0){

        $head = "";
		echo "<table class=\"table table\">";
                while($row = $res->fetch_assoc()){
                    if($head != $row["e_name"]){
		                echo "<tr class=\"rowheader\"><th colspan=\"2\">".$row["e_name"]."</th></tr>";
                        $head = $row["e_name"];
                    }
		            echo "<tr><td>".$row["name"]." </td></tr>\n";
                }
		echo "</table>";

		}
    }

    public function generateOverview(){
        $evote = new Evote();
        $res = $evote->getAllSessions();
        if($res->num_rows > 0){
            echo "<div class=\"well well-sm\" style=\"max-width: 600px\">";
            $head = "";
            echo "<div class=\"panel panel-default\">";
    		echo "<table class=\"table table\">";
            echo "<tr class=\"rowheader\">\n".
                    "<th>".getLocalizedText("Name")."</th>
                    <th>".getLocalizedText("Opened")."</th>
                    <th>".getLocalizedText("Closed")."</th>
                    </tr>";
            while($row = $res->fetch_assoc()) {
                $name = $row['name'];
                $start = $row['start'];
                $end = $row['end'];
                $active = $row['active'];

                $style = "" ;
                if($active == 1){
                    $style = "rowwin";
                }
                if($end == "0000-00-00 00:00:00")
                    $end = "-";
                if($start == "0000-00-00 00:00:00")
                    $start = "-";

                echo "<tr class=\"$style\">
                        <th>$name</th>
                        <th>$start</th>
                        <th>$end</th>
                        </tr>";
            }

    		echo "</table>";
            echo "</div>";
    		echo "</div>";
		}
    }

}

?>
