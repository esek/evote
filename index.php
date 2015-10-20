<!DOCTYPE HTML>

<html>

<head>
    <title>E-vote - Ditt digitala röstsystem</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/evote.css" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
</head>

<body>

    <!-- Header -->
    <div class="fixed-header">
        <div class ="row">
            <div class="col-md-4">
                <div class="logo">
                    <div><h3><span class="label label-info">INSERT LOGO HERE</span></h3></div>
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
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown user-dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                Dropdown<span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>Insert link here</li>
                                <li>Logga ut</li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>  
        </div>
    </div>


    <!-- Sidebar -->
    <div class="container-fluid">

        <div class="col-sm-3 sidebar navbar-collapse collapse col-md-2">
            <ul class="nav nav-sidebar">
                <li class="nav-header disabled"><a>Menyrubrik</a></li>
                <li><a href="index.php">Home</a></li>
                <li><a href="admin.php">Admin</a></li>
            </ul>
        </div>
    </div>

    <!-- Main content -->
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        INSERT CONTENT HERE
    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>