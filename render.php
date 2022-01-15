<?php

require "views/class_views.php";
require "models/class_models.php";
require "controllers/class_controllers.php";
require 'vendor/autoload.php';

$database = new Database();
$database->connect("LOCAL");

######################ez csak teszt
var_dump($_POST);
echo("<br>");
#echo("valami " . $_POST["name"]);
echo("UPDATE `items` SET `name` =" . " '" . $_POST['name'] . "' " . "WHERE `items`.`id` = " . $_POST['save']);

#echo("UPDATE `items` SET `name` = \"' . $_POST["name"] . '\" WHERE `items`.`id` = 1");


#UPDATE `items` SET `name` = 'Túró rudi2', `code` = 'tr1', `quantity` = '56', `unit` = '2', `category` = '3' WHERE `items`.`id` = 1

#UPDATE `items` SET `name` = 'Túró rudi2' WHERE `items`.`id` = 1

######################


$result = $database->sqlquery("UPDATE `items` SET `name` =" . " '" . $_POST['name'] . "' " . 
	", `code` =" . " '" . $_POST['code'] . "' " . ", `quantity` =" . " '" . $_POST['quantity'] . "' " . "WHERE `items`.`id` = " . $_POST['save']);

#ez kell WHERE elé,de az ID kell nem a NAME
#. ", `unit` =" . " '" . $_POST['unit'] . "' " . ", `category` =" . " '" . $_POST['category'] . "' " 



header("location: items.php");

?>


