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
						<div class="dn-link" onclick="location.href='staff'">
							<img src="content/img/name-icon.png" alt="" class="nav-icon">
						</div>
						<div class="dn-link" onclick="location.href='posts'">
							<img src="content/img/newpost-icon.png" alt="" class="nav-icon">
						</div>
						<div class="dn-link" onclick="location.href='events'">
							<img src="content/img/event-icon.png" alt="" class="nav-icon">
						</div>
						<div class="dn-link dnl-active" onclick="location.href='schedule'">
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
					}}

				?>
				<div class="wrapper">
					<div class="wrp-header">
						<img src="content/img/logo-full.png" class="hdr-logo" alt="">
						<img src="content/img/search-icon.png" class="hdr-search" alt="">
					</div>
					<div class="content-title">Horaires</div>

					<div class="page-subnav">
						<a href="newschedule" class="psub-link">Créer un nouvel horaire</a>
					</div>

               <div class="schedule-layout">
						<?php

						if(!isset($_GET["week"])){
							$getschedules = mysqli_query($conn, "SELECT COUNT(*),week FROM schedule GROUP BY week");
							$numshce = mysqli_num_rows($getschedules);
							if($numshce < 1){
								echo "Aucun horaire";
							}else{
								echo "
								<div class='choose-schedule'>
								<div class='sc-exp'>
									<div class='scexp-label'>Semaine</div>
									<div class='scexp-label'>Employés inclus</div>
									<div class='scexp-label'>Fixe</div>
									<br clear='both'>
								</div>
								";
								while($sche = mysqli_fetch_array($getschedules)){
									$nbempweek = $sche["week"];
									$scheloc = 'location.href="schedule?week='.$nbempweek.'"';
									echo "
										<div class='sc-week' onclick=".$scheloc.">
											<div class='scweek-ctn'>
												<div class='scw-week scw-infos'>".$sche["week"]."</div>
												<div class='scw-nbemp scw-infos'>";

												$nbempsche = mysqli_query($conn, "SELECT * FROM schedule WHERE week='$nbempweek'");
												echo mysqli_num_rows($nbempsche);
												echo "</div>
												<div class='scw-fixe scw-infos'>Non</div>
												<div class='scw-delete scw-infos'><img src='content/img/deletepost-icon.png'></div>
												<br clear='both'>
											</div>
										</div>

									";
								}
								echo "</div>";
							}
						}else{
							$week = $_GET["week"];
							$getschedule = mysqli_query($conn, "SELECT * FROM schedule WHERE week='$week'");
							if(mysqli_num_rows($getschedule) < 0){
								header("Location:schedule");
							}else{
								echo "
									<div class='show-schedule'>
										<div class='sc-weekteller'>
											<span class='sc-weeknb'>".$week."</span><br>
											<span class='sc-weekdays'>";
											$datenum = str_replace("-W","",$week);
											$datey = substr($datenum, 0, -2);
											$datew = substr($datenum, -2);
											for($day=1; $day<=7; $day++){
												echo date('d M', strtotime($datey."W".$datew.$day))." - ";
											}
											echo "
											</span>
										</div>

										<div class='sc-schedule'>
											<table class='schedule'>

												<tr>
													<th class='sc-indic'>Employés</th>
													<th class='sc-indic'>Lundi</th>
													<th class='sc-indic'>Mardi</th>
													<th class='sc-indic'>Mercredi</th>
													<th class='sc-indic'>Jeudi</th>
													<th class='sc-indic'>Vendredi</th>
													<th class='sc-indic'>Samedi</th>
													<th class='sc-indic'>Dimanche</th>
													<th class='sc-indic'>Total d'heures</th>
												</tr>
												<tr>
													<th></th>
													<th>Entrée/Sortie</th>
													<th>Entrée/Sortie</th>
													<th>Entrée/Sortie</th>
													<th>Entrée/Sortie</th>
													<th>Entrée/Sortie</th>
													<th>Entrée/Sortie</th>
													<th>Entrée/Sortie</th>
													<th></th>
												</tr>";

												while($sce = mysqli_fetch_array($getschedule)){
													$empstelsche = $sce["emptel"];
												echo "
												<tr>";
												$getempnamesche = mysqli_query($conn, "SELECT nom FROM employees WHERE tel='$empstelsche'");
												while($telname = mysqli_fetch_array($getempnamesche)){
													echo "<th>".$telname['nom']."</th>";
												}
												echo "
													<th>".$sce['lundi']."</th>
													<th>".$sce['mardi']."</th>
													<th>".$sce['mercredi']."</th>
													<th>".$sce['jeudi']."</th>
													<th>".$sce['vendredi']."</th>
													<th>".$sce['samedi']."</th>
													<th>".$sce['dimanche']."</th>
													<th>".$sce['totalhr']."</th>
												</tr>

												";
											}

											echo "
											</table>
										</div>

									</div>
								";




							}
						}


						 ?>


				  <!-- <div class="show-schedule">

					<div class="sc-weekteller">
						<span class="sc-weeknb">19w-30</span><br>
						<span class="sc-weekdays">12 aug - 13 aug - 14 aug - 15 aug - 16 aug - 17 aug - 18 aug -</span>
					</div>
					<div class="sc-schedule">
						<table class="schedule">

							<tr>
								<th class="sc-indic">Employés</th>
								<th class="sc-indic">Lundi</th>
								<th class="sc-indic">Mardi</th>
								<th class="sc-indic">Mercredi</th>
								<th class="sc-indic">Jeudi</th>
								<th class="sc-indic">Vendredi</th>
								<th class="sc-indic">Samedi</th>
								<th class="sc-indic">Dimanche</th>
								<th class="sc-indic">Total d'heures</th>
							</tr>
							<tr>
								<th></th>
								<th>Entré/Sortie</th>
								<th>Entré/Sortie</th>
								<th>Entré/Sortie</th>
								<th>Entré/Sortie</th>
								<th>Entré/Sortie</th>
								<th>Entré/Sortie</th>
								<th>Entré/Sortie</th>
								<th></th>
							</tr>

						</table>
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
