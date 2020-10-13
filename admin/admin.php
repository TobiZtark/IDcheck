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
require ('connect.php');

$set = oci_parse($conn,"SELECT COUNT (*) AS SEED FROM A_CARD_DATA");
oci_execute($set);
$sount = oci_fetch_array($set);
$count = $sount["SEED"];

$ret = oci_parse($conn,"SELECT COUNT(PAYMENT_TYPE) AS TEED FROM A_CARD_DATA");
oci_execute($ret);
$lount = oci_fetch_array($ret);
$dount = $lount["TEED"];

$tet = oci_parse($conn,"SELECT COUNT(STATUS) AS FEED FROM A_CARD_DATA where STATUS ='printed'or STATUS ='in-transit'or STATUS ='delivered'or STATUS ='collected'");
oci_execute($tet);
$vount = oci_fetch_array($tet);
$fount = $vount["FEED"];

$vet = oci_parse($conn,"SELECT COUNT(STATUS) AS DEED FROM A_CARD_DATA where Status = 'delivered'");
oci_execute($vet);
$zount = oci_fetch_array($vet);
$gount = $zount["DEED"];

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
                    <li class="active">
                        <a href="admin.php"><i class="fa fa-fw fa-dashboard"></i>Dashboard</a>
                    </li>
                    
                    <li>
                        <a href="transactions.php"><i class="fa fa-fw fa-table"></i>Transactions</a>
                    </li>
                    
                    <li>
                        <a href="update.php"><i class="fa fa-fw fa-edit"></i>Status Update</a>
                    </li>
                    <li>
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
                    <li class="active">
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
                    <li>
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
                            Overview
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  <strong>Welcome <?php echo $username; ?></strong>, please note your activities on this page is monitored and can be called for questioning at any time. Thanks.
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-database fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">

                                        <div class="huge"><?php if ($count!=""){ echo $count;} ?></div>
                                        <div>Total Records</div>
                                    </div>
                                </div>
                            </div>
                            <a href="permdb.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-credit-card fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php if ($fount!=""){ echo $fount;} ?></div>
                                        <div>Cards Printed</div>
                                    </div>
                                </div>
                            </div>
                            <a href="permdb.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php if ($dount!=""){ echo $dount;} ?></div>
                                        <div>New Transactions</div>
                                    </div>
                                </div>
                            </div>
                            <a href="transactions.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-check-circle fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php if ($gount!=""){ echo $gount;} ?></div>
                                        <div>Ready for Collection</div>
                                    </div>
                                </div>
                            </div>
                            <a href="permdb.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i> Donut Chart</h3>
                            </div>
                            <div class="panel-body">
                                <div id="morris-donut-chart"></div>
                                <div class="text-right">
                                    <a href="#">View Details <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Tasks Panel</h3>
                            </div>
                            <div class="panel-body">
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <span class="badge">just now</span>
                                        <i class="fa fa-fw fa-calendar"></i> Calendar updated
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">4 minutes ago</span>
                                        <i class="fa fa-fw fa-comment"></i> Commented on a post
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">23 minutes ago</span>
                                        <i class="fa fa-fw fa-truck"></i> Order 392 shipped
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">46 minutes ago</span>
                                        <i class="fa fa-fw fa-money"></i> Invoice 653 has been paid
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">1 hour ago</span>
                                        <i class="fa fa-fw fa-user"></i> A new user has been added
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">2 hours ago</span>
                                        <i class="fa fa-fw fa-check"></i> Completed task: "pick up dry cleaning"
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">yesterday</span>
                                        <i class="fa fa-fw fa-globe"></i> Saved the world
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">two days ago</span>
                                        <i class="fa fa-fw fa-check"></i> Completed task: "fix error on sales page"
                                    </a>
                                </div>
                                <div class="text-right">
                                    <a href="#">View All Activity <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Transactions Panel</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>NIN</th>
                                                <th>Dispatch ID</th>
                                                <th>Change Time</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $met= oci_parse($conn,"SELECT * FROM A_CARD_DATA ");
                                        oci_execute($met);
                                        
                                        while (($rows = oci_fetch_array($met, OCI_BOTH+OCI_RETURN_NULLS)) != false)
                            {
                                if ($rows["PAYMENT_DATE"]!="")
                                {
                                ?>
    
                                   <tr>
                                        <td><?php echo $rows["NIN"];?></td>
                                        <td><?php echo $rows["DISPATCH_ID"];?></td>
                                        <td><?php echo $rows["PAYMENT_DATE"];?></td>
                                        <td><?php echo $rows["CONFIRMATION_STATUS"];?></td>
                                        
                                        </tr>
                                        <?php
                                    }
                            }
                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-right">
                                    <a href="transactions.php">View All Transactions <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
   


    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>


</body>

</html>
<?php
ob_flush();

?>