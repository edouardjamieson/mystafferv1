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
					<div class="content-title">Nouvel horaire</div>

					<div class="page-subnav">
						<a href="schedule" class="psub-link">Retour aux horaires</a>
					</div>

               <div class="schedule-layout">

				  <div class="show-schedule">

					<div class="sc-schedule">
						<script type="text/javascript">
							function fixedSche(cb){
								if(cb.checked == true){
									document.getElementById("scparam-week").setAttribute("disabled","disabled");
									$(".fixedsche-alert").fadeIn(1);
								}else if(cb.checked == false){
									document.getElementById("scparam-week").removeAttribute("disabled","disabled");
									$(".fixedsche-alert").fadeOut(1);
								}
							}
						</script>
						<form method="post">

							<?php

							$getemps = mysqli_query($conn, "SELECT * FROM employees WHERE rank!='pending'");
							$getrowsemps = mysqli_num_rows($getemps);
							if($getrowsemps < 1){
								echo "Vous devez avoir des employés pour créer un horaire.";
							}else{
								echo "

								<div class='sc-param'>
									<span class='scparam-label'>Choisir une semaine :</span><br>
									<input type='week' class='scparam-week' id='scparam-week' name='sce-date' required><br>
									<span class='scparam-label'>Ou, faire de cet horaire un horaire fixe :</span>
									<input type='checkbox' name='sce-fixe' onchange='fixedSche(this)' class='scparam-fixe'>
									<div class='fixedsche-alert'>
										En créant un horaire fixe vos employés ne pourront voir que cet horaire jusqu'à ce que vous le supprimiez. Ceci vous permet de garder un horaire stable sans devoir re-créer le même horaire chaques semaines.
									</div>
								</div>

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
									</tr>";

									while ($emps = mysqli_fetch_array($getemps)) {
										$empsid = $emps["id"];
										echo "

										<tr>
											<td>".$emps["nom"]."</td>
											<td>
												<input type='time' name='lundi-from-".$emps["id"]."' class='sc-timestamp'>
												<input type='time' name='lundi-to-".$emps["id"]."' class='sc-timestamp'>
											</td>
											<td>
												<input type='time' name='mardi-from-".$emps["id"]."' class='sc-timestamp'>
												<input type='time' name='mardi-to-".$emps["id"]."' class='sc-timestamp'>
											</td>
											<td>
												<input type='time' name='mercredi-from-".$emps["id"]."' class='sc-timestamp'>
												<input type='time' name='mercredi-to-".$emps["id"]."' class='sc-timestamp'>
											</td>
											<td>
												<input type='time' name='jeudi-from-".$emps["id"]."' class='sc-timestamp'>
												<input type='time' name='jeudi-to-".$emps["id"]."' class='sc-timestamp'>
											</td>
											<td>
												<input type='time' name='vendredi-from-".$emps["id"]."' class='sc-timestamp'>
												<input type='time' name='vendredi-to-".$emps["id"]."' class='sc-timestamp'>
											</td>
											<td>
												<input type='time' name='samedi-from-".$emps["id"]."' class='sc-timestamp'>
												<input type='time' name='samedi-to-".$emps["id"]."' class='sc-timestamp'>
											</td>
											<td>
												<input type='time' name='dimanche-from-".$emps["id"]."' class='sc-timestamp'>
												<input type='time' name='dimanche-to-".$emps["id"]."' class='sc-timestamp'>
											</td>
										</tr>

										";
										if(isset($_POST["createschedule"])){
											$scedate = $_POST["sce-date"];
											$tel = $emps["tel"];

											$lundifrom = $_POST["lundi-from-".$empsid];
											$lundito = $_POST["lundi-to-".$empsid];

											$mardifrom = $_POST["mardi-from-".$empsid];
											$mardito = $_POST["mardi-to-".$empsid];

											$mercredifrom = $_POST["mercredi-from-".$empsid];
											$mercredito = $_POST["mercredi-to-".$empsid];

											$jeudifrom = $_POST["jeudi-from-".$empsid];
											$jeudito = $_POST["jeudi-to-".$empsid];

											$vendredifrom = $_POST["vendredi-from-".$empsid];
											$vendredito = $_POST["vendredi-to-".$empsid];

											$samedifrom = $_POST["samedi-from-".$empsid];
											$samedito = $_POST["samedi-to-".$empsid];

											$dimanchefrom = $_POST["dimanche-from-".$empsid];
											$dimancheto = $_POST["dimanche-to-".$empsid];
											$totalhr = ($lundito-$lundifrom) + ($mardito-$mardifrom) + ($mercredito-$mercredifrom) + ($jeudito-$jeudifrom) + ($vendredito-$vendredifrom) + ($samedito-$samedifrom) + ($dimancheto-$dimanchefrom);

											$createschedule = mysqli_query($conn, "INSERT INTO schedule (week,emptel,lundi,mardi,mercredi,jeudi,vendredi,samedi,dimanche,totalhr) VALUES
											('$scedate','$tel','$lundifrom-$lundito','$mardifrom-$mardito','$mercredifrom-$mercredito','$jeudifrom-$jeudito','$vendredifrom-$vendredito','$samedifrom-$samedito','$dimanchefrom-$dimancheto','$totalhr')");
										}
									}

									echo "
								</table>
								<div class='sc-createbtn'>
									<input type='submit' name='createschedule' value='Terminé' class='sc-submit'>
								</div>
								";
							}

							 ?>

						</form>
					</div>

				  </div>

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
