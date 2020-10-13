<?php
require ('direct.php');
session_start();
if( $_POST["nin"] == "" ){
header("location:index.php");
}
	
header("location:admin.php");

?>