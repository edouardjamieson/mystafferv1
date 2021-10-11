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
					<div class="navi-link navi-active" onclick="window.location = 'home'">
						<img src="content/img/home-icon.png" alt="" class="ni-icon">
						<span class="ni-label">ACCUEIL</span>
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
					<div class="navi-link" onclick="window.location = 'settings'">
						<img src="content/img/settings-icon.png" alt="" class="ni-icon">
					</div>
				</div>
			</div>
			<div class="content-wrapper">
				<div class="wrapper-inner">
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

				?>
				<div class="home-commerce-header">
					<img src="content/img/logo-full.png" alt="logo" class="navi-logoimg">
					<a href='logout' class="commerce-user">Déconnexion</a>
				</div>
				<?php

				if($entinfos["subtype"] == "trial"){
					$ddstring = $entinfos["duedate"];
					$duedate = date("d/m/Y", strtotime($ddstring));
					$todaydate = date("d/m/Y");
					$subdaterest = $duedate-$todaydate;
					$subdateday = date("d", strtotime($subdaterest));
					echo "
					<div class='trial-alert'>
						Votre version d'essaie de MyStaffer se fini le ".$duedate.". Il vous reste ".$subdateday." jours.
						<a href='https://mystaffer.ca/more/buying' style='color:#fff'>En savoir plus</a>
					</div><br>
					";
				}

				 ?>
				<div class="home-commerce-box">
					<span class="commerce-name-big"><?php echo $entinfos["entname"]; ?></span><br>
					<span class="commerce-pin">#<?php echo $entinfos["nocommerce"]; ?></span>
				</div>
				<?php }

				$getempinfos = mysqli_query($conn, "SELECT * FROM employees WHERE rank !='pending'");
				$getemppendinginfos = mysqli_query($conn, "SELECT * FROM employees WHERE rank = 'pending'");
				$getpostinfos = mysqli_query($conn, "SELECT * FROM posts");
				$getscheduleinfos = mysqli_query($conn, "SELECT COUNT(*),week FROM schedule GROUP BY week");

				 ?>
				<div class="home-commerce-stats">
					<div class="hcs-box">
						<div class="hcs-stats" onclick="window.location.href='staff'">
							<span class="hcs-number"><?php echo mysqli_num_rows($getempinfos); ?></span><br>
							<span class="hcs-label">Employés</span>
						</div>
						<div class="hcs-stats" style="margin-left:4%;" onclick="window.location.href='posts'">
							<span class="hcs-number"><?php echo mysqli_num_rows($getpostinfos); ?></span><br>
							<span class="hcs-label">Publications</span>
						</div>
						<div class="hcs-stats" style="margin-left:4%;" onclick="window.location.href='schedule'">
							<span class="hcs-number"><?php echo mysqli_num_rows($getscheduleinfos); ?></span><br>
							<span class="hcs-label">Horaires</span>
						</div>
						<div class="hcs-stats" style="margin-left:4%;" onclick="window.location.href='addstaff'">
							<span class="hcs-number"><?php echo mysqli_num_rows($getemppendinginfos); ?></span><br>
							<span class="hcs-label">Demandes pour rejoindre</span>
						</div>
						<br clear="both">
					</div>
				</div>
				<!-- <div class="home-shortcut-btn">
					<div class="hsb-box">
						<div class="hsb-box-content">
							<img src="content/img/employees-icon-active.png" class="hsb-overimg"><br>
							<a href="staff" class="hsb-link">Voir</a>
						</div>
					</div>
					<div class="hsb-box">
						<div class="hsb-box-content">
							<img src="content/img/posts-icon-active.png" class="hsb-overimg"><br>
							<a href="newpost" class="hsb-link">Publier</a>
						</div>
					</div>
					<div class="hsb-box">
						<div class="hsb-box-content">
							<img src="content/img/schedule-icon-active.png" class="hsb-overimg"><br>
							<a href="createschedule" class="hsb-link">Créer</a>
						</div>
					</div>
					<div class="hsb-box">
						<div class="hsb-box-content">
							<img src="content/img/addname-icon-active.png" class="hsb-overimg"><br>
							<a href="addstaff" class="hsb-link">Voir</a>
						</div>
					</div>
					<br clear="both">
				</div> -->
			</div>
			</div>

		</div>

	</body>
</html>
