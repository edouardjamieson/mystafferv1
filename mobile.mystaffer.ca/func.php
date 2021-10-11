<?php
session_start();

$conndb = "solidebr_".$_COOKIE['nocommerce'];
$conn = mysqli_connect("localhost","solidebr_staffer","edouard99",$conndb) or die("erreur");
$_SESSION["usertel"] = $telephone;

 ?>
