<?php

require "controllers/class_controllers.php";
require "models/class_models.php";
require "views/class_views.php";

$database = new Database();
$database->connect("LOCAL");

$result = $database->sqlquery("SELECT password FROM users WHERE email=\"" . $_POST["username"] . "\"");


if(password_verify($_POST["password"], $result["password"])){
	echo("MEGEGYEZIK");
	$_SESSION['username']=$_POST["username"];
}
else{
	echo("NEM EGYEZIK MEG");
}

var_dump(password_hash("teszt", PASSWORD_DEFAULT));	
var_dump(password_verify("teszt", "\$2y\$10\$S.0GMrbAtgoCQGkgPqgp.OTK4QPanuU0jRySoOZZ8plW0owsft88i"));

var_dump($result);
var_dump($_SESSION);
var_dump($_POST);


header("Location: index.php");
?>