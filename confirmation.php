<?php
session_start();
ob_start();
include("maigaurd/dbconfig.php");

$name = $_SESSION['nameses'];
$family = $_SESSION['famses'];
$nin = $_SESSION['ninses'];
if ($name == "")
{
	header("location:index.php");
}

?>
<!DOCTYPE html>
<html>

<!-- Head -->
<head>

	<title>NIMC Connect | Confirmation</title>

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


	function to_up($data){

		$data = strtoupper($data);
		return $data;
	}
$destination = "";
	if (isset($_POST["name"] )) {
		$name = test_input($_POST["name"]);
		$family = test_input($_POST["family"]);
		$address = test_input($_POST["address"]);
		$phone = test_input($_POST["phone"]);
		$email = test_input($_POST["email"]);
		$city = test_input($_POST["city"]);
		$state = test_input($_POST["State"]);
		$destination = $address.", ".$state.", ".$city;
	}
	else if (isset($_POST["centre"]))
	{
		$centre = test_input($_POST["centre"]);
		$state = test_input($_POST["State"]);
		$phone = test_input($_POST["phone"]);
		$email = test_input($_POST["email"]);
		$destination = $centre;
	}


	$date = date("Y-m-d H:i:s");
	$dispatch = to_up(substr(base_convert(md5($nin), 16,32), 0, 12));

	$set = oci_parse($conn,"SELECT * FROM A_CARD_DATA WHERE name='$name' AND nin='$nin'" );
	oci_execute($set);
	$rows = oci_fetch_assoc($set);

	if ($rows >= 1)
	{
		if (isset($_POST["name"])) {

			$ret = oci_parse($conn,"SELECT * FROM ADDR_REQ WHERE nin='$nin'" );
			oci_execute($ret);
			$sows = oci_fetch_assoc($ret);

			if($sows>=1)
			{
				$get = oci_parse($conn,"UPDATE ADDR_REQ SET ADDRESS='$address', PHONE='$phone', CITY='$city', STATE='$state' WHERE NIN='$nin'");
				$updated = oci_execute($get, OCI_COMMIT_ON_SUCCESS);

				$let = oci_parse($conn,"UPDATE A_CARD_DATA SET COLLECTION_CENTRE='HOME', STATE='$state', PHONE='$phone', EMAIL='$email', PAYMENT_DATE='$date', CONFIRMATION_STATUS='OK', PAYMENT_TYPE='ONLINE' WHERE NIN='$nin'" );
				$updated = oci_execute($let, OCI_COMMIT_ON_SUCCESS);

			}
			else
			{
				$get = oci_parse($conn,"INSERT INTO ADDR_REQ(NIN, ADDRESS, PHONE, CITY, STATE) VALUES ('$nin','$address','$phone','$city','$state')");
				$updated = oci_execute($get);

				$let = oci_parse($conn,"UPDATE A_CARD_DATA SET COLLECTION_CENTRE='HOME', STATE='$state', PHONE='$phone', EMAIL='$email', PAYMENT_DATE='$date', CONFIRMATION_STATUS='OK', PAYMENT_TYPE='ONLINE' WHERE NIN='$nin'" );
				$updated = oci_execute($let, OCI_COMMIT_ON_SUCCESS);
			}
		}
		else {

			$let = oci_parse($conn,"UPDATE A_CARD_DATA SET COLLECTION_CENTRE='$centre', STATE='$state', PHONE='$phone', EMAIL='$email', CONFIRMATION_STATUS='OK', PAYMENT_TYPE='ONLINE', PAYMENT_DATE='$date' WHERE NIN='$nin'" );
			$updated = oci_execute($let, OCI_COMMIT_ON_SUCCESS);
		}
		if ($updated)
		{ 
			$bet = oci_parse($conn,"UPDATE A_CARD_DATA SET DISPATCH_ID='$dispatch' WHERE NIN='$nin'" );
			$upd = oci_execute($bet, OCI_COMMIT_ON_SUCCESS);


			$html_head = file_get_contents("mailer/template/confirm-change/head_html.html");
			$html_body = file_get_contents("mailer/template/confirm-change/body_html.html");
        	$html_before_tail = file_get_contents("mailer/template/confirm-change/before_tail_html.html");
        	$html_after_tail = file_get_contents("mailer/template/confirm-change/after_tail_html.html");

			$html_tail = "
	<tr>
		<td>
			Dispatch ID:
		</td>
		<td>
			".$dispatch."<br><br>
		</td>
	</tr>

	<tr>
		<td>
			Destination:
		</td>
		<td>
			".$destination."
		</td>
	</tr>";

	$subject = "NIMC Connect (Card Collection Center Change)";

$email_message = $html_head.$html_body.$html_before_tail.$html_tail.$html_after_tail;
$sms_message = "Your card collection center was successfully changed. Dispatch ID: ".$dispatch;
	$sms_sent = $crud->sendSMS($phone, $sms_message);
	$email_sent = $crud->send_confirmation_email($email, $email_message, $subject);
	?>
	<div id="small-dialog3">
		<div class="contact-form1">
			<div class="contact-w3-agileits">
				<img src="images/logo.png">
				<h3>Payment Notification<br><hr>
					<br>
					<h3> Transaction Successful! <br>
						Dispatch ID: <?php  echo $dispatch;  ?></h3>
						Your change of collection centre request is successfully completed.<br> Note: Please keep your Dispatch ID safe for future reference. You can write it down somewhere. <br><br>
<?php
if($sms_sent || $email_sent){

?>
A confirmation message has been sent to your phone number and email

<?php
}

?>
						<div class="submit-w3l">
							<p><a href="index.php"> <input type="submit" value="Done"></a></p>
						</div>
					</div>
				</div>	
			</div>
			<?php
		}
		else {
			?>
			<div id="small-dialog3">
				<div class="contact-form1">
					<div class="contact-w3-agileits">
						<img src="images/logo.png">
						<h3>Payment Notification</h3><hr>
						<br>
						<h3> Transaction Unsuccessful! </h3>
						Your change of collection centre request is unsuccessful <br><br>
						<br>
						<div class="submit-w3l">
							<p><a href="index.php"> <input type="submit" value="Try again"></a></p>
						</div>
					</div>
				</div>	
			</div>
			<?php
		}
	}   else {
		?>
		<div id="small-dialog3">
			<div class="contact-form1">
				<div class="contact-w3-agileits">
					<img src="images/logo.png">
					<h3>Payment Notification</h3><hr>
					<br>
					<h3> Transaction Unsuccessful! </h3>
					Your change of collection centre request is unsuccessful <br><br>
					Status: <?php echo oci_error()?>
					<br>
					<div class="submit-w3l">
						<p><a href="index.php"> <input type="submit" value="Try again"></a></p>
					</div>
				</div>
			</div>	
		</div>
		<?php
	}
	?>


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
<?php
ob_start();
session_destroy();
?>