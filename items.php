<?php

require "views/class_views.php";
require "models/class_models.php";
require "controllers/class_controllers.php";

$view = new Views();
$view->menuView();

$view->tableRenderView();

?>