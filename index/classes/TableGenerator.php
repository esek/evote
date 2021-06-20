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
