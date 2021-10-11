<?php

if(!isset($_COOKIE["session"])){
	header("Location:login");
}else{
	header("Location:home");
}



 ?>
