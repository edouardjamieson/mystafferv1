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
					<div class="navi-link navi-active" onclick="window.location = 'schedule'">
						<img src="content/img/schedule-icon.png" alt="" class="ni-icon">
						<span class="ni-label">HORAIRE</span>
					</div>
					<div class="navi-link" onclick="window.location = 'staff'">
						<img src="content/img/employees-icon.png" alt="" class="ni-icon">
					</div>
					<div class="navi-link" onclick="window.location = 'settings'">
						<img src="content/img/settings-icon.png" alt="" class="ni-icon">
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
				<div class="page-title"><div class="page-title-text">Horaires</div></div>
				<div class="newpost-box"><a href='newschedule'>Nouvel horaire</a></div><br>
				<form method="post">

					<div class="schedule-view">

						<div class="container-view">

								<?php
								if(!isset($_GET["week"])){
									$getschedules = mysqli_query($conn, "SELECT COUNT(*),week FROM schedule GROUP BY week");
									if(mysqli_num_rows($getschedules < 1)){
										echo "Aucun horaire";
									}
									while($sche = mysqli_fetch_array($getschedules)){
										echo "
										<div class='choose-schedule'>
											<a href='schedule?week=".$sche["week"]."'>Pour la semaine ".$sche["week"]."</a>
										</div>

										";
									}

								}else{
									$week = $_GET["week"];
									$getschedule = mysqli_query($conn, "SELECT * FROM schedule WHERE week='$week'");
									if(mysqli_num_rows($getschedule) < 0){
										header("Location:schedule");
									}else{
										echo "
										<div class='schedule-box'>

										<div class='sce-date-label'>
											Pour la semaine # : ".$week."<br>
											";

											$datenum = str_replace("-W","",$week);
											$datey = substr($datenum, 0, -2);
											$datew = substr($datenum, -2);
											for($day=1; $day<=7; $day++){
												echo date('d M', strtotime($datey."W".$datew.$day))." - ";
											}

											echo "
										</div>
										<div class='sce-print'>
											<a href='printschedule?week=".$week."' target='_blank'>Imprimer</a>
										</div><br><br>

										<table class='sce-table'>
											<tr>
												<th></th>
												<th>Lundi</th>
												<th>Mardi</th>
												<th>Mercredi</th>
												<th>Jeudi</th>
												<th>Vendredi</th>
												<th>Samedi</th>
												<th>Dimanche</th>
												<th></th>
											</tr>
											<tr>
												<th>Employé</th>
												<th>Entré/Sortie</th>
												<th>Entré/Sortie</th>
												<th>Entré/Sortie</th>
												<th>Entré/Sortie</th>
												<th>Entré/Sortie</th>
												<th>Entré/Sortie</th>
												<th>Entré/Sortie</th>
												<th>Total d'heures</th>
											</tr>
										</div>


										";
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
									}
								}




								 ?>
							 </table>

						</div>
					</div>
				</form>


			</div>

		</div>

	</body>
</html>
