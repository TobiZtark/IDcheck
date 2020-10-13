
<html>

<!-- Head -->
<head>

<title>NIMC Connect | Change Collection</title>

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
<script>
    function show_price(lga)
    {
        document.getElementById('price_sp').innerHTML = lga;
    }
 </script>
</head>
<!-- //Head -->

<!-- Body -->
<body onload="fillCategory();">
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

				<br>
				<p>You can now go to your Collection Centre for your card.
				Thank you for being patient with us</p><br>
				
					<form action="payment.php?type=centre" method="post" name="drop_list">
						<div class="form-sub-w3ls">
							<select Name="State" onChange="SelectSubCat()" style="width:400px; height: 30px;">
								<Option value="0">State</option>
							</select>
						</div>
						<br>
						<div class="form-sub-w3ls">
						  <!-- <select name="price" action="post" id="mySelect" onchange="return show_price(this.value);"> -->
		<SELECT   class="form-control" id="lga" NAME="centre" onchange="return show_price(this.value);"  style="width:400px; height: 30px;">
								<Option value="0">Collection center</option>
							
							</SELECT>
						</div>
						<br>
						<br>
						<div class="form-sub-w3ls">
							<input placeholder="Phone Number" name="phone" type="text" required="">
							
						</div>
						<div class="form-sub-w3ls">
							<input placeholder="Email" name="email" type="text" required="">
							
						</div>
						<br>
						<div class="form-sub-w3ls">
						 <div>Location:<br><span id="price_sp"><span></div>
						 </div>
					
					<div class="submit-w3l">
					
							<p> <input type="submit" value="PROCEED"></p><br>
							<p>Back to <a href="index.php">Home</a></p>
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
