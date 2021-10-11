<?php session_start(); ?>
<!DOCTYPE html>
<!--[if lte IE 6]><html class="preIE7 preIE8 preIE9"><![endif]-->
<!--[if IE 7]><html class="preIE8 preIE9"><![endif]-->
<!--[if IE 8]><html class="preIE9"><![endif]-->
<!--[if gte IE 9]><!-->
<html lang="en" dir="ltr"><!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<title>MyStaffer</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="default">
		<meta name="apple-mobile-web-app-title" content="MyStaffer">
		<link rel="apple-touch-startup-image" href="content/img/startup.png">
		<link rel="apple-touch-icon" href="content/img/apple-icon.png"/>

		<meta name="mobile-web-app-capable" content="yes">
		<link rel="shortcut icon" sizes="196x196" href="content/img/apple-touch-icon.png">
		<link rel="shortcut icon" sizes="128x128" href="content/img/apple-touch-icon.png">
		<link rel="icon" href="content/img/apple-touch-icon.png">
		<link rel="stylesheet" href="content/css/main.css">
		<link rel="stylesheet" href="content/css/prelogin.css">
	</head>
	<body onload="side();">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
		<script src="content/js/main.js" type="text/javascript"></script>
		<script src="content/js/side.js" type="text/javascript"></script>

		<div id="main-framework-mobileapp">

			<?php

			if(!isset($_COOKIE['usertel'])){
				header("Location:index");
			}

			$conndb = "admin_".$_COOKIE['nocommerce'];
			$conn = mysqli_connect("localhost",$conndb,"dieuaimelamoutarde123",$conndb) or die("erreur");
			$tel = $_COOKIE['usertel'];
			$getpending = mysqli_query($conn, "SELECT * FROM employees WHERE tel='$tel'");
			$nrows = mysqli_num_rows($getpending);
			if($nrows < 1){
				echo "<script language='javascript'>alert('La demande a expirée!')</script>";
				header("Location:logout");
			}else{
			while($emp = mysqli_fetch_array($getpending)){
			 	if($emp['rank'] != "pending"){
					header("Location:home");
				}
			}
		}

			?>

			<div class="reg-logoplacement">
				<img src="content/img/logo-full.png" alt="logo" class="reg-logo">
			</div>
			<div class="pending-box">
				<span class="pending-warning">PATIENTEZ</span>
				<div class="pending-text">
					<div class="pending-p">Votre demande à rejoindre le groupe à été fait au gérant. Vous receverez un courriel lorsqu'il ou elle vous aura accepté!<br><br>Merci de votre compréhension.</div><br>
					<div class="refresh-pending" onclick="location.reload()">Rafraichir</div>
				</div>
			</div>

		</div>

	</body>
</html>
