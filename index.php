<?php

require "controllers/class_controllers.php";
require "models/class_models.php";
require "views/class_views.php";

$database = new Database();
$view = new Views();

$view->menuView();

if(array_key_exists("username", $_SESSION)){
	echo("<div style='margin-top: 60px'>Huhú</div>");
}
else{
	$view->loginView();
}

$database->connect("LOCAL");

setcookie("ui","dark");

var_dump($_POST);

var_dump($_SESSION);

?>