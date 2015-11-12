<?php
if($evote->verifyUser($_SESSION["user"], 0) || $evote->verifyUser($_SESSION["user"], 1)){
    $evote = new Evote();
    $res = $evote->getLastResult();
    if ($res->num_rows > 0) {
?>


    <div style="max-width: 400px">
		<h3>Föregående valomgång</h3>
		<?php
		echo "<table class=\"table\">";
		$head = "";
		$p = 1;
        	while($row = $res->fetch_assoc()) {
                        $tot = $row["tot"];
                        $precent = "- %";
                        if($tot != 0){
                            $precent = number_format(($row["votes"]/$tot)*100,1 ) . ' %';
                        }
        		if($head != $row["e_name"]){
                                echo "<tr style=\"background-color: rgb(232,232,232);\"><th colspan=\"2\">".$row["e_name"]." ($tot röster)</th></tr>";
        			$head = $row["e_name"];
        			$p = 1;
        		}
                        echo "<tr><td class=\"col-md-4\"><b>$p</b> (".$row["votes"].", $precent) </td>
                                <td class=\"col-md-8\">".$row["name"]."</td></tr>\n";
                        $p++;
         	}
         	echo "</table>";
		?>
		</div>
<?php
    }
    if($evote->ongoingRound()){
       echo "Vänta tills valomgången är slut." ;
    }
}
?>
