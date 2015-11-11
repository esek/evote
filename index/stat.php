<?php
if(!($_SESSION["user"] == "adjust" || $_SESSION["user"] == "admin")){
        echo "Du har inte behörighet att visa denna sida.";
}else{
    
    require "data/evote.php";
    $evote = new Evote();

    
    $res = $evote->getLastResult();
    if ($res->num_rows > 0) {
?>
    	<div style="max-width: 400px">
		<h3>Tidigare valomgångar</h3>
		<?php
		echo "<table class=\"table table\">";
		$head = "";
		$p = 1;
        	while($row = $res->fetch_assoc()) {
        		if($head != $row["e_name"]){
        			echo "<tr style=\"background-color: rgb(232,232,232);\"><th colspan=\"2\">".$row["e_name"]."</th></tr>";
        			$head = $row["e_name"];
        			$p = 1;
        		}
        		echo "<tr><td class=\"col-md-1\">$p</td>
                        	<td class=\"col-md-11\"> (".$row["votes"].") ".$row["name"]."</td></tr>\n";
                        $p++;
         	}
         	echo "</table>";
		?>
		</div>
    
<?php
    }
}
?>
