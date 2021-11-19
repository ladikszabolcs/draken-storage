<?php

require "views/class_views.php";
require "models/class_models.php";
require "controllers/class_controllers.php";


$database = new Database();
$view = new Views();


$database->connect("LOCAL");
$database->sqlquery("SHOW TABLES;");	//??????
$view->menuView();

if(array_key_exists("registry", $_POST)){
	$view->registryView();
}
elseif(array_key_exists("username", $_SESSION)){
	echo("<div style='margin-top:60px'>Huhú bejelentkezve</div>");
}
else{
	$view->loginView();
}





//$kimenet = $database->sqlquery("SELECT * FROM users WHERE email='robert'");

//var_dump($kimenet);





#var_dump($_SESSION)

?>