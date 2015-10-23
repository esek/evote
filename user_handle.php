<?php
if(isset($_POST["usr_handle"])){
	if($_POST["usr_handle"]=="login"){
	
                session_start();
	        $_SESSION["user"]="admin";      
              	echo $_SESSION["user"];
                header("Location: /index.php?newpage=admin");
        }
}
?>
