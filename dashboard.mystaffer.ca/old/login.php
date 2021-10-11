<!DOCTYPE html>
<!--[if lte IE 6]><html class="preIE7 preIE8 preIE9"><![endif]-->
<!--[if IE 7]><html class="preIE8 preIE9"><![endif]-->
<!--[if IE 8]><html class="preIE9"><![endif]-->
<!--[if gte IE 9]><!-->
<html lang="en" dir="ltr"><!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<title>MyStaffer - Panneau de contrôles</title>
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link rel="stylesheet" href="content/css/main.css">
		<link rel="stylesheet" href="content/css/dashboard.css">
	</head>
	<body>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
		<script src="content/js/main.js" type="text/javascript"></script>
		<script src="content/js/side.js" type="text/javascript"></script>

		<div id="main-frame">
			<div class="sign-view">

				<div class="sign-header">
					<div class="back-to-link" onclick="window.location.href='https://mystaffer.ca'">
						<img src="content/img/arrow-left-icon.png" class="backto-arrow" alt="">
						<span class="backto-label">Retour</span>
					</div>
				</div>
				<div class="sign-container">
					<div class="sign-logo">
						<img src="content/img/logo-full.png">
					</div>
						<form class="sictn-form" method="post">
							<div class="sign-form-input">
								<img src="content/img/nocommerce-icon.png" class="sign-form-img" alt="">
								<input type="text" name="nocommerce" class="sign-form-tb" placeholder="Numéro de commerce">
								<br clear="both">
							</div>
							<div class="sign-form-input">
								<img src="content/img/name-icon.png" class="sign-form-img" alt="">
								<input type="text" name="username" class="sign-form-tb" placeholder="Nom d'utilisateur" autocomplete="off">
								<br clear="both">
							</div>
							<div class="sign-form-input">
								<img src="content/img/nocommerce-icon.png" class="sign-form-img" alt="">
								<input type="password" name="password" class="sign-form-tb" placeholder="Mot de passe" autocomplete="off">
								<br clear="both">
							</div><br>
							<input type="submit" name="login" value="Se connecter" class="sign-form-submit">
						</form>


						<?php

						if(isset($_COOKIE["session"])){
							header("Location:home");
						}

						if(isset($_POST["login"])){
							$nocommerce = htmlentities($_POST["nocommerce"]);
							$username = htmlentities($_POST["username"]);
							$password = htmlentities($_POST["password"]);

							if(empty($nocommerce)){
								echo "<script language='javascript'>alert('Vous devez entrer votre numéro de commerce!')</script>";
							}
							if(empty($username)){
								echo "<script language='javascript'>alert('Vous devez entrer votre identifiant!')</script>";
							}
							if(empty($password)){
								echo "<script language='javascript'>alert('Vous devez entrer votre mot de passe!')</script>";
							}else{
								if(!empty($nocommerce && $username && $password)){
									$db = "admin_".$nocommerce;
									$conn = mysqli_connect("localhost",$db,"dieuaimelamoutarde123",$db);
									$getent = mysqli_query($conn, "SELECT * FROM entreprise WHERE username='$username' AND password='$password'");
									$numrowsent = mysqli_num_rows($getent);
									if($numrowsent < 1){
										echo "<script language='javascript'>alert('Les informations indiquées ne sont pas correctes!')</script>";
									}else{
										$sessionrand = rand(100000000000000,999999999999999);
										$session = $sessionrand;
										setcookie("session", $session, time() + (10 * 365 * 24 * 60 * 60));
										setcookie("nocommerce", $nocommerce, time() + (10 * 365 * 24 * 60 * 60));
										$setsession = mysqli_query($conn, "UPDATE entreprise SET session='$session' WHERE nocommerce='$nocommerce'");
										header("Location:home");
									}
								}
							}


						}


						 ?>
				</div>

			</div>
		</div>
	</body>
</html>
