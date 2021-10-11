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

				$nocommerce = $_COOKIE["nocommerce"];
				$db = "admin_".$nocommerce;
				$conn = mysqli_connect("localhost",$db,"dieuaimelamoutarde123",$db);

				?>
				<div class="page-title"><div class="page-title-text">Supprimer un un employé</div></div>
				<div class="posts-view">
					<div class="deletepost-view">
						Souhaitez-vous vraiment supprimer cet employé?<br>
						<form method="post">
							<input type="submit" name="deleteemp" value="Oui" class="deletepost-btn" class="deletepost-btn">
							<a href="staff" class="dontdeletepost-btn">Non</a>
						</form>
					</div><br>
					<?php
					$empid = $_GET["emp"];

					$getempinfos = mysqli_query($conn, "SELECT * FROM employees WHERE id=$empid");
					if(mysqli_num_rows($getempinfos) < 1){
						header("Location:staff");
					}else{
					while($emp = mysqli_fetch_array($getempinfos)){

						echo "
						<div class='employee-box'>
							<div class='container-view'>
								<div class='employee-inner'>
									<div class='emp-pdp' style='background:url(".$emp["pdp"].");'></div>
									<span class='emp-name'>".$emp["nom"]."</span>
									<div class='emp-sep'></div>
									<span class='emp-info-tell'>Téléphone:</span><br>
									<span class='emp-info-ctn'>".$emp["tel"]."</span><br><br>
									<span class='emp-info-tell'>Courriel:</span><br>
									<span class='emp-info-ctn'>".$emp["email"]."</span><br><br>
								</div>
							</div>
						</div>



						";


					}

					if(isset($_POST["deleteemp"])){
						$delete = mysqli_query($conn, "DELETE FROM employees WHERE id=$empid");
						header("Location:staff");
					}
				}

					?>
				</div>

			</div>

		</div>

	</body>
</html>
