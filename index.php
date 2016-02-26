<!DOCTYPE HTML>

<html>

<head>
    <title>E-vote - Ditt digitala röstsystem</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/evote.css" rel="stylesheet">
</head>

<body>
<?php
session_start();
require 'data/evote.php';
require 'index/classes/TableGenerator.php';
require 'index/classes/MenuGenerator.php';
require 'data/RandomInfo.php';
require 'data/Dialogue.php';

$evote = new Evote();
$tg = new TableGenerator();
$mg = new MenuGenerator();
$randomString = new RandomInfo();
?>
    <!-- Header -->
    <div class="fixed-header">
        <div class ="row">
            <div class="col-md-4">
                <div class="logo">
                    <!--<div><h3><span class="label label-info">E-vote - Ditt digitala röstsystem</span></h3></div> -->
					<img src="/logo.jpg" />
                </div>
            </div>
        </div>


        <div class="navbar navbar-inverse navbar-default" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">
                        <span>E-vote</span>
                    </a>
                </div>

               <div>

<!--                      <ul class="nav navbar-nav navbar-right">

                      <li class="dropdown user-dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                Dropdown<span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>Insert link here</li>
                                <li>Logga ut</li>
                            </ul>
                        </li>
                    </ul>-->
                </div>
            </div>
        </div>
    </div>


    <!-- Sidebar -->
    <div class="container-fluid">

        <div class="col-sm-3 sidebar navbar-collapse collapse col-md-2">
            <ul class="nav nav-sidebar">

                <?php
                if (true) {
                    echo "<li><a href=\"/vote\">Röstningssida</a></li>";
                    echo "<li class=\"nav-header disabled\"><a><hr class=sidebarruler></a></li>";
                    if (!isset($_SESSION['user'])) {
                        echo '<li><a href="/login">Logga in</a></li>';
                    } else {
                        $priv = $evote->getPrivilege($_SESSION['user']);
                        if ($priv == 1) {
                            echo '<li><a href="/electionadmin">Valansvarig</a></li>';
                        } elseif ($priv == 2) {
                            echo '<li><a href="/adjust">Justerare</a></li>';
                        } elseif ($priv == 0) {
                            echo '<li><a href="/useradmin">Hantera användare</a></li>';
                            echo '<li><a href="/adminmain">Administratör</a></li>';
                        }
                        echo '<li><a href="/logout">Logga ut</a></li>';
                    }
                    #echo "<li class=\"nav-header disabled\"><a><hr class=sidebarruler></a></li>";
                }

                ?>



            </ul>
        </div>
    </div>

    <!-- Main content -->
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<?php


    if(isset($_SESSION['message']) && is_string($_SESSION['message']) && $_SESSION['message'] != ''){
        $d = unserialize($_SESSION['message']);
        $d->printAlerts();
        unset($_SESSION['message']);
    }

