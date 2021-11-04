<?php

require "controllers/class_controllers.php";
require "models/class_models.php";
require "views/class_views.php";

$database = new Database();
$view = new Views();

$view->menuView();
$view->loginView();

$database->connect("LOCAL");

var_dump($_POST);

?>