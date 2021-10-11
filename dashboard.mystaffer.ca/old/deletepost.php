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
				<div class="page-title"><div class="page-title-text">Supprimer un publications</div></div>
				<div class="posts-view">
					<div class="deletepost-view">
						Souhaitez-vous vraiment supprimer cette publication?<br>
						<form method="post">
							<input type="submit" name="deletepost" value="Oui" class="deletepost-btn" class="deletepost-btn">
							<a href="posts" class="dontdeletepost-btn">Non</a>
						</form>
					</div><br>
					<?php
					$postid = $_GET["post"];

					$getpostinfos = mysqli_query($conn, "SELECT * FROM posts WHERE id=$postid");
					if(mysqli_num_rows($getpostinfos) < 1){
						header("Location:posts");
					}else{
					while($posts = mysqli_fetch_array($getpostinfos)){

						echo "
						<div class='container-view'>
							<div class='post-view'>
								<span class='post-poster'>".$posts['poster']."</span><br>
								<p class='post-content'>".$posts['text']."</p>
								<span class='post-date'>".$posts['date']."</span>
							</div>
						</div>



						";


					}

					if(isset($_POST["deletepost"])){
						$delete = mysqli_query($conn, "DELETE FROM posts WHERE id=$postid");
						header("Location:posts");
					}
				}

					?>
				</div>

			</div>

		</div>

	</body>
</html>
