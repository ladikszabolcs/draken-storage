<?php

require "views/class_views.php";
require "models/class_models.php";
require "controllers/class_controllers.php";

$database = new Database();
$view = new Views();

$database->connect("LOCAL");
$database->sqlquery("SHOW TABLES;");	//??????
$view->menuView();
echo("<div style='margin-top:60px'></div>"); 

if(array_key_exists("error", $_GET)){
	$value = $_GET["error"];
	switch ($value) {
		case 'useralreadyexists':
			$view->errorMessageView("Ilyen felhasználó már létezik", "warning");
			break;
		case 'success':
			$view->errorMessageView("Siker!", "success");
			break;
		case 'passwordfail':
			$view->errorMessageView("Jelszó nem megfelelő!", "danger");
		default:
			break;
	}
}

if(array_key_exists("registry", $_POST)){
	$view->registryView();
}
elseif(array_key_exists("username", $_SESSION)){
	echo("<div style='margin-top:60px'>Huhú bejelentkezve</div>");
}
else{
	$view->loginView();
}

#var_dump($_SESSION);

//$kimenet = $database->sqlquery("SELECT * FROM users WHERE email='robert'");

//var_dump($kimenet);





#var_dump($_SESSION)

?>