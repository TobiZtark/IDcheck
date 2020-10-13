<?php
require ('connect.php');

function test_input($data) {
  $data = strtolower($data);
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
$last_update = test_input(date("Y-m-d H:i:s"));
										if(isset($_POST["enter"]))
										{
											$load = test_input($_POST['update']);
											
										echo $load."".$last_update;
										}

?>