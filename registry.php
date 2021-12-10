<?php

require "views/class_views.php";
require "models/class_models.php";
require "controllers/class_controllers.php";

$database = new Database();
$database->connect("LOCAL");


#echo($_POST["username"]);
echo("<br>");
#echo("INSERT INTO `users` (`id`, `email`, `password`) VALUES (NULL, \"" . $_POST["username"] . "\", \"" . $_POST["password"] . "\")");
echo("<br>");

$result = $database->sqlquery("SELECT * FROM users WHERE email=\"" . $_POST["username"] . "\"");

var_dump($result);
if($result == false){
	#regisztráció
	$result = $database->sqlquery("INSERT INTO `users` (`id`, `email`, `password`) VALUES (NULL, \"" . $_POST["username"] . "\", \"" . password_hash($_POST["password"], PASSWORD_DEFAULT) . "\")");
	header("location: index.php?error=success");
	$log->info('User ' . $_POST['username'] . ' registered successfully.');
}
else{
	#már van ilyen felhasználó, hibaüzenetet megjeleníteni
	header("location: index.php?error=useralreadyexists");
	$log->info('Register fail for ' . $_POST["username"] . ' , username already exists.');
}

?>


