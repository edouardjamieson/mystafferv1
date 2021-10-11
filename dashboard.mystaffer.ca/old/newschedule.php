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
				<div class="page-title"><div class="page-title-text">Créer un horaire</div></div>
				<form method="post">

					<div class="schedule-view">
						<div class="container-view">
							<div class="schedule-box">

								<script type="text/javascript">
									function fixedSche(checkbox){
										if(checkbox.checked == true){
											document.getElementById('notfixeddate').setAttribute("disabled","disabled");
											$(".sce-date-fix-alert").fadeIn(1);
										}
										if(checkbox.checked == false){
											document.getElementById('notfixeddate').removeAttribute("disabled");
											$(".sce-date-fix-alert").fadeOut(1);
										}
									}
								</script>

								<?php

								$getemps = mysqli_query($conn, "SELECT * FROM employees");
								$getrowsemps = mysqli_num_rows($getemps);
								if($getrowsemps < 1){
									echo "Vous devez avoir des employés pour créer un horaire.";
								}else{
									echo "
									<div class='sce-date-label'>
										Pour la semaine du : <input type='week' name='sce-date' class='sce-date' id='notfixeddate' required>
									</div><br>
									<div class='sce-date-label'>
										Faire de cet horaire un horaire fixe : <input type='checkbox' name='sce-date' value='fixe' onchange='fixedSche(this)'>
									</div>
									<div class='sce-date-fix-alert' id='sce-fix-alert'>
										En créant un horaire fixe vos employés ne pourront voir que cet horaire jusqu'à ce que vous le supprimiez. Ceci vous permet de garder un horaire stable sans devoir re-créer le même horaire chaques semaines.
									</div>
									<br><br>

									<table class='sce-table'><form method='post'>
										<tr>
											<th></th>
											<th>Dimanche</th>
											<th>Lundi</th>
											<th>Mardi</th>
											<th>Mercredi</th>
											<th>Jeudi</th>
											<th>Vendredi</th>
											<th>Samedi</th>
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
										</tr>";
									while($emps = mysqli_fetch_array($getemps)){
										$empsid = $emps["id"];

										echo "
											<tr>
												<td>".$emps["nom"]."</td>

												<td><input type='time' name='dimanche-from-".$emps["id"]."' class='sce-timestamp'>
												<input type='time' name='dimanche-to-".$emps["id"]."' class='sce-timestamp'></td>

												<td><input type='time' name='lundi-from-".$empsid."' class='sce-timestamp'>
												<input type='time' name='lundi-to-".$emps["id"]."' class='sce-timestamp'></td>

												<td><input type='time' name='mardi-from-".$emps["id"]."' class='sce-timestamp'>
												<input type='time' name='mardi-to-".$emps["id"]."' class='sce-timestamp'></td>

												<td><input type='time' name='mercredi-from-".$emps["id"]."' class='sce-timestamp'>
												<input type='time' name='mercredi-to-".$emps["id"]."' class='sce-timestamp'></td>

												<td><input type='time' name='jeudi-from-".$emps["id"]."' class='sce-timestamp'>
												<input type='time' name='jeudi-to-".$emps["id"]."' class='sce-timestamp'></td>

												<td><input type='time' name='vendredi-from-".$emps["id"]."' class='sce-timestamp'>
												<input type='time' name='vendredi-to-".$emps["id"]."' class='sce-timestamp'></td>

												<td><input type='time' name='samedi-from-".$emps["id"]."' class='sce-timestamp'>
												<input type='time' name='samedi-to-".$emps["id"]."' class='sce-timestamp'></td>
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
									echo "</table><input type='submit' name='createschedule' value='Créer' class='create-sche-btn'>";

								}

								 ?>
							</div>
						</div>
					</div>
				</form>


			</div>

		</div>

	</body>
</html>
