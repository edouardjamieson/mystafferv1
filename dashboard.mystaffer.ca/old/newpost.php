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
					<div class="navi-link navi-active" onclick="window.location = 'posts'">
						<img src="content/img/posts-icon.png" alt="" class="ni-icon">
						<span class="ni-label">PUBLICATIONS</span>
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

				<?php

				$nocommerce = $_COOKIE["nocommerce"];
				$db = "admin_".$nocommerce;
				$conn = mysqli_connect("localhost",$db,"dieuaimelamoutarde123",$db);
				?>

				<div class="page-title"><div class="page-title-text">Rédiger une publication</div></div>
				<div class="new-post-view">
					<div class="container-view">
						<form method="post" class="new-post-inner">
							<?php

							if(isset($_POST['newpost-submit'])){
								$nptext = mysqli_real_escape_string($conn,$_POST['newpost-text']);
								$npfile = htmlentities($_POST['newpost-imgdoc']);
								$npdate = date("d/m/Y");
								$getmanager = mysqli_query($conn, "SELECT manager FROM entreprise");
								while($maninf = mysqli_fetch_array($getmanager)){$npposter = $maninf["manager"];
								if(empty($nptext)){
									echo "<script language='javascript'>alert('Vous devez entrer un message!')</script>";
								}else{
									$newnotif = mysqli_query($conn, "INSERT INTO notifications (type,content,for) VALUES ('post','bonjour','all')");
									$addpost = mysqli_query($conn, "INSERT INTO posts (poster,text,imgdoc,date) VALUES ('$npposter','$nptext','$npfile','$npdate')");

									header("Location:posts");
								}
							}
						}

							?>
							<textarea name="newpost-text" class="ui-textarea-post" placeholder="Écrivez un fait, une remarque ou encore un message pour féliciter l'équipe."></textarea>
							<input type="file" name="newpost-imgdoc" style="visibility:hidden;" id="newpost-imgdoc">
							<div class="newpost-imgdoc">

								<label for="newpost-imgdoc" class="newpost-imgdoc-label">Ajouter une image ou un document</label>
							</div>
							<div class="newpost-submit">
								<input type="submit" name="newpost-submit" value="Publier" class="newpost-submit-btn">
							</div>

						</form>
						<br clear="both">
					</div>
				</div>


			</div>

		</div>

	</body>
</html>
