<?php

if ($_POST["tracking"] == "")
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
<meta charset="utf-8" />
<link rel="icon" type="image/png" href="image/logo3.png">
<link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />

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
  $tracking = test_input($_POST["tracking"]);
}
$set = oci_parse($conn,"SELECT * FROM A_CARD_DATA WHERE tracking_id='$tracking'" );
oci_execute($set);
$rows = oci_fetch_assoc($set);

if ($rows ==0)
{
	echo '
				<h3> Oops!<br>
				We cannot verify your Enrolment Status.</h3> <p>You either have entered wrong details or you have not been properly enrolled. 
				Please visit any <a href="http://www.nimc.gov.ng/enrolment-centres/">NIMC Enrolment Centre</a> for more information.</p>
				</div>
				<div class="submit-w3l">
				<p><a href="index.php"> <input type="submit" value="Go Back to Home"></a></p><br>';

}
if ($rows >=1)
{

	if ($rows['ENROLMENT_STATUS']=="not successful")
	{
	echo '
				Hello '.$rows["NAME"].'<br><br>
				<h3>Your Enrolment is pending</h3>
				<p>Please check back later or visit any <a href="http://www.nimc.gov.ng/enrolment-centres/">NIMC Enrolment Centre</a> for more information.</p>
				</div>
				<div class="submit-w3l">
				<p><a href="index.php"> <input type="submit" value="GO TO HOME"></a></p><br>';
	}
	
else if($rows['ENROLMENT_STATUS']=="successful")
	{
		echo '
				Hello '.$rows["NAME"].',<br>
				Enrolment Status:<br><br>
				<h2>Status: '.$rows["ENROLMENT_STATUS"].'<br>
				Centre: '.$rows["ENROLMENT_CENTRE"].'<br>
				Date: '.$rows["ENROLMENT_DATE"].'<br></h2>
				Please visit any <a href="http://www.nimc.gov.ng/enrolment-centres/">NIMC Enrolment Centre</a> to pick-up your NIN slip.
				</div>
				<div class="submit-w3l">
				<p><a href="index.php"> <input type="submit" value="GO TO HOME"></a></p><br>';
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
				<p>It is now possible to change the collection centre for your National ID-Card. This is a service offered by The National Identity Management Commission to ease collection of cards for relocated persons.<br>
				Note:This service attracts a fee of N3500 only.
				</p>
				<div class="submit-w3l">
				<p><a href="#"> <input type="submit" value="PROCEED"></a></p>
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
