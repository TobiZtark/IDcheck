<?php
require ('index.php');
session_start();
if( !isset( $_SESSION['nin'] ) ){
header("location:index.php");
}
	
header("location:esc.php");

?>