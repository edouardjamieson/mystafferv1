<!DOCTYPE html>
<!--[if lte IE 6]><html class="preIE7 preIE8 preIE9"><![endif]-->
<!--[if IE 7]><html class="preIE8 preIE9"><![endif]-->
<!--[if IE 8]><html class="preIE9"><![endif]-->
<!--[if gte IE 9]><!-->
<html lang="en" dir="ltr"><!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<title>MyStaffer</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="default">
		<meta name="apple-mobile-web-app-title" content="MyStaffer">
		<link rel="apple-touch-startup-image" href="content/img/startup.png">
		<link rel="apple-touch-icon" href="content/img/apple-icon.png"/>

		<meta name="mobile-web-app-capable" content="yes">
		<link rel="shortcut icon" sizes="196x196" href="content/img/apple-touch-icon.png">
		<link rel="shortcut icon" sizes="128x128" href="content/img/apple-touch-icon.png">
		<link rel="icon" href="content/img/apple-touch-icon.png">
		<link rel="stylesheet" href="content/css/main.css">
	</head>
	<body onload="main();side()">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
		<script src="content/js/main.js" type="text/javascript"></script>
		<script src="content/js/side.js" type="text/javascript"></script>

		<?php

		if(!isset($_COOKIE['usertel'])){
			header("Location:index");
		}
		$conndb = "admin_".$_COOKIE['nocommerce'];
		$conn = mysqli_connect("localhost",$conndb,"dieuaimelamoutarde123",$conndb) or die("erreur");

		//check session
		$tel = $_COOKIE['usertel'];
		$checksession = mysqli_query($conn, "SELECT * FROM employees WHERE tel='$tel'");
		$nrowssess = mysqli_num_rows($checksession);
		if($nrowssess < 1){
			header("Location:logout");
		}

		 ?>

		<div id="main-framework-mobileapp">

			<div class="edit-profile-overlay">
				<div class="edit-profile-inner"><br>
					<div class="exit-edp-icon">
						<img src="content/img/x-icon.png" alt="x" class="exit-edp" onclick="editProfileC()">
					</div><br>
					<div class="page-title" style="text-align:center;">Modifier le profil</div><br>
					<form method="post" class="edp-edit">
						<?php
						$tel = $_COOKIE['usertel'];
						$getemp = mysqli_query($conn, "SELECT * FROM employees WHERE tel='$tel'");
						while($emp = mysqli_fetch_array($getemp)){
						?>
						<span class="edp-label">Nom</span><br>
						<input type="text" name="edp-name" value="<?php echo $emp["nom"]; ?>" placeholder="Nom complet" class="edp-textbox"><br>
						<span class="edp-label">Adresse courriel</span><br>
						<input type="text" name="edp-email" value="<?php echo $emp["email"]; ?>" placeholder="Adresse courriel" class="edp-textbox"><br>
						<div class="edp-submit-box">
							<input type="submit" name="edp-submit" value="Modifier" class="edp-submit">
						</div>
					<?php }



					if(isset($_POST['edp-submit'])){
						$edpname = $_POST["edp-name"];
						$edpemail = $_POST["edp-email"];
						$edppdp = $_POST["edp-pdp"];
						if(empty($edpname)){
							echo "<script type='text/javascript'>alert('Vous devez avoir un nom!')</script>";
						}
						if(empty($edpemail)){
							echo "<script type='text/javascript'>alert('Vous devez avoir une adresse courriel!')</script>";
						}

						if(!empty($_POST["edp-name"] && $_POST["edp-email"])){
							$updateprof = mysqli_query($conn, "UPDATE employees SET nom='$edpname', email='$edpemail' WHERE tel='$tel'");
						}

					}

					 ?>
					</form>
					<div class="logout-box">
						<span class="logout-btn" onclick="logOut()">Se déconnecter du commerce</span>
						<script type="text/javascript">
							function logOut(){
								if(confirm("Se déconnecter entrainera la suppression de votre profil dans cette entreprise. Voulez-vous continuer?")){
									window.location.href = 'logout';
								}
							}
						</script>
					</div>
				</div>
			</div>

			<div class="newpost-overlay">
				<div class="page-content">
					<div class="post-cancel" onclick="closePost()">Annuler</div>
					<div class="page-title">Publier</div><br>
					<form method="post">
						<textarea name="np-text" class="np-text" placeholder="Écrivez un commentaire, un fait ou encore un message pour féliciter l'équipe!"></textarea><br>
						<input type="submit" name="np-submit" class="np-submit" value="Publier">
						<?php
						if(isset($_POST["np-submit"])){
							$nptext = mysqli_real_escape_string($conn, $_POST["np-text"]);
							$npdate = date("d/m/Y");
							$getemppostinfos = mysqli_query($conn, "SELECT * FROM employees WHERE tel='$tel'");
							while($pemp = mysqli_fetch_array($getemppostinfos)){
							$pempname = $pemp["nom"];
							if(empty($nptext)){
								echo "<script type='text/javascript'>alert('Vous devez entrer du texte!')</script>";
							}else{
								$addpostmobile = mysqli_query($conn, "INSERT INTO posts (poster,text,date) VALUES ('$pempname','$nptext','$npdate')");
							}
						}
						}

						 ?>
					</form>
				</div>
			</div>


			<div class="main-header">
				<div class="hdr-logo-box">
					<img src="content/img/logo-full.png" alt="logo" class="hdr-logo">
				</div>
			</div>

			<div class="main-body">
				<div id="pageholder">1</div>

				<div class="page-holder">
					<div class="homepage page">

						<div class="page-content">
							<div class="home-title page-title">Accueil</div>
							<div class="home-refresh">
								<img src="content/img/refresh-icon.png"  class="refresh-icon" alt="" onclick="location.reload();">
							</div>
							<br><br>
							<div class="posts">
								<?php
								$getpinnedpost = mysqli_query($conn, "SELECT * FROM posts WHERE pinned='1' ORDER BY id DESC");
								while($pposts = mysqli_fetch_array($getpinnedpost)){
									echo "

									<div class='page-post'>
										<div class='pagepost-content'>
											<div class='ppc-poster'>".$pposts['poster']."</div>
											<span class='ppc-date'>".$pposts['date']."</span>
											<div class='ppc-textcontent'><p>".$pposts['text']."</p></div><br>
											<img src='content/img/pinnedpost-icon.png' class='read-msg-icon'><br clear='both'>
										</div>
									</div>

									";
								}

								$getposts = mysqli_query($conn, "SELECT * FROM posts WHERE pinned='0' ORDER BY id DESC");
								$numrowsposts = mysqli_num_rows($getposts);
								if($numrowsposts < 1){
									echo "Aucune publication";
								}else{
								while($posts = mysqli_fetch_array($getposts)){


									echo "

									<div class='page-post'>
										<div class='pagepost-content'>
											<div class='ppc-poster'>".$posts['poster']."</div>
											<span class='ppc-date'>".$posts['date']."</span>
											<div class='ppc-textcontent'><p>".$posts['text']."</p></div><br>
											<form method='post'>";

												$seenby = $posts["seenby"];
												if(strpos($seenby, $tel) == true){
													echo "<img src='content/img/readpostchecked-icon.png' class='read-msg-icon'><br clear='both'>";
												}else{
													echo "<label for='read-msg-".$posts['id']."'><img src='content/img/readpost-icon.png' class='read-msg-icon'></label><input type='submit' name='read-msg-".$posts['id']."' class='read-msg' id='read-msg-".$posts['id']."'><br clear='both'>";
												}
												$readid = "read-msg-".$posts["id"];
												if(isset($_POST[$readid])){
													$newseenby = $seenby.",".$tel;
													$postsid = $posts["id"];
													$addread = mysqli_query($conn, "UPDATE posts SET seenby='$newseenby' WHERE id='$postsid'");
													echo "<script type='text/javascript'>document.location.reload()</script>";
												}


												echo "
											</form>
										</div>
									</div>



									";


								}
							}

								 ?>
							</div>
						</div>

					</div>
					<div class="schedulepage page">

						<div class="page-content">
							<div class="page-title">Horaire</div><br>
							<span class="week-teller">Pour la semaine du :
							<form method="post">
								<select class="sche-week" name="sche-week">
									<option selected disabled>Selectionner une semaine</option>
							<?php
							$getweeks = mysqli_query($conn, "SELECT id,week FROM schedule WHERE emptel='$tel'");
							while($week = mysqli_fetch_array($getweeks)){
								$userweeks = $week["week"];
								$weekid = $week["id"];
								echo "<option value='".$week["id"]."'>".$userweeks."</option>";
								if(isset($_POST["sche-week"])){
									$chosenweek = $_POST["sche-week"];
									setcookie("week", $chosenweek, time() + (10 * 365 * 24 * 60 * 60));
									echo "<script type='text/javascript'>document.location.reload()</script>";
								}
							}

							 ?>
								</select>
							</form><br>

							<script type="text/javascript">

								$(".sche-week").on('change', function(){
									$(".schedule-box").fadeOut(1);
									var scheval = $(".sche-week").val();
									var sche = "#sche-"+scheval;
									$(sche).fadeIn(1);
								});

							</script>

							<?php
							echo "<span class='sche-week-teller'>".$ccweek."</span>";
							$getschedule = mysqli_query($conn, "SELECT * FROM schedule WHERE emptel='$tel'");
							while($sche = mysqli_fetch_array($getschedule)){


							?>
							<div class="schedule-box" id="sche-<?php echo $sche["id"]; ?>" style="display:none;">

								<div class="sche-sep"></div>
								<div class="schedule-teller">
									<span class="weekday">Lundi</span><br>
									<span class="shift-teller"><?php echo $sche["lundi"]; ?></span>
								</div>
								<div class="schedule-teller">
									<span class="weekday">Mardi</span><br>
									<span class="shift-teller"><?php echo $sche["mardi"]; ?></span>
								</div>
								<div class="schedule-teller">
									<span class="weekday">Mercredi</span><br>
									<span class="shift-teller"><?php echo $sche["mercredi"]; ?></span>
								</div>
								<div class="schedule-teller">
									<span class="weekday">Jeudi</span><br>
									<span class="shift-teller"><?php echo $sche["jeudi"]; ?></span>
								</div>
								<div class="schedule-teller">
									<span class="weekday">Vendredi</span><br>
									<span class="shift-teller"><?php echo $sche["vendredi"]; ?></span>
								</div>
								<div class="schedule-teller">
									<span class="weekday">Samedi</span><br>
									<span class="shift-teller"><?php echo $sche["samedi"]; ?></span>
								</div>
								<div class="schedule-teller">
									<span class="weekday">Dimanche</span><br>
									<span class="shift-teller"><?php echo $sche["dimanche"]; ?></span>
								</div>
								<div class="sche-sep"></div>
								<div class="totalhr">
									<span class="total-label">Total d'heures :</span>
									<span class="total-hr"><?php echo $sche["totalhr"]; ?>h</span>
								</div>
							</div>
						<?php } ?>

						</div>

					</div>
					<div class="employeespage page">

						<div class="page-content">
							<div class="page-title">Notifications</div><br>
							<div class="notifications">
								<?php
								$getnotifs = mysqli_query($conn, "SELECT * FROM notifs WHERE for='$tel' ORDER BY id");
								$nrowsnotifs = mysqli_num_rows($getnotifs);
								if($nrowsnotifs < 1){
									echo "Aucune notification";
								}else{
									while($notif = mysqli_fetch_array($getnotifs)){
										//notif new member
										//notif new schedule
										//notif
									}
								}
								 ?>

								 <div class="notif-cell">
									 <div class="notif-content">
									 	<img src="content/img/posts-icon-active.png" class="notif-img">
										<span class="notif-text">Nouvelle publication du gérant</span>
									 </div>
								 </div>
								 <div class="notif-cell">
									 <div class="notif-content">
									 	<img src="content/img/schedule-icon-active.png" class="notif-img">
										<span class="notif-text">Un nouvel horaire est disponible</span>
									 </div>
								 </div>
								 <div class="notif-cell">
									 <div class="notif-content">
									 	<img src="content/img/name-icon-active.png" class="notif-img">
										<span class="notif-text">Un nouvel employé a rejoin le groupe</span>
									 </div>
								 </div>

							</div>

						</div>

					</div>
					<div class="profilepage page">

						<div class="page-content">
							<div class="page-title">Profil</div><br>
							<?php
							$tel = $_COOKIE['usertel'];
							$getemp = mysqli_query($conn, "SELECT * FROM employees WHERE tel='$tel'");
							while($emp = mysqli_fetch_array($getemp)){

								$emprank = $emp["rank"];
								$getrank = mysqli_query($conn, "SELECT * FROM ranks WHERE id='$emprank'");
								while($rank = mysqli_fetch_array($getrank)){
									echo "<div class='rankpr' style='background:#".$rank["color"]."'>".$rank["nom"]."</div><br>";
								}?>
							<div class="profile-box">
								<?php
									echo "
									<div class='pb-frontbox'><br>
										<span class='pb-name'>".$emp['nom']."</span>
									<div class='pb-infosbox'>
										<div class='pb-info'>".$emp['tel']."</div>
										<div class='pb-info'>".$emp['email']."</div>
										<br clear='both'>
									</div></div>

									";

								}

								 ?>
								 <div class="edit-profile-btn" onclick="editProfileO()">Modifier le profil</div><br>
							</div>
							<?php $getemps = mysqli_query($conn, "SELECT * FROM employees WHERE tel!='$tel' AND rank!='pending'");
							while($emps = mysqli_fetch_array($getemps)){

								echo "

								<div class='employee'><div class='emp-inner'>";

									$emprank = $emps["rank"];
									$getrank = mysqli_query($conn, "SELECT * FROM ranks WHERE id='$emprank'");
									while($rank = mysqli_fetch_array($getrank)){
										echo "<span class='rank' style='background:#".$rank["color"]."'>".$rank["nom"]."</span>";
									}
									echo "<span class='em-name'>".$emps['nom']."</span><br>
									<span class='em-action'>Tel :</span>
									<a class='em-action-link' href='tel:".$emps['tel']."'>".$emps['tel']."</a><br>
									<span class='em-action'>Courriel :</span>
									<a class='em-action-link' href='mailto:".$emps['email']."'>".$emps['email']."</a><br>
								</div></div>

								";

							}

							 ?>
						</div>

					</div>
				</div>

			</div>
			<div class="main-footer">
				<div class="navigation-box">
					<div class="navi-separate"></div>
					<div class="navi-spacer"></div>
					<div class="navi-btn" onclick="openPage(1)">
						<img src="content/img/home-icon.png" alt="home" class="home-icon navi-icon" id="home-icon navicon">
						<!-- <span class="navi-label">Accueil</span> -->
					</div>
					<div class="navi-btn" onclick="openPage(2)">
						<img src="content/img/schedule-icon.png" alt="schedule" class="schedule-icon navi-icon" id="schedule-icon navicon">
						<!-- <span class="navi-label">Horaire</span> -->
					</div>
					<?php

					$getstgs = mysqli_query($conn, "SELECT * FROM settings");
					while($stg = mysqli_fetch_array($getstgs)){
						if($stg["usercanpost"] == 1){
							echo "
							<style>.navi-btn{width:20%;}</style>
							<div class='navi-btn' onclick='openPost()'>
								<img src='content/img/posts-icon.png' alt='post' class='post-icon navi-icon' id='post-icon navicon'>
							</div>
							";
						}else{
							echo "<style>.navi-btn{width:25%;}</style>";
						}
					}

					 ?>
					<div class="navi-btn" onclick="openPage(3)">
						<img src="content/img/notif-icon.png" alt="employees" class="notif-icon navi-icon" id="employees-icon navicon">
						<!-- <span class="navi-label">Notification</span> -->
					</div>
					<div class="navi-btn" onclick="openPage(4)">
						<img src="content/img/name-icon.png" alt="profile" class="profile-icon navi-icon" id="profile-icon navicon">
						<!-- <span class="navi-label">Profil</span> -->
					</div>
				</div>
			</div>

		</div>

	</body>
</html>
