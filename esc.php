<?php

if ($_POST["nin"] == "")
{
	header("location:index.php");
}

?>

<html>

<!-- Head -->
<head>

<title>NIMC Connect</title>

<!-- Meta-Tags -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="keywords" content="National Identity Management Commission Enrolment System Check">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //Meta-Tags -->
<meta charset="utf-8">
<link rel="icon" type="image/png" href="image/logo3.png">
<link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all">

<!-- Style --> <link rel="stylesheet" href="css/style.css" type="text/css" media="all">

<!-- Fonts -->
<link href="//fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
<!-- //Fonts -->

</head>
<!-- //Head -->

<!-- Body -->
<body>
<script type="text/javascript">
   var num;
   var temp=0;
   var speed=5000; /* this is set for 5 seconds, edit value to suit requirements */
   var preloads=[];

/* add any number of images here */

preload(
        "images/bg1.jpg",
        "images/bg2.jpg",
        "images/bg3.jpg",
        "images/bg4.jpg",
        "images/bg5.jpg",
        "images/bg6.jpg"
       );

function preload(){

for(var c=0;c<arguments.length;c++) {
   preloads[preloads.length]=new Image();
   preloads[preloads.length-1].src=arguments[c];
  }
 }

function rotateImages() {
   num=Math.floor(Math.random()*preloads.length);
if(num==temp){
   rotateImages();
 }
else {
document.body.style.backgroundImage="url("+preloads[num].src+")";
   temp=num;

setTimeout(function(){rotateImages()},speed);
  }
 }

if(window.addEventListener){
   window.addEventListener("load",rotateImages,false);
 }
else { 
if(window.attachEvent){
   window.attachEvent("onload",rotateImages);
  }
 }
</script>

<div id="small-dialog1">
		<div class="contact-form1">
			<div class="contact-w3-agileits">
			<img src="images/logo.png">
				<h2>National ID-Card Processing Information</h2><hr>
<?php
require ('connect.php');

function test_input($data) {
  $data = strtolower($data);
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["name"]);
  $family = test_input($_POST["family"]);
  $nin = test_input($_POST["nin"]);
}
$set = oci_parse($conn,"SELECT * FROM A_CARD_DATA WHERE nin='$nin' AND name='$name' AND family='$family'" );
oci_execute($set);
$rows = oci_fetch_assoc($set);

