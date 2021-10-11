<?php
if(!isset($_COOKIE['usertel'])){
	header("Location:index");
}

$conndb = "admin_".$_COOKIE['nocommerce'];
$conn = mysqli_connect("localhost",$conndb,"dieuaimelamoutarde123",$conndb) or die("erreur");

$tel = $_COOKIE['usertel'];
setcookie('usertel', '', time()-3600);
setcookie('nocommerce', '', time()-3600);
header("Location:index");
 ?>
