<?php

require "views/class_views.php";
require "models/class_models.php";
require "controllers/class_controllers.php";
require 'vendor/autoload.php';

$items = new Items();
$items->updateItems($_POST);

header("location: items.php");

?>