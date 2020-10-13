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
	
	<div>
	<div class="w3layoutscontaineragileits">
	<img src="images/logo.png">
	<h2> Check your National ID-Card Status</h2>
	<p><a class="w3_play_icon1" href="#small-dialog3"> <img src="images/bg7.png"></a></p>
		<h3>Note: The details provided MUST be as you spelt them during enrolment and currently printed on your NIN Slip.<br> Please check your NIN Slip.</h3>
			<div class="submit-w3l">
				<p><a class="w3_play_icon1" href="#small-dialog1"> <input type="submit" value="CARD STATUS"></a></p><br><hr>
				<p><h3>If you don't have a NIN Slip or have problems with your card status process.You can check here for your Enrolment Status.</h3></p><br>
				<p><a class="w3_play_icon1" href="#small-dialog"> <input type="submit" value="ENROLMENT STATUS"></a></p><br>
				<br>
				<p>Please visit any <a href="http://www.nimc.gov.ng/enrolment-centres/">NIMC CENTRE</a> nearest to you for more information.</p>
				<div class="clear"></div>
			</div>
	</div>
	</div>
	
	<!-- check card details -->
	<div id="small-dialog1" class="mfp-hide">
		<div class="contact-form1">
			<div class="contact-w3-agileits">
			<img src="images/logo.png">
				<h3>Please enter your Enrolment Details</h3>
				<form action="esc.php" method="post">
						<div class="form-sub-w3ls">
							<input placeholder="First Name" name="name" type="text" required="">
							<div class="icon-agile">
								<i class="fa fa-user" aria-hidden="true"></i>
							</div>
						</div>
						<div class="form-sub-w3ls">
							<input placeholder="Last Name" name="family" type="text" required="">
							<div class="icon-agile">
								<i class="fa fa-user" aria-hidden="true"></i>
							</div>
						</div>
						<div class="form-sub-w3ls">
							<input placeholder="National Identification Number (NIN)" name="nin" type="text" required="">
							<div class="icon-agile">
								<i class="fa fa-unlock-alt" aria-hidden="true"></i>
							</div>
						</div>

					<div class="login-check">
						 <label class="checkbox"><input type="checkbox" name="checkbox" required="">Details provided are the same as that on the NIN Slip</label>
					</div>
					<div class="submit-w3l">
						<input type="submit" value="CHECK STATUS">
					</div>
				</form>
			</div>
		</div>	
	</div>
	<!-- //Card specification -->
	
	<div id="small-dialog3" class="mfp-hide">
		<div class="contact-form1">
			<div class="contact-w3-agileits">
			<img src="images/logo.png">
				<h3>Card Specification</h3><hr>
				<p><a href="mapgame.html"><img src="images/bg8.png"></a></p>
			</div>
		</div>	
	</div>
	
		<!-- //New Enrolment -->
	
	<div id="small-dialog" class="mfp-hide">
		<div class="contact-form1">
			<div class="contact-w3-agileits">
			<img src="images/logo.png">
				<h3>Enrolment Information</h3><hr>
				You can check your Enrolment status below or begin your Pre-enrolment for the National ID-Card Online. All you need is to enter a few details then you can proceed to one of the enrolment centres nearest to you to complete the process.<br>
				Note: Only citizens not previously enrolled would be allowed to successfully enrol.
				<div class="submit-w3l">
				<p><a class="w3_play_icon1" href="#small-dialog2"> <input type="submit" value="CHECK ENROLMENT"></a></p><br>
				<p><a href="http://penrol.nimc.gov.ng"> <input type="submit" value="GO TO PRE-ENROLMENT"></a></p><br>
				<p>Visit any <a href="http://www.nimc.gov.ng/enrolment-centres/">NIMC CENTRE</a> nearest to you</p><br>
				<div class="clear"></div>
			</div>
			</div>
		</div>	
	</div>
	
	<div id="small-dialog2" class="mfp-hide">
		<div class="contact-form1">
			<div class="contact-w3-agileits">
			<img src="images/logo.png">
				<h3>Please enter your Tracking Details</h3>
				<form action="check.php" method="post">
						<div class="form-sub-w3ls">
							<input placeholder="Tracking ID" name="tracking" type="text" required="">
							<div class="icon-agile">
								<i class="fa fa-unlock-alt" aria-hidden="true"></i>
							</div>
						</div>

					<div class="login-check">
						 <label class="checkbox"><input type="checkbox" name="checkbox" required="">Details provided are the same as that on the Tracking Slip</label>
					</div>
					<div class="submit-w3l">
						<input type="submit" value="CHECK STATUS">
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