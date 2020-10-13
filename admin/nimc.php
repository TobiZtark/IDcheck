<?php
session_start();
ob_start();
$username = "";
$username = $_SESSION['uSession'];
$role = $_SESSION['roleses'];
$nin = $_SESSION['ninses'];

if ($username=="")
{
	header("location:index.php");
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

    <title>NIMC CONNECT ADMIN</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style>
	  iframe {
		height:600px;
        width: 100%;
        margin: 0;
        padding: 0;
      }
	</style>
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
          <?php

include('include/header.php');
               ?>
            <?php 
            if ($role == 'A')
            {
                ?>

           <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="admin.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    
                    <li>
                        <a href="transactions.php"><i class="fa fa-fw fa-table"></i> Transactions</a>
                    </li>
                    
                    <li>
                        <a href="update.php"><i class="fa fa-fw fa-edit"></i> Status Update</a>
                    </li>
                    <li class="active">
                        <a href="nimc.php"><i class="fa fa-fw fa-desktop"></i> NIMC Centres</a>
                    </li>
                    
                </ul>
            </div>
            <?php
        } else
        {
        ?>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="admin.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="permdb.php"><i class="fa fa-fw fa-bar-chart-o"></i> Perm DB Monitor</a>
                    </li>
                    <li>
                        <a href="transactions.php"><i class="fa fa-fw fa-table"></i> Transactions</a>
                    </li>
                    <li>
                        <a href="personal.php"><i class="fa fa-fw fa-desktop"></i> Home Delivery</a>
                    </li>
                    <li>
                        <a href="update.php"><i class="fa fa-fw fa-edit"></i> Status Update</a>
                    </li>
                    <li class="active">
                        <a href="nimc.php"><i class="fa fa-fw fa-desktop"></i> NIMC Centres</a>
                    </li>
                    
                </ul>
            </div>

        <?php
    }
    ?>
            <!-- /.navbar-collapse -->
        </nav>

                <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                     <img src="images/nimc-logo.png">
                        <h1 class="page-header">
                            NIMC Centres Nationwide
                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->
				
                
                  
					<iframe src="map.html"></iframe> 
                
                <!-- /.row -->
		</div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>


</body>


</html>
<?php
ob_flush();

?>