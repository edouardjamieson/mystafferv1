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
	<body onload="side();main()">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
		<script src="content/js/main.js" type="text/javascript"></script>
		<script src="content/js/side.js" type="text/javascript"></script>

		<div class="loading">
			<img src="content/img/ajax-loader.gif" alt="" draggable="false">
		</div>
		<?php

		if($_GET["tutorial"] == "on"){
			$newloc = 'location.href="staff?tutorial=on";';
			echo "
			<div class='tutorial'>
				<div class='tut-box'>
					<div class='tut-content'>
						<span class='tut-title'>Bienvenue sur MyStaffer!</span><br>
						<div class='tut-sep'></div>
						<div class='tut-desc'>
							Bonjour Édouard, Bienvenue sur votre toute nouvelle interface. Sur cette page vous trouverai une vue globale de votre commerce.
							Vous pouvez voir votre nombre d'employés sur l'application par exemple, ou encore le nombre d'horaires créés. À votre gauche se trouve le menu de navigation.
							À tout moment, vous pouvez naviguer sur l'interface pour y découvrir le contenue. Si vous ne savez pas quel icon menne à quelle page, vous pouvez cliquer sur celle
							tout en haut pour afficher une légende.<br><br>
							Pour toutes question, vous pouvez nous contacter à l'adresse suivante : <span class='tut-email'>hi@mystaffer.ca</span>. Bienvenue!
						</div>
						<div class='tut-next' onclick='".$newloc."'>Suivant</div>
					</div>
				</div>
			</div>
			";
		}


		 ?>

		<div id="main-frame">
			<script type="text/javascript">
			if ('serviceWorker' in navigator) {
  			navigator.serviceWorker.register('service-worker.js');
			}
			</script>
			<div class="search-layout">
				<div class="search-ctn">
					<div class="search-exit" onclick="exitSearch()"><img src="content/img/x-icon.png" alt=""></div>
					<br clear="both">

					<input type="text" name="search-textbox" onkeyup="search(this)" class="search-textbox" placeholder="Saisissez votre recherche" class="search-tb">

					<div class="search-result">

					</div>
				</div>
			</div>

			<div class="dash-navigation">
				<div class="dn-content">

					<div class="dnc-icons">
						<div class="dn-link menu-icon" style="margin-bottom:20%;" onclick="openMenu()">
							<img src="content/img/menu-icon.png" alt="" class="nav-icon x-icon">
						</div>
						<div class="dn-link dnl-active" onclick="location.href='home'">
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

				$nocommerce = $_COOKIE["nocommerce"];
				$alertconn = mysqli_connect("localhost","admin_mystaffer","LFdUiO0BUc","admin_mystaffer");

				$getalerts = mysqli_query($alertconn, "SELECT * FROM alerts");
				while($nalert = mysqli_fetch_array($getalerts)){
					if(mysqli_num_rows($getalerts > 0)){
						echo "

						<div class='system-alert'>
							
						</div>


						";
					}
				}


				 ?>

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
				<div class="wrapper">
					<div class="wrp-header">
						<img src="content/img/logo-full.png" class="hdr-logo" alt="">
						<img src="content/img/search-icon.png" class="hdr-search" alt="" onclick="openSearch()">
					</div>
					<div class="content-title">À propos</div>
					<div class="home-infosbox">
						<div class="ib-commerce">
							<div class="ibc-name"><?php echo $entinfos["entname"]; ?></div>
							<div class="ibc-no">#<?php echo $entinfos["nocommerce"]; ?></div>
							<div class="ibc-infos"><a href="#">Comment rejoindre?</a></div>
						</div>
						<div class="ib-user">
							<div class="ibu-pdp"><?php echo substr($entinfos["manager"],0,1); ?></div>
							<div class="ibu-name"><?php echo $entinfos["manager"]; ?></div>
							<div class="ibc-infos"><a href="settings">Modifier le profil</a></div>
						</div>
						<br clear="both">
					</div>
					<div class="content-title">Vue analytique</div>
					<?php }

					$getempinfos = mysqli_query($conn, "SELECT * FROM employees WHERE rank !='pending'");
					$getemppendinginfos = mysqli_query($conn, "SELECT * FROM employees WHERE rank = 'pending'");
					$getpostinfos = mysqli_query($conn, "SELECT * FROM posts");
					$getscheduleinfos = mysqli_query($conn, "SELECT COUNT(*),week FROM schedule GROUP BY week");

					 ?>
					<div class="home-statsbox">
						<div class="statbox hovshadow" style="margin-right:2%;" onclick="location.href = 'staff'">
							<img src="content/img/name-icon.png" alt="" class="stat-icon">
							<div class="stat-nb"><?php echo mysqli_num_rows($getempinfos); ?></div>
							<div class="stat-label">Employés</div>
						</div>
						<div class="statbox hovshadow" style="margin-right:2%;" onclick="location.href = 'posts'">
							<img src="content/img/newpost-icon.png" alt="" class="stat-icon">
							<div class="stat-nb"><?php echo mysqli_num_rows($getpostinfos); ?></div>
							<div class="stat-label">Publications</div>
						</div>
						<div class="statbox hovshadow" style="margin-right:2%;" onclick="location.href = 'schedule'">
							<img src="content/img/schedule-icon.png" alt="" class="stat-icon">
							<div class="stat-nb"><?php echo mysqli_num_rows($getscheduleinfos); ?></div>
							<div class="stat-label">Horaires</div>
						</div>
						<div class="statbox hovshadow" onclick="location.href = 'addstaff'">
							<img src="content/img/name-icon.png" alt="" class="stat-icon">
							<div class="stat-nb"><?php echo mysqli_num_rows($getemppendinginfos); ?></div>
							<div class="stat-label">Demandes pour rejoindre</div>
						</div>
						<br clear="both">
					</div>
					<div class="content-title">Prochainement</div>
					<div class="home-nextbox">
						<div class="ne-box">
							<img src="content/img/event-icon.png" class="ne-icon" alt="">
							<?php

							$getevent = mysqli_query($conn, "SELECT * FROM events");
							$nbevent = mysqli_num_rows($getevent);
							if($nbevent < 1){
								echo "
								<div class='ne-name'>Aucun évènement!</div><br>
								<div class='ibc-infos'><a href='newevent'>Créer en un dès maintenant</a></div>
								";
							}else{
								echo "
								<div class='ne-name'>Party de noel</div>
								<div class='ne-date'>10/10/2019</div>
								<div class='ibc-infos'><a href='events'>Voir l'évènement</a></div>
								";
							}

							 ?>
						</div>
						<div class="nes-box hovshadow" onclick="location.href = 'newschedule'">
							<img src="content/img/schedule-icon.png" class="nes-icon" alt="">
							<div class="nes-name">Nouvel horaire</div>
						</div>
						<br clear="both">
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
