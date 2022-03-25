<?php

require "views/class_views.php";
require "models/class_models.php";
require "controllers/class_controllers.php";
require 'vendor/autoload.php';

$database = new Database();
$view = new Views();


$database->connect("LOCAL");
$view->menuView();

echo("<div style='margin-top:60px'></div>");
echo("<br>");
#var_dump($_GET);


if(array_key_exists("registry", $_POST)){
	$view->registryView();
}
elseif(array_key_exists("error", $_GET)){
	$value = $_GET["error"];
	switch ($value) {
		case 'useralreadyexits':
			$view->registryView();
			$view->errorMessageView("A felhasználónév foglalt" , "danger");
			break;
		case 'success':
			$view->errorMessageView("Siker!" , "success");
			break;
		case 'success2':
			$view->loginView();
			$view->errorMessageView("Siker!" , "success");
			break;
		case 'passwordfail':
			$view->errorMessageView("Hibás jelszó" , "danger");
			break;
		default:
			// code...
			break;
	}


	
}

elseif(array_key_exists("username", $_SESSION)){
		echo("<div style='margin-top:60px'>Huhú bejelentkezve</div>");
	}
	else{
		$view->loginView();
	
}



#$view->errorMessageView("teszt" , "succes");


//$kimenet = $database->sqlquery("SELECT * FROM users WHERE email='robert'");

//var_dump($kimenet);





#var_dump($_SESSION);

?>