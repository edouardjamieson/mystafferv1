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
					<div class="content-title">Publications</div>

					<div class="page-subnav">
						<a href="newpost" class="psub-link">Rédiger une publication</a>
					</div>

					<div class="post-layout">

						<?php

						$getpinnedpost = mysqli_query($conn, "SELECT * FROM posts WHERE pinned='1' ORDER BY id DESC");
						while($pposts = mysqli_fetch_array($getpinnedpost)){
							echo "
								<div class='post pinned'>
									<div class='post-ctn'>
										<div class='post-date'>
											";
											$ppdate = $pposts["date"];
											$ppmonth = date("M",strtotime($ppdate));
											$ppday = date("d",strtotime($ppdate));
											echo "
											<span class='pdate-day'>".$ppday."</span><br>
											<span class='pdate-month'>".$ppmonth."</span>
										</div>
										<div class='post-writter'>".$pposts["poster"]."</div>
										<div class='post-content'>".$pposts["text"]."
										";
										if(!empty($pposts["link"])){
											echo "<br><br><a href='".$pposts["link"]."' class='post-link' target='_blank'>Visiter le lien attaché</a></div>";
										}else{
											echo "</div>";
										}
										echo "

										<div class='post-seenby'></div>
										<div class='post-buttons'>
											<a href='deletepost?post=".$pposts['id']."'><img src='content/img/deletepost-icon.png' class='post-btn'></a>
										</div>
										<br clear='both'>
									</div>
								</div>

							";
						}

						$getpostinfos = mysqli_query($conn, "SELECT * FROM posts WHERE pinned='0' ORDER BY id DESC");
						if(mysqli_num_rows($getpostinfos) < 1){
							echo "Aucune publication";
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
									echo "
									<div class='post-seenby'></div>
									<div class='post-buttons'>
										<form method='post'>
										<label for='pin-".$posts["id"]."'><img src='content/img/pinpost-icon.png' class='post-btn'></label>
										<input type='submit' name='pin-".$posts["id"]."' id='pin-".$posts["id"]."' class='pin-submit'>
										<a href='deletepost?post=".$posts['id']."'><img src='content/img/deletepost-icon.png' class='post-btn'></a>
										</form>
									</div>
									<br clear='both'>
								</div>
							</div>

							";
							$pinnedid = "pin-".$posts["id"];
							$pinid = $posts["id"];
							if(isset($_POST[$pinnedid])){
								$setpinned = mysqli_query($conn, "UPDATE posts SET pinned='1' WHERE id='$pinid'");
								echo "<script>location.reload();</script>";
							}

						}
					}


						 ?>

						<!-- <div class="post">
							<div class="post-ctn">
								<div class="post-date">
									<span class="pdate-day">13</span><br>
									<span class="pdate-month">NOV</span>
								</div>
								<div class="post-writter">Édouard Jamieson</div>
								<div class="post-content">bonjour les amis vous avez bien travaillé aujourd'hui je suis fier de vous on continue comme ca!!bonjour les amis vous avez bien travaillé aujourd'hui je suis fier de vous on continue comme ca!!bonjour les amis vous avez bien travaillé aujourd'hui je suis fier de vous on continue comme ca!!bonjour les amis vous avez bien travaillé aujourd'hui je suis fier de vous on continue comme ca!!bonjour les amis vous avez bien travaillé aujourd'hui je suis fier de vous on continue comme ca!!bonjour les amis vous avez bien travaillé aujourd'hui je suis fier de vous on continue comme ca!!bonjour les amis vous avez bien travaillé aujourd'hui je suis fier de vous on continue comme ca!!</div>
								<div class="post-seenby">
								</div>
								<div class="post-buttons">
									<img src="content/img/pinpost-icon.png" class="post-btn" alt="">
									<img src="content/img/deletepost-icon.png" alt="" class="post-btn">
								</div>
								<br clear="both">
							</div>
						</div> -->

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
