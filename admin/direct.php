<?php
if ($_POST["nin"] == "")
{
	header("location:index.php");
}

require ('connect.php');
session_start();
function test_input($data) {
  $data = strtolower($data);
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = test_input($_POST["username"]);
  $password = test_input($_POST["pass"]);
  $nin = test_input($_POST["nin"]);
}
//$last_login = date("Y-m-d H:i:s");

$date = date("Y-m-d H:i:s");

$set = oci_parse($conn,"SELECT * FROM ADMIN WHERE nin='$nin' AND password='$password'" );
oci_execute($set);
$rows = oci_fetch_assoc($set);


if($rows==0)
{
	
	echo "<script language=\"JavaScript\">\n";
	echo "alert('Oops! You entered incorrect details');\n";
	echo "window.location='index.php'";
	echo "</script>";
	die;
}

if($rows>=1)
{
	$sql = "UPDATE ADMIN SET LAST_LOGIN ='$date' WHERE username ='$username'";
	$sys = oci_parse($conn,$sys);
	oci_execute($sys);

	$_SESSION["roleses"] = $rows['ROLE'];
	$_SESSION["ninses"] = $nin;
	$_SESSION['uSession']=$username;
	
	if ($rows['ROLE'] == "S")
	{
		
		header("location:admin.php");
		echo "<script language=\"JavaScript\">\n";
		echo "alert('Welcome Super Admin!');\n";
		echo "window.location.href='admin.php'";
		echo "</script>";
		
	}
	
	else if ($rows['ROLE'] == "A")
	{

		echo "<script language=\"JavaScript\">\n";
		echo "alert('Welcome Administrator!');\n";
		echo "window.location.href='admin.php'";
		echo "</script>";
	}
	else
		echo "<script language=\"JavaScript\">\n";
		echo "alert('An Error Occured');\n";
		echo "window.location='index.php'";
		echo "</script>";
		die;
}
	else
		echo "<script language=\"JavaScript\">\n";
		echo "alert('An Error Occured. Try again');\n";
		echo "window.location='index.php'";
		echo "</script>";
		die;

?>