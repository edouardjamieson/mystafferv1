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
	<body onload="side();">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
		<script src="content/js/main.js" type="text/javascript"></script>
		<script src="content/js/side.js" type="text/javascript"></script>

		<div class="loading">
			<img src="content/img/ajax-loader.gif" alt="" draggable="false">
		</div>
		<div id="main-frame">
			<script type="text/javascript">
			if ('serviceWorker' in navigator) {
  			navigator.serviceWorker.register('service-worker.js');
			}
			</script>

			<div class="dash-navigation">
				<div class="dn-content">

					<div class="dnc-icons">
						<div class="dn-link menu-icon" style="margin-bottom:20%;" onclick="openMenu()">
							<img src="content/img/menu-icon.png" alt="" class="nav-icon x-icon">
						</div>
						<div class="dn-link" onclick="location.href='home'">
							<img src="content/img/home-icon.png" alt="" class="nav-icon">
						</div>
						<div class="dn-link dnl-active" onclick="location.href='staff'">
							<img src="content/img/name-icon.png" alt="" class="nav-icon">
						</div>
						<div class="dn-link" onclick="location.href='posts'">
							<img src="content/img/newpost-icon.png" alt="" class="nav-icon">
						</div>
						<div class="dn-link" onclick="location.href='events'">
							<img src="content/img/event-icon.png" alt="" class="nav-icon">
						</div>
						<div class="dn-link" onclick="location.href='schedule'">
							<img src="content/img/schedule-icon.png" alt="" class="nav-icon">
						</div>
						<div class="dn-link" onclick="location.href='settings'">
							<img src="content/img/settings-icon.png" alt="" class="nav-icon">
						</div>
						<div class="dn-link" onclick="location.href='logout'">
							<img src="content/img/logout-icon.png" alt="" class="nav-icon">
						</div>

					</div>
					<div class="dn-labels">
						<div class="dn-label" onclick="closeMenu()" style="margin-bottom:10%;">Fermer</div>
						<div class="dn-label" onclick="location.href='home'">Accueil</div>
						<div class="dn-label" onclick="location.href='staff'">Employés</div>
						<div class="dn-label" onclick="location.href='posts'">Publications</div>
						<div class="dn-label" onclick="location.href='events'">Évènements</div>
						<div class="dn-label" onclick="location.href='schedule'">Horaires</div>
						<div class="dn-label" onclick="location.href='settings'">Paramètres</div>
						<div class="dn-label" onclick="location.href='logout'">Déconnexion</div>
					</div>
				</div>

			</div>

			<div class="dash-wrapper">
				<?php

				if(!isset($_COOKIE["session"])){
					header("Location:login");
				}


				$nocommerce = $_COOKIE["nocommerce"];
				$db = "admin_".$nocommerce;
				$conn = mysqli_connect("localhost",$db,"dieuaimelamoutarde123",$db);
				$getentinfos = mysqli_query($conn, "SELECT * FROM entreprise");
				while($entinfos = mysqli_fetch_array($getentinfos)){

					//check session
					$coksess = $_COOKIE["session"];
					$sessnb = $entinfos["session"];
					if($coksess != $sessnb){
						header("Location:logout");
					}
				}

				?>
				<div class="wrapper">
					<div class="wrp-header">
						<img src="content/img/logo-full.png" class="hdr-logo" alt="">
						<img src="content/img/search-icon.png" class="hdr-search" alt="">
					</div>
					<div class="content-title">Demandes d'ajout</div>

					<div class="page-subnav">
						<a href="staff" class="psub-link">Revenir aux employés</a>
					</div>

					<div class="emp-layout">

						<?php
						$getempinfos = mysqli_query($conn, "SELECT * FROM employees WHERE rank = 'pending'");
						if(mysqli_num_rows($getempinfos) < 1){
							echo "Vous n'avez aucune demande d'ajout";
						}else{
							echo "

							<div class='emp-exp'>
								<div class='empexp-label' style='width:25%;'>Nom</div>
								<div class='empexp-label' style='width:20%;'>Téléphone</div>
								<div class='empexp-label' style='width:25%;'>Courriel</div>
								<br clear='both'>
							</div>

							";

							while($aemp = mysqli_fetch_array($getempinfos)){
								echo "

								<div class='emp-box'>
									<div class='empbox-content'>
										<div class='emp-name emp-infos'>".$aemp["nom"]."</div>
										<div class='emp-tel emp-infos'>".$aemp["tel"]."</div>
										<div class='emp-email emp-infos'>".$aemp["email"]."</div>
										<div class='emp-acc emp-infos'>
											<form method='post' class='emp-form'>
												<input type='submit' name='addstaff-".$aemp["id"]."' class='addstaff-btn addbtn' value='Accepter'>
												<input type='submit' name='deletestaff-".$aemp["id"]."' class='addstaff-btn deletesbtn' value='Refuser'>
											</form>
										</div>
										<br clear='both'>
									</div>
								</div>

								";
								$aempid = $aemp["id"];
								$addempid = "addstaff-".$aempid;
								$removeempid = "deletestaff-".$aempid;
								$aempname = $aemp["nom"];
								$aempemail = $aemp["email"];

								if(isset($_POST[$addempid])){
									$addstaff = mysqli_query($conn, "UPDATE employees SET rank='1' WHERE id='$aempid'");
									$mailsubject = "Bienvenue dans l'équipe!";
									$mailmessage = "<html>
									<div style='width:100%;text-align:center;'>
									<img src='https://mystaffer.ca/content/img/logo-full.png' style='width:50%;height:auto;'>
									</div>
									<div style='font-size:20px;'>
									 Bonjour, $aempname!<br><br>
									 Ceci est un message pour vous confirmer l'acceptation de votre demande à rejoindre un groupe. Vous pouvez désormais vous rendre sur l'application et appuyer sur le bouton rafraîchir pour accèder au contenu!<br><br>
									 Bienvenue!<br><br><br><br>
									 Pour toutes autres questions, écrivez-nous :<br>
									 <a href='mailto:hi@mystaffer.ca'>Ici</a>.
									</div>
									</html>
									";
									$headers = "MIME-Version: 1.0" . "\r\n";
									$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
									$headers .= 'From: <noreply@mystaffer.ca>' . "\r\n";
									mail($aempemail, $mailsubject, $mailmessage, $headers);

									echo "<script>location.reload();</script>";
								}

								if(isset($_POST[$removeempid])){
									$removestaff = mysqli_query($conn, "DELETE FROM employees WHERE id='$aempid'");
									echo "<script>location.reload();</script>";
								}

							}


						}



						 ?>

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
