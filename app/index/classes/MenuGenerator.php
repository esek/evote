<?php


class MenuGenerator {

    public function printElectionadminPanelMenu($page){
        $evote = new Evote();
        $ongoingS = $evote->ongoingSession();
        $activate = array("", "", "", "");
        switch($page){
            case 'stat': $activate[1] ='active';
                break;
            default: $activate[0] ='active';
        }
        //$activate[$activeTab] = "active";
        echo "<ul class=\"nav nav-tabs\">";
            echo "<li class=\"$activate[0]\"><a href=\"/electionadmin/control\">".getLocalizedText("Administrate election")."</a></li>";
            if($ongoingS){
                echo "<li class=\"$activate[1]\"><a href=\"/electionadmin/stat\">".getLocalizedText("See previous rounds")."</a></li>";
                //echo "<li class=\"$activate[2]\"><a href=\"/clear\">Stäng nuvarande val</a></li>";
            }

        echo "</ul>";
    }

    public function printAdjustPanelMenu($page){
        $evote = new Evote();
        $activate = array("", "", "");
        switch($page){
            case 'stat': $activate[1] ='active';
                break;
            default: $activate[0] ='active';
        }
        echo "<ul class=\"nav nav-tabs\">";
            echo "<li class=\"$activate[0]\"><a href=\"/adjust/adjustpanel\">".getLocalizedText("See previous round")."</a></li>";
            echo "<li class=\"$activate[1]\"><a href=\"/adjust/stat\">".getLocalizedText("See all rounds")."</a></li>";

        echo "</ul>";
    }

    public function printUserhandlerPanelMenu($page){
        $evote = new Evote();
        $activate = array("", "", "", "");
        switch($page){
            case 'changepassword': $activate[2] ='active';
                break;
            case 'newuser': $activate[1] ='active';
                break;
            default: $activate[0] ='active';
        }
        echo "<ul class=\"nav nav-tabs\">";
            echo "<li class=\"$activate[0]\"><a href=\"/useradmin/handleusers\">".getLocalizedText("Manage users")."</a></li>";
            echo "<li class=\"$activate[1]\"><a href=\"/useradmin/newuser\">".getLocalizedText("New user")."</a></li>";
            echo "<li class=\"$activate[2]\"><a href=\"/useradmin/changepassword\">".getLocalizedText("Change password")."</a></li>";

        echo "</ul>";
    }

    public function printAdminMenu($page){
        $evote = new Evote();
        $activate = array("", "", "", "");
        switch($page){
            case 'electioncontrol': $activate[1] ='active';
                break;
            case 'settings': $activate[2] ='active';
                break;
            default: $activate[0] ='active';
        }
        echo "<ul class=\"nav nav-tabs\">";
            echo "<li class=\"$activate[0]\"><a href=\"/adminmain/info\">Information</a></li>";
            echo "<li class=\"$activate[1]\"><a href=\"/adminmain/electioncontrol\">".getLocalizedText("Manage election session")."</a></li>";
            //echo "<li class=\"$activate[2]\"><a href=\"/adminmain/settings\">Inställningar</a></li>";

        echo "</ul>";
    }

}

?>
