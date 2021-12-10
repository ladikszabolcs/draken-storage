<?php

$array = [];

$array["id"] = NULL;

var_dump(isset($array["id"]));
var_dump($array);

function arrayteszt(){
	return $array = ["kutya" => "abc", "cica" => "def"];
}

var_dump(arrayteszt()["kutya"]);

?>