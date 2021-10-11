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
					<div class="content-title">Employés</div>

					<div class="page-subnav">
						<a href="ranks" class="psub-link">Gérer les grades</a>
						<a href="addstaff" class="psub-link">Demandes d'ajout (<?php
						$getpendingemp = mysqli_query($conn, "SELECT * FROM employees WHERE rank = 'pending'");
						echo mysqli_num_rows($getpendingemp);

						 ?>)</a>
					</div>

					<div class="emp-layout">

						<?php

						$getempinfos = mysqli_query($conn, "SELECT * FROM employees WHERE rank != 'pending'");
						if(mysqli_num_rows($getempinfos) < 1){
							echo "Vous n'avez aucun employé";
						}else{

							echo "

							<div class='emp-exp'>
								<div class='empexp-label' style='width:25%;'>Nom</div>
								<div class='empexp-label' style='width:20%;'>Téléphone</div>
								<div class='empexp-label' style='width:25%;'>Courriel</div>
								<div class='empexp-label' style='width:20%;'>Grade</div>
								<br clear='both'>
							</div>

							";
							while($emp = mysqli_fetch_array($getempinfos)){
								echo "
									<div class='emp-box'>
										<div class='empbox-content'>
											<div class='emp-name emp-infos'>".$emp["nom"]."</div>
											<div class='emp-tel emp-infos'>".$emp["tel"]."</div>
											<div class='emp-email emp-infos'>".$emp["email"]."</div>
											<div class='emp-rank emp-infos'>
												";
												$emprank = $emp["rank"];
												$getrank = mysqli_query($conn, "SELECT * FROM ranks WHERE id='$emprank'");
												while($rank = mysqli_fetch_array($getrank)){
													echo $rank["nom"];
												}
											echo "
											</div>
											<div class='emp-delete emp-infos'><a href='deleteemp?emp=".$emp["id"]."'><img src='content/img/deletepost-icon.png'></a></div>
											<br clear='both'>
										</div>
									</div>

								";

							}
						}

						 ?>

						<!-- <div class="emp-box">
							<div class="empbox-content">
								<div class="emp-name emp-infos">Édouard Jamieson</div>
								<div class="emp-tel emp-infos">5145769679</div>
								<div class="emp-email emp-infos">jidepix@outlook.fr</div>
								<div class="emp-rank emp-infos">Employé</div>
								<div class="emp-delete emp-infos"><img src="content/img/deletepost-icon.png" alt=""></div>
								<br clear="both">
							</div>
						</div> -->

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
