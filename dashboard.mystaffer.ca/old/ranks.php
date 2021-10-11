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
					<div class="navi-link navi-active" onclick="window.location = 'staff'">
						<img src="content/img/employees-icon.png" alt="" class="ni-icon">
						<span class="ni-label">EMPLOYÉS</span>
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
				<div class="page-title"><div class="page-title-text">Gestion des grades</div></div>

				<div class="employees-view">

					<?php

					$getranks = mysqli_query($conn, "SELECT * FROM ranks WHERE nom!='Employée'");
					while($rank = mysqli_fetch_array($getranks)){

						echo "

						<div class='rank-showcase'>
							<div class='rank-inner'>
								<div class='rank-display' style='background:#".$rank["color"]."'>
									".$rank["nom"]."
								</div><br>
								<div class='rank-delete'>
									<form method='post'>
										<input type='submit' name='deleterank".$rank["id"]."' style='background:none;border:none;cursor:pointer;color:#fff;' value='Supprimer'>
									</form>
								</div>
							</div>
						</div>


						";

					}

					?>
					<br clear='both'>

					<div class="create-rank-title">
						Créer un grade
					</div>
					<form method="post">

						<span>Nom du nouveau grade</span><br>
						<div class="nrank-tb-box">
							<input type="text" name="nrank-name" class="nrank-tb">
						</div><br><br>

						<span>Couleur du nouveau grade</span><br>

						<div class="nrank-color nr-red">
							<label for="nrank-color-one" class="nrank-label"></label>
							<input type="radio" name="nrankcolor" value="" id="nrank-color-one" >
						</div>


					</form>


				</div>


			</div>

		</div>

	</body>
</html>
