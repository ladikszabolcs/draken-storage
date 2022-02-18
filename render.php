<?php

require "views/class_views.php";
require "models/class_models.php";
require "controllers/class_controllers.php";
require 'vendor/autoload.php';

$items = new Items();

if(array_key_exists("save", $_POST)){
	if($_POST["save"]=="addnewitem"){
		$items->addItem($_POST);
	}
	else{
		$items->updateItems($_POST);
	}
}

if(array_key_exists("delete", $_POST)){
	$items->deleteItem($_POST["delete"]);
}

header("location: items.php");

?>