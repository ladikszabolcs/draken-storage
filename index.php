<?php

require "controllers/class_controllers.php";
require "models/class_models.php";
require "views/class_views.php";

echo "Hello!";

$database = new Database();

$database->kiskutya("SHOW TABLES;");

echo "Mizu?";

?>