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



$result = $database->sqlquery("INSERT INTO `users` (`id`, `email`, `password`) VALUES (NULL, \"" . $_POST["username"] . "\", \"" . $_POST["password"] . "\")");





#var_dump($result);
echo("<br>");


#var_dump($_SESSION);
echo("<br>");



#header("location: index.php");
?>


