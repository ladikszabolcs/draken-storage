<?php

require "views/class_views.php";
require "models/class_models.php";
require "controllers/class_controllers.php";
require 'vendor/autoload.php';

var_dump($_POST);
echo("<br>");

$database = new Database();
$database->connect("LOCAL");


$result = $database->sqlquery("SELECT * FROM users WHERE email =\"" . $_POST["username"] . "\"");


var_dump($result);
echo("<br>");


if (password_verify($_POST["password"], $result["password"])){
	$log->info('Sikeres belépés: ' . $_POST["username"]);
	header("location: index.php?error=success");
	$_SESSION['username']=$_POST["username"];

}
else{
	$log->info('Hibás jelszó: ' . $_POST["username"]);
	header("location: index.php?error=passwordfail");
}


echo("<br>");
var_dump($_SESSION);


echo("<br>");
#var_dump(password_hash("teszt", PASSWORD_DEFAULT));

echo("<br>");





?>


