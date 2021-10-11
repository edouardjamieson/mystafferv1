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

			<div class="dashnavigation-menu">
				<div class="navi-inner">
					<div class="navi-link" onclick="window.location = 'home'">
						<img src="content/img/home-icon.png" alt="" class="ni-icon">
					</div>
					<div class="navi-link" onclick="window.location = 'posts'">
						<img src="content/img/posts-icon.png" alt="" class="ni-icon">

					</div>
					<div class="navi-link" onclick="window.location = 'schedule'">
						<img src="content/img/schedule-icon.png" alt="" class="ni-icon">
					</div>
					<div class="navi-link" onclick="window.location = 'staff'">
						<img src="content/img/employees-icon.png" alt="" class="ni-icon">
					</div>
					<div class="navi-link navi-active" onclick="window.location = 'settings'">
						<img src="content/img/settings-icon.png" alt="" class="ni-icon">
						<span class="ni-label">PARAMÈTRES</span>
					</div>
				</div>
			</div>
			<div class="content-wrapper">
				<?php

				if(!isset($_COOKIE["session"])){
					header("Location:login");
				}


				$nocommerce = $_COOKIE["nocommerce"];
				$db = "admin_".$nocommerce;
				$conn = mysqli_connect("localhost",$db,"dieuaimelamoutarde123",$db);

				?>
				<div class="page-title"><div class="page-title-text">Paramètres</div></div>
				<div class="param-view"><br>

					<div class="param-box">

						<span class="param-teller">Paramètre de l'entreprise</span><br><br>
						<form method="post">

							<?php

								$getparament = mysqli_query($conn, "SELECT * FROM entreprise");
								while($parament = mysqli_fetch_array($getparament)){


							 ?>

							<span class="param-label">Nom du commerce</span><br>
							<input type="text" class="param-tb" name="commerce-name" value="<?php echo $parament["entname"]; ?>"><br><br>
							<span class="param-label">Type de commerce</span><br>
							<input type="text" class="param-tb" name="commerce-type" value="<?php echo $parament["enttype"]; ?>"><br><br>
							<span class="param-label">Adresse courriel du gérant</span><br>
							<input type="text" class="param-tb" name="commerce-email" value="<?php echo $parament["email"]; ?>"><br><br>
							<span class="param-label">Nom d'utilisateur du gérant</span><br>
							<input type="text" class="param-tb" name="commerce-username" value="<?php echo $parament["username"]; ?>"><br><br>
							<span class="param-label">Nom du gérant</span><br>
							<input type="text" class="param-tb" name="commerce-manager" value="<?php echo $parament["manager"]; ?>"><br><br>
							<input type="submit" name="submit-entstgs" value="Sauvegarder" class="stgs-submit">



						<?php }
						if(isset($_POST["submit-entstgs"])){
							$commercename = $_POST["commerce-name"];
							$commercetype = $_POST["commerce-type"];
							$commerceemail = $_POST["commerce-email"];
							$commerceusername = $_POST["commerce-username"];
							$commercemanager = $_POST["commerce-manager"];
							if(empty($commercename)){
								echo "<script language='javascript'>alert('Votre commerce doit avoir un nom!')</script>";
							}
							if(empty($commercetype)){
								echo "<script language='javascript'>alert('Votre commerce doit avoir un type!')</script>";
							}
							if(empty($commerceemail)){
								echo "<script language='javascript'>alert('Votre commerce doit avoir une adresse courriel!')</script>";
							}
							if(empty($commerceusername)){
								echo "<script language='javascript'>alert('Votre commerce doit avoir un nom de connexion!')</script>";
							}
							if(empty($commercemanager)){
								echo "<script language='javascript'>alert('Votre commerce doit comporter un nom de gérant valide!')</script>";
							}
							if(!empty($commercename && $commercetype && $commerceemail && $commerceusername && $commercemanager)){
								$newentstgs = mysqli_query($conn, "UPDATE entreprise SET entname='$commercename', enttype='$commercetype', email='$commerceemail', manager='$commercemanager', username='$commerceusername' WHERE id='1'");
								header("Location:home");
							}
						}
						?>

					</form><br>
						<div class="stgs-sep"></div><br>

						<span class="param-teller">Paramètre des employés</span><br><br>
						<form method="post">

							<?php

							$getparam = mysqli_query($conn, "SELECT * FROM settings");
							while($stg = mysqli_fetch_array($getparam)){

							 ?>

							<span class="param-label">Notification pour une nouvelle publication</span><br>
							<select class="stgs-select" name="stg-notifpost">
								<?php
								if($stg["alertonpost"] == 1){
									echo "
									<option value='1' selected>Oui</option>
									<option value='0'>Non</option>
									";
								}else{
									echo "
									<option value='1'>Oui</option>
									<option value='0' selected>Non</option>";
								}
								 ?>
							</select><br>

							<span class="param-label">Notification pour un nouvel horaire</span><br>
							<select class="stgs-select" name="stg-notifschedule">
								<?php
								if($stg["alertonschedule"] == 1){
									echo "
									<option value='1' selected>Oui</option>
									<option value='0'>Non</option>
									";
								}else{
									echo "
									<option value='1'>Oui</option>
									<option value='0' selected>Non</option>";
								}
								 ?>
							</select><br>

							<span class="param-label">Notification pour un nouvel employé</span><br>
							<select class="stgs-select" name="stg-notifjoin">
								<?php
								if($stg["alertonjoin"] == 1){
									echo "
									<option value='1' selected>Oui</option>
									<option value='0'>Non</option>
									";
								}else{
									echo "
									<option value='1'>Oui</option>
									<option value='0' selected>Non</option>";
								}
								 ?>
							</select><br>

							<span class="param-label">Les employés peuvent publier</span><br>
							<select class="stgs-select" name="stg-usercanpost">
								<?php
								if($stg["usercanpost"] == 1){
									echo "
									<option value='1' selected>Oui</option>
									<option value='0'>Non</option>
									";
								}else{
									echo "
									<option value='1'>Oui</option>
									<option value='0' selected>Non</option>";
								}
								 ?>
							</select><br>



							<input type="submit" name="submit-empstgs" value="Sauvegarder" class="stgs-submit">

						<?php }

						if(isset($_POST["submit-empstgs"])){
							$notifpost = $_POST["stg-notifpost"];
							$notifschedule = $_POST["stg-notifschedule"];
							$notifjoin = $_POST["stg-notifjoin"];
							$stguserpost = $_POST["stg-usercanpost"];

							$newempstgs = mysqli_query($conn, "UPDATE settings SET alertonpost='$notifpost', alertonschedule='$notifschedule', alertonjoin='$notifjoin', usercanpost='$stguserpost' WHERE id='1'");
							header("Location:home");
						}


						 ?>

					</form><br>
					<div class="stgs-sep"></div><br>

						<span class="param-teller">Autres paramètres</span><br><br>
							<a href="changepass" class="param-link">Modifier le mot de passe</a><br>
							<a href="logout" class="param-link">Se déconnecter</a><br>
							<a href="resetcommerce" class="param-link">Remettre le commerce à zéro</a><br>
							<a href="destroycommerce" class="param-link">Supprimer le commerce</a><br>
						<br>

					</div>


				</div>

			</div>

		</div>

	</body>
</html>
