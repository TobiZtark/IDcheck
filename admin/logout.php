<?php
session_start();
ob_start();
$username = "";
$username = $_SESSION['uSession'];
session_destroy();
ob_flush();
header("location:index.php");

?>