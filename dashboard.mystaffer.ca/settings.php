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
						<div class="dn-link" onclick="location.href='schedule'">
							<img src="content/img/schedule-icon.png" alt="" class="nav-icon">
						</div>
						<div class="dn-link dnl-active" onclick="location.href='settings'">
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
					<div class="content-title">Paramètres</div>

					<div class="page-subnav">
						<a href="logout" class="psub-link">Déconnexion</a>
						<a href="home?tutorial=on" class="psub-link">Relancer le tutoriel</a>
					</div>

               <div class="stg-title">Paramètres du commerce</div>
               <div class="stg-box">
                  <div class="stg-boxctn">
                     <form method="post">
								<?php

								$getentinfos = mysqli_query($conn, "SELECT * FROM entreprise");
								while($ent = mysqli_fetch_array($getentinfos)){

								 ?>
                        <span class="stg-stglabel">Nom du commerce :</span><br>
                        <input type="text" name="entname" value="<?php echo $ent["entname"]; ?>" placeholder="Entrez un nom de commerce" class="stg-tb"><br>
                        <span class="stg-stglabel">Type de commerce :</span><br>
                        <input type="text" name="enttype" value="<?php echo $ent["enttype"]; ?>" placeholder="Entrez un type de commerce" class="stg-tb"><br>
                        <span class="stg-stglabel">Adresse courriel du gérant :</span><br>
                        <input type="text" name="email" value="<?php echo $ent["email"]; ?>" placeholder="Entrez une adresse courriel" class="stg-tb"><br>
                        <span class="stg-stglabel">Nom d'utilisateur du gérant :</span><br>
                        <input type="text" name="username" value="<?php echo $ent["username"]; ?>" placeholder="Entrez un nom d'utilisateur" class="stg-tb"><br>
                        <span class="stg-stglabel">Nom complet du gérant :</span><br>
                        <input type="text" name="manager" value="<?php echo $ent["manager"]; ?>" placeholder="Entrez votre nom complet" class="stg-tb"><br>
								<div class="np-submitbtn hovshadow">
									<input type="submit" name="save-stgsent" value="Sauvegarder" class="np-submit">
								</div>

							<?php }
								if(isset($_POST["save-stgsent"])){
									if(empty($_POST["entname"])){
										echo "<script>alert('Vous devez avoir un nom de commerce!');</script>";
									}
									if(empty($_POST["enttype"])){
										echo "<script>alert('Vous devez avoir un type de commerce!');</script>";
									}
									if(empty($_POST["email"])){
										echo "<script>alert('Vous devez avoir une adresse courriel');</script>";
									}
									if(empty($_POST["username"])){
										echo "<script>alert('Vous devez avoir un pseudonyme pour la connexion!');</script>";
									}
									if(empty($_POST["manager"])){
										echo "<script>alert('Vous devez inscrire votre nom complet!');</script>";
									}
									$entname = $_POST["entname"];
									$enttype = $_POST["enttype"];
									$email = $_POST["email"];
									$username = $_POST["username"];
									$manager = $_POST["manager"];
									if(!empty($entname && $enttype && $email && $username && $manager)){
										$newstgsent = mysqli_query($conn, "UPDATE entreprise SET entname='$entname', enttype='$enttype', email='$email', username='$username', manager='$manager'");
										echo "<script>
											alert('Les changements ont été effectués avec succès!');
											location.href = 'settings';
										</script>";
									}
								}
							 ?>
							</form>
                  </div>
               </div>

               <div class="stg-title">Paramètres des employés</div>
               <div class="stg-box">
                  <div class="stg-boxctn">
                     <form method="post">

                     </form>
                  </div>
               </div>

               <div class="stg-title">Plus de paramètres</div>
               <div class="stg-box">
                  <div class="stg-boxctn">
                     <form method="post">

                     </form>
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
