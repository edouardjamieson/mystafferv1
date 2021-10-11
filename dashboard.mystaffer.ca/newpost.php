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
						<div class="dn-link dnl-active" onclick="location.href='posts'">
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
					<div class="content-title">Rédiger une publication</div>

					<div class="page-subnav">
						<a href="posts" class="psub-link">Retour aux publications</a>
					</div>

						<div class="newpost-layout">
                     <div class="newpost-ctn">
                        <form method="post">
                           <textarea name="np-text" class="np-text" placeholder="Publier un fait, une remarque ou encore un message pour féliciter l'équipe"></textarea>
                           <input type="text" name="np-link" class="np-tb" placeholder="Ajouter un lien vers un site ou document externe (facultatif)">
                           <script type="text/javascript">
                              function getfileName(){
                                 var filename = $(".npfile-sub").value();
                                 .npfile-lbtn.innerHTML = filename;
                              }
                           </script>
                           <div class="npfile-btn">
                              <label for="npfile" class="npfile-lbtn">Ajouter un document ou une image</label>
                           </div>

                           <input type="file" name="npfile" id="npfile" class="npfile-sub" value="" onchange="getfileName()">
                           <div class="np-submitbtn hovshadow">
                              <input type="submit" name="createpost" value="Publier" class="np-submit">
                           </div>

									<?php

									if(isset($_POST["createpost"])){

										$nptext = mysqli_real_escape_string($conn,$_POST["np-text"]);
										$nplink = htmlentities($_POST["np-link"]);
										$npdate = date("Y-m-d");
										$getmanager = mysqli_query($conn, "SELECT manager FROM entreprise");
										while($maninf = mysqli_fetch_array($getmanager)){$npposter = $maninf["manager"];
										if(empty($nptext)){
											echo "<script language='javascript'>alert('Vous devez entrer un message!')</script>";
										}else{
											$addpost = mysqli_query($conn, "INSERT INTO posts (poster,text,imgdoc,link,date) VALUES ('$npposter','$nptext','$npfile','$nplink','$npdate')");

											echo "<script>location.href='posts';</script>";
										}

									}
								}

									 ?>

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
