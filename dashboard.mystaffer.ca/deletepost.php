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
					<div class="content-title">Souhaitez-vous vraiment supprimer cette publication?</div>

					<div class="page-subnav">
						<a href="posts" class="psub-link">Retour aux publications</a>
					</div>

					<div class="post-layout">

						<?php
                  $delid = $_GET["post"];
						$getpostinfos = mysqli_query($conn, "SELECT * FROM posts WHERE id='$delid'");
						if(mysqli_num_rows($getpostinfos) < 1){
							echo "Cette publication n'existe pas!";
						}else{
						while($posts = mysqli_fetch_array($getpostinfos)){

							echo "
							<div class='post'>
								<div class='post-ctn'>
									<div class='post-date'>
										";
										$pdate = $posts["date"];
										// $pmonth = date("M",strtotime($ppdate));
										// $pday = date("d",strtotime($ppdate));
										$d = date_parse_from_format("Y-m-d", $pdate);
										$pmonth = date("M", mktime(0, 0, 0, $d["month"], 10));
										echo "
										<span class='pdate-day'>".$d["day"]."</span><br>
										<span class='pdate-month'>".$pmonth."</span>
									</div>
									<div class='post-writter'>".$posts["poster"]."</div>
									<div class='post-content'>".$posts["text"]."
									";
									if(!empty($posts["link"])){
										echo "<br><br><a href='".$posts["link"]."' class='post-link' target='_blank'>Visiter le lien attaché</a></div>";
									}else{
										echo "</div>";
									}
                           $back2post = 'location.href = "posts"';
									echo "
									<div class='post-seenby'></div>
									<div class='post-buttons'>
										<form method='post'>
                                 <input type='submit' name='deletepost' value='Confirmer' class='deletepost-btn deletebtn'>
                                 <input type='button' name='' value='Retour' class='deletepost-btn keepbtn' onclick='".$back2post."'>
                              </form>
									</div>
									<br clear='both'>
								</div>
							</div>

							";
							if(isset($_POST["deletepost"])){
                        $delpost = $posts["id"];
                        $deletepost = mysqli_query($conn, "DELETE FROM posts WHERE id='$delpost'");
                        echo "<script>location.href = 'posts';</script>";
                     }

						}
					}


						 ?>

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
