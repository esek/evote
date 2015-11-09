<?php
if(!($_SESSION["user"] == "adjust" || $_SESSION["user"] == "admin")){
        echo "Du har inte behörighet att visa denna sida.";
}else{

	echo "NEDAN SKA STATISTIK VISAS";

}
?>
