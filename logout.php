<?php

require "controllers/class_controllers.php";
require "models/class_models.php";
require "views/class_views.php";

if(array_key_exists("logout", $_POST)){
	session_unset();
	session_destroy();
}

var_dump($_POST);
header("Location: index.php");
?>