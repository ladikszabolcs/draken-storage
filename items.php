<?php

require "views/class_views.php";
require "models/class_models.php";
require "controllers/class_controllers.php";

if(!array_key_exists("username", $_SESSION)){
header("location: index.php");
}
$view = new Views();
$view->menuView();
$view->searchBarView();
$view->sortTableView();
$view->tableRenderView();
$view->addItemView();
echo("<p id=\"demo\"></p>");



?>