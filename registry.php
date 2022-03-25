<?php

require "views/class_views.php";
require "models/class_models.php";
require "controllers/class_controllers.php";
require 'vendor/autoload.php';

$database = new Database();
$database->connect("LOCAL");


$result = $database->sqlquery("SELECT * FROM users WHERE email =\"" . $_POST["username"] . "\"");
#var_dump($result);

if($result == false){
	#regi
	$result = $database->sqlquery("INSERT INTO `users` (`id`, `email`, `password`) VALUES (NULL, \"" . $_POST["username"] . "\", \"" . password_hash($_POST["password"], PASSWORD_DEFAULT) . "\")");
		header("location: index.php?error=success2");
		$log->info('Sikeres regisztráció: ' . $_POST["username"]);

}
else{
	#már van
	header("location: index.php?error=useralreadyexits");
	$log->info('Foglalt felhasználó: ' . $_POST["username"]);

}



?>


