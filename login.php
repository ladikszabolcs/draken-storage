<?php

require "controllers/class_controllers.php";
require "models/class_models.php";
require "views/class_views.php";

$database = new Database();

$database->connect("LOCAL");

$result = $database->sqlquery("SELECT password FROM users WHERE email=\"" . $_POST["username"] . "\"");

if(password_verify($_POST["password"], $result["password"])){
	//Sikeres belépés
	$log->info('User: ' . $_POST["username"] . ' logged in successfully.');
	$_SESSION['username']=$_POST["username"];
	header("Location: index.php?error=success");
}
else{
	//Sikertelen belépés
	$log->info('Password fail for user: ' . $_POST["username"]);
	header("Location: index.php?error=passwordfail");
}
?>