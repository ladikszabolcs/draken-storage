<?php

require 'vendor/autoload.php';

session_set_cookie_params(86400);
session_start();




class Database
{
	public $connection;
	public $server = "localhost";
	public $username;
	public $password;
	public $database = "raktarprojekt";

	function __construct()
	{

	}

	function connect($status)
	{
		switch ($status) {
			case 'LOCAL':
				$this->username = "root";
				$this->password = "";
				break;

			case 'SERVER':
				$this->username = "raktarprojekt";
				$this->password = "RakTar987+";
				break;
			
			default:
				
				break;
		}

		$this->connection=mysqli_connect($this->server,$this->username,$this->password,$this->database);
	}

	function sqlquery($sql)
	{
		$eredmenysql = mysqli_query($this->connection,$sql);
		if(is_bool($eredmenysql)){
			return $eredmenysql;
		}
		else{
			return mysqli_fetch_assoc($eredmenysql);
		}
	}

	function sqlqueryall($sql)
	{
		$eredmenysql = mysqli_query($this->connection,$sql);
		if(is_bool($eredmenysql)){
			return $eredmenysql;
		}
		else{
			return mysqli_fetch_all($eredmenysql, MYSQLI_ASSOC);
		}
	}

	function __destruct()
	{	
		mysqli_close($this->connection);
	}
}


	class Reports extends Database
	{
		
		function __construct(){
			$this->connect("LOCAL");
		}

		function getChartDates($from,$to){
			#return (strtotime($to)-strtotime($from))/86400;
			if($from && $to){
			$from = date_create_from_format("Y-m-d", $from);
			$to = date_create_from_format("Y-m-d", $to);
			$diff = date_diff($to,$from);
			$diff = $diff->days;	#kiszámolom hány nap
			$diff++;
		}
		else{
			$diff = 0;
		}
		$result ="";
		$date = $from;	#átveszem az induló dátumot
		for ($i=0; $i < $diff; $i++) { 
			$strdate = $date->format('Y-m-d');#dátumból szöveg 
		 	$result = $result . "'$strdate',";
		 	$date = date("Y-m-d", strtotime("+1 day", strtotime($strdate)));#szövegból idő +1 nap hozzáadása
		 	$date = date_create_from_format("Y-m-d", $date);#időből dátum
		 }
		 return $result;
		}

		function getChartData($from, $to){
			$dates = $this->getChartDates($from, $to);
			$dates = substr_replace($dates, "", -1);
			$datesarray = explode(",", $dates);
			if($from && $to){
				$itemssold = array();
				foreach ($datesarray as $key => $value) {
					$sql = "SELECT * FROM sales WHERE date=$value";
					$result = $this->sqlqueryall($sql);
					foreach ($result as $key => $value2) {
						$itemexits = 0;
						foreach ($itemssold as $key => $value3) {
							if($value2["itemid"]==$value3){
								$itemexits = 1;
							}
						}
						if($itemexits == 0){
							array_push($itemssold, $value2["itemid"]);
						}
					}

					echo("<br>");echo("<br>");
					var_dump($result);
				}
					echo("<br>");echo("<br>");
					var_dump($itemssold);
			}
		}

		function __destruct(){
			parent::__destruct();
		}
	}

	class Items extends Database
	{
		function __construct()
		{
			$this->connect("LOCAL");
		}

		function getItems()
		{
			$result = $this->sqlqueryall("SELECT * FROM items");
			return $result;
		}
		
		function updateItems($post)
		{
			$sql = "UPDATE items SET ";
			foreach ($post as $key => $value) {
				if($key=="save"){
					$sql = substr_replace($sql, "", -2);
					$sql = $sql . " WHERE id=" . $value;
				}
				else{
					$sql = $sql . $key . "=\"" . $value . "\", ";
				}
			}
			
			$result = $this->sqlquery($sql);
		}

		function addItem($post)
		{
			$sql = "INSERT INTO items (name, code, quantity, unit, category, image) VALUES(";
			foreach ($post as $key => $value) {
				if ($key=="save"){
					$sql = $sql;
				}
				else{
					$sql = $sql . "'" . $value . "',";
				}
			}
			$sql = substr_replace($sql, "", -1);
			$sql = $sql . ");";
			$result = $this->sqlquery($sql);

		}

		function deleteItem($id)
		{
			$sql = "DELETE FROM items WHERE id=" . $id . ";";
			$result = $this->sqlquery($sql);
		}

		function addquality($id)
		{
			$sql = "UPDATE items SET quantity = quantity + 1 WHERE id=$id";
			$result = $this->sqlquery($sql);
		}
		
		function delquality($id)
		{
			$sql = "UPDATE items SET quantity = quantity - 1 WHERE id=$id";
			$result = $this->sqlquery($sql);	
			$date = date("Y-m-d");
			$sql = "INSERT INTO sales VALUE ($id,1,'$date')";
			$result = $this->sqlquery($sql);
		}

		function getUnit($unit)
		{
			$result = $this->sqlquery("SELECT name FROM units WHERE id=" . $unit);
			return $result["name"];
		}
#		function getCategory($unit)
#		{
#			$result = $this->sqlquery("SELECT name FROM categories WHERE id=" . $unit);
#			return $result["name"];
#		}
		function getCategorys()
		{
			$result = $this->sqlqueryall("SELECT * FROM categories");
			return $result;
		}
		function massivedelete($post)
		{
			foreach ($post as $key => $value) {
				if(is_int($key)){
					$this->deleteItem($key);
				}
			}
		}
		function getUnits()
		{
			$result = $this->sqlqueryall("SELECT * FROM units");
			return $result;
		}

		function __destruct()
		{
			parent::__destruct();
		}
	}
?>