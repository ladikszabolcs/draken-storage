<?php

require "controllers/class_controllers.php";
require "models/class_models.php";
require "views/class_views.php";

$database = new Database();
$database->connect("LOCAL");
// 							   SELECT * FROM users WHERE email="ladikszabolcs@draken.hu"
$result = $database->sqlquery("SELECT * FROM users WHERE email=\"" . $_POST["username"] . "\"");

//var_dump("SELECT * FROM users WHERE email=" . $_POST["username"]);

var_dump($result);

var_dump($_POST);



$_SESSION['username']="teszt";

//header("Location: index.php");
?>