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
				<div class="page-title"><div class="page-title-text">Employés</div></div>
				<div class='newpost-box'>
				<?php

				$getpendingemp = mysqli_query($conn, "SELECT * FROM employees WHERE rank = 'pending'");
				$numrowspend = mysqli_num_rows($getpendingemp);
				if($numrowspend > 0){
					echo "<a href='addstaff'>Demandes d'ajout (".$numrowspend.")</a>";
				}

				 ?>
				 <a href='ranks'>Gérer les grades</a>
			 </div><br>

				<div class="employees-view">

					<?php

					$getempinfos = mysqli_query($conn, "SELECT * FROM employees WHERE rank != 'pending'");
					if(mysqli_num_rows($getempinfos) < 1){
						echo "Vous n'avez aucun employé";
					}else{
					while($emp = mysqli_fetch_array($getempinfos)){

						echo "

						<div class='employee-box'>
							<div class='container-view'>
								<div class='employee-inner'>
									<div class='emp-btn'>
										<a href='editemp?emp=".$emp["id"]."'><img src='content/img/editpost-icon.png' class='emp-btn-img'></a>
										<a href='deleteemp?emp=".$emp["id"]."'><img src='content/img/deletepost-icon.png' class='emp-btn-img'></a>
									</div>
									<span class='emp-name'>".$emp["nom"]."</span>
									";
									$emprank = $emp["rank"];
									$getrank = mysqli_query($conn, "SELECT * FROM ranks WHERE id='$emprank'");
									while($rank = mysqli_fetch_array($getrank)){
										echo "<div class='emp-rank' style='background:#".$rank["color"]."'>".$rank["nom"]."</div>";
									}
									echo "
									<div class='emp-sep'></div>
									<span class='emp-info-tell'>Téléphone:</span><br>
									<span class='emp-info-ctn'>".$emp["tel"]."</span><br><br>
									<span class='emp-info-tell'>Courriel:</span><br>
									<span class='emp-info-ctn'>".$emp["email"]."</span><br><br>
								</div>
							</div>
						</div>


						";
						if(isset($_POST["deleteemp".$emp['id']])){
							$deletestaff = mysqli_query($conn, "DELETE FROM employees WHERE id='".$emp["id"]."'");
							header("Refresh:0");
						}

					}
				}





					?>


				</div>

			</div>

		</div>

	</body>
</html>