if ($rows ==0)
{
	echo '
				<h3> Oops!<br>
				<p>We cannot find your Card details.</h3> You either have entered wrong details or you have not been enrolled. Please go back to Home and try again.</p>
				<div class="submit-w3l">
				
				<p>Kindly visit any <a href="http://www.nimc.gov.ng/enrolment-centres/">NIMC CENTRE</a> nearest to you</p><br>
				<p>Go to <a href="index.php">HOME</a></p><br>
				<div class="clear"></div>';

}
if ($rows >=1)
{
 session_start();
 $_SESSION["ninses"] = $nin;
 $_SESSION["nameses"] = $name;
 $_SESSION["famses"] = $family;

	if ($rows['STATUS']=="processing")
	{
	echo '
				<h3><p>Hello '.$name.'</p></h3>
				<h2>Your Card is still being processed.<br></h2>
				<h3>For more information dial *346# on your mobile phone</h3>
				<div class="submit-w3l">
				<p><a class="w3_play_icon1" href="#small-dialog2"> <input type="submit" value="CHANGE COLLECTION CENTRE"></a></p><br>
				<p>Back to <a href="index.php">HOME</a></p>
				<div class="clear"></div>';
	}
	
else if($rows['STATUS']=="printed")
	{
		echo '
				<h3><p>Hello '.$name.'</p></h3>
				Check Card progress below:</p><br><br>
				<h2>Your Card is being processed.<br></h2>
				<h3>For more information dial *346# on your mobile phone</h3>
				<div class="submit-w3l">
				<p><a class="w3_play_icon1" href="#small-dialog2"> <input type="submit" value="CHANGE COLLECTION CENTRE"></a></p><br>
				<p>Back to <a href="index.php">HOME</a></p>
				<div class="clear"></div>';
	}
	
else if($rows['STATUS']=="in-transit")
	{
		echo '
				<h3><p>Hello '.$name.'</p></h3>
				Card Status:</p><br><br>
				<h2>Your Card is being processed for delivery.<br></h2>
				<h3>For more information dial *346# on your mobile phone</h3>
				<div class="submit-w3l">
				<p>Back to <a href="index.php">HOME </a></p><br>
				<p><a class="w3_play_icon1" href="#small-dialog2"> <input type="submit" value="CHANGE COLLECTION CENTRE"></a></p>
				<div class="clear"></div>';
	}
	
else if($rows['STATUS']=="delivered")
	{
		echo '
				<h3><p>Hello '.$name.'</p></h3>
				Card Status:</p><br>
				<h2>Your Card is ready for pickup.</h2>
				<h3>For more information dial *346# on your mobile phone</h3>
				<div class="submit-w3l">
				<p><a class="w3_play_icon1" href="#small-dialog2"> <input type="submit" value="CHANGE COLLECTION CENTRE"></a></p><br>
				<p>Back to <a href="index.php">HOME </a></p>
				<div class="clear"></div>';
				
				
	}

	else if($rows['STATUS']=="collected")
	{
		echo '
				<h3><p>Hello '.$name.'</p></h3>
				Card Status:</p><br>
				<h2>Your Card has been collected.</h2>
				<h3>For more information dial *346# on your mobile phone</h3>
				<div class="submit-w3l">
				<p>Back to <a href="index.php">HOME </a></p>
				<div class="clear"></div>';
				
				
	}
	
else if($rows['STATUS']=="bad enrolment")
	{
		echo'
				<h3><p>Hello '.$name.'</p></h3>
				<h2>Your Enrolment is pending<br></h2>
				<p>Please check back later or visit any <a href="http://www.nimc.gov.ng/enrolment-centres/"NIMC Enrolment Centre</a> for more information.</p>.
				<div class="submit-w3l">
				<p>Back to <a href="index.php">HOME</a></p>
				<div class="clear"></div>';
	}
	else
		echo oci_error();
}


oci_free_statement($set);
oci_close($conn);
?>

				</div>
			</div>
		</div>
	</div>
	
		
	<div id="small-dialog2" class="mfp-hide">
		<div class="contact-form1">
			<div class="contact-w3-agileits">
			<img src="images/logo.png">
				<h3>Change Collection Centre Information</h3><hr>
				It is now possible to change the collection centre for your National ID-Card. This is a service offered by The National Identity Management Commission to ease collection of cards for relocated persons.<br><br>
				You can have your Card delivered to your Home or a collection centre nearest to you.<br><br>
				Note: This service attracts a fee.
				
				<div class="submit-w3l">
				<p><a href="home.php?check=true"> <input type="submit" value="Deliver to Personal Address"></a></p><br>
				<p><a href="change-collection.php"> <input type="submit" value="Deliver to Collection Centre"></a></p>

				<div class="clear"></div>
				</div>
			</div>
		</div>	
	</div>
	
		
	
<div class="w3layoutscontaineragileits">
		<p> &copy; 2017 National Identity Management Comission.<br> All Rights Reserved</p>
	</div>
	
	
	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>

	<!-- pop-up-box-js-file -->  
		<script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
	<!--//pop-up-box-js-file -->
	<script>
		$(document).ready(function() {
		$(".w3_play_icon,.w3_play_icon1,.w3_play_icon2").magnificPopup({
			type: "inline",
			fixedContentPos: false,
			fixedBgPos: true,
			overflowY: "auto",
			closeBtnInside: true,
			preloader: false,
			midClick: true,
			removalDelay: 300,
			mainClass: "my-mfp-zoom-in"
		});
																		
		});
	</script>

</body>
<!-- //Body -->

</html>
