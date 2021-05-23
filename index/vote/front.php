<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/countdown.js"></script>
<style>
tr.alternative:hover {
    background-color: rgb(245, 245, 245);
}
</style>
<?php

if(!$evote->ongoingSession()){
	echo "<p><h3>".pickLanguage("Det finns inget pågående val för tillfället.", "There is no election session currently")."</h3></p><br>";
	?>
	<!-- Countdown timer for rechecking round, works with sessions as well I guess -->
		<div id="countdown-container">
			<p><h5><?php echoLanguageChoice("Kollar efter ny omröstning om", "Checking for new election round in")?> <span id="countdown-counter"></span>...</h5><p>
		</div>
		<!-- If the check fails -->
		<div id="polling-failure" style="display: none;">
			<p><h5><?php echoLanguageChoice("Hoppsan! Kunde inte kolla efter ny omröstning. Testa att ladda om sidan!", 
			"Oops! Could not check for new election round. Try refreshing the page!")?></h5></p>
			<button class="btn-lg btn-primary" onClick="window.location.reload();"><?php echoLanguageChoice("Ladda om sidan", "Refresh Page")?></button>
		</div>
		<script src="js/checkForNewRound.js"></script>
	<?php
}else{
	$ongoing = $evote->ongoingRound();

	if(!$ongoing){
		?>
		<p><h3><?php echoLanguageChoice("Det finns inget att rösta på för tillfället. Ta en kaka.", "There is nothing to vote on currently. Take a cookie.")?></h3></p><br>
		<!-- Countdown timer for rechecking round -->
		<div id="countdown-container">
			<p><h5><?php echoLanguageChoice("Kollar efter ny omröstning om", "Checking for new election round in")?> <span id="countdown-counter"></span>...</h5><p>
		</div>
		<!-- If the check fails -->
		<div id="polling-failure" style="display: none;">
			<p><h4><?php echoLanguageChoice("Hoppsan! Kunde inte kolla efter ny omröstning. Testa att ladda om sidan!", 
			"Oops! Could not check for new election round. Try refreshing the page!")?></h4></p>
			<button class="btn-lg btn-primary" onClick="window.location.reload();"><?php echoLanguageChoice("Ladda om sidan", "Refresh Page")?></button>
		</div>
		<script src="js/checkForNewRound.js"></script>
		<?php
	} else{
			?>
			<!-- Countdown timer for rechecking if round open -->
			<script src="js/checkIfRoundClosed.js"></script>
			<?php
            $res = $evote->getOptions();
            if($res->num_rows > 0){
?>
	    	<h3 class="small-centered" style="max-width: 165px;"><?php echoLanguageChoice("Röstning pågår", "Voting in progress")?></h3>
			<hr>
			<div class="well small-centered"style="max-width: 400px;">
				<?php
				$max = $evote->getMaxAlternatives();
				echo "<div name=\"maxalt_header\" >";
					echo "<h4>".pickLanguage("Du får rösta på <b>".$max."</b> av alternativen", "You can vote on <b>".$max."</b> of the alternatives")."</h4>";
				echo "</div>";
				?>
	    	    <form action="actions/votingpagehandler.php" method="POST" autocomplete="off">
	    	        <?php
                        $head = "";
						$type = "checkbox";
						$id = 0;
						if($max <= 1){
							$type = "radio";
							$id = 1;
						}
						echo "<div class=\"panel panel-default\">";
	    	        	echo "<table class=\"table table\" id=\"contentTable\">";
                        while($row = $res->fetch_assoc()){
                                if($head != $row["e_name"]){
	    	        	        echo "<tr class=\"rowheader\";><th colspan=\"2\">".$row["e_name"]."</th></tr>";
                                $head = $row["e_name"];
                                                }
	    	        			echo "<tr class=\"alternative\" style=\"cursor: pointer;\">
									<td class=\"col-md-1 col-xs-1\">
									<input type=$type class=\"big\" name=\"person[]\" style=\"cursor: pointer;\" id=$id value=".$row["id"]." onclick=\"maxCheck()\"></td>
	    	        				<td class=\"col-md-11 col-xs-11\">".$row["name"]." </td>
									</tr>\n";
	    	        		}
	    	        	echo "</table>";
						echo "</div>";
	    	        ?>
					<script>
					function maxCheck(){
    					var max = <?php echo $evote->getMaxAlternatives() ?>;

    					var checkboxes = document.getElementsByName("person[]");
						var countChecked = 0;
						for(var i = 0; i<checkboxes.length; i++){
							if(checkboxes[i].checked == true){
								countChecked++;
							}
						}
						for(var i = 0; i<checkboxes.length; i++){
							checkboxes[i].disabled = false;
							if(checkboxes[i].checked == false && countChecked >= max && checkboxes[i].id != 1){
								checkboxes[i].disabled = true;
							}
						}


					}
					</script>

					</script>
	    	        <div class="form-group">
	    	            <label><?php echoLanguageChoice("Personlig valkod:", "Personal election code:")?></label>
	    	            <input type="password" class="form-control" name="code1">
	    	        </div>
	    	        <div class="form-group">
	    	            <label><?php echoLanguageChoice("Tillfällig valkod:", "Temporary election code:")?></label>
	    	            <input type="text" class="form-control" name="code2">
	    	        </div>
                            <br>
                            <div class="span7 text-center">
	    	                <button type="submit" class="btn-lg btn-primary" value="vote" name="button" ><?php echoLanguageChoice("Rösta!", "Vote!")?></button>
                            </div>
	    	    </form>
		</div>
<?php
            }
		}
	}
?>

<script>
// Script for selecting the checkbox when the table row is selected
$('tr').on('click', function() {
		var checkbox = $(this).find('input');
		if(!checkbox.prop("disabled")){
			checkbox.prop("checked", !checkbox.prop("checked"));
		}

		maxCheck()
	});
$("tr input").on("click", function(e){
	e.stopPropagation();
});
</script>
