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

			<div class="noapp-view">
				<div class="noapp-desc">
					<span class="noapp-alert">Vous y êtes presque!</span>
					<p>Il ne vous reste plus qu'a ajouter l'application à votre écran d'accueil en appuyant sur le bouton ci-dessou!</p>
				</div>
				<div class="arrow">
					<img src="content/img/arrow-down.png" class="arrow-down">
				</div>
			</div>

      <div class="back-to-reg" onclick="window.location = 'index'">
				<img src="content/img/arrow-left-icon.png" class="backtoreg-img" alt="">
			</div>

			<div class="reg-logoplacement">
				<img src="content/img/logo-full.png" alt="logo" class="reg-logo">
			</div>
			<div class="reg-registerbox">
				<div class="register">
					<?php

					if(isset($_COOKIE['usertel'])){
						header("Location:pending");
					}

					if(isset($_POST["submit-register"])){

						$nocommerce = htmlentities($_POST["nocommerce"]);
						$name = htmlentities($_POST["userfullname"]);
						$email = htmlentities($_POST["useremail"]);
						$tel = htmlentities($_POST["usertel"]);

						if(empty($nocommerce)){
							echo "<script language='javascript'>alert('Vous devez entrer un numéro de commerce!')</script>";
						}
						if(empty($name)){
							echo "<script language='javascript'>alert('Vous devez entrer votre nom!')</script>";
						}
						if(empty($email)){
							echo "<script language='javascript'>alert('Vous devez entrer une adresse courriel!')</script>";
						}
						if(empty($tel)){
							echo "<script language='javascript'>alert('Vous devez entrer un numéro de téléphone!')</script>";
						}

						if(!empty($nocommerce && $name && $email && $tel)){

							$conndb = "admin_".$nocommerce;
							$conn = mysqli_connect("localhost",$conndb,"dieuaimelamoutarde123",$conndb) or die("erreur");
							$fetchuser = mysqli_query($conn, "SELECT * FROM employees WHERE tel='$tel'");
							$nrows = mysqli_num_rows($fetchuser);
							if($nrows > 0){
								echo "<script language='javascript'>alert('Cet employé existe déjà!')</script>";
							}else {
								$adduser = mysqli_query($conn, "INSERT INTO employees (nom,email,tel,rank) VALUES ('$name','$email','$tel','pending')");
								setcookie("nocommerce", $nocommerce, time() + (10 * 365 * 24 * 60 * 60));
								setcookie("usertel", $tel, time() + (10 * 365 * 24 * 60 * 60));
								header("Location:pending");
							}

						}

					}


					?>
					<form method="post">
						<div class="reg-uitextbox">
							<img src="content/img/nocommerce-icon.png" alt="nocommerce" class="uitxtbox-icon">
							<input type="number" name="nocommerce" placeholder="# de commerce" class="reg-textbox">
						</div>
						<div class="reg-uitextbox">
							<img src="content/img/name-icon.png" alt="fullname" class="uitxtbox-icon">
							<input type="text" name="userfullname" placeholder="Nom complet" class="reg-textbox">
						</div>
						<div class="reg-uitextbox">
							<img src="content/img/email-icon.png" alt="email" class="uitxtbox-icon">
							<input type="text" name="useremail" placeholder="Adresse courriel" class="reg-textbox">
						</div>
						<div class="reg-uitextbox">
							<img src="content/img/tel-icon.png" alt="email" class="uitxtbox-icon">
							<input type="text" name="usertel" placeholder="Téléphone" class="reg-textbox">
						</div>
						<div class="reg-submitbtn reg-uitextbox">
							<img src="content/img/done-icon.png" alt="done" class="uitxtbox-icon">
							<input type="submit" name="submit-register" value="C'est partie!" class="submit-reg">
						</div><br>

					</form>
				</div>
			</div>

		</div>

	</body>
</html>
