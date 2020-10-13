<?php

// if ($_POST["name"] == "")
 //{
 //	header("location:index.php");
 //}

?>
<!DOCTYPE html>
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
			'images/bg1.jpg',
			'images/bg2.jpg',
			'images/bg3.jpg',
			'images/bg4.jpg',
			'images/bg5.jpg',
			'images/bg6.jpg'
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
				document.body.style.backgroundImage='url('+preloads[num].src+')';
				temp=num;

				setTimeout(function(){rotateImages()},speed);
			}
		}

		if(window.addEventListener){
			window.addEventListener('load',rotateImages,false);
		}
		else { 
			if(window.attachEvent){
				window.attachEvent('onload',rotateImages);
			}
		}
	</script>

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
		$address = test_input($_POST["address"]);
		$phone = test_input($_POST["phone"]);
		$email = test_input($_POST["email"]);
		$city = test_input($_POST["city"]);
		$state = test_input($_POST["state"]);
	}
	?>

	<div id="small-dialog">
		<div class="contact-form1">
			<div class="contact-w3-agileits">
				<img src="images/logo.png">
				<h3>Personal Address Summary</h3><hr>
				<table>

					<tr>
						<td>Name:      </td>
						<td align="left"> <?php echo $name;?><hr></td>
					</tr> 
					<tr>
						<td>Family:    </td>
						<td  align="left"> <?php echo $family;?><hr></td>
					</tr>
					<tr>
						<td>Address:     </td>
						<td  align="left"> <?php echo $address;?><hr></td>
					</tr>
					<tr>
						<td>Phone:     </td>
						<td  align="left"> <?php echo $phone;?><hr></td>
					</tr>
					<tr>
						<td>Email:     </td>
						<td  align="left"> <?php echo $email;?><hr></td>
					</tr>
					<tr>
						<td>City:      </td>
						<td  align="left"> <?php echo $city;?><hr></td>
					</tr>
					<tr>
						<td>State:     </td>
						<td  align="left"> <?php echo $state;?></td>
					</tr>

				</table>
				<div class="submit-w3l">
					<p><a class="w3_play_icon1" href="#small-dialog2"> <input type="submit" value="Submit"></a></p><br>
					<form action="home.php" method="post">
						<div class="form-sub-w3ls">
							<input placeholder="First Name" name="name" type="hidden" value="<?php echo $name;?>">

							<input placeholder="Last Name" name="family" type="hidden" value="<?php echo $family;?>">

							<input placeholder="Address" name="address" type="hidden" value="<?php echo $address;?>">

							<input placeholder="Phone Number" name="phone" type="hidden" value="<?php echo $phone;?>">

							<input placeholder="Email" name="email" type="hidden" value="<?php echo $email;?>">

							<input placeholder="City" name="city" type="hidden" value="<?php echo $city;?>">

							<input placeholder="State/Region" name="state" type="hidden" value="<?php echo $state;?>">

							<p><input type="submit" value="Edit"></p>

						</form>
						<div class="clear"></div>
					</div>
				</div>
			</div>	
		</div>



		<div id="small-dialog2" class="mfp-hide">
			<div class="contact-form1">
				<div class="contact-w3-agileits">
					<img src="images/logo.png">
					<h3>Personal Address Confirmation</h3><hr>
					The details provided are confirmed as accurate and I want to proceed to payment.<br><br>
					Note: This details cannot be changed if you proceed
					<div class="submit-w3l">
						<form action="payment.php?type=home" method="post">
							<div class="form-sub-w3ls">
								<input placeholder="First Name" name="name" type="hidden" value="<?php echo $name;?>">

								<input placeholder="Last Name" name="family" type="hidden" value="<?php echo $family;?>">

								<input placeholder="Address" name="address" type="hidden" value="<?php echo $address;?>">

								<input placeholder="Phone Number" name="phone" type="hidden" value="<?php echo $phone;?>">

								<input placeholder="Email" name="email" type="hidden" value="<?php echo $email;?>">

								<input placeholder="City" name="city" type="hidden" value="<?php echo $city;?>">

								<input placeholder="State/Region" name="state" type="hidden" value="<?php echo $state;?>">
								<br><br>

								<p><input type="submit" value="Proceed to Payment"></a></p>

							</div>

						</form>
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
					$('.w3_play_icon,.w3_play_icon1,.w3_play_icon2').magnificPopup({
						type: 'inline',
						fixedContentPos: false,
						fixedBgPos: true,
						overflowY: 'auto',
						closeBtnInside: true,
						preloader: false,
						midClick: true,
						removalDelay: 300,
						mainClass: 'my-mfp-zoom-in'
					});

				});
			</script>

		</body>
		<!-- //Body -->

		</html>