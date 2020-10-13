<!DOCTYPE html>
<html>

<!-- Head -->
<head>

<title> NIMC Connect</title>

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
<?php
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
  $address = test_input($_POST["address"]);
  $phone = test_input($_POST["phone"]);
  $email = test_input($_POST["email"]);
  $city = test_input($_POST["city"]);
  $state = test_input($_POST["state"]);
} 
else
{
  $name = "";
  $family = "";
  $address = "";
  $phone = "";
  $email = "";
  $city = "";
  $state = "";
}

session_start();

$name = $_SESSION['nameses'];
$family = $_SESSION['famses'];
?>

		<div id="small-dialog" >
		<div class="contact-form1">
			<div class="contact-w3-agileits">
			<img src="images/logo.png">
				<h3>Personal Address Delivery</h3><hr>
				<form action="home-delivery.php" method="post">

						<div class="form-sub-w3ls">
							<input placeholder="First Name" name="name" type="text" value="<?php echo $name;?>" required="">
							
						</div>
						<div class="form-sub-w3ls">
							<input placeholder="Last Name" name="family" type="text" value="<?php echo $family;?>" required="">
							
						</div>

						<div class="form-sub-w3ls">
							<input placeholder="Address" name="address" type="text" value="<?php echo $address;?>" required="">
							
						</div>
						<div class="form-sub-w3ls">
							<input placeholder="Phone Number" name="phone" type="text" value="<?php echo $phone;?>" required="">
							
						</div>
						<div class="form-sub-w3ls">
							<input placeholder="Email" name="email" type="text" value="<?php echo $email;?>" required="">
							
						</div>
						<div class="form-sub-w3ls">
							<input placeholder="City" name="city" type="text" value="<?php echo $city;?>" required="">
							
						</div>
						<div class="form-sub-w3ls">
							<input placeholder="State/Region" name="state" type="text" value="<?php echo $state;?>" required="">
							
						</div>

					<div class="login-check">
						 <label class="checkbox"><input type="checkbox" name="checkbox" required="">Details provided are checked and accurate</label>
					</div>
					<div class="submit-w3l">
						<p> <input type="submit" value="PROCEED"></p>
					</div>
				</form>
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
