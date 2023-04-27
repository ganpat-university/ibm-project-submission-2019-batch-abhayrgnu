<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: user_login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
        <title>DAC|User</title>
        <!-- Bootstrap Core CSS -->
        <link href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Menu CSS -->
        <link href="../assets/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
        <!-- chartist CSS -->
        <link href="../assets/bower_components/chartist-js/dist/chartist.min.css" rel="stylesheet">
        <link href="../assets/bower_components/chartist-js/dist/chartist-init.css" rel="stylesheet">
        <link href="../assets/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css"
            rel="stylesheet">
        <link href="../assets/bower_components/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body>
        <!-- Preloader -->
        <div class="preloader">
            <div class="cssload-speeding-wheel"></div>
        </div>
        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" style="margin-bottom: 0">
                <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg "
                        href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i
                            class="ti-menu"></i></a>
                    <div class="top-left-part">
                        <a class="logo" href="index.php"><b><img src="../assets/images/maple-icon.png"
                                    alt="Home"></b><span class="hidden-xs">
                                <font>DAC | User</font>
                            </span></a>
                    </div>
                    <ul class="nav navbar-top-links navbar-left">
                        <li><a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light"><i
                                    class="icon-arrow-left-circle ti-menu"></i></a></li>

                    </ul>
                    <ul class="nav navbar-top-links navbar-right pull-right">

                        <li class="dropdown">
                            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <img
                                    src="../assets/images/users/hritik.jpg" alt="user-img" width="36"
                                    class="img-circle"><b
                                    class="hidden-xs"><b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></b>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                        <!-- /.dropdown -->
                    </ul>
                </div>
                <!-- /.navbar-header -->
                <!-- /.navbar-top-links -->
                <!-- /.navbar-static-side -->
            </nav>
            <div class="navbar-default sidebar nicescroll" role="navigation">
                <div class="sidebar-nav navbar-collapse ">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                            <!--  <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search..."> <span class="input-group-btn">
            <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
            </span> </div> -->
                            <!-- /input-group -->
                        </li>
                        <li class="nav-small-cap">
                            <!-- <b>Main Menu</b> -->
                        </li>
                        <li class="active">
                            <a href="userDashboard.php" class="waves-effect"><b>Dashbord</b></a>
                        </li>
                        <!-- <li class="active">
                        <a href="display_admins.php" class="waves-effect"><b>Display Admin</b></a>
                    </li> -->
                        <li>
                            <a href="collectAddress.php" class="waves-effect"><b>Add address</b></a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- Page Content -->