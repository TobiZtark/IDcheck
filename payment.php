
<html>

<!-- Head -->
<head>

<title>NIMC Connect | Payment</title>

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

<script  src="js/state-lga.js" type="text/javascript"></script>

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

	<?php

	function test_input($data) {
		$data = strtolower($data);
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	if ($_GET["type"] == "home") {
		$name = test_input($_POST["name"]);
		$family = test_input($_POST["family"]);
		$address = test_input($_POST["address"]);
		$phone = test_input($_POST["phone"]);
		$email = test_input($_POST["email"]);
		$city = test_input($_POST["city"]);
		$state = test_input($_POST["state"]);
	}
	else if($_GET["type"] == "centre"){
		$centre = test_input($_POST["centre"]);
		$state = test_input($_POST["State"]);
		$phone = test_input($_POST["phone"]);
		$email = test_input($_POST["email"]);	
	}
	?>

	<div id="small-dialog2" class="mfp-hide">
		<div class="contact-form1">
			<div class="contact-w3-agileits">
			<img src="images/logo.png">
				<h3>USSD Payment</h3><hr>
				You can now make payments via your mobile phone call units, dial:<br>
				<h3> *346# </h3>
				from any mobile phone provider and follow the prompts.<br><br>
				Note: Make sure your phone balance is enough for the transaction you want to pay for.
			</div>
		</div>	
	</div>
	
	
	<div id="small-dialog">
		<div class="contact-form1">
			<div class="contact-w3-agileits">
			<img src="images/logo.png">
				<h3>Payment Processing</h3><hr>
				<p>Select payment platform.</p>
				<div class="submit-w3l">
						<form action="confirmation.php" method="post">
							<div class="form-sub-w3ls">
							<?php
							if ($_GET["type"] == "home") {
							?>
								<input placeholder="First Name" name="name" type="hidden" value="<?php echo $name;?>">

								<input placeholder="Last Name" name="family" type="hidden" value="<?php echo $family;?>">

								<input placeholder="Address" name="address" type="hidden" value="<?php echo $address;?>">

								<input placeholder="Phone Number" name="phone" type="hidden" value="<?php echo $phone;?>">

								<input placeholder="Email" name="email" type="hidden" value="<?php echo $email;?>">

								<input placeholder="City" name="city" type="hidden" value="<?php echo $city;?>">

								<input placeholder="State/Region" name="State" type="hidden" value="<?php echo $state;?>">
								
						<?php
						}

						else if ($_GET["type"] == "centre") {
						?>


								<input placeholder="City" name="centre" type="hidden" value="<?php echo $centre;?>">

								<input placeholder="State/Region" name="State" type="hidden" value="<?php echo $state;?>">

								<input placeholder="Phone Number" name="phone" type="hidden" value="<?php echo $phone;?>">

								<input placeholder="Email" name="email" type="hidden" value="<?php echo $email;?>">
								<?php
							}
							?>
								

								<p><input type="submit" value="Online Payment"></a></p>
								<br>
							</div>

						</form>
				
				<p><a class="w3_play_icon1" href="#small-dialog2"> <input type="submit" value="USSD Payment"></a></p><br>
				<p>we accept </p><img src="images/cardtypes.png">
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
