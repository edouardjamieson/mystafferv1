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
		<link rel="shortcut icon" sizes="196x196" href="content/img/apple-icon.png">
		<link rel="shortcut icon" sizes="128x128" href="content/img/apple-icon.png">
		<link rel="icon" href="content/img/apple-touch-icon.png">
		<link rel="stylesheet" href="content/css/main.css">
	</head>
	<body onload="main();side()">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
		<script src="content/js/main.js?v=2" type="text/javascript"></script>
		<script src="content/js/side.js?v=2" type="text/javascript"></script>
		<script src="content/js/p2refresh.js" type="text/javascript"></script>
		<script type="text/javascript">
		if ('serviceWorker' in navigator) {
		navigator.serviceWorker.register('service-worker.js');
		}
		</script>

		<div class="loading">
			<img src="content/img/ajax-loader.gif" alt="">
		</div>

		<?php

		// if(!isset($_COOKIE['usertel'])){
		// 	header("Location:index");
		// }
		$conndb = "admin_".$_COOKIE['nocommerce'];
		// $conn = mysqli_connect("localhost",$conndb,"dieuaimelamoutarde123",$conndb) or header("Location:logout");

		//check session
		$tel = $_COOKIE['usertel'];
		$checksession = mysqli_query($conn, "SELECT * FROM employees WHERE tel='$tel'");
		$nrowssess = mysqli_num_rows($checksession);
		// if($nrowssess < 1){
		// 	header("Location:logout");
		// }

		 ?>

		 <script type="text/javascript">
		 PullToRefresh.init({
mainElement: 'body', // above which element?
onRefresh: function (done) {
  setTimeout(function () {
	 done(); // end pull to refresh
	 location.reload();
  }, 1500);
}
});
		 </script>

		<div id="main-framework-mobileapp">

			<div class="settings-overlay">
				<div class="settings"><br>
					<div class="page-title">Paramètres</div>
				</div>
			</div>
			<div class="newpost-overlay">
				<div class="newpost"><br>
					<div class="page-title">Publier</div>
					<form method="post">
						<div class="np-text">
							<textarea name="np-text" class="np-textarea" placeholder="Demandez un remplacement, faites une remarque ou dites simplement une blague" ></textarea>
						</div>
						<input type="submit" name="newpost-post" value="Publier" class="np-submit">
					</form>
				</div>
			</div>

			<div class="app-header">
				<div class="aheader-inner">
					<img src="content/img/logo-full.png" class="header-logo" alt="">
					<img src="content/img/settings-icon.png" class="settings-icon" alt="" onclick="openSettings()">
					<br clear="both">
				</div>
			</div>

			<div class="app-core">

				<div class="post-page page">
					<div class="page-content">

						<div class="page-title" onclick="location.reload();" id="page-title">Accueil</div>
						<?php
						$getpinnedpost = mysqli_query($conn, "SELECT * FROM posts WHERE pinned='1' ORDER BY id DESC");
						while($pposts = mysqli_fetch_array($getpinnedpost)){
							echo "
							<div class='post-box pinned-post'>
								<div class='post'>
									<div class='post-date'>
										<div class='pdate'>
											<span class='pdate-num'>15</span><br>
											<span class='pdate-month'>NOV</span>
										</div>
									</div>
									<div class='post-content'>
										<div class='post-title'>".$pposts['poster']."</div>
										<div class='post-precontent'>".$pposts['text']."</div>
									</div>
									<br clear='both'>
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

							<div class='post-box'>
								<div class='post'>
									<div class='post-date'>
										<div class='pdate'>";
										$ppdate = $posts["date"];
										$ppmonth = date("M",strtotime($ppdate));
										$ppday = date("d",strtotime($ppdate));
										echo "
											<span class='pdate-num'>".$ppday."</span><br>
											<span class='pdate-month'>".$ppmonth."</span>
										</div>
									</div>
									<div class='post-content'>
										<div class='post-title'>".$posts['poster']."</div>
										<div class='post-precontent'>".$posts['text']."</div>
									</div>
									<br clear='both'>
									<form method='post'>";

									$seenby = $posts["seenby"];
									if(strpos($seenby, $tel) == true){
										echo "<div class='read-btn'><img src='content/img/readpost-checked-icon.png'></div>";
									}else{
										echo "
										<input type='submit' name='read-msg-".$posts['id']."' class='read-btn-submit' id='read-msg-".$posts['id']."'>
										<label for='read-msg-".$posts['id']."' class='read-btn'>
											<img src='content/img/readpost-icon.png'>
										</label>
										";
									}
									$readid = "read-msg-".$posts["id"];
									if(isset($_POST[$readid])){
										$newseenby = $seenby.",".$tel;
										$postsid = $posts["id"];
										$addread = mysqli_query($conn, "UPDATE posts SET seenby='$newseenby' WHERE id='$postsid'");
										echo "<script type='text/javascript'>document.location.reload()</script>";
									}

									echo "</form><br clear='both'>
								</div>
							</div>

							";

						}}
						?>


					</div>

				</div>

				<div class="schedule-page page">
					<div class="page-content">
						<div class="page-title">Horaire</div>
						<form method="post">
							<div class="choose-schedule">
								<img src="content/img/schedule-icon.png" class="choose-schedule-icon" alt="">
								<select class="choose-schedule-select" name="choose-schedule">
									<option selected disabled>Choisir une semaine</option>
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
							</div>
						</form>

						<script type="text/javascript">

							$(".choose-schedule-select").on('change', function(){
								$(".week-schedule").fadeOut(1);
								var scheval = $(".choose-schedule-select").val();
								var sche = "#sche-"+scheval;
								$(sche).fadeIn(1);
							});

						</script>
						<?php
						echo "<span class='sche-week-teller'>".$ccweek."</span>";
						$getschedule = mysqli_query($conn, "SELECT * FROM schedule WHERE emptel='$tel'");
						while($sche = mysqli_fetch_array($getschedule)){


						?>

						<div class="week-schedule" id="sche-<?php echo $sche["id"]; ?>" style="display:none;">
							<div class="day-schedule">
								<span class="week-day">Dimanche</span><br>
								<span class="shift-day"><?php echo $sche["dimanche"]; ?></span>
							</div>
							<div class="day-schedule">
								<span class="week-day">Lundi</span><br>
								<span class="shift-day"><?php echo $sche["lundi"]; ?></span>
							</div>
							<div class="day-schedule">
								<span class="week-day">Mardi</span><br>
								<span class="shift-day"><?php echo $sche["mardi"]; ?></span>
							</div>
							<div class="day-schedule">
								<span class="week-day">Mercredi</span><br>
								<span class="shift-day"><?php echo $sche["mercredi"]; ?></span>
							</div>
							<div class="day-schedule">
								<span class="week-day">Jeudi</span><br>
								<span class="shift-day"><?php echo $sche["jeudi"]; ?></span>
							</div>
							<div class="day-schedule">
								<span class="week-day">Vendredi</span><br>
								<span class="shift-day"><?php echo $sche["vendredi"]; ?></span>
							</div>
							<div class="day-schedule">
								<span class="week-day">Samedi</span><br>
								<span class="shift-day"><?php echo $sche["samedi"]; ?></span>
							</div>
							<div class="totalhr-schedule">
								<span class="totalhr-label">Total d'heures</span><br>
								<span class="totalhr-nb"><?php echo $sche["totalhr"]; ?></span>
							</div>
						</div>


					<?php } ?>

					</div>
				</div>

				<div class="event-page page">
					<div class="page-content">
						<div class="page-title">Évèvements</div>
						<div class="events">

							<div class="event-timeteller">Prochain</div>
							<div class="event">
								<div class="event-content">
									<div class="event-bubble"></div>
									<div class="event-name">Party de noel</div>
									<br clear="both">
									<div class="event-sep"></div>
									<div class="event-desc">Apportez votre alcool, habillez vous chics, ca va brosser</div>
									<div class="event-date">19/19/2010 à 21:00</div>
								</div>
							</div>

							<br>
							<div class="event-timeteller">À venir</div>
							<div class="event">
								<div class="event-content">
									<div class="event-bubble-soon"></div>
									<div class="event-name">Party de noel</div>
									<br clear="both">
									<div class="event-sep"></div>
									<div class="event-desc">Apportez votre alcool, habillez vous chics, ca va brosser</div>
									<div class="event-date">19/19/2010 à 21:00</div>
								</div>
							</div>
							<div class="event">
								<div class="event-content">
									<div class="event-bubble-soon"></div>
									<div class="event-name">Party de noel</div>
									<br clear="both">
									<div class="event-sep"></div>
									<div class="event-desc">Apportez votre alcool, habillez vous chics, ca va brosser</div>
									<div class="event-date">19/19/2010 à 21:00</div>
								</div>
							</div>

						</div>
					</div>
				</div>

				<div class="profile-page page">
					<div class="page-content">
						<div class="page-title">Profil</div>
						<div class="profile">
							<?php
							$tel = $_COOKIE['usertel'];
							$getemp = mysqli_query($conn, "SELECT * FROM employees WHERE tel='$tel'");
							while($emp = mysqli_fetch_array($getemp)){

								$emprank = $emp["rank"];
								$getrank = mysqli_query($conn, "SELECT * FROM ranks WHERE id='$emprank'");
								while($rank = mysqli_fetch_array($getrank)){
									echo "<div class='profile-rank' style='background:#".$rank["color"]."'>".$rank['nom']."</div>";
								}
								?>
							<!-- <div class="profile-rank" style="background:#ced6e0;">Employé</div> -->
							<?php
								echo "

								<div class='profile-name'>".$emp['nom']."</div>
								<div class='profile-sep'></div>
								<div class='profile-infos'>
									<img src='content/img/phone-icon.png' class='profile-inf-img'>
									<span class='profile-inf'>".$emp['tel']."</span><br>
									<img src='content/img/email-icon.png' class='profile-inf-img'>
									<span class='profile-inf'>".$emp['email']."</span>
								</div>
								<div class='profile-sep'></div>

								";
							}
							?>
						</div>
						<div class="com-emps">
						<?php $getemps = mysqli_query($conn, "SELECT * FROM employees WHERE tel!='$tel' AND rank!='pending'");
						while($emps = mysqli_fetch_array($getemps)){
							echo "

							<div class='com-emp'>
								<div class='com-emp-content'>
									<span class='cemp-name'>".$emps['nom']."</span><br>
									<img src='content/img/phone-icon.png' class='cemp-img'>
									<a href='tel:".$emps['tel']."' class='cemp-link'>".$emps['tel']."</a><br>
									<img src='content/img/email-icon.png' class='cemp-img'>
									<a href='mailto:".$emps['email']."' class='cemp-link'>".$emps['email']."</a><br>
								</div>
							</div>

							";
						}
						?>

						</div>
					</div>
				</div>



			</div>

			<div class="app-navigator">
				<div class="navigator" onclick="openPage(1)">
					<img src="content/img/home-icon.png" class="navigator-icon" alt="">
				</div>
				<div class="navigator" onclick="openPage(2)">
					<img src="content/img/schedule-icon.png" class="navigator-icon" alt="">
				</div>
				<?php

				$getstgs = mysqli_query($conn, "SELECT * FROM settings");
				while($stg = mysqli_fetch_array($getstgs)){
					if($stg["usercanpost"] == 1){
						echo "
						<style>.navigator{width:20%;}</style>
						<div class='navigator' onclick='openPost()'>
							<img src='content/img/posts-icon.png' class='navigator-icon'>
						</div>
						";
					}else{
						echo "<style>.navigator{width:25%;}</style>";
					}
				}

				 ?>
				<div class="navigator" onclick="openPage(3)">
					<img src="content/img/event-icon.png" class="navigator-icon" alt="">
				</div>
				<div class="navigator" onclick="openPage(4)">
					<img src="content/img/name-icon.png" class="navigator-icon" alt="">
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
