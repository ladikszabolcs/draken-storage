<?php
require 'vendor/autoload.php';

$log = new Monolog\Logger('users');
$log->pushHandler(new Monolog\Handler\StreamHandler('users.log', Monolog\Logger::INFO));



?>