<?php

require "views/class_views.php";
require "models/class_models.php";
require "controllers/class_controllers.php";

if(!array_key_exists("username", $_SESSION)){
 header("location: index.php");
}

$view = new Views();
$view->menuView();

$view->tableRenderView();
$view->addItemView();

?>