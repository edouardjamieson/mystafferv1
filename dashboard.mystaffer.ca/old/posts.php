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

				if(!isset($_COOKIE["session"])){
					header("Location:login");
				}


				$nocommerce = $_COOKIE["nocommerce"];
				$db = "admin_".$nocommerce;
				$conn = mysqli_connect("localhost",$db,"dieuaimelamoutarde123",$db);

				?>
				<div class="page-title"><div class="page-title-text">Publications</div></div>
				<div class="newpost-box"><a href='newpost'>Nouvelle publication</a></div><br>
				<div class="posts-view">
					<?php
					$getpinnedpost = mysqli_query($conn, "SELECT * FROM posts WHERE pinned='1' ORDER BY id DESC");
					while($pposts = mysqli_fetch_array($getpinnedpost)){
						echo "<div class='container-view'>
							<div class='post-view'>
								<div class='post-action-btn'>
									<img src='content/img/pinnedpost-icon.png' class='post-action-img'>
									<a href='deletepost?post=".$pposts['id']."'><img src='content/img/deletepost-icon.png' class='post-action-img'></a>
								</div>
								<span class='post-poster'>".$pposts['poster']."</span><br>
								<p class='post-content'>".$pposts['text']."</p>
								<span class='post-date'>".$pposts['date']."</span>
							</div>
						</div>";
					}

					$getpostinfos = mysqli_query($conn, "SELECT * FROM posts WHERE pinned='0' ORDER BY id DESC");
					if(mysqli_num_rows($getpostinfos) < 1){
						echo "Aucune publication";
					}else{
					while($posts = mysqli_fetch_array($getpostinfos)){

						echo "

						<div class='container-view'>
							<div class='post-view'>
								<div class='post-action-btn'>
									<form method='post'>
										<label for='pin-".$posts["id"]."'><img src='content/img/pinpost-icon.png' class='post-action-img' style='display:inline-block;'></label>
										<input type='submit' name='pin-".$posts["id"]."' id='pin-".$posts["id"]."' value='' class='post-setpinned'><br clear='both'>
									</form>
									<a href='deletepost?post=".$posts['id']."'><img src='content/img/deletepost-icon.png' class='post-action-img'></a>
								</div>
								<span class='post-poster'>".$posts['poster']."</span><br>
								<p class='post-content'>".$posts['text']."</p>
								<span class='post-date'>".$posts['date']."</span>
							</div>
						</div>



						";
						$pinnedid = "pin-".$posts["id"];
						$pinid = $posts["id"];
						if(isset($_POST[$pinnedid])){
							$setpinned = mysqli_query($conn, "UPDATE posts SET pinned='1' WHERE id='$pinid'");
							header("Refresh:0");
						}


					}
				}

					?>
				</div>

			</div>

		</div>

	</body>
</html>