/*
    if (isset($_SESSION['message']) && $_SESSION['message']['message'] != '') {
        $type = $_SESSION['message']['type'];
        $info = $randomString->generateTip($type);
        if ($type == 'error') {
            echo '<div class="panel panel-danger">';
        } elseif ($type == 'success') {
            echo '<div class="panel panel-success">';
        }
        echo '<div class="panel-heading">'.$info.'</div>';
        echo '<div class="panel-body">'.$_SESSION['message']['message'].'</div>';
        echo '</div>';
        unset($_SESSION['message']);
    }
*/

    $page = trim($_SERVER['REQUEST_URI'], '/');
    $tr = trim($_SERVER['REQUEST_URI'], '/');
    $nav = explode('/',$tr);

    $module = '';
    $page = '';
    if(isset($nav[0])){
        $module = $nav[0];
    }
    if(isset($nav[1])){
        $page = $nav[1];
    }
    #echo $module;
    #echo $page;

    //
    if($module == 'vote'){
        include 'index/vote/front.php';
    }elseif($module == 'login'){
        include 'index/session/login.php';
    }elseif($module == 'electionadmin'){
        if (!isset($_SESSION['user'])) {
            include 'index/session/login.php';
        } else {
            $mg->printElectionadminPanelMenu($page);
            if($page == 'control')
                include 'index/electionadmin/electionadminpanel.php';
            elseif($page == 'stat')
                include 'index/adjust/stat.php';
            else
                include 'index/electionadmin/electionadminpanel.php';
            }
    }elseif($module == 'adjust'){
        if (!isset($_SESSION['user'])) {
            include 'index/session/login.php';
        } else {
            $mg->printAdjustPanelMenu($page);
            if($page == 'adjustpanel')
                include 'index/adjust/adjustpanel.php';
            elseif($page == 'stat')
                include 'index/adjust/stat.php';
            else
                include 'index/adjust/adjustpanel.php';
            }
    }elseif($module == 'useradmin'){
        if (!isset($_SESSION['user'])) {
            include 'index/session/login.php';
        } else {
            $mg->printUserhandlerPanelMenu($page);
            if($page == 'handleusers')
                include 'index/useradmin/useradminpanel.php';
            elseif($page == 'changepassword')
                include 'index/useradmin/changepassword.php';
            elseif($page == 'newuser')
                include 'index/useradmin/newuser.php';
            else
                include 'index/useradmin/useradminpanel.php';
        }
    }elseif($module == 'adminmain'){
        if (!isset($_SESSION['user'])) {
            include 'index/session/login.php';
        } else {
            $mg->printAdminMenu($page);
            if($page == 'info')
                include 'index/admin/electionsinfo.php';
            elseif($page == 'electioncontrol')
                include 'index/admin/electionControl.php';
            elseif($page == 'electioncontrol')
                include 'index/admin/electionControl.php';
            else
                include 'index/admin/electionsinfo.php';
        }
    }elseif($module == 'logout'){
        if (!isset($_SESSION['user'])) {
            include 'index/session/login.php';
        } else {
            include 'index/session/logout.php';
        }
    }else{
        include 'index/vote/front.php';
    }
/*
    if (!empty($page)) {
        if ($page == 'front') {
            include 'index/front.php';
        } elseif ($page == 'electionadmin') { //----------------- ADMIN
            if (!isset($_SESSION['user'])) {
                include 'index/login.php';
            } else {
                include 'index/electionadminpanel.php';
            }
        } elseif ($page == 'stat') { //------------------ STAT
            if (!isset($_SESSION['user'])) {
                include 'index/login.php';
            } else {
                include 'index/stat.php';
            }
        } elseif ($page == 'clear') { //----------------- CLEAR
            if (!isset($_SESSION['user'])) {
                include 'index/login.php';
            } else {
                include 'index/clear.php';
            }
        } elseif ($page == 'adjust') { //----------------- ADJUST
            if (!isset($_SESSION['user'])) {
                include 'index/login.php';
            } else {
                include 'index/adjustpanel.php';
            }
        } elseif ($page == 'useradmin') { //-------------- USERADMIN
            if (!isset($_SESSION['user'])) {
                include 'index/login.php';
            } else {
                include 'index/useradminpanel.php';
            }
        } elseif ($page == 'newuser') { //---------------- NEW USER
            if (!isset($_SESSION['user'])) {
                include 'index/login.php';
            } else {
                include 'index/newuser.php';
            }
        } elseif ($page == 'changepassword') { //---------------- CHANGE USERPASSWORD
            if (!isset($_SESSION['user'])) {
                include 'index/login.php';
            } else {
                include 'index/changepassword.php';
            }
        } elseif ($page == 'logout') { //---------------- LOGOUT
            if (!isset($_SESSION['user'])) {
                include 'index/login.php';
            } else {
                include 'index/logout.php';
            }
        } elseif ($page == 'login') { //---------------- LOGIN
            include 'index/login.php';
        }

        if($page == 'adminlogin'){
            include 'index/admin/adminlogin.php';
        } elseif ($page == 'adminlogout'){
            if (!isset($_SESSION['user'])) {
                include 'index/admin/adminlogin.php';
            } else {
                include 'index/logout.php';
            }
        } elseif ($page == 'adminmain'){
            if (!isset($_SESSION['user'])) {
                include 'index/admin/adminlogin.php';
            } else {
                include 'index/admin/adminmain.php';
            }
        } elseif ($page == 'electionControl'){
            if (!isset($_SESSION['user'])) {
                include 'index/admin/adminlogin.php';
            } else {
                include 'index/admin/electionControl.php';
            }
        } elseif ($page == 'adminsettings'){
            if (!isset($_SESSION['user'])) {
                include 'index/admin/adminlogin.php';
            } else {
                include 'index/admin/settings.php';
            }
        }
    } else {
        include 'index/front.php';
    }
    */
?>

    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/js/bootstrap.min.js"></script>
</body>

</html>
