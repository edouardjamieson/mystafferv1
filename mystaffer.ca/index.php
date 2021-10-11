<?php

$lang = "fr";
if(isset($_COOKIE["lang"])){
	$lang = $_COOKIE["lang"];
}
if(isset($_GET["lang"])){
	$lang = $_GET["lang"];
	setcookie("lang", $lang, time() + (10 * 365 * 24 * 60 * 60));
}
$langage = "lang/$lang.php";
include $langage;

 ?>
<!DOCTYPE html>
<!--[if lte IE 6]><html class="preIE7 preIE8 preIE9"><![endif]-->
<!--[if IE 7]><html class="preIE8 preIE9"><![endif]-->
<!--[if IE 8]><html class="preIE9"><![endif]-->
<!--[if gte IE 9]><!-->
<html lang="en" dir="ltr"><!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<title>MyStaffer</title>
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link rel="stylesheet" href="content/css/main.css">
		<link rel="stylesheet" href="content/css/dashboard.css">
	</head>
	<body onload="checkMobile()">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
		<script src="content/js/main.js" type="text/javascript"></script>
		<script src="content/js/side.js" type="text/javascript"></script>
		<script type="text/javascript">
			function checkMobile(){
				if( navigator.userAgent.match(/Android/i)
				 || navigator.userAgent.match(/webOS/i)
				 || navigator.userAgent.match(/iPhone/i)
				 || navigator.userAgent.match(/iPad/i)
				 || navigator.userAgent.match(/iPod/i)
				 || navigator.userAgent.match(/BlackBerry/i)
				 || navigator.userAgent.match(/Windows Phone/i)
				 ){
				    window.location.href = "https://mobile.mystaffer.ca";
				  }
			}
		</script>

		<div id="main-frame">

			<div class="header-navigation">
				<div class="def-rest">
					<img src="content/img/logo-full.png" class="header-logo" alt="">
					<a href="products" class="hd-nav-link"><?php echo $nav_products; ?></a>
					<a href="contact" class="hd-nav-link"><?php echo $nav_contact; ?></a>
					<a href="https://dashboard.mystaffer.ca/login" target="_blank" class="hd-nav-implink"><?php echo $nav_member; ?></a>
					<a href="https://mystaffer.ca?lang=<?php echo $naven; ?>" class="hd-nav-lglink"><?php echo $navenb; ?></a>
				</div>
			</div>
			<div class="index-presview">
				<div class="def-rest">
					<div class="idxpre-textcontent">
						<span style='font-size:3.5vw;font-weight: bold;color:#ff4757;'><?php echo $pre_slog1; ?></span><br><span style='font-size:3vw;'><?php echo $pre_slog12; ?><br> <?php echo $pre_slog13; ?></span><br><br>
						<div class="idx-txtsep"></div><br><br>
						<span style='font-size:1vw;'><?php echo $pre_slog2; ?><br><?php echo $pre_slog21; ?></span>
						<br><br><br>
						<a href="products" class="def-redbtn"><?php echo $pre_slog3; ?></a>
					</div>
					<div class="idxpre-imgcontent">
						<img src="content/img/index-iphone.png" class="index-phone" alt="">
					</div>
					<br clear="both">
				</div>
			</div>
			<div class="index-features">
				<div class="def-rest">
					<div class="ftr-title"><?php echo $f_title; ?></div><br><br><br>
					<div class="ftr-box">
						<img src="content/img/desktop-ft.png" class="ftr-img" alt=""><br>
						<span class="ftr-boxtitle"><?php echo $f1; ?></span>
						<div class="ftr-boxsep"></div>
						<div class="ftr-boxctn">
							<?php echo $f11; ?>
						</div>
					</div>
					<div class="ftr-box" style="margin-left:2%;margin-right:2%;">
						<img src="content/img/mobile-ft.png" class="ftr-img" alt=""><br>
						<span class="ftr-boxtitle"><?php echo $f2; ?></span>
						<div class="ftr-boxsep"></div>
						<div class="ftr-boxctn">
							<?php echo $f22; ?>
						</div>
					</div>
					<div class="ftr-box">
						<img src="content/img/lock-ft.png" class="ftr-img" alt=""><br>
						<span class="ftr-boxtitle"><?php echo $f3; ?></span>
						<div class="ftr-boxsep"></div>
						<div class="ftr-boxctn">
							<?php echo $f33; ?>
						</div>
					</div>
					<div class="ftr-box">
						<img src="content/img/employees-ft.png" class="ftr-img" alt=""><br>
						<span class="ftr-boxtitle"><?php echo $f4; ?></span>
						<div class="ftr-boxsep"></div>
						<div class="ftr-boxctn">
							<?php echo $f44; ?>
						</div>
					</div>
					<div class="ftr-box" style="margin-left:2%;margin-right:2%;">
						<img src="content/img/doc-ft.png" class="ftr-img" alt=""><br>
						<span class="ftr-boxtitle"><?php echo $f5; ?></span>
						<div class="ftr-boxsep"></div>
						<div class="ftr-boxctn">
							<?php echo $f55; ?>
						</div>
					</div>
					<div class="ftr-box">
						<img src="content/img/schedule-ft.png" class="ftr-img" alt=""><br>
						<span class="ftr-boxtitle"><?php echo $f6; ?></span>
						<div class="ftr-boxsep"></div>
						<div class="ftr-boxctn">
							<?php echo $f66; ?>
						</div>
					</div>
					<div class="ftr-box">
						<img src="content/img/talk-ft.png" class="ftr-img" alt=""><br>
						<span class="ftr-boxtitle"><?php echo $f7; ?></span>
						<div class="ftr-boxsep"></div>
						<div class="ftr-boxctn">
							<?php echo $f77; ?>
						</div>
					</div>
					<div class="ftr-box" style="margin-left:2%;margin-right:2%;">
						<img src="content/img/settings-ft.png" class="ftr-img" alt=""><br>
						<span class="ftr-boxtitle"><?php echo $f8; ?></span>
						<div class="ftr-boxsep"></div>
						<div class="ftr-boxctn">
							<?php echo $f88; ?>
						</div>
					</div>
					<div class="ftr-box">
						<img src="content/img/nopaper-ft.png" class="ftr-img" alt=""><br>
						<span class="ftr-boxtitle"><?php echo $f9; ?></span>
						<div class="ftr-boxsep"></div>
						<div class="ftr-boxctn">
							<?php echo $f99; ?>
						</div>
					</div>
					<br clear="both">
					<div class="ftr-teaser">
						<?php echo $f10; ?>
					</div>
				</div>
			</div>
			<div class="index-interfaceoverview">
				<div class="def-rest">
					<div class="inter-title"><?php echo $ov1; ?></div><br>
					<div class="inter-subtitle"><?php echo $ov2; ?></div>
					<div class="inter-imgs">
						<img src="content/img/ios-logo.png" class="inter-img" alt=""><br>
						<img src="content/img/android-logo.png" class="inter-img" alt="">
						<br>
						<img src="content/img/macos-logo.png" class="inter-img" alt=""><br>
						<img src="content/img/window-logo.png" class="inter-img" alt="">
					</div><br>
					<div class="inter-sep"></div>
					<div class="inter-subtitle" style='font-weight:bold'>Comment y accèder?</div><br><br>
					<div class="inter-links">
						<div class="inter-link">
							<span>Interface gérant :</span>
							<div class="inter-linkbox">
								<a href="https://dashboard.mystaffer.ca">https://dashboard.mystaffer.ca</a>
							</div>
						</div>
						<div class="inter-link">
							<span>Interface employés :</span>
							<div class="inter-linkbox">
								<a href="https://mobile.mystaffer.ca">https://mobile.mystaffer.ca</a>
							</div>
						</div>
					</div>

				</div>
			</div>
			<div class="index-invite">
				<div class="def-rest">
					<div class="inv-title">
						Alors, interessé?
					</div>
					<div class="inv-subdesc">
						Bénéficier d'un <u>essaie gratuit d'un mois</u> en rejoingnant l'application qui ressere les liens entre vous et vos employés et établie une meilleure communication.
					</div>
					<div style='width:90%;margin:auto;text-align:center;margin-top:5%;'>
						<a href="products" class="def-redbtn">Essayer gratuitement</a>
					</div>

				</div>
			</div>
			<div class="footer-view">
				<div class="footer-content">
					<div class="fot-linkbox">
						<a href="http://dashboard.mystaffer.ca/login" target="_blank" class="footer-link">Espace membre</a><br>
						<a href="more/about" class="footer-link">À propos</a><br>
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
