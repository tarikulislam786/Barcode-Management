<?php 
include('../dbconnect.php');
include('config.php');
//include 'config.php' ;

?>

<?php 
$email =$_SESSION["email"];//print_r($email);
 $query = "SELECT fname, lname, role from users where email="."'$email'";//print_r($query);

$result= $conn->query($query);//print_r($result);
//exit(mysql_error());
$result->setFetchMode(PDO::FETCH_ASSOC);
$countmach =$result->rowCount();
//echo $countmach;
if($countmach ==1) {//print_r("login successful");exit;
    $row = $result->fetch();//print_r($row);exit;
    $role = $row['role'];
    $fname = $row['fname'];
    $lname = $row['lname'];
    //print_r($role);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>نظام إدارة الباركود</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
    <meta name="author" content="Muhammad Usman">

    <!-- The styles -->
    <link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">

    <link href="css/charisma-app.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/message.css" media="all" />
    <link href='bower_components/fullcalendar/dist/fullcalendar.css' rel='stylesheet'>
    <link href='bower_components/fullcalendar/dist/fullcalendar.print.css' rel='stylesheet' media='print'>
    <link href='bower_components/chosen/chosen.min.css' rel='stylesheet'>
    <link href='bower_components/colorbox/example3/colorbox.css' rel='stylesheet'>
    <link href='bower_components/responsive-tables/responsive-tables.css' rel='stylesheet'>
    <link href='bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css' rel='stylesheet'>
    <link href='css/jquery.noty.css' rel='stylesheet'>
    <link href='css/noty_theme_default.css' rel='stylesheet'>
    <link href='css/elfinder.min.css' rel='stylesheet'>
    <link href='css/elfinder.theme.css' rel='stylesheet'>
    <link href='css/jquery.iphone.toggle.css' rel='stylesheet'>
    <link href='css/uploadify.css' rel='stylesheet'>
    <link href='css/animate.min.css' rel='stylesheet'>
    <link href='css/pagination.css' rel='stylesheet'>
    <!-- sweetalert css and js -->
    <link rel="stylesheet" href="css/sweetalert/sweetalert.css">
    <!-- jQuery -->
    <script src="js/sweetalert/sweetalert-dev.js"></script>
    <script src="bower_components/jquery/jquery.min.js"></script>
    <!-- Ajax script -->
     <script src="js/script.js"></script>
     <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>

<!-- following 2 scriptfor datatable pagination -->
<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script> -->
<!-- <script type="text/javascript" src="code.jquery.com/jquery-1.12.4.js"></script> -->
     <!--for paginaion-->
    
     <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css" />
     
    <!-- The fav icon -->
    


</head>
<body class="bg">
<?php if (!isset($no_visible_elements) || !$no_visible_elements) { ?>
    <!-- topbar starts -->
    <div class="navbar navbar-default" role="navigation">
        <div class="navbar-inner">
            <button type="button" class="navbar-toggle pull-left animated flip">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="http://chem-barcode.com/usms/admin/home.php"> <img alt="Charisma Logo" src="img/logo20.png" class="hidden-xs"/>
                <span> قسم المختبرات </span></a>
            <!-- user dropdown starts -->
            <div class="btn-group pull-right">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> 
                    <?php 
                    if($role=='1'){echo 'admin';
                    }elseif ($role=='2') {
                        echo $fname.' '.$lname;
                    }
                    else{echo $fname.' '.$lname;}?></span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                   <?php if ($role=='2' || $role=='3') {?>
                       <li><a href="issue-details.php">Details</a></li>
                       <li class="divider"></li>
                    <?php }?>


                    <li><a href="profile-manage.php">Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
            <!-- user dropdown ends -->
            
            <ul class="collapse navbar-collapse nav navbar-nav top-menu">
                <li><a href="http://chem-barcode.com/usms/admin/home.php"><i class="glyphicon glyphicon-globe"></i> Home</a></li>
                
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown"><i class="glyphicon glyphicon-star"></i> Modules <span
                            class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <!-- <li><a href="users-manage.php"><i class="glyphicon glyphicon-cog"></i>&nbsp;Manage User</a></li>
                        <li><a href="users.php"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp;Add User</a></li>
                        <li class="divider"></li> -->
                        <?php if($role== '1'){ // if admin ?>
                        <li><a href="barcode-manage.php"><i class="glyphicon glyphicon-cog"></i>&nbsp;Manage Barcode</a></li>
                        <li><a href="barcode.php"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp;Add Barcode</a></li>
                        <?php }?>
                        <li><a href="barcode-form-search.php"><i class="glyphicon glyphicon-eye-open"></i>&nbsp;View Barcode</a></li>
                        
                    </ul>
                </li>
                
                <!-- <li>
                    <form class="navbar-search pull-left">
                        <input placeholder="Search" class="search-query form-control col-md-10" name="query"
                               type="text">
                    </form>
                </li> -->
            </ul>

        </div>
    </div>
    <!-- topbar ends -->
<?php } ?>
<div class="ch-container">
    <div class="row">
        <?php if (!isset($no_visible_elements) || !$no_visible_elements) { ?>
        <!-- left menu starts -->
        <div class="col-sm-2 col-lg-2">
            <div class="sidebar-nav">
                <div class="nav-canvas">
                    <div class="nav-sm nav nav-stacked">
                    </div>
                    <ul class="nav nav-pills nav-stacked main-menu">
                        <li class="nav-header">Main</li>
                        <li><a class="ajax-link" href="home.php"><i class="glyphicon glyphicon-home"></i><span> Dashboard</span></a>
                        </li>
                        <li class="accordion">
                            <a href="#"><i class="glyphicon glyphicon-plus"></i><span> Barcode</span></a>
                            <ul class="nav nav-pills nav-stacked">
                                
                                <li><a href="barcode-form-search.php"><i class="glyphicon glyphicon-eye-open"></i>&nbsp;View Barcode</a></li>
                                <?php if($role== '1'){ ?>
                                <li><a href="barcode.php"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp;Add Barcode</a></li>
                                <li><a href="barcode-manage.php"><i class="glyphicon glyphicon-cog"></i>&nbsp;Manage Barcode</a></li>
                                <?php }?>
                            </ul>
                        </li>
                    
                    </ul>
                </div>
            </div>
        </div>
        <!--/span-->
        <!-- left menu ends -->

        <!-- <noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Warning!</h4>

                <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
                    enabled to use this site.</p>
            </div>
        </noscript> -->
        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
            <?php } ?>
