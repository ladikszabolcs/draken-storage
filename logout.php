<?php

require "views/class_views.php";
require "models/class_models.php";
require "controllers/class_controllers.php";
require 'vendor/autoload.php';

if(array_key_exists("logout", $_POST)){
	$log->info('Sikeres kilépés: ' . $_SESSION["username"]);
	session_unset();
	session_destroy();
}



header("location: index.php");
?>