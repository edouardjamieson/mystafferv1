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


			<div class="thankyou">

				<div class="ty-logo">
					<img src="content/img/logo-full.png" alt="">
				</div>

				<div class="ty-tks">
					<span style="font-size:1.5em;">Bienvenue sur MyStaffer</span><br>
					<span style="font-size:1.8em;color:#ff4757;"><?php echo $_GET["entname"]; ?></span><br><br>
					<span style="font-size:1.3em;">Vous pouvez désormais vous rendre à l'espace de connexion <a href="login">ici</a> et vous connectez à votre commerce.</span><br>
					<span style="font-size:1.3em;">Un courriel contenant les informations de connexion vous a été envoyé à l'adresse <?php echo $_GET["mail"]; ?>.</span><br>
					<span style="font-size:1.2em;color:#ced6e0;">Ce courriel pourrait se trouver dans vos courriels indésirables!</span><br><br>
					<span style="font-size:1.3em;">Prendre note que votre version d'essaie prendra fin le <?php echo $_GET["duedate"]; ?>!</span><br><br>
					<span style="font-size:1.4em;">Merci de nous faire confiance!</span>
				</div>

			</div>

		</div>

	</body>
</html>
