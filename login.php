<?php

require "controllers/class_controllers.php";
require "models/class_models.php";
require "views/class_views.php";

var_dump($_POST);

$_SESSION['username']="teszt";

header("Location: index.php");
?>