<?php


class MenuGenerator {

    public function printElectionadminPanelMenu($activeTab){
        $evote = new Evote();
        $ongoingS = $evote->ongoingSession();
        $activate = array("", "", "", "");
        $activate[$activeTab] = "active";
        echo "<ul class=\"nav nav-tabs\">";
            echo "<li class=\"$activate[0]\"><a href=\"/electionadmin\">Administrera val</a></li>";
            if($ongoingS){
                echo "<li class=\"$activate[1]\"><a href=\"/stat\">Se tidigare omgångar</a></li>";
                echo "<li class=\"$activate[2]\"><a href=\"/clear\">Stäng nuvarande val</a></li>";
            }
            echo "<li class=\"$activate[3]\"><a href=\"/logout\">Logga ut</a></li>";

        echo "</ul>";
    }

    public function printAdjustPanelMenu($activeTab){
        $evote = new Evote();
        $activate = array("", "", "");
        $activate[$activeTab] = "active";
        echo "<ul class=\"nav nav-tabs\">";
            echo "<li class=\"$activate[0]\"><a href=\"/adjust\">Se föregående omgång</a></li>";
            echo "<li class=\"$activate[1]\"><a href=\"/stat\">Se alla omgångar</a></li>";
            echo "<li class=\"$activate[2]\"><a href=\"/logout\">Logga ut</a></li>";

        echo "</ul>";
    }

    public function printUserhandlerPanelMenu($activeTab){
        $evote = new Evote();
        $activate = array("", "", "", "");
        $activate[$activeTab] = "active";
        echo "<ul class=\"nav nav-tabs\">";
            echo "<li class=\"$activate[0]\"><a href=\"/useradmin\">Hantera användare</a></li>";
            echo "<li class=\"$activate[1]\"><a href=\"/newuser\">Ny användare</a></li>";
            echo "<li class=\"$activate[2]\"><a href=\"/changepassword\">Ändra lösenord</a></li>";
            echo "<li class=\"$activate[3]\"><a href=\"/logout\">Logga ut</a></li>";

        echo "</ul>";
    }

    public function printAdminMenu($activeTab){
        $evote = new Evote();
        $activate = array("", "", "", "");
        $activate[$activeTab] = "active";
        echo "<ul class=\"nav nav-tabs\">";
            echo "<li class=\"$activate[0]\"><a href=\"/adminaccount\">Konto</a></li>";
            echo "<li class=\"$activate[1]\"><a href=\"/adminsettings\">Inställningar</a></li>";
            echo "<li class=\"$activate[2]\"><a href=\"/adminusers\">Hantera användare</a></li>";
            echo "<li class=\"$activate[3]\"><a href=\"/adminlogout\">Logga ut</a></li>";

        echo "</ul>";
    }

}

?>
