<!DOCTYPE html>
<!--[if lte IE 6]><html class='preIE7 preIE8 preIE9'><![endif]-->
<!--[if IE 7]><html class='preIE8 preIE9'><![endif]-->
<!--[if IE 8]><html class='preIE9'><![endif]-->
<!--[if gte IE 9]><!-->
<html lang='en' dir='ltr'><!--<![endif]-->
	<head>
		<meta charset='utf-8'>
		<title>MyStaffer</title>
		<meta name='viewport' content='width=device-width,initial-scale=1,user-scalable=0'>
		<meta name='apple-mobile-web-app-capable' content='yes'>
		<meta name='apple-mobile-web-app-status-bar-style' content='default'>
		<meta name='apple-mobile-web-app-title' content='MyStaffer'>
		<link rel='apple-touch-startup-image' href='content/img/startup.png'>
		<link rel='apple-touch-icon' href='content/img/apple-icon.png'/>

		<meta name='mobile-web-app-capable' content='yes'>
		<link rel='shortcut icon' sizes='196x196' href='content/img/apple-touch-icon.png'>
		<link rel='shortcut icon' sizes='128x128' href='content/img/apple-touch-icon.png'>
		<link rel='icon' href='content/img/apple-touch-icon.png'>
		<link rel='stylesheet' href='content/css/main.css'>
		<link rel='stylesheet' href='content/css/prelogin.css'>
	</head>
	<body onload='side();main();'>
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js' type='text/javascript'></script>
		<script src='content/js/main.js' type='text/javascript'></script>
		<script src='content/js/side.js' type='text/javascript'></script>
		<script src="content/js/p2refresh.js" type="text/javascript"></script>
		<script type="text/javascript">
		if ('serviceWorker' in navigator) {
		navigator.serviceWorker.register('service-worker.js');
		}
		</script>
		<div class="loading">
			<img src="content/img/ajax-loader.gif" alt="">
		</div>

		<div id='main-framework-mobileapp'>


			<?php

			if(!isset($_COOKIE['usertel'])){
				$notloggedin = true;
			}

			if($notloggedin == true){
				echo "

				<div class='noapp-view'>
					<div class='noapp-desc'>
						<span class='noapp-alert'>Vous y êtes presque!</span><br>
						<img src='content/img/mystaffer-install.gif' class='noapp-install' alt=''>
						<p>Il ne vous reste plus qu'a ajouter l'application à votre écran d'accueil en appuyant sur le bouton ci-dessou!</p>
					</div>
					<div class='arrow'>
						<img src='content/img/arrow-down.png' class='arrow-down'>
					</div>
				</div>
				<div class='back-to-reg' onclick='backtoSelect()'>
					<img src='content/img/arrow-left-icon.png' class='backtoreg-img'>
				</div>

				<div class='reg-logoplacement'>
					<img src='content/img/logo-full.png' alt='logo' class='reg-logo'>
				</div>
				<div class='reg-registerbox'>
					<div class='register'>
							<div class='select-login'>
								<br><br>
								<div class='reg-submitbtn reg-uitextbox' style='color:#fff;'>
									<span class='login-label' onclick='openRegister()'>Nouvel utilisateur</span>
								</div>
								<div class='reg-uitextbox'>
									<span class='login-label' onclick='openLogin()'>Se connecter</span>
								</div>
							</div>
							<form method='post' name='login' class='login-form'>
								<div class='reg-uitextbox'>
									<input type='tel' name='lnocommerce' placeholder='# de commerce' class='reg-textbox'>
								</div>
								<div class='reg-uitextbox'>
									<input type='text' name='luseremail' placeholder='Adresse courriel' class='reg-textbox' autocapitalize='none'>
								</div>
								<div class='reg-uitextbox'>
									<input type='tel' name='lusertel' placeholder='Téléphone' class='reg-textbox'>
								</div>
								<div class='reg-submitbtn reg-uitextbox'>
									<input type='submit' name='submit-login' value='Continuer' class='submit-reg'>
								</div><br>

							</form>
							";
							if(isset($_POST["submit-login"])){

								$lnocommerce = htmlentities($_POST["lnocommerce"]);
								$lemail = htmlentities($_POST["luseremail"]);
								$ltel = htmlentities($_POST["lusertel"]);

								if(empty($lnocommerce)){
									echo "<script language='javascript'>alert('Vous devez entrer un numéro de commerce!')</script>";
								}
								if(empty($lemail)){
									echo "<script language='javascript'>alert('Vous devez entrer une adresse courriel!')</script>";
								}
								if(empty($ltel)){
									echo "<script language='javascript'>alert('Vous devez entrer un numéro de téléphone!')</script>";
								}

								if(!empty($lnocommerce && $lemail && $ltel)){

									$conndb = "admin_".$lnocommerce;
									$conn = mysqli_connect("localhost",$conndb,"dieuaimelamoutarde123",$conndb);
									$fetchuser = mysqli_query($conn, "SELECT * FROM employees WHERE tel='$ltel'");
									$lnrows = mysqli_num_rows($fetchuser);
									if($lnrows > 0){
										echo "<script>
										document.cookie = 'nocommerce=".$lnocommerce."; expires= Thu, 21 Aug 2020 20:00:00 UTC';
										document.cookie = 'usertel=".$ltel."; expires= Thu, 21 Aug 2020 20:00:00 UTC';
										location.reload();
										</script>";
										//setcookie("nocommerce", $lnocommerce, time() + (10 * 365 * 24 * 60 * 60), "/");
										//setcookie("usertel", $ltel, time() + (10 * 365 * 24 * 60 * 60), "/");

									}else{
										echo "<script language='javascript'>alert('Cet employé est innexistant!');</script>";

										//echo "<script language='javascript'>location.reload();</script>";
										//$adduser = mysqli_query($conn, "INSERT INTO employees (nom,email,tel,rank) VALUES ('$name','$email','$tel','pending')");
										//setcookie("nocommerce", $nocommerce, time() + (10 * 365 * 24 * 60 * 60));
										//setcookie("usertel", $tel, time() + (10 * 365 * 24 * 60 * 60));
									}

								}

							}
							echo"
							<form method='post' class='register-form' name='register'>
								<div class='reg-uitextbox'>
									<input type='tel' name='rnocommerce' placeholder='# de commerce' class='reg-textbox'>
								</div>
								<div class='reg-uitextbox'>
									<input type='text' name='ruserfullname' placeholder='Nom complet' class='reg-textbox'>
								</div>
								<div class='reg-uitextbox'>
									<input type='text' name='ruseremail' placeholder='Adresse courriel' class='reg-textbox' autocapitalize='none'>
								</div>
								<div class='reg-uitextbox'>
									<input type='tel' name='rusertel' placeholder='Téléphone' class='reg-textbox'>
								</div>
								<div class='reg-submitbtn reg-uitextbox'>
									<input type='submit' name='submit-register' value='Terminé' class='submit-reg'>
								</div><br>

							</form>
					</div>
				</div>

				";



				if(isset($_POST["submit-register"])){

					$rnocommerce = htmlentities($_POST["rnocommerce"]);
					$rname = htmlentities($_POST["ruserfullname"]);
					$remail = htmlentities($_POST["ruseremail"]);
					$rtel = htmlentities($_POST["rusertel"]);

					if(empty($rnocommerce)){
						echo "<script language='javascript'>alert('Vous devez entrer un numéro de commerce!')</script>";
					}
					if(empty($rname)){
						echo "<script language='javascript'>alert('Vous devez entrer votre nom!')</script>";
					}
					if(empty($remail)){
						echo "<script language='javascript'>alert('Vous devez entrer une adresse courriel!')</script>";
					}
					if(empty($rtel)){
						echo "<script language='javascript'>alert('Vous devez entrer un numéro de téléphone!')</script>";
					}

					if(!empty($rnocommerce && $rname && $remail && $rtel)){

						$conndb = "admin_".$rnocommerce;
						$conn = mysqli_connect("localhost",$conndb,"dieuaimelamoutarde123",$conndb);
						$fetchuser = mysqli_query($conn, "SELECT * FROM employees WHERE tel='$rtel'");
						$nrows = mysqli_num_rows($fetchuser);
						if($nrows > 0){
							echo "<script language='javascript'>alert('Cet employé existe déjà!')</script>";
						}else {
							$adduser = mysqli_query($conn, "INSERT INTO employees (nom,email,tel,rank,visible) VALUES ('$rname','$remail','$rtel','pending','1')");
							//setcookie("nocommerce", $rnocommerce, time() + (10 * 365 * 24 * 60 * 60));
							//setcookie("usertel", $rtel, time() + (10 * 365 * 24 * 60 * 60));
							echo "<script>
							document.cookie = 'nocommerce=".$rnocommerce."; expires= Thu, 21 Aug 2030 20:00:00 UTC';
							document.cookie = 'usertel=".$rtel."; expires= Thu, 21 Aug 2030 20:00:00 UTC';
							location.reload();
							</script>";
							//header("Refresh:0");
						}

					}

				}


			}else{

				$nocommerce = $_COOKIE["nocommerce"];
				$tel = $_COOKIE["usertel"];

				$conndb = "admin_".$nocommerce;
				$conn = mysqli_connect("localhost",$conndb,"dieuaimelamoutarde123",$conndb);

				$getpending = mysqli_query($conn, "SELECT * FROM employees WHERE tel='$tel'");
				while($ispending = mysqli_fetch_array($getpending)){
					if($ispending["rank"] == "pending"){
						echo "
						<div class='reg-logoplacement'>
							<img src='content/img/logo-full.png' alt='logo' class='reg-logo'>
						</div>
						<div class='pending-box'>
							<span class='pending-warning'>PATIENTEZ</span>
							<div class='pending-text'>
								<div class='pending-p'>Votre demande à rejoindre le groupe à été fait au gérant. Vous receverez un courriel lorsqu'il ou elle vous aura accepté!<br><br>Merci de votre compréhension.</div><br>
								<div class='refresh-pending' onclick='location.reload()'>Rafraichir</div>
							</div>
						</div>

						";
					}else{

						echo "

						<div class='settings-overlay'>
							<div class='settings'><br>
								<div class='page-title'>Paramètres</div>
								<form method='post' style='margin-top:2%;'>
									<span class='stgs-label'>Visible dans les contactes :</span><br>
									<select name='contactlist' class='stgs-select'>
										<option value='1'>Oui</option>
										<option value='0'>Non</option>
									</select>

									<span class='stgs-label'>Mode sombre :</span><br>
									<select name='contactlist' class='stgs-select'>
										<option value='1' disabled>Bientot disponnible</option>
									</select>
								</form>
							</div>
						</div>
						<div class='newpost-overlay'>
							<div class='newpost'><br>
								<div class='page-title'>Publier</div>
								<form method='post'>
									<div class='np-text'>
										<textarea name='np-text' class='np-textarea' placeholder='Demandez un remplacement, faites une remarque ou dites simplement une blague' ></textarea>
									</div>
									<input type='submit' name='newpost-post' value='Publier' class='np-submit'>
								</form>";
								if(isset($_POST["newpost-post"])){
									$getpostuser = mysqli_query($conn, "SELECT * FROM employees WHERE tel='$tel'");
									while($npname = mysqli_fetch_array($getpostuser)){
										$npposter = $npname["nom"];
										$nptext = mysqli_real_escape_string($conn, $_POST["np-text"]);
										$npdate = date("Y-m-d");
										if(!empty($nptext)){
											$addpost = mysqli_query($conn, "INSERT INTO posts (poster,text,date) VALUES ('$npposter','$nptext','$npdate')");
											echo "<script>location.reload();</script>";
										}else{
											echo "<script language='javascript'>alert('Vous devez entrer un message!')</script>";
										}

									}
								}

								echo"
							</div>
						</div>

						<div class='app-header'>
							<div class='aheader-inner'>
								<img src='content/img/logo-full.png' class='header-logo' alt=''>
								<img src='content/img/settings-icon.png' class='settings-icon' alt='' onclick='openSettings()'>
								<br clear='both'>
							</div>
						</div>

						<div class='app-core' id='app-core'>
							<div class='post-page page' id='pagepo'>"; ?>

								<script type="text/javascript">
								 PullToRefresh.init({
								  mainElement: '#pagepo', // above which element?
								  onRefresh: function (done) {
									 setTimeout(function () {
									 done(); // end pull to refresh
									 location.reload();
									 }, 1500);
								  }
								  });
								</script>

								<?php echo "

								<div class='page-content'>

									<div class='page-title'>Accueil</div>";
									$getpinnedpost = mysqli_query($conn, "SELECT * FROM posts WHERE pinned='1' ORDER BY id DESC");
									while($pposts = mysqli_fetch_array($getpinnedpost)){
										echo "
										<div class='post-box pinned-post'>
											<div class='post'>
												<div class='post-date'>
													<div class='pdate'>";
													$ppdate = $pposts["date"];
													$ppmonth = date("M",strtotime($ppdate));
													$ppday = date("d",strtotime($ppdate));
													echo "
														<span class='pdate-num'>".$ppday."</span><br>
														<span class='pdate-month'>".$ppmonth."</span>
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
													$pdate = $posts["date"];
													$pmonth = date("M",strtotime($pdate));
													$pday = date("d",strtotime($pdate));
													echo "
														<span class='pdate-num'>".$pday."</span><br>
														<span class='pdate-month'>".$pmonth."</span>
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
									echo "

									</div>
									</div>

									<div class='schedule-page page' id='pagesch'>
										<div class='page-content'>
											<div class='page-title'>Horaire</div>
											<form method='post'>
												<div class='choose-schedule'>
													<img src='content/img/schedule-icon.png' class='choose-schedule-icon' alt=''>
													<select class='choose-schedule-select' name='choose-schedule'>
														<option selected disabled>Choisir une semaine</option>
									";
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
									echo "

									</select>
									</div>
									</form>

									<script type='text/javascript'>
										$('.choose-schedule-select').on('change', function(){
											$('.week-schedule').fadeOut(1);
											var scheval = $('.choose-schedule-select').val();
											var sche = '#sche-'+scheval;
											$(sche).fadeIn(1);
										});
									</script>
									";
									echo "<span class='sche-week-teller'>".$ccweek."</span>";
									$getschedule = mysqli_query($conn, "SELECT * FROM schedule WHERE emptel='$tel'");
									while($sche = mysqli_fetch_array($getschedule)){

										echo "

										<div class='week-schedule' id='sche-".$sche['id']."' style='display:none;'>
											<div class='day-schedule'>
												<span class='week-day'>Lundi</span><br>
												<span class='shift-day'>".$sche['lundi']."</span>
											</div>
											<div class='day-schedule'>
												<span class='week-day'>Mardi</span><br>
												<span class='shift-day'>".$sche['mardi']."</span>
											</div>
											<div class='day-schedule'>
												<span class='week-day'>Mercredi</span><br>
												<span class='shift-day'>".$sche['mercredi']."</span>
											</div>
											<div class='day-schedule'>
												<span class='week-day'>Jeudi</span><br>
												<span class='shift-day'>".$sche['jeudi']."</span>
											</div>
											<div class='day-schedule'>
												<span class='week-day'>Vendredi</span><br>
												<span class='shift-day'>".$sche['vendredi']."</span>
											</div>
											<div class='day-schedule'>
												<span class='week-day'>Samedi</span><br>
												<span class='shift-day'>".$sche['samedi']."</span>
											</div>
											<div class='day-schedule'>
												<span class='week-day'>Dimanche</span><br>
												<span class='shift-day'>".$sche['dimanche']."</span>
											</div>
											<div class='totalhr-schedule'>
												<span class='totalhr-label'>Total d'heures</span><br>
												<span class='totalhr-nb'>".$sche['totalhr']."</span>
											</div>
										</div>


										";

									}

									echo "

									</div>
									</div>

									<div class='event-page page'>
										<div class='page-content'>
											<div class='page-title'>Évèvements</div>
											<div class='events'>

												<div class='event-timeteller'>Prochain</div>
												<div class='event'>
													<div class='event-content'>
														<div class='event-bubble'></div>
														<div class='event-name'>Party de noel</div>
														<br clear='both'>
														<div class='event-sep'></div>
														<div class='event-desc'>Apportez votre alcool, habillez vous chics, ca va brosser</div>
														<div class='event-date'>19/19/2010 à 21:00</div>
													</div>
												</div>

												<br>
												<div class='event-timeteller'>À venir</div>
												<div class='event'>
													<div class='event-content'>
														<div class='event-bubble-soon'></div>
														<div class='event-name'>Party de noel</div>
														<br clear='both'>
														<div class='event-sep'></div>
														<div class='event-desc'>Apportez votre alcool, habillez vous chics, ca va brosser</div>
														<div class='event-date'>19/19/2010 à 21:00</div>
													</div>
												</div>
												<div class='event'>
													<div class='event-content'>
														<div class='event-bubble-soon'></div>
														<div class='event-name'>Party de noel</div>
														<br clear='both'>
														<div class='event-sep'></div>
														<div class='event-desc'>Apportez votre alcool, habillez vous chics, ca va brosser</div>
														<div class='event-date'>19/19/2010 à 21:00</div>
													</div>
												</div>

											</div>
										</div>
									</div>

									<div class='profile-page page'>
										<div class='page-content'>
											<div class='page-title'>Profil</div>
											<div class='profile'>
											<div class='profile-ent'>
									";

									$getent = mysqli_query($conn, "SELECT * FROM entreprise");
									while($entinf = mysqli_fetch_array($getent)){
										echo "<div class='pr-ent-name'>".$entinf["entname"]."</div>
										<div class='pr-ent-no'>#".$nocommerce."</div></div>";
									}

									$tel = $_COOKIE['usertel'];
									$getemp = mysqli_query($conn, "SELECT * FROM employees WHERE tel='$tel'");
									while($emp = mysqli_fetch_array($getemp)){

										$emprank = $emp["rank"];
										$getrank = mysqli_query($conn, "SELECT * FROM ranks WHERE id='$emprank'");
										while($rank = mysqli_fetch_array($getrank)){
											echo "<div class='profile-rank' style='background:#".$rank["color"]."'>".$rank['nom']."</div>";
										}

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
									echo "
									</div>
									<div class='com-emps'>
									";
									$getemps = mysqli_query($conn, "SELECT * FROM employees WHERE tel!='$tel' AND rank!='pending'");
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
									echo "
									</div>
									</div>
									</div>
									</div>

									<div class='app-navigator'>
										<div class='navigator' onclick='openPage(1)'>
											<img src='content/img/home-icon.png' class='navigator-icon' alt=''>
										</div>
										<div class='navigator' onclick='openPage(2)'>
											<img src='content/img/schedule-icon.png' class='navigator-icon' alt=''>
										</div>
									";
									$getstgs = mysqli_query($conn, "SELECT * FROM settings");
									while($stg = mysqli_fetch_array($getstgs)){
										if($stg["usercanpost"] == 1){
											echo "
											<style>.navigator{width:20%;}</style>
											<div class='navigator' onclick='openPost()'>
												<img src='content/img/newpost-icon.png' class='navigator-icon'>
											</div>
											";
										}else{
											echo "<style>.navigator{width:25%;}</style>";
										}
									}
									echo "
									<div class='navigator' onclick='openPage(3)'>
										<img src='content/img/event-icon.png' class='navigator-icon' alt=''>
									</div>
									<div class='navigator' onclick='openPage(4)'>
										<img src='content/img/name-icon.png' class='navigator-icon' alt=''>
									</div>
								</div>
									";


					}
				}

			}

			 ?>

		</div>
		<script language="javascript" type="text/javascript">
		 	$(window).load(function() {
		     	$('.loading').hide();
		  	});
		</script>

	</body>
</html>
