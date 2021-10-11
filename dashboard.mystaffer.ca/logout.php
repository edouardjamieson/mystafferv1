<?php
if(!isset($_COOKIE['nocommerce'])){
	header("Location:login");
}
setcookie('session', '', time()-3600);
setcookie('nocommerce', '', time()-3600);
header("Location:login");




 ?>
