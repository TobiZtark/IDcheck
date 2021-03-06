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

    </head>

    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
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

                    <li class="active">
                        <a href="update.php"><i class="fa fa-fw fa-edit"></i> Status Update</a>
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
                    <li class="active">
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
                                Update Card Delivery Status
                            </h1>
                            <ol class="breadcrumb">
                                <li>
                                    <form action="" method="post">  
                                        Search: <input type="text" name="search" required= ""/>  
                                        <input type="submit" value="Submit" name="submit" />  
                                    </form>  
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.row -->


                    <div class="col-lg-15">

                        <div class="table-responsive">
                               <form action="" method="post">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>

                                        <th>NIN</th>
                                        <th>Name</th>
                                        <th>Current Status</th>
                                        <th>Enrolment Centre</th>
                                        <th>Enrolment Date</th>
                                        <th>Date Delivered</th>
                                        <th>Collection Centre</th>
                                        <th>Collection Date</th>
										<th>Update Status</th>


                                    </tr>
                                </thead>
                                <tbody>
                                   <?php
                                   require ('connect.php');

                                   function test_input($data) {
                                       $data = strtolower($data);
                                       $data = trim($data);
                                       $data = stripslashes($data);
                                       $data = htmlspecialchars($data);
                                       return $data;}

                            $search="";
                            
                            if($search=="")
                            {
                                $set = oci_parse($conn,"SELECT * FROM A_CARD_DATA");

                            }
                             if(isset($_POST["submit"])){
                            $search = test_input($_POST["search"]);
                            $set = oci_parse($conn,"SELECT * FROM A_CARD_DATA WHERE NIN='$search' or NAME='$search' or FAMILY='$search' or STATUS='$search' or ENROLMENT_CENTRE='$search'" );}

                                           oci_execute($set);
                                            while (($rows = oci_fetch_array($set, OCI_BOTH+OCI_RETURN_NULLS)) != false)
                                           {

                                           if($rows <= 0)
                                           {	
                                             ?>
                                             <tr><td colspan="10">No result found</td></tr>
                                             <?php
                                         }
                                         if ($rows>=1)
                                         {

                                         

                                           
                                            if ($rows["STATUS"]=="printed" ||$rows["STATUS"]=="in-transit" || $rows["STATUS"]=="delivered")
                                            {
                                                ?>
                                         
                                                   <tr>

                                                    <td><?php echo $rows["NIN"];?></td>
                                                    <input type="hidden" value="<?php echo $rows["NIN"];?>" name="PKnin[]" />
                                                    <td><?php echo $rows["NAME"]." ".$rows["FAMILY"];?></td>
                                                    <td><?php echo $rows["STATUS"];?></td>
                                                   
                           <td><?php echo $rows["ENROLMENT_CENTRE"];?></td>
                           <td><?php echo $rows["ENROLMENT_DATE"];?></td>
                           <td><?php echo $rows["DATE_DELIVERED"];?></td>
                           <td><?php echo $rows["COLLECTION_CENTRE"];?></td>
                           <td><?php echo $rows["COLLECTION_DATE"];?></td>
                           <td><?php if ($rows["STATUS"]=="printed")
                                                      { ?>
                                                      <select name="update[]" class="form-control">
                                                       <option value="in-transit">in-transit</option>
                                                       <option value="delivered">delivered</option>
                                                       
                                                   </select>
                                                   <?php
                                               }
                                               else if ($rows["STATUS"]=="in-transit")
                                                  { ?>
                                              <select name="update[]" class="form-control">
                                               <option value="delivered">delivered</option>
                                               
                                           </select>
                                           <?php
                                       
                               }
                               else echo $rows["STATUS"];
                               ?>
                           </td>

                       </tr>
     
                   <?php




               }

           }
       }
   

						//	$last_update = test_input(date("Y-m-d H:i:s"));
								//		if(isset($_POST["enter"]))
								//		{


   if (isset($_POST['btn-update-status'])) {
    $nins = $_POST['PKnin'];
    $stats = $_POST['update'];
    for($i=0; $i<=$nins; $i++){

        $set = oci_parse($conn,"UPDATE A_CARD_DATA SET STATUS ='".$stats[$i]."' WHERE NIN='".$nins[$i]."'" );
        $updated = oci_execute($set, OCI_COMMIT_ON_SUCCESS);

        if ($updated)
        {
            echo "<script language=\"JavaScript\">\n";
            echo "alert('Status Update Successful');\n";
            echo "window.location='update.php'";
            echo "</script>";
            die;
        }
        else 
            echo "<script language=\"JavaScript\">\n";
        echo "alert(". oci_error().");\n";
        echo "window.location='update.php'";
        echo "</script>";
        die;
    }
}

										// 	$setname = $rows['NIN'];
										// 	$load = test_input($_POST['update']);
										// 	$set = oci_parse($conn,"UPDATE A_CARD_DATA SET STATUS ='".$load."' WHERE NIN='".$setname."'" );
										// 	$update = oci_execute($set, OCI_COMMIT_ON_SUCCESS);

										// 	if ($update)
										// 	{
										// 			echo "<script language=\"JavaScript\">\n";
										// 			echo "alert('Status Update Successful');\n";
										// 			echo "window.location='update.php'";
										// 			echo "</script>";
										// 			die;
										// 	}
										// 	else 
										// 		echo "<script language=\"JavaScript\">\n";
										// 			echo "alert(". oci_error().");\n";
										// 			echo "window.location='update.php'";
										// 			echo "</script>";
										// 			die;
										// }

?>
<tr><td colspan="9"><input type="submit" value="Submit" name="btn-update-status" /></td></tr>
</tbody>
</table>
              </form>
</div>
</div>
</div>
<!-- /.row -->



</div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>


</body>


</html>
<?php
ob_flush();

?>