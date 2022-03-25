<?php

require "views/class_views.php";
require "models/class_models.php";
require "controllers/class_controllers.php";
require 'vendor/autoload.php';

$items = new Items();
var_dump($_POST);
echo("<br>");
echo("<br>");
echo("<br>");
var_dump($_FILES);
echo("<br>");
echo("<br>");
echo("<br>");
var_dump(base64_encode(file_get_contents($_FILES['image']['tmp_name'])));
echo("<br>");
echo("<br>");
echo("<br>");
if(array_key_exists("save", $_POST)){
	if ($_POST["save"]=="addnewitem") {
		$items->addItem($_POST);
	}
	else{
		$items->updateItems($_POST);
	}
}

if(array_key_exists("delete", $_POST)){
	$items->deleteItem($_POST["delete"]);
}

if (array_key_exists("massivedelete", $_POST)) {
	$items->massivedelete($_POST);
}

######################ez csak teszt
#var_dump($_POST);
echo("<br>");


#$database = new Database();
#$database->connect("LOCAL");

# Ciklussal megoldva
#$sql = "UPDATE items SET ";
#foreach ($_POST as $key => $value) {
#	if($key=="save"){
#		$sql = substr_replace($sql, "", -2);
#		$sql = $sql . " WHERE id=" . $value;
#	}
#	else{
#		$sql = $sql . $key . "=\"" . $value . "\", ";
#	}
#}
#echo($sql);
#$result = $database->sqlquery($sql);

# Én megoldásom
#$result = $database->sqlquery("UPDATE `items` SET `name` =" . " '" . $_POST['name'] . "' " . 
#	", `code` =" . " '" . $_POST['code'] . "' " . ", `quantity` =" . " '" . $_POST['quantity'] . "' "  . ", `unit` =" . " '" . $_POST['unit'] . "' " . ", `category` =" . " '" . $_POST['category'] . "' " . "WHERE `items`.`id` = " . $_POST['save']);

#header("location: items.php");
?>


