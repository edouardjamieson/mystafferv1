<!DOCTYPE html>
<!--[if lte IE 6]><html class="preIE7 preIE8 preIE9"><![endif]-->
<!--[if IE 7]><html class="preIE8 preIE9"><![endif]-->
<!--[if IE 8]><html class="preIE9"><![endif]-->
<!--[if gte IE 9]><!-->
<html lang="en" dir="ltr"><!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<title>MyStaffer - Inscription</title>
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
					<!-- <div class="back-btn">
						<a href="https://mystaffer.ca">Retour</a>
					</div> -->
					<div class="login-form" style="transform: translateY(15%);">
						<div class="login-label">Inscription</div>
						<div class="logo-space">
							<img src="content/img/logo-full.png" alt="">
						</div>
						<form method="post" class="lg-fr">
							<div class="login-textbox">
								<input type="text" name="username" placeholder="Nom d'utilisateur" class="login-tb">
							</div>
							<div class="login-textbox">
								<input type="text" name="fullname" placeholder="Nom complet" class="login-tb">
							</div>
							<div class="login-textbox">
								<input type="password" name="password" placeholder="Mot de passe" class="login-tb">
							</div>
							<div class="login-textbox">
								<input type="password" name="repassword" placeholder="Répétez le mot de passe" class="login-tb">
							</div>
							<div class="login-textbox">
								<input type="text" name="email" placeholder="Adresse courriel" class="login-tb">
							</div>
							<div class="login-textbox">
								<input type="text" name="entname" placeholder="Nom du commerce" class="login-tb">
							</div>
							<div class="login-textbox">
								<input type="text" name="enttype" placeholder="Type de commerce" class="login-tb">
							</div>

							<br>
							<input type="submit" name="register" value="C'est partit!" class="login-button">
						</form>

						<?php
						if(!isset($_GET["newregister"])){
							header("Location:https://mystaffer.ca");
						}
						if(isset($_COOKIE["session"])){
							header("Location:home");
						}

						if(isset($_POST["register"])){

							$myusername = htmlentities($_POST["username"]);
							$fullname = htmlentities($_POST["fullname"]);
							$mypassword = htmlentities($_POST["password"]);
							$remypassword = htmlentities($_POST["repassword"]);
							$email = htmlentities($_POST["email"]);
							$entname = htmlentities($_POST["entname"]);
							$enttype = htmlentities($_POST["enttype"]);

							if(empty($myusername)){
								echo "<script language='javascript'>alert('Vous devez entrer votre identifiant!')</script>";
							}
							if(empty($fullname)){
								echo "<script language='javascript'>alert('Vous devez entrer votre nom complet!')</script>";
							}
							if(empty($email)){
								echo "<script language='javascript'>alert('Vous devez entrer votre adresse courriel!')</script>";
							}
							if(empty($mypassword)){
								echo "<script language='javascript'>alert('Vous devez entrer un mot de passe!')</script>";
							}
							if($mypassword != $remypassword){
								echo "<script language='javascript'>alert('Les deux mots de passe ne sont pas identiques!')</script>";
							}
							if(empty($entname)){
								echo "<script language='javascript'>alert('Votre commerce doit tout de même avoir un nom!')</script>";
							}
							if(empty($enttype)){
								echo "<script language='javascript'>alert('Veuillez spécifier le type de votre commerce!')</script>";
							}else{
								if(!empty($myusername && $fullname && $mypassword && $email && $entname && $enttype)){
									$nocommercerand = rand(10000,99999);
									$nocommerce = $nocommercerand;
										// Server credentials
										$vst_hostname = 'mystaffer.ca';
										$vst_username = 'admin';
										$vst_password = 'edouard99';
										$vst_returncode = 'yes';
										$vst_command = 'v-add-database';

										// New Database
										$username = 'admin';
										$db_name = $nocommerce;
										$db_user = $nocommerce;
										$db_pass = 'dieuaimelamoutarde123';

										// Prepare POST query
										$postvars = array(
										    'user' => $vst_username,
										    'password' => $vst_password,
										    'returncode' => $vst_returncode,
										    'cmd' => $vst_command,
										    'arg1' => $username,
										    'arg2' => $db_name,
										    'arg3' => $db_user,
										    'arg4' => $db_pass
										);
										$postdata = http_build_query($postvars);

										// Send POST query via cURL
										$curl = curl_init();
										curl_setopt($curl, CURLOPT_URL, 'https://' . $vst_hostname . ':8083/api/');
										curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
										curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
										curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
										curl_setopt($curl, CURLOPT_POST, true);
										curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
										$answer = curl_exec($curl);

										// Check result
if($answer == 0) {
    echo "Database has been successfuly created\n";
} else {
    echo "Query returned error code: " .$answer. "\n";
}

										$connvar = "admin_".$nocommerce;

										$conn = mysqli_connect("localhost",$connvar,"dieuaimelamoutarde123",$connvar);
										$createent = mysqli_query($conn, "CREATE TABLE `entreprise` (
										  `id` int(11) NOT NULL AUTO_INCREMENT,
										  `session` varchar(255) NOT NULL,
										  `entname` varchar(255) NOT NULL,
										  `enttype` varchar(255) NOT NULL,
										  `email` varchar(255) NOT NULL,
										  `nocommerce` varchar(255) NOT NULL,
										  `manager` varchar(255) NOT NULL,
										  `username` varchar(255) NOT NULL,
										  `password` varchar(255) NOT NULL,
										  `subtype` varchar(255) NOT NULL,
										  `duedate` varchar(255) NOT NULL,
										  PRIMARY KEY (`id`)
									  ) ENGINE=MyISAM DEFAULT CHARSET=latin1;");

										$createemp = mysqli_query($conn, "CREATE TABLE `employees` (
										  `id` int(11) NOT NULL AUTO_INCREMENT,
										  `nom` varchar(255) NOT NULL,
										  `email` varchar(255) NOT NULL,
										  `tel` varchar(255) NOT NULL,
										  `rank` varchar(255) NOT NULL,
										  `visible` varchar(255) NOT NULL,
										  PRIMARY KEY (`id`)
									  ) ENGINE=MyISAM DEFAULT CHARSET=latin1;");

									  $createranks = mysqli_query($conn, "CREATE TABLE `ranks` (
										`id` int(11) NOT NULL AUTO_INCREMENT,
										`nom` varchar(255) NOT NULL,
										`color` varchar(255) NOT NULL,
										PRIMARY KEY (`id`)
									) ENGINE=MyISAM DEFAULT CHARSET=latin1;");

									  	$createevents = mysqli_query($conn, "CREATE TABLE `events` (
										  `id` int(11) NOT NULL AUTO_INCREMENT,
										  `name` varchar(255) NOT NULL,
										  `desc` text NOT NULL,
										  `date` varchar(255) NOT NULL,
										  PRIMARY KEY (`id`)
									  ) ENGINE=MyISAM DEFAULT CHARSET=latin1;");

									  	$createposts = mysqli_query($conn, "CREATE TABLE `posts` (
										  `id` int(11) NOT NULL AUTO_INCREMENT,
										  `poster` varchar(255) NOT NULL,
										  `text` text NOT NULL,
										  `imgdoc` varchar(255) DEFAULT NULL,
										  `link` text DEFAULT NULL,
										  `date` varchar(255) NOT NULL,
										  `pinned` varchar(255) DEFAULT '0',
										  `seenby` text NOT NULL,
										  PRIMARY KEY (`id`)
									  ) ENGINE=MyISAM DEFAULT CHARSET=latin1;");

									  	$createschedule = mysqli_query($conn, "CREATE TABLE `schedule` (
										  `id` int(11) NOT NULL AUTO_INCREMENT,
										  `week` varchar(255) NOT NULL,
										  `emptel` varchar(255) NOT NULL,
										  `lundi` varchar(255) NOT NULL,
										  `mardi` varchar(255) NOT NULL,
										  `mercredi` varchar(255) NOT NULL,
										  `jeudi` varchar(255) NOT NULL,
										  `vendredi` varchar(255) NOT NULL,
										  `samedi` varchar(255) NOT NULL,
										  `dimanche` varchar(255) NOT NULL,
										  `totalhr` varchar(255) NOT NULL,
										  PRIMARY KEY (`id`)
									  ) ENGINE=MyISAM DEFAULT CHARSET=latin1;");

									  $createsettings = mysqli_query($conn, "CREATE TABLE `settings` (
										`id` int(11) NOT NULL AUTO_INCREMENT,
										`alertonpost` varchar(255) NOT NULL,
										`alertonschedule` varchar(255) NOT NULL,
										`alertonjoin` varchar(255) NOT NULL,
										`usercanpost` varchar(255) NOT NULL,
										PRIMARY KEY (`id`)
									) ENGINE=MyISAM DEFAULT CHARSET=latin1;");

										$duedate = date("d/m/Y", strtotime("+1 months"));
									  $addent = mysqli_query($conn, "INSERT INTO entreprise (entname,enttype,email,nocommerce,manager,username,password,subtype,duedate) VALUES ('$entname','$enttype','$email','$nocommerce','$fullname','$myusername','$mypassword','trial','$duedate')");
									  $addsettings = mysqli_query($conn, "INSERT INTO settings (alertonpost,alertonschedule,alertonjoin,usercanpost) VALUES ('1','1','1','0')");
									  $addrank = mysqli_query($conn, "INSERT INTO ranks (nom,color) VALUES ('Employé','dfe4ea')");
									  $mailsubject = "Votre compte a été activé!";
									  $mailmessage = "<html>
									  <div style='width:100%;text-align:center;'>
									  <img src='https://mystaffer.ca/content/img/logo-full.png' style='width:50%;height:auto;'>
									  </div>
									  <div style='font-size:20px;'>
									  	Bienvenue sur MyStaffer, $fullname!<br><br>
										Ceci est un message pour vous confirmer la création de votre compte ainsi que de ses paramètres. Vous pouvez dès maintenant accèder à votre compte avec l'adresse suivante:<br>
										<a href='https://dashboard.mystaffer.ca/login'>Accèder à mon compte</a><br><br>
										Numéro de commerce : $nocommerce<br>
										Nom d'utilisateur : $myusername<br>
										Mot de passe : $mypassword<br><br>
										Pour que vos employés se connectent à votre commerce, ils n'ont qu'à se rendre sur l'adresse :<br>
										<a href='https://mystaffer.ca'>MyStaffer.ca</a><br>Ou sur,
										<a href='https://mobile.mystaffer.ca'>mobile.MyStaffer.ca</a> !<br><br>
										Bienvenue!<br><br><br><br>
										Pour toutes autres questions, écrivez-nous :<br>
										<a href='mailto:hi@mystaffer.ca'>Ici</a>.
									  </div>
									  </html>
									  ";
									  $headers = "MIME-Version: 1.0" . "\r\n";
									  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
									  $headers .= 'From: <noreply@mystaffer.ca>' . "\r\n";
									  mail($email, $mailsubject, $mailmessage, $headers);
									  header("Location:thankyou?mail=$email&entname=$entname&duedate=$duedate");

									}
								}
							}


						 ?>



						<div class="login-notice">
							En vous inscrivant, <u>vous</u> et <u>vos employés</u> acceptent les <a href="https://mystaffer.ca/more/use" target="_blank" style="color:#ff4757">Politiques d'utilisation</a> de MyStaffer.
						</div>
						<div class="login-link">
							<a href="#" class="login-link-btn">Déja inscrit ?</a>
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
