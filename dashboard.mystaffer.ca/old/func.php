<?php
//connect to bdd
$conn = mysqli_connect("localhost","solidebr_staffer","edouard99","solidebr_staffer");

//get ent Informations
$getentinfos = mysqli_query($conn, "SELECT * FROM entreprise");
while($entinfos = mysqli_fetch_assoc($getentinfos)){
	$einfos[] = $entinfos;
}return $einfos;
?>
