<!DOCTYPE html>
<!--[if lte IE 6]><html class="preIE7 preIE8 preIE9"><![endif]-->
<!--[if IE 7]><html class="preIE8 preIE9"><![endif]-->
<!--[if IE 8]><html class="preIE9"><![endif]-->
<!--[if gte IE 9]><!-->
<html lang="en" dir="ltr"><!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<title>MyStaffer - Connexion</title>
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link rel="stylesheet" href="content/css/main.css">
		<link rel="stylesheet" href="content/css/prelogin.css">
	</head>
	<body onload="side();">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
		<script src="content/js/main.js" type="text/javascript"></script>
		<script src="content/js/side.js" type="text/javascript"></script>

		<div class="loading">
			<img src="content/img/ajax-loader.gif" alt="" draggable="false">
		</div>
		<div id="main-frame">

         <div class="login-container">
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
								setcookie("logno", $nocommerce, time() + (10 * 365 * 24 * 60 * 60));
								setcookie("logus", $username, time() + (10 * 365 * 24 * 60 * 60));
								$setsession = mysqli_query($conn, "UPDATE entreprise SET session='$session' WHERE nocommerce='$nocommerce'");
								header("Location:home");
							}
						}
					}


				}



				 ?>
					<!-- <div class="back-btn">
						<a href="https://mystaffer.ca">Retour</a>
					</div> -->
					<div class="login-form">
						<div class="login-label">Connexion à l'espace gérant</div>
						<div class="logo-space">
							<img src="content/img/logo-full.png" alt="">
						</div>
						<form method="post" class="lg-fr">
							<div class="login-textbox">
								<input type="number" name="nocommerce" placeholder="Numéro de commerce" class="login-tb" value="<?php if(!empty($_COOKIE["logno"])){echo $_COOKIE["logno"];} ?>">
							</div>
							<div class="login-textbox">
								<input type="text" name="username" placeholder="Nom d'utilisateur" class="login-tb"  value="<?php if(!empty($_COOKIE["logus"])){echo $_COOKIE["logus"];} ?>">
							</div>
							<div class="login-textbox">
								<input type="password" name="password" placeholder="Mot de passe" class="login-tb">
							</div><br>
							<input type="submit" name="login" value="Connexion" class="login-button">
						</form>
						<div class="login-link">
							<a href="#" class="login-link-btn">Mot de passe perdu ?</a>
							<a href="#" class="login-link-btn">Pas encore inscrit ?</a>
						</div>
					</div>


         </div>



		</div>
		<script language="javascript" type="text/javascript">
		 	$(window).load(function() {
		     	$('.loading').hide();
		  	});
		</script>

	</body>
</html>
