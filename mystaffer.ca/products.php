<!DOCTYPE html>
<!--[if lte IE 6]><html class="preIE7 preIE8 preIE9"><![endif]-->
<!--[if IE 7]><html class="preIE8 preIE9"><![endif]-->
<!--[if IE 8]><html class="preIE9"><![endif]-->
<!--[if gte IE 9]><!-->
<html lang="en" dir="ltr"><!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<title>MyStaffer - PRODUITS</title>
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link rel="stylesheet" href="content/css/main.css">
		<link rel="stylesheet" href="content/css/dashboard.css">
	</head>
	<body>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
		<script src="content/js/main.js" type="text/javascript"></script>
		<script src="content/js/side.js" type="text/javascript"></script>

		<div id="main-frame">

			<div class="header-navigation">
				<div class="def-rest">
					<img src="content/img/logo-full.png" class="header-logo" alt="">
					<a href="index" class="hd-nav-link">Accueil</a>
					<a href="contact" class="hd-nav-link">Contacte</a>
					<a href="https://dashboard.mystaffer.ca/login" target="_blank" class="hd-nav-implink">Espace membre</a>
				</div>
			</div>
			<div class="prd-plans-wrapper">
				<div class="def-rest">
					<div class="prd-title">Accéder à la bêta</div><br><br><br><br>
					<div class="prd-betabox">
						<span class="prd-betabox-ft">Inscrivez votre code d'accès pour la version bêta ci-dessous</span><br>
						<span class="prd-betabox-st">Vous serez redirigé vers la page d'inscription</span>
						<br><br><br>
						<form method="post">
							<div class="prd-betacode">
								<input type="text" name="betacode" placeholder="12345" class="prd-bcodetb">
							</div><br><br>
							<input type="submit" name="accessbeta" value="Accéder" class="prd-bcodebtn">
							<?php

							if(isset($_POST["accessbeta"])){
								if($_POST["betacode"] == "bonjour"){
									header("Location:https://dashboard.mystaffer.ca/register?newregister=trialtype");
								}else{
									echo "<script type='text/javascript'>alert('Code incorrect!')</script>";
								}
							}


							 ?>
						</form>
					</div>
					<!-- <div class="plan-box">
						<div class="plan-content"><br>
							<div class="plan-title">MyStaffer</div>
							<div class="plan-pricing"><span class='plan-price'>80$</span><span class='plan-timing'>/mois</span></div>
							<div class="plan-sep"></div>
							<div class="plan-ftr">
								<span>- Pour petit ou moyen commerce</span><br><br>
								<span>- Création d'horaire</span><br><br>
								<span>- Publications</span><br><br>
								<span>- Gestions des employés</span><br><br>
								<span>- Et bien plus encore</span><br><br>
							</div>
							<div class="plan-sep"></div><br>
							<div class="plan-choosebtn">Choisir</div><br>
							<div class="plan-freealert">
								IMPORTANT<br>Du à nos politiques de paiements, aucun des plans ne se renouvellent automatiquement. Afin de conserver votre abonnement, une alerte s'affichera quand le temps de renouveller sera venu.
							</div><br>
						</div>
					</div>
					<div class="plan-box" style="position:relative;top:-20px;">
						<div class="plan-content"><br>
							<div class="plan-title">Essaie gratuit</div>
							<div class="plan-duration">1 mois</div>
							<div class="plan-sep"></div>
							<div class="plan-ftr">
								<span>- 100% des avantages de MyStaffer</span><br><br>
								<span>- Pour petit ou moyen commerce</span><br><br>
								<span>- Aucunes restrictions</span><br><br>
								<span>- Aucunes obligations</span><br><br>
							</div>
							<div class="plan-sep"></div><br>
							<div class="plan-choosebtn">Choisir</div><br>
							<div class="plan-freealert">
								IMPORTANT<br>Par la suite de votre essaie, vous pourrez commencer à payer de façon hebdomadaire afin de continuer les services, sans ça, votre compte se verra supprimé après 10 jours.
							</div><br>
						</div>
					</div>
					<div class="plan-box">
						<div class="plan-content"><br>
							<div class="plan-title">MyStaffer +</div>
							<div class="plan-pricing"><span class='plan-price'>400$</span><span class='plan-timing'>/mois</span></div>
							<div class="plan-sep"></div>
							<div class="plan-ftr">
								<span>- Pour gros commerce</span><br><br>
								<span>- Tous les avantages de MyStaffer</span><br><br>
								<span>- Machine dédiée</span><br><br>
								<span>- Énorme rapidité</span><br><br>
								<span>- Encore plus fiable!</span><br><br>
							</div>
							<div class="plan-sep"></div><br>
							<div class="plan-choosebtn">Choisir</div><br>
							<div class="plan-freealert">
								IMPORTANT<br>Du à nos politiques de paiements, aucun des plans ne se renouvellent automatiquement. Afin de conserver votre abonnement, une alerte s'affichera quand le temps de renouveller sera venu.							</div><br>
						</div>
					</div> -->
				</div>
			</div>

			<div class="footer-view">
				<div class="footer-content">
					<div class="fot-linkbox">
						<a href="http://dashboard.mystaffer.ca/login" target="_blank" class="footer-link">Espace membre</a><br>
						<a href="about" class="footer-link">À propos</a><br>
						<a href="more/faq" class="footer-link">F.A.Q.</a><br>
						<a href="contact" class="footer-link">Nous contacter</a><br>
					</div>
					<div class="fot-linkbox">
						<a href="more/use" class="footer-link">Utilisation</a><br>
						<a href="more/privacy" class="footer-link">Confidentalité</a><br>
						<a href="more/cookies" class="footer-link">Cookies</a><br>
						<a href="more/buying" class="footer-link">Achat</a><br>
					</div>
					<div class="fot-linkbox">
						<a href="more/blog" class="footer-link">Blog</a><br>
						<a href="more/api" class="footer-link">API</a><br>
						<a href="more/logo" class="footer-link">Logo</a><br>
						<a href="more/changelog" class="footer-link">Change log</a><br>
					</div>
					<div class="fot-linkbox">
						<a href="more/version" class="footer-link">Version 0.1</a><br>
						<a href="#" class="footer-link">Status : BETA</a><br>
						<a href="#" class="footer-link">-</a><br>
						<a href="more/love" class="footer-link">Fait avec ❤️</a><br>
					</div>
					<br clear="both">
					<div class="fot-logo">
						<img src="content/img/logo-full.png" alt="">
					</div>
				</div>
			</div>

		</div>

	</body>
</html>
